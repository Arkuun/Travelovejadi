<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Share;
use Illuminate\Support\Facades\Crypt;
use App\User;
class ShareController extends Controller
{
	private $status = array('0' => 'Pending' , '1' => 'Posting','2' => 'Blokir' );
	protected $original_column = array(
    1 => "status"
    );
	public function index()
	{
		$title = 'xxx | xxxx';
        return view('xmanage/share/index',compact('title'));
	}
	public function getData(Request $request)
	{
		$limit = $request->length;
        $start = $request->start;
        $page  = $start +1;
        $search = $request->search['value'];

        $xshare = Share::select('id','title','image','content','status','id_user','slug');
        if(array_key_exists($request->order[0]['column'], $this->original_column)){
           $xshare->orderByRaw($this->original_column[$request->order[0]['column']].' '.$request->order[0]['dir']);
        }
         if($search) {
          $xshare->where(function ($query) use ($search) {
                  $query->orWhere('content','LIKE',"%{$search}%");
          });
        }
        $totalData = $xshare->get()->count();
        // Filtered
        $totalFiltered = $xshare->get()->count();
        // Paginate
        $xshare->limit($limit);
        $xshare->offset($start);
        $data = $xshare->get();
        foreach ($data as $key=> $share)
        {
        	$enc= Crypt::encryptString($share->id);
            $action = "";
            $action .='<a href="'.route('xshare.detail',$enc).'" class="btn btn-xs btn-success"><i class="fa fa-eye"></i> Detail</a>';
            $action .='<a href="'.route('xshare.ubah',$enc).'" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i> Ubah</a>';
            $action .='<a href="#" onclick="deleteshare(this,'.$share->id.')" class="btn btn-xs btn-danger">
                          <i class="fa fa-trash"></i>
                          <span>Hapus</span></a>'; 
            $share->no         = $key+$page;
            $share->id         = $share->id;
            if ($share->image==null) {
            	$share->image       = '<img src="'.asset('media/no_avatar.png').'" width="50px" class="img-responsive">';
            } else {
            	$share->image   = '<img src="'.url($share->image).'" width="50px" class="img-responsive">';
            }
            
            $share->content      = $share->content;
            $share->title         = $share->title;
            $share->pengguna     = $share->user?$share->user->name:'';
            if ($share->status=='0') {
            	$share->status ='<label class="btn btn-warning btn-xs">Pending</label>';
            }elseif ($share->status=='1') {
            	$share->status ='<label class="btn btn-success btn-xs">Posting</label>';
            } 
            else {
            	$share->status ='<label class="btn btn-danger btn-xs">Blokir</label>';
            	
            }
            
            $share->action       = $action;
        }
        $json_data = array(
                    "draw"            => intval($request->input('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );
          
        return json_encode($json_data); 
	}
	public function tambah()
    {
     
      $title         = 'xxx | xxxx';
      $pengguna      = User::where('tipe',2)->get();
      $penggunaterpilih = '';

      $statusterpilih='1';
      return view('xmanage/share/form',['title'=>$title,'pengguna'=>$pengguna,'status'=>$this->status,'statusterpilih'=>$statusterpilih,'penggunaterpilih'=>$penggunaterpilih]);
    }
    public function ubah($id=null)
    {
      $decr=Crypt::decryptString($id);
      $pengguna      = User::where('tipe',2)->get();
      $share = Share::find($decr);
      $penggunaterpilih = $share->id_user;
      if ($share) {
          $title = 'xxx | xxxx';
            $statusterpilih=$share->status;

          return view('xmanage/share/form',['title'=>$title,'share'=>$share,'statusterpilih'=>$statusterpilih,'status'=>$this->status,'pengguna'=>$pengguna,'penggunaterpilih'=>$penggunaterpilih]);
      }
    }
    public function detail($id)
    {
      $decr=Crypt::decryptString($id);
      $title = 'xxx | xxxx';
      $share = Share::find($decr);
      $status = $this->status[$share->status]; 
      if ($share) {
          return view('xmanage/share/detail',compact('share','title','status'));
      }
    }
    public function simpan(Request $request,$id=null)
    {
       
        // directory image
        $dir         = 'media/share/';
        if(!file_exists($dir)){
            mkdir($dir, 0777, true);
        }
        $image = $request->file('foto');
        if($image == true){
          $file = 'share_'.rand(11111, 99999) . '.' . $image->getClientOriginalExtension();
          $extension = $image->getClientOriginalExtension();
          if ($extension=='jpg' || $extension=='JPG' || $extension=='jpeg' || $extension=='JPEG' || $extension=='png' || $extension=='PNG' ){
              $image->move($dir, $file);
              $path  = url($dir . $file);
          } else {
              $info = 'Ekstensi file salah.';
            if($id){
                  return redirect()->route('xshare.ubah',$id)->with('message', ['status'=>'danger','info'=>$info]);
              }else{
                  return redirect()->route('xshare.tambah')->with('message', ['status'=>'danger','info'=>$info]);
              }
          }
      }else{
        if ($id) {
          $share = Share::find($id);
          $path = $share->image;
        }else{
          $path='';
        }
      }
      if ($id) {
        $share = Share::find($id);
        $share->title         = $request->title;
        $share->status         = $request->status;
        $share->image           = $path;
        $share->content         = $request->content;
        $share->id_user         = $request->idname;
        $share->slug            = str_slug($request->title,'-');
        $share->save();
        $status = 'Data berhasil diubah.';
      }else {
        $share = new Share();
        $share->title         = $request->title;
        $share->status         = $request->status;
        $share->image           = $path;
        $share->content         = $request->content;
        $share->id_user         = $request->idname;
        $share->slug            = str_slug($request->title,'-');
        $share->save();
        $status = 'Data berhasil ditambahkan.';
      }
      return redirect()->route('xshare.index')->with('message', ['status'=>'success','info'=>$status]);
    }
    public function hapus($id)
    {
        $share = Share::find($id);
        $share->delete();
        return json_decode('success');
    }
}
