<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Slider;
use App\User;
use Auth;
use DB;

class SliderController extends Controller
{
	public function status()
    {
      $x = array('0' =>'Tidak aktif' ,'1' =>'Aktif' );
      return $x;
    }
    public function index()
    {
    	$title = 'xxxxx| xxxx';
        $slider = Slider::orderBy('sort')->get();
        return view('xmanage/slider/index',compact('slider','slider','title'));
    }
    public function tambah()
    {
    	$statusselected='1';
    	$title = 'xxx|xxxx';
        return view('xmanage/slider/form',['status'=>$this->status(),'title'=>$title,'statusselected'=>$statusselected]);
    }
    public function ubah($id=null)
    {
    	$slider = Slider::find($id);
    	$statusselected=$slider->status;
    	$title = 'xxx|xxxx';
        return view('xmanage/slider/form',['status'=>$this->status(),'title'=>$title,'slider'=>$slider,'statusselected'=>$statusselected]);
    }
    public function save(Request $req,$id=null)
    {
    	// dd($req->status);
    	$dir         = 'media/slider/';
        if(!file_exists($dir)){
            mkdir($dir, 0777, true);
        }
        $image = $req->file('image');
	    // dd($image->getClientSize());
        if($image == true){
        	$file = 'slider_'.rand(11111, 99999) . '.' . $image->getClientOriginalExtension();
	        $fileSize    = round($image->getClientSize() / 1024);
	        $maxSize     = 2048 ; //2MB;
	        // dd($maxSize);
	        $extension = $image->getClientOriginalExtension();
	        if ($extension=='jpg' || $extension=='JPG' || $extension=='jpeg' || $extension=='JPEG' || $extension=='png' || $extension=='PNG' ){
	        	if ($fileSize <= $maxSize) {
	        		if ($image->getClientSize()==0) {
	        			$info = 'Ukuran File terlalu besar. Maksimal 2MB';
		        		if($id){
		                    return redirect()->route('slider.ubah',$id)->with('message', ['status'=>'danger','info'=>$info]);
		                }else{

		                    return redirect()->route('slider.tambah')->with('message', ['status'=>'danger','info'=>$info]);
		                }	
	        		}
	        		$image->move($dir, $file);
	                $path  = url($dir . $file);
					if($id) {
						$slider = Slider::find($id);
						if(file_exists($slider->image)){
                            unlink($slider->image);
                        }
						$info = 'Slider berhasil diubah';
					}else{
						$slider = new Slider;
						$newsort  = DB::table('slider')->max('sort');
						$slider->sort=$newsort+1;
						$info = 'Slider berhasil ditambahkan';
					}
					$slider->image   	= $path;
					$slider->url  		= $req->url;
					$slider->status 	= $req->status;
					$slider->save();
					return redirect()->route('slider.index')->with('message', ['status'=>'success','info'=>$info]);
	        	} 
	        	else {
	        	    $info = 'Ukuran File terlalu besar. Maksimal 2MB';
	        		if($id){
	                    return redirect()->route('slider.ubah',$id)->with('message', ['status'=>'danger','info'=>$info]);
	                }else{

	                    return redirect()->route('slider.tambah')->with('message', ['status'=>'danger','info'=>$info]);
	                }	 
	        	}
	        } else {
	            $info = 'Ekstensi file salah.';
	        	if($id){
	                return redirect()->route('slider.ubah',$id)->with('message', ['status'=>'danger','info'=>$info]);
	            }else{
	                return redirect()->route('slider.tambah')->with('message', ['status'=>'danger','info'=>$info]);
	            }
	        }
        }
        // Jika Gambar tidak diisi
        else{
			if($id)  {
				$slider = Slider::find($id);
				$info = 'Slider berhasil diubah';
			}else{
				$slider = new Slider;
				$newsort  = DB::table('slider')->max('sort');
				$slider->sort=$newsort+1;
				$info = 'Slider berhasil ditambahkan';
			}
			$slider->status  	= $req->status;
			$slider->url        = $req->url;

			$slider->save();
			return redirect()->route('slider.index')->with('message', ['status'=>'success','info'=>$info]);
        }
    }
    public function delete($id)
    {
        $slider = Slider::find($id);
        $slider->delete();
        return json_decode('success');
    }
    public function sorting(Request $request,$id){

     $this->doSorting($request->input('sorting'));
     
     return response()->json(['success'=>true]);
    }

    public function doSorting($data){
       for ($i=0; $i < sizeof($data); $i++) { 
        $slide    = Slider::find($data[$i]['id']);
        $slide->sort  = $data[$i]['sort'];
        $slide->save();
       }
    }
}
