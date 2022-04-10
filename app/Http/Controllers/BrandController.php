<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\MultiPic;
use Auth;
use Illuminate\Support\Carbon;
use Image;
class BrandController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }
    public function AllBrand(){
        $allbrands = Brand::latest()->paginate(8);
        return view('admin.brand.index', compact('allbrands'));
    }
    public function StoreBrand(Request $request){
        $validateDate = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpg,jpeg,png',
        ]);

        $brand_image = $request->file('brand_image');
        // $name_gen = hexdec(uniqid());
        // $img_ext = strtolower($brand_image->getClientOriginalExtension());
        // $img_name = $name_gen.'.'.$img_ext;
        // $up_location = 'image/brand/';
        // $last_img = $up_location.$img_name;
        // $brand_image->move($up_location,$img_name);

        // Image Intervention

        $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(100,70)->save('image/brand/'.$name_gen);
        $last_img= 'image/brand/'.$name_gen;

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now() 
        ]);

        return Redirect()->back()->with('success', 'Brand Inserted Successfull');
    }
    public function Edit($id){
        $brands = Brand::find($id);
        return view('admin.brand.edit', compact('brands'));
    }

    public function Update(Request $request, $id){
        $validateDate = $request->validate([
            'brand_name' => 'required|min:4',
            //'brand_image' => 'required|mimes:jpg,jpeg,png',
        ]);
        $old_image = $request->old_image;
        $brand_image = $request->file('brand_image');
        if($brand_image){

            // $name_gen = hexdec(uniqid());
            // $img_ext = strtolower($brand_image->getClientOriginalExtension());
            // $img_name = $name_gen.'.'.$img_ext;
            // $up_location = 'image/brand/';
            // $last_img = $up_location.$img_name;
            // $brand_image->move($up_location,$img_name);

            // Image Intervention

            $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
            Image::make($brand_image)->resize(100,70)->save('image/brand/'.$name_gen);
            $last_img= 'image/brand/'.$name_gen;
    
            unlink($old_image);
            Brand::find($id)->update([
                'brand_name' =>$request->brand_name,
                'brand_image' =>$last_img,
                'created_at' =>Carbon::now()
            ]);
            return Redirect()->route('all.brand')->with('success', 'Brand Updated Successfull');
        }else{
            Brand::find($id)->update([
                'brand_name' =>$request->brand_name,
                //'brand_image' =>$last_img,
                'created_at' =>Carbon::now()
            ]);
            return Redirect()->route('all.brand')->with('success', 'Brand Updated Successfull'); 
        }


       
    }


    public function Delete($id){
        $image = Brand::find($id);
        $old_image = $image->brand_image;
        unlink($old_image);

        Brand::find($id)->delete();

        return Redirect()->back()->with('success', 'Brand Delete Successfull');
    }

    //multiple Image

    public function MultiImage(){
        $images = MultiPic::latest()->paginate(10);
        return view('admin.multi.index', compact('images'));
    }

    public function StoreImages(Request $request){
        $images = $request->file('image');
        // $name_gen = hexdec(uniqid());
        // $img_ext = strtolower($brand_image->getClientOriginalExtension());
        // $img_name = $name_gen.'.'.$img_ext;
        // $up_location = 'image/brand/';
        // $last_img = $up_location.$img_name;
        // $brand_image->move($up_location,$img_name);

        // Image Intervention
        foreach($images as $multi_img)
        {
            $name_gen = hexdec(uniqid()).'.'.$multi_img->getClientOriginalExtension();
            Image::make($multi_img)->resize(420,540)->save('image/multi/'.$name_gen);
            $last_img= 'image/multi/'.$name_gen;

            Multipic::insert([
                'images' => $last_img,
                'created_at' => Carbon::now() 
            ]);
        }
        return Redirect()->back()->with('success', 'Images Inserted Successfull');


    }
   public function Logout(){
       Auth::logout();
       return Redirect()->route('login')->with('success', 'User Logout');
   }

} 
