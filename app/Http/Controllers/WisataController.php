<?php

namespace App\Http\Controllers;
use Auth;
use App\Wisata;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class WisataController extends Controller
{

	public $status = array('0' =>'Tidak Aktif' ,'1'=>'Aktif');
    protected $original_column = array(
      1 => "id",
      2 => "id_user",
      3 => "name"
    );
	public function index()
	{
		$title = 'xxx | xxxx';
        return view('xmanage/wisata/index',compact('title'));
	}
	public function getData(Request $request)
	{
		$limit = $request->length;
        $start = $request->start;
        $page  = $start +1;
        $search = $request->search['value'];
        $xwisata = Wisata::select('id','id_user','name','email','long_titude','late_titude','phone','address','slug','url','htm','description','image','status');

        // $xwisata->where('id_user','=',Auth()->user()->id );
        if(array_key_exists($request->order[0]['column'], $this->original_column)){
           $xwisata->orderByRaw($this->original_column[$request->order[0]['column']].' '.$request->order[0]['dir']);
        }
         if($search) {
          $xwisata->where(function ($query) use ($search) {

                  $query->orWhere('id','LIKE',"%{$search}%");
                  $query->orWhere('id_user','LIKE',"%{$search}%");
                  $query->orWhere('name','LIKE',"%{$search}%");
          });
        }
        $totalData = $xwisata->get()->count();
        // Filtered
        $totalFiltered = $xwisata->get()->count();
        // Paginate
        $xwisata->limit($limit);
        $xwisata->offset($start);
        $data = $xwisata->get();
        foreach ($data as $key=> $wisata)
        {
        	$enc= Crypt::encryptString($wisata->id);
            $action = "";
            $action .='<a href="'.route('xwisata.detail',$enc).'" class="btn btn-xs btn-success"><i class="fa fa-eye"></i> Detail</a>';
            $action .='<a href="'.route('xwisata.ubah',$enc).'" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i> Ubah</a>';
            $action .='<a href="#" onclick="deletewisata(this,'.$wisata->id.')" class="btn btn-xs btn-danger">
                          <i class="fa fa-trash"></i>
                          <span>Hapus</span></a>'; 
            $wisata->no         = $key+$page;
            $wisata->id         = $wisata->id;
            $wisata->name       = $wisata->name;
            $wisata->email      = $wisata->email;
            $wisata->namauser   = $wisata->user?$wisata->user->name:'';
            if ($wisata->image==null) {
            	$wisata->image       = '<img src="'.asset('media/no_avatar.png').'" width="50px" class="img-responsive">';
            } else {
            	$wisata->image       = '<img src="'.url($wisata->image).'" width="50px" class="img-responsive">';
            }
            if ($wisata->status=='1') {
            	$wisata->status ='<label class="btn btn-success btn-xs">Aktif</label>';
            } else {
            	$wisata->status ='<label class="btn btn-danger btn-xs">Tidak Aktif</label>';
            	
            }
            
            $wisata->phone      = $wisata->phone;
            $wisata->action     = $action;
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
     
      $title          = 'xxx | xxxx';
      $statusterpilih = 1;
      $pengelola = User::where('tipe',1)->get();
      $namapengelola = '';
      //dd($pengelola);
      return view('xmanage/wisata/form',['title'=>$title,'status'=>$this->status,'statusterpilih'=>$statusterpilih,'pengelola'=>$pengelola,'namapengelola'=>$namapengelola]);
    }
    public function ubah($id=null)
    {
      $decr=Crypt::decryptString($id);
      $wisata = Wisata::find($decr);
      $pengelola = User::where('tipe',1)->get();
      $namapengelola = $wisata->id_user;
      $statusterpilih = $wisata->status;

      if ($wisata) {
          $title = 'xxx | xxxx';
          return view('xmanage/wisata/form',['title'=>$title,'wisata'=>$wisata,'status'=>$this->status,'statusterpilih'=>$statusterpilih,'pengelola'=>$pengelola,'namapengelola'=>$namapengelola]);
      }
    }
    public function detail($id)
    {
      $decr=Crypt::decryptString($id);
      $title = 'xxx | xxxx';
      $wisata = Wisata::find($decr);
      $status = $this->status[$wisata->status];
      $pengelola = User::where('tipe',1)->get();

      if ($wisata) {
          return view('xmanage/wisata/detail',compact('wisata','title','status'));
      }
    }

    public function simpan(Request $request,$id=null)
    {
       
        // directory image
        $dir         = 'media/wisata/';
        if(!file_exists($dir)){
            mkdir($dir, 0777, true);
        }
        $image = $request->file('image');
        if($image == true){
          $file = 'wisata_'.rand(11111, 99999) . '.' . $image->getClientOriginalExtension();
          $extension = $image->getClientOriginalExtension();
          if ($extension=='jpg' || $extension=='JPG' || $extension=='jpeg' || $extension=='JPEG' || $extension=='png' || $extension=='PNG' ){
              $image->move($dir, $file);
              $path  = url($dir . $file);
          } else {
              $info = 'Ekstensi file salah.';
            if($id){
                  return redirect()->route('xwisata.ubah',$id)->with('message', ['status'=>'danger','info'=>$info]);
              }else{
                  return redirect()->route('xwisata.tambah')->with('message', ['status'=>'danger','info'=>$info]);
              }
          }
      }else{
        if ($id) {
          $wisata = Wisata::find($id);
          $path = $wisata->image;
        }else{
          $path='';
        }
      }
      if ($id) {
        $wisata = Wisata::find($id);
        $wisata->id_user        = $request->id_user;
        $wisata->name           = $request->name;
        $wisata->email          = $request->email;
        $wisata->long_titude    = $request->long_titude;
        $wisata->late_titude    = $request->late_titude;
        $wisata->phone          = $request->phone;
        $wisata->address        = $request->address;
        $wisata->slug           = str_slug($request->name,'-');
        $wisata->url            = $request->url;
        $wisata->htm            = $request->htm;
        $wisata->description    = $request->description;
        $wisata->image          = $path;
        $wisata->status         = $request->status;
        $wisata->id_user        = $request->pengelola;
        $wisata->save();
        $status = 'Data berhasil diubah.';
      }else {
        $wisata = new Wisata();
        $wisata->id_user        = $request->id_user;
        $wisata->name           = $request->name;
        $wisata->email          = $request->email;
        $wisata->long_titude    = $request->long_titude;
        $wisata->late_titude    = $request->late_titude;
        $wisata->phone          = $request->phone;
        $wisata->address        = $request->address;
        $wisata->slug           = str_slug($request->name,'-');
        $wisata->url            = $request->url;
        $wisata->htm            = $request->htm;
        $wisata->description    = $request->description;
        $wisata->image          = $path;
        $wisata->status         = $request->status;
        $wisata->id_user        = $request->pengelola;
        $wisata->save();
        $status = 'Data berhasil ditambahkan.';
      }
      return redirect()->route('xwisata.index')->with('message', ['status'=>'success','info'=>$status]);
    }
    public function hapus($id)
    {
    	$wisata = Wisata::find($id);
        $wisata->delete();
        return json_decode('success');
    }
    
}
