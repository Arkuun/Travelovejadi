<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\KategoriWahana;
use Illuminate\Support\Facades\Crypt;
class KategoriWahanaController extends Controller
{
  public $status = array('0' =>'Tidak Aktif' ,'1'=>'Aktif');
	protected $original_column = array(
      1 => "name",
      2 => "status",
      
    );
	public function index()
	{
		$title = 'xxx | xxxx';
        return view('xmanage/kategoriwahana/index',compact('title'));
	}
	public function getData(Request $request)
	{
		$limit = $request->length;
        $start = $request->start;
        $page  = $start +1;
        $search = $request->search['value'];

        $xkategoriwahana = KategoriWahana::select('id','name','status');
        if(array_key_exists($request->order[0]['column'], $this->original_column)){
           $xkategoriwahana->orderByRaw($this->original_column[$request->order[0]['column']].' '.$request->order[0]['dir']);
        }
         if($search) {
          $xkategoriwahana->where(function ($query) use ($search) {
                  $query->orWhere('name','LIKE',"%{$search}%");
                  $query->orWhere('status','LIKE',"%{$search}%");
                  
          });
        }
        $totalData = $xkategoriwahana->get()->count();
        // Filtered
        $totalFiltered = $xkategoriwahana->get()->count();
        // Paginate
        $xkategoriwahana->limit($limit);
        $xkategoriwahana->offset($start);
        $data = $xkategoriwahana->get();
        foreach ($data as $key=> $kategori)
        {
        	$enc= Crypt::encryptString($kategori->id);
            $action = "";
            $action .='<a href="'.route('xkategoriwahana.ubah',$enc).'" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i> Ubah</a>';
            $action .='<a href="#" onclick="deletekategori(this,'.$kategori->id.')" class="btn btn-xs btn-danger">
                          <i class="fa fa-trash"></i>
                          <span>Hapus</span></a>'; 
            if ($kategori->status=='1') {
            	$kategori->status ='<label class="btn btn-success btn-xs">Aktif</label>';
            } else {
            	$kategori->status ='<label class="btn btn-danger btn-xs">Tidak Aktif</label>';
            	
            }
            
            $kategori->no         = $key+$page;
            $kategori->id         = $kategori->id;
            $kategori->name       = $kategori->name;
            $kategori->action     = $action;
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
      $statusterpilih ='0';
      return view('xmanage/kategoriwahana/form',['title'=>$title,'status'=>$this->status,'statusterpilih'=>$statusterpilih]);
    }
    public function ubah($id=null)
    {
      $decr=Crypt::decryptString($id);
      $kategori = KategoriWahana::find($decr);
      if ($kategori) {
          $title = 'xxx | xxxx';
          $statusterpilih =$kategori->status;

          return view('xmanage/kategoriwahana/form',['title'=>$title,'kategori'=>$kategori,'statusterpilih'=>$statusterpilih,'status'=>$this->status]);
      }
    }
    
    public function simpan(Request $request,$id=null)
    {
       

      
      if ($id) {
        $kategori = KategoriWahana::find($id);
        $kategori->name           = $request->name;
        $kategori->status         = $request->status;
        
        $kategori->save();
        $info = 'Data berhasil diubah.';
      }else {
        $kategori = new KategoriWahana();
        $kategori->name           = $request->name;
        $kategori->status        = $request->status;
        
        $kategori->save();
        $info = 'Data berhasil ditambahkan.';
      }
      return redirect()->route('xkategoriwahana.index')->with('message', ['status'=>'success','info'=>$info]);
    }
    public function hapus($id)
    {
        $kategori = KategoriWahana::find($id);
        $kategori->delete();
        return json_decode('success');
    }
}
