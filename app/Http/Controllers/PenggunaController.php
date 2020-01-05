<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Crypt;

class PenggunaController extends Controller
{
    protected $original_column = array(
      1 => "name",
      2 => "email",
      3 => "no_hp"
    );
	public function index()
	{
		$title = 'xxx | xxxx';
    return view('xmanage/pengguna/index',compact('title'));
	}
	public function getData(Request $request)
	{
		    $limit = $request->length;
        $start = $request->start;
        $page  = $start +1;
        $search = $request->search['value'];

        $xpengguna = User::select('id','name','email','no_hp','foto');
        $xpengguna->where('tipe','2')->where('id','!=',Auth()->user()->id );
        if(array_key_exists($request->order[0]['column'], $this->original_column)){
           $xpengguna->orderByRaw($this->original_column[$request->order[0]['column']].' '.$request->order[0]['dir']);
        }
         if($search) {
          $xpengguna->where(function ($query) use ($search) {
                  $query->orWhere('name','LIKE',"%{$search}%");
                  $query->orWhere('email','LIKE',"%{$search}%");
                  $query->orWhere('no_hp','LIKE',"%{$search}%");
          });
        }
        $totalData = $xpengguna->get()->count();
        // Filtered
        $totalFiltered = $xpengguna->get()->count();
        // Paginate
        $xpengguna->limit($limit);
        $xpengguna->offset($start);
        $data = $xpengguna->get();
        foreach ($data as $key=> $pengguna)
        {
        	  $enc= Crypt::encryptString($pengguna->id);
            $action = "";
            $action .='<a href="'.route('xpengguna.detail',$enc).'" class="btn btn-xs btn-success"><i class="fa fa-eye"></i> Detail</a>';
            $action .='<a href="'.route('xpengguna.ubah',$enc).'" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i> Ubah</a>';
            $action .='<a href="#" onclick="deletepengguna(this,'.$pengguna->id.')" class="btn btn-xs btn-danger">
                          <i class="fa fa-trash"></i>
                          <span>Hapus</span></a>'; 
            $pengguna->no         = $key+$page;
            $pengguna->id         = $pengguna->id;
            $pengguna->name       = $pengguna->name;
            $pengguna->email      = $pengguna->email;
            if ($pengguna->foto==null) {
            	$pengguna->foto       = '<img src="'.asset('media/no_avatar.png').'" width="50px" class="img-responsive">';
            } else {
            	$pengguna->foto       = '<img src="'.url($pengguna->foto).'" width="50px" class="img-responsive">';
            }
            
            $pengguna->no_hp      = $pengguna->no_hp;
            $pengguna->action     = $action;
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
      return view('xmanage/pengguna/form',['title'=>$title]);
    }
    public function ubah($id=null)
    {
      $decr=Crypt::decryptString($id);
      $pengguna = User::find($decr);
      if ($pengguna) {
          $title = 'xxx | xxxx';
          return view('xmanage/pengguna/form',['title'=>$title,'pengguna'=>$pengguna]);
      }
    }
    public function detail($id)
    {
      $decr=Crypt::decryptString($id);
      $title = 'xxx | xxxx';
      $pengguna = User::find($decr);
      if ($pengguna) {
          return view('xmanage/pengguna/detail',compact('pengguna','title'));
      }
    }
    public function simpan(Request $request,$id=null)
    {
       
        // directory image
        $dir         = 'media/pengguna/';
        if(!file_exists($dir)){
            mkdir($dir, 0777, true);
        }
        $image = $request->file('foto');
        if($image == true){
          $file = 'pengguna_'.rand(11111, 99999) . '.' . $image->getClientOriginalExtension();
          $extension = $image->getClientOriginalExtension();
          if ($extension=='jpg' || $extension=='JPG' || $extension=='jpeg' || $extension=='JPEG' || $extension=='png' || $extension=='PNG' ){
              $image->move($dir, $file);
              $path  = url($dir . $file);
          } else {
              $info = 'Ekstensi file salah.';
            if($id){
                  return redirect()->route('xpengguna.ubah',$id)->with('message', ['status'=>'danger','info'=>$info]);
              }else{
                  return redirect()->route('xpengguna.tambah')->with('message', ['status'=>'danger','info'=>$info]);
              }
          }
      }else{
        if ($id) {
          $pengguna = User::find($id);
          $path = $pengguna->foto;
        }else{
          $path='';
        }
      }
      if ($id) {
        $pengguna = User::find($id);
        $pengguna->name           = $request->name;
        $pengguna->email          = $request->email;
        $pengguna->no_hp          = $request->no_hp;
        $pengguna->foto           = $path;
        $pengguna->no_hp          = $request->no_hp;
        $pengguna->alamat         = $request->alamat;
        $pengguna->save();
        $status = 'Data berhasil diubah.';
      }else {
        $pengguna = new User();
        $pengguna->name           = $request->name;
        $pengguna->email          = $request->email;
        $pengguna->password       = bcrypt($request->password);
        $pengguna->no_hp          = $request->no_hp;
        $pengguna->foto           = $path;
        $pengguna->no_hp          = $request->no_hp;
        $pengguna->alamat         = $request->alamat;
        $pengguna->tipe           = 2;
        $pengguna->save();
        $status = 'Data berhasil ditambahkan.';
      }
      return redirect()->route('xpengguna.index')->with('message', ['status'=>'success','info'=>$status]);
    }
    public function hapus($id)
    {
        $pengguna = User::find($id);
        $pengguna->delete();
        return json_decode('success');
    }
}
