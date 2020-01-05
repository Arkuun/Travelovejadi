<?php

namespace App\Http\Controllers;
use Auth;
use App\Wahana;
use App\User;
use App\Wisata;
use App\KategoriWahana;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class WahanaController extends Controller
{

	public $status = array('0' =>'Tidak Aktif' ,'1'=>'Aktif');
    protected $original_column = array(
      1 => "id",
      2 => "id_wisata",
      3 => "id_kat_wahana",
      4 => "id_user",
      5 => "name"
    );
	public function index()
	{
		$title = 'xxx | xxxx';
        return view('xmanage/wahana/index',compact('title'));
	}
	public function getData(Request $request)
	{
		$limit = $request->length;
        $start = $request->start;
        $page  = $start +1;
        $search = $request->search['value'];
        $xwahana = Wahana::select('id','id_wisata','id_user','id_kat_wahana','name','description','htm','status');

        
        if(array_key_exists($request->order[0]['column'], $this->original_column)){
           $xwahana->orderByRaw($this->original_column[$request->order[0]['column']].' '.$request->order[0]['dir']);
        }
         if($search) {
          $xwahana->where(function ($query) use ($search) {

                  $query->orWhere('id','LIKE',"%{$search}%");
                  $query->orWhere('id_user','LIKE',"%{$search}%");
                  $query->orWhere('id_wisata','LIKE',"%{$search}%");
                  $query->orWhere('id_kat_wahana','LIKE',"%{$search}%");
                  $query->orWhere('name','LIKE',"%{$search}%");
          });
        }
        $totalData = $xwahana->get()->count();
       
        $totalFiltered = $xwahana->get()->count();
       
        $xwahana->limit($limit);
        $xwahana->offset($start);
        $data = $xwahana->get();
        foreach ($data as $key=> $wahana)
        {
        	$enc= Crypt::encryptString($wahana->id);
            $action = "";
            $action = ' <div class="btn-group  btn-group-xs">
                        <a href="'.route('xwahana.detail',$enc).'" class="btn btn-xs btn-success"><i class="fa fa-eye"></i> Detail</a>
                         <a href="'.route('xwahana.ubah',$enc).'"  class="btn btn-xs btn-warning"><i class="fa fa-eye"></i>Ubah</a>
                        <a href="#" onclick="deletewahana(this,'.$wahana->id.')" class="btn btn-xs btn-danger">
                          <i class="fa fa-trash"></i>
                         <span>Hapus</span></a>
                      </div>';
            
            $wahana->no        		 = $key+$page;
            $wahana->id        			 = $wahana->id;
            $wahana->id_wisata    			   = $wahana->id_wisata?$wahana->wisata->name:'';
            $wahana->id_kat_wahana      = $wahana->kategoriwahana?$wahana->kategoriwahana->name:'';
            $wahana->name 				= $wahana->name;
            $wahana->namauser 			  = $wahana->user?$wahana->user->name:'';
            if ($wahana->image==null) {
            	$wahana->image       = '<img src="'.asset('media/no_avatar.png').'" width="50px" class="img-responsive">';
            } else {
            	$wahana->image       = '<img src="'.url($wahana->image).'" width="50px" class="img-responsive">';
            }
            
            
            $wahana->htm      = $wahana->htm;
            $wahana->action     = $action;
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
      $namawisata = Wisata::where('status',1)->get();
      $kategoriwahana = KategoriWahana::where('status',1)->get();
      $namapengelola = '';
      $tempatwisata = '';
      $jeniswahana = '';
      //dd($pengelola);
      return view('xmanage/wahana/form',['title'=>$title,'status'=>$this->status,'statusterpilih'=>$statusterpilih,'pengelola'=>$pengelola,'namapengelola'=>$namapengelola,'namawisata'=>$namawisata,'tempatwisata'=>$tempatwisata,'kategoriwahana'=>$kategoriwahana,'jeniswahana'=>$jeniswahana]);
    }
    public function ubah($id=null)
    {
      $decr=Crypt::decryptString($id);
      $wahana = Wahana::find($decr);
      $pengelola = User::where('tipe',1)->get();
      
      $namawisata = Wisata::where('status',1)->get();
      
      $kategoriwahana = KategoriWahana::where('status',1)->get();
      
      $statusterpilih = $wahana->status;
      $namapengelola = $wahana->id_user;
      $tempatwisata = $wahana->id_wisata;
      $jeniswahana = $wahana->id_kat_wahana;
      if ($wahana) {
          $title = 'xxx | xxxx';
          return view('xmanage/wahana/form',['title'=>$title,'status'=>$this->status,'statusterpilih'=>$statusterpilih,'pengelola'=>$pengelola,'namapengelola'=>$namapengelola,'namawisata'=>$namawisata,'tempatwisata'=>$tempatwisata,'kategoriwahana'=>$kategoriwahana,'jeniswahana'=>$jeniswahana,'wahana'=>$wahana]);
      }
    }
    public function detail($id)
    {
      $decr=Crypt::decryptString($id);
      $title = 'xxx | xxxx';
      $wahana = Wahana::find($decr);
      
		if ($wahana->status=='1') {
            	$wahana->status ='Aktif';
            } else {
            	$wahana->status ='Tidak Aktif';
            	
            }
      $pengelola = User::where('tipe',1)->get();

      if ($wahana) {
          return view('xmanage/wahana/detail',compact('wahana','title','status'));
      }
    }

    public function simpan(Request $request,$id=null)
    {
       
        
        $dir         = 'media/wahana/';
        if(!file_exists($dir)){
            mkdir($dir, 0777, true);
        }
        $image = $request->file('image');
        if($image == true){
          $file = 'wahana_'.rand(11111, 99999) . '.' . $image->getClientOriginalExtension();
          $extension = $image->getClientOriginalExtension();
          if ($extension=='jpg' || $extension=='JPG' || $extension=='jpeg' || $extension=='JPEG' || $extension=='png' || $extension=='PNG' ){
              $image->move($dir, $file);
              $path  = url($dir . $file);
          } else {
              $info = 'Ekstensi file salah.';
            if($id){
                  return redirect()->route('xwahana.ubah',$id)->with('message', ['status'=>'danger','info'=>$info]);
              }else{
                  return redirect()->route('xwahana.tambah')->with('message', ['status'=>'danger','info'=>$info]);
              }
          }
      }else{
        if ($id) {
          $wahana = Wahana::find($id);
          $path = $wahana->image;
        }else{
          $path='';
        }
      }
      if ($id) {
        $wahana = Wahana::find($id);
        $wahana->id_wisata        = $request->id_wisata;
        $wahana->id_user           = $request->id_user;
        $wahana->id_kat_wahana      = $request->id_kat_wahana;
        $wahana->name    		= $request->name;
        $wahana->description    = $request->description;
        $wahana->htm         	 = $request->htm;
        $wahana->status       	 = $request->status;
        $wahana->id_wisata       	 = $request->namawisata;
        $wahana->id_kat_wahana     	  = $request->id_kat_wahana;
        $wahana->image 			 	 = $path;
        $wahana->id_user        	 = $request->pengelola;
        $wahana->save();
        $status = 'Data berhasil diubah.';
      }else {
        $wahana = new Wahana();
        $wahana->id_wisata       	 = $request->id_wisata;
        $wahana->id_user       		 = $request->id_user;
        $wahana->id_kat_wahana     	  = $request->id_kat_wahana;
        $wahana->name  				  = $request->name;
        $wahana->description  		  = $request->description;
        $wahana->htm        		  = $request->htm;
        $wahana->status      		  = $request->status;
        $wahana->id_wisata       	 = $request->namawisata;
        $wahana->id_kat_wahana     	  = $request->id_kat_wahana;
        $wahana->image 			 	 = $path;
        $wahana->id_user        	 = $request->pengelola;
        $wahana->save();
        $status = 'Data berhasil ditambahkan.';
      }
      return redirect()->route('xwahana.index')->with('message', ['status'=>'success','info'=>$status]);
    }
    public function hapus($id)
    {
    	$wahana = Wahana::find($id);
        $wahana->delete();
        return json_decode('success');
    }
    
}
