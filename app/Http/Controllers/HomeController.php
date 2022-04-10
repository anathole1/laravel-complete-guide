<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Image;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function HomeSlider(){
        $sliders = Slider::latest()->paginate(10);
        return view('admin.slider.index', compact('sliders'));
    }

    public function AddSlider(Request $request){
        $validateData = $request->validate([
            'title' =>'required|min:5',
            'description' => 'required',
            'image'=>'required|mimes:jpg,jpeg,png'
        ]);
        $Slider_image = $request->file('image');
     

        // Image Intervention

        $name_gen = hexdec(uniqid()).'.'.$Slider_image->getClientOriginalExtension();
        Image::make($Slider_image)->resize(1920,1088)->save('image/slider/'.$name_gen);
        $last_img= 'image/slider/'.$name_gen;

        Slider::insert([
            'title' => $request->title,
            'description' =>$request->description,
            'image' => $last_img,
            'created_at' => Carbon::now() 
        ]);

        return Redirect()->back()->with('success', 'Slider Inserted Successfull');
    }
}
