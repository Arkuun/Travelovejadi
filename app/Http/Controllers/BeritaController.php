<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Berita;
use App\User;
use App\Kategori;
use Auth;

use Illuminate\Support\Facades\Crypt;

class BeritaController extends Controller
{
	protected $original_column = array(
		1	=>	"id",
		2	=>	"id_user",
		3	=>	"id_kat",
		4	=>	"title"
	);

	public function index()
	{
		$title = 'xxx | xxxx';
		return view('xmanage/berita/index',compact('title'));

	}

	public function getData(Request $request)
	{
		$limit		= $request->length;
		$start		= $request->start;
		$page		= $start +1;
		$search		= $request->search['value'];
		$xberita	= Berita::select('id','id_user','id_kat','title','description','image','slug','view','love','tag');

		if (array_key_exists($request->order[0]['column'], $this->original_column)) {
			$xberita->orderByRaw($this->original_column[$request->order[0]['column']].' '.$request->order[0]['dir']);
		}
		if ($search) {
			$xberita->where(function ($query) use ($search){

				$query->orWhere('id','LIKE',"%{$search}%");
				$query->orWhere('id_user','LIKE',"%{$search}%");
				$query->orWhere('id_kat','LIKE',"%{$search}%");
				$query->orWhere('title','LIKE',"%{$search}%");
			});
		}

		$totalData		= $xberita->get()->count();
		//Filtered
		$totalFiltered	= $xberita->get()->count();
		//Paginate
		$xberita->limit($limit);
		$xberita->offset($start);
		$data 			= $xberita->get();

		foreach ($data as $key => $berita) 
		{
			$enc= Crypt::encryptString($berita->id);
			$action = "";
			$action .='<a href="'.route('xberita.detail',$enc).'" class="btn btn-xs btn-success"><i class="fa fa-eye"></i> Detail</a>';

			$action .='<a href="'.route('xberita.ubah',$enc).'" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i> Ubah</a>';

			$action .='<a href="#" onclick="deleteberita(this,'.$berita->id.')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i><span>Hapus</span></a>';

			$berita->no 		= $key+$page;
			$berita->id 		= $berita->id;
			$berita->namauser 	= $berita->user?$berita->user->name:'';
			$berita->katber 	= $berita->kategori?$berita->kategori->name:'';
			$berita->title 		= $berita->title;
			$berita->action 	= $action;
		}
		$json_data	=	array(
							"draw"				=> intval($request->input('draw')),
							"recordsTotal"		=> intval($totalData),
							"recordsFiltered"	=> intval($totalFiltered),
							"data"				=> $data
						);
		return json_encode($json_data);
	}

	public function tambah()
	{
		$title 			=  'xxx | xxxx';
		$katpilih		=	Kategori::where('status',1)->get();
		$namakat		=	'';
		$pengelola		=	User::where('tipe',1)->get();
		$namapengelola	=	'';

		return view('xmanage/berita/form',['title'=>$title,'katpilih'=>$katpilih,'namakat'=>$namakat,'pengelola'=>$pengelola,'namapengelola'=>$namapengelola]);
	}

	public function ubah($id=null)
	{
		$decr 			= Crypt::decryptString($id);
		$berita 		= Berita::find($decr);
		$katpilih		= Kategori::where('status',1)->get();
		$namakat 		= $berita->id_kat;
		$pengelola		= User::where('tipe',1)->get();
		$namapengelola 	= $berita->id_user;

		if ($berita) {
			
			$title 			=  'xxx | xxxx';
			return view('xmanage/berita/form',['title'=>$title,'berita'=>$berita,'katpilih'=>$katpilih,'namakat'=>$namakat,'pengelola'=>$pengelola,'namapengelola'=>$namapengelola]);
		}
	}

	public function detail($id)
	{
		$decr 			= Crypt::decryptString($id);
		$berita 		= Berita::find($decr);
		$title 			=  'xxx | xxxx';
		$katpilih		= Kategori::where('status',1)->get();
		$pengelola		= User::where('tipe',1)->get();

		if ($berita) {
			return view('xmanage/berita/detail',compact('berita','title'));
		}

	}

	public function simpan(Request $request,$id=null)
	{

		//directory image
		$dir 			= 'media/berita/';
		if (!file_exists($dir)) {
			mkdir($dir,0777,true);
		}
		$image			= $request->file('image');
		if ($image == true) {
			$file = 'berita_'.rand(11111, 99999) . '.' . $image->getClientOriginalExtension();
			$extension = $image->getClientOriginalExtension();
			if ($extension=='jpg' || $extension=='JPG' || $extension=='jpeg' || $extension=='JPEG'|| $extension=='png' || $extension=='PNG') {
				$image->move($dir,$file);
				$path	= url($dir . $file);
			}else{
				$info	= 'Ekstensi file salah.';
				if ($id) {
					return redirect()->route('xberita.ubah',$id)->with('message', ['status'=>'danger','info'=>$info]);
				}else{
					return redirect()->route('xberita.tambah',$id)->with('message', ['status'=>'danger','info'=>$info]);
				}
			}
		}else{
			if ($id) {
				$berita = Berita::find($id);
				$path	= $berita->image;
			}else{
				$path	= '';
			}
		}

		if ($id) {
			$berita = Berita::find($id);
			$berita->id_user 			= $request->pengelola;
			$berita->id_kat 			= $request->katpilih;
			$berita->title 				= $request->title;
			$berita->description 		= $request->description;
			$berita->image 				= $path;
			$berita->slug 				= str_slug($request->title,'-');
			$berita->tag 				= $request->tag;
			// $berita->view 				= 0;
			// $berita->love 				= 0;
			$berita->save();
			$status = 'Data Berhasil diubah.';
		}else{
			$berita = new Berita();
			$berita->id_user 			= $request->pengelola;
			$berita->id_kat 			= $request->katpilih;
			$berita->title 				= $request->title;
			$berita->description 		= $request->description;
			$berita->image 				= $path;
			$berita->slug 				= str_slug($request->title,'-');
			$berita->tag 				= $request->tag;
			// $berita->view 				= 0;
			// $berita->love 				= 0;
			$berita->save();
			$status = 'Data Berhasil ditambahkan.';
		}
		return redirect()->route('xberita.index')->with('message',['status'=>'success','info'=>$status]);
	}

	public function hapus($id)
	{
		$berita = Berita::find($id);
		$berita->delete();
		return json_decode('success');
	}
	
}