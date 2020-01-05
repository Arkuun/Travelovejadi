<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Illuminate\Support\Facades\Crypt;
class AdminController extends Controller
{
	protected $original_column = array(
      1 => "name",
      2 => "email",
      3 => "no_hp"
    );
	public function index()
	{
		$title = 'xxx | xxxx';
    return view('xmanage/admin/index',compact('title'));
	}
	public function getData(Request $request)
	{
		    $limit = $request->length;
        $start = $request->start;
        $page  = $start +1;
        $search = $request->search['value'];

        $xadmin = User::select('id','name','email','no_hp','foto');
        $xadmin->where('tipe','0')->where('id','!=',Auth()->user()->id );
        if(array_key_exists($request->order[0]['column'], $this->original_column)){
           $xadmin->orderByRaw($this->original_column[$request->order[0]['column']].' '.$request->order[0]['dir']);
        }
         if($search) {
          $xadmin->where(function ($query) use ($search) {
                  $query->orWhere('name','LIKE',"%{$search}%");
                  $query->orWhere('email','LIKE',"%{$search}%");
                  $query->orWhere('no_hp','LIKE',"%{$search}%");
          });
        }
        $totalData = $xadmin->get()->count();
        // Filtered
        $totalFiltered = $xadmin->get()->count();
        // Paginate
        $xadmin->limit($limit);
        $xadmin->offset($start);
        $data = $xadmin->get();
        foreach ($data as $key=> $admin)
        {
        	  $enc= Crypt::encryptString($admin->id);
            $action = "";
            $action .='<a href="'.route('xadmin.detail',$enc).'" class="btn btn-xs btn-success"><i class="fa fa-eye"></i> Detail</a>';
            $action .='<a href="'.route('xadmin.ubah',$enc).'" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i> Ubah</a>';
            $action .='<a href="#" onclick="deleteadmin(this,'.$admin->id.')" class="btn btn-xs btn-danger">
                          <i class="fa fa-trash"></i>
                          <span>Hapus</span></a>'; 
            $admin->no         = $key+$page;
            $admin->id         = $admin->id;
            $admin->name       = $admin->name;
            $admin->email      = $admin->email;
            if ($admin->foto==null) {
            	$admin->foto       = '<img src="'.asset('media/no_avatar.png').'" width="50px" class="img-responsive">';
            } else {
            	$admin->foto       = '<img src="'.url($admin->foto).'" width="50px" class="img-responsive">';
            }
            
            $admin->no_hp      = $admin->no_hp;
            $admin->action     = $action;
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
      return view('xmanage/admin/form',['title'=>$title]);
    }
    public function ubah($id=null)
    {
      $decr=Crypt::decryptString($id);
      $admin = User::find($decr);
      if ($admin) {
          $title = 'xxx | xxxx';
          return view('xmanage/admin/form',['title'=>$title,'admin'=>$admin]);
      }
    }
    public function detail($id)
    {
      $decr=Crypt::decryptString($id);
      $title = 'xxx | xxxx';
      $admin = User::find($decr);
      if ($admin) {
          return view('xmanage/admin/detail',compact('admin','title'));
      }
    }
    public function simpan(Request $request,$id=null)
    {
       
        // directory image
        $dir         = 'media/admin/';
        if(!file_exists($dir)){
            mkdir($dir, 0777, true);
        }
        $image = $request->file('foto');
        if($image == true){
          $file = 'admin_'.rand(11111, 99999) . '.' . $image->getClientOriginalExtension();
          $extension = $image->getClientOriginalExtension();
          if ($extension=='jpg' || $extension=='JPG' || $extension=='jpeg' || $extension=='JPEG' || $extension=='png' || $extension=='PNG' ){
              $image->move($dir, $file);
              $path  = url($dir . $file);
          } else {
              $info = 'Ekstensi file salah.';
            if($id){
                  return redirect()->route('xadmin.ubah',$id)->with('message', ['status'=>'danger','info'=>$info]);
              }else{
                  return redirect()->route('xadmin.tambah')->with('message', ['status'=>'danger','info'=>$info]);
              }
          }
      }else{
        if ($id) {
          $admin = User::find($id);
          $path = $admin->foto;
        }else{
          $path='';
        }
      }
      if ($id) {
        $admin = User::find($id);
        $admin->name           = $request->name;
        $admin->email          = $request->email;
        $admin->no_hp          = $request->no_hp;
        $admin->foto           = $path;
        $admin->no_hp          = $request->no_hp;
        $admin->alamat         = $request->alamat;
        $admin->save();
        $status = 'Data berhasil diubah.';
      }else {
        $admin = new User();
        $admin->name           = $request->name;
        $admin->email          = $request->email;
        $admin->password       = bcrypt($request->password);
        $admin->no_hp          = $request->no_hp;
        $admin->foto           = $path;
        $admin->no_hp          = $request->no_hp;
        $admin->alamat         = $request->alamat;
        $admin->tipe           = 0;
        $admin->save();
        $status = 'Data berhasil ditambahkan.';
      }
      return redirect()->route('xadmin.index')->with('message', ['status'=>'success','info'=>$status]);
    }
    public function hapus($id)
    {
        $admin = User::find($id);
        $admin->delete();
        return json_decode('success');
    }
}
