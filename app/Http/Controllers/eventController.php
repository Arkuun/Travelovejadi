<?php

namespace App\Http\Controllers;
use Auth;
use App\Event;
use App\User;
use App\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class EventController extends Controller
{

	public $status = array('0' =>'Tidak Aktif' ,'1'=>'Aktif');
  protected $original_column = array(
    1 => "nama",
    2 => "date_end",
    3 => "date_start",
    4 => "status"
    );

  // public function status()
    // {
      // $status = array('0' =>'Tidak aktif' ,'1' =>'Aktif' );
      // return $status;
    // }
	public function index()
	{
		$title = 'xxx | xxxx';
    $event = Event::all();
        return view('xmanage/event/index',compact('title'));
	}
	public function getData(Request $request)
	{
		$limit = $request->length;
        $start = $request->start;
        $page  = $start +1;
        $search = $request->search['value'];
        $xevent = Event::select('id','id_wisata','id_user','nama','image','description','date_start','date_end','slug_event','tag','status');
        // $xevent->where('id','=',Auth()->user()->id );       
        if(array_key_exists($request->order[0]['column'], $this->original_column)){
           $xevent->orderByRaw($this->original_column[$request->order[0]['column']].' '.$request->order[0]['dir']);
        }
         if($search) {
          $xevent
          ->where(function ($query) use ($search) {
                  $query->orWhere('nama','LIKE',"%{$search}%");
                  $query->orWhere('date_end','LIKE',"%{$search}%");
                  $query->orWhere('date_start','LIKE',"%{$search}%");
                  $query->orWhere('status','LIKE',"%{$search}%");
          });
        }
        $totalData = $xevent->get()->count();
        
        // Filtered
        $totalFiltered = $xevent->get()->count();
        // Paginate
        $xevent->limit($limit);
        $xevent->offset($start);
        $data = $xevent->get();
        foreach ($data as $key=> $event)
        {
        	$enc= Crypt::encryptString($event->id);
            $action = "";
            $action .='<a href="'.route('xevent.detail',$enc).'" class="btn btn-xs btn-success"><i class="fa fa-eye"></i> Detail</a>';
            $action .='<a href="'.route('xevent.ubah',$enc).'" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i> Ubah</a>';
            $action .='<a href="#" onclick="deleteevent(this,'.$event->id.')" class="btn btn-xs btn-danger">
                          <i class="fa fa-trash"></i>
                          <span>Hapus</span></a>'; 
           if ($event->status=='1') {
              $event->status ='<label class="btn btn-success btn-xs">Aktif</label>';
            } else {
              $event->status ='<label class="btn btn-danger btn-xs">Tidak Aktif</label>';
              
            }
            $event->no         = $key+$page;
            $event->id         = $event->id;
            $event->namawisata = $event->wisata?$event->wisata->name:'';
            $event->pengguna   = $event->user?$event->user->name:'';
            $event->nama       = $event->nama;
            
            if ($event->image==null) {
            	$event->image       = '<img src="'.asset('media/no_avatar.png').'" width="50px" class="img-responsive">';
            } else {
            	$event->image       = '<img src="'.url($event->image).'" width="50px" class="img-responsive">';
            }
            
            $event->description = $event->description;
            $event->date_start  = $event->date_start;
            $event->date_end    = $event->date_end;
            $event->status      = $event->status;
            $event->action      = $action;
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
     $wisata        = Wisata::where('status',1)->get();
     $pengguna      = User::where('tipe',2)->get();
     $namawisata     = '';
     $penggunaterpilih='';
     $statusterpilih='1';
      return view('xmanage/event/form',['title'=>$title,'wisata'=>$wisata,'pengguna'=>$pengguna,'status'=>$this->status,'statusterpilih'=>$statusterpilih,'namawisata'=>$namawisata,'penggunaterpilih'=>$penggunaterpilih]);
    
    }
    public function ubah($id=null)
    {
      $decr=Crypt::decryptString($id);
      $event         = Event::find($decr);
      $wisata        = Wisata::where('status',1)->get();
      $pengguna      = User::where('tipe',2)->get();
      $penggunaterpilih=$event->id_user;
      $namawisata    = $event->id_wisata;
      $statusterpilih = $event->status;
      if ($event) {
          $title = 'xxx | xxxx';
          $statusterpilih=$event->status;
          return view('xmanage/event/form',['title'=>$title,'wisata'=>$wisata,'pengguna'=>$pengguna,'status'=>$this->status,'statusterpilih'=>$statusterpilih,'namawisata'=>$namawisata,'penggunaterpilih'=>$penggunaterpilih,'event'=>$event]);
      }
    }
    public function detail($id)
    {
      $decr=Crypt::decryptString($id);
      $title = 'xxx | xxxx';
      $event = Event::find($decr);
      $wisata = $event->wisata->name;
      $status = $this->status[$event->status]; 
      $pengguna = User::where('tipe',2)->get();
      if ($event) {
          return view('xmanage/event/detail',compact('event','title','wisata','status','pengguna'));
      }
    }
    public function simpan(Request $request,$id=null)
    {
     
        // directory image
        $dir         = 'media/event/';
        if(!file_exists($dir)){
            mkdir($dir, 0777, true);
        }
        $image = $request->file('image');
        if($image == true){
          $file = 'event_'.rand(11111, 99999) . '.' . $image->getClientOriginalExtension();
          $extension = $image->getClientOriginalExtension();
          if ($extension=='jpg' || $extension=='JPG' || $extension=='jpeg' || $extension=='JPEG' || $extension=='png' || $extension=='PNG' ){
              $image->move($dir, $file);
              $path  = url($dir . $file);
          } else {
              $info = 'Ekstensi file salah.';
            if($id){
                  return redirect()->route('xevent.ubah',$id)->with('message', ['status'=>'danger','info'=>$info]);
              }else{
                  return redirect()->route('xevent.tambah')->with('message', ['status'=>'danger','info'=>$info]);
              }
          }
      }else{
        if ($id) {
          $event = Event::find($id);
          $path = $event->image;
        }else{
          $path='';
        }
      }
      if ($id) {
        $event = Event::find($id);
        $event->nama            = $request->nama;
        $event->image           = $path;
        $event->description     = $request->description;
        $event->date_end        = date('Y-m-d', strtotime($request->date_end));     
        $event->date_start      = date('Y-m-d', strtotime($request->date_start)); 
        $event->tag             = $request->tag;
        $event->slug_event      = str_slug($request->nama,'-');
        $event->id_user         = $request->pengguna;
        $event->id_wisata       = $request->wisata;
        $event->status          = $request->status;
        $event->save();
        $status = 'Data berhasil diubah.';
      }else {
        $event = new Event();
        $event->nama            = $request->nama;
        $event->image           = $path;
        $event->description     = $request->description;
        $event->date_end        = date('Y-m-d', strtotime($request->date_end));     
        $event->date_start      = date('Y-m-d', strtotime($request->date_start));
        $event->tag             = $request->tag;
        $event->slug_event      = str_slug($request->nama,'-');
        $event->id_user         = $request->pengguna;
        $event->id_wisata       = $request->wisata;
        $event->status          = $request->status;
        $event->save();
        $status = 'Data berhasil ditambahkan.';
      }
      return redirect()->route('xevent.index')->with('message', ['status'=>'success','info'=>$status]);
    }
    public function hapus($id)
    {
        $event = Event::find($id);
        $event->delete();
        return json_decode('success');
    }
}
