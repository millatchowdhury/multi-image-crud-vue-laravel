<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Service;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ImageController extends Controller
{
    public function index(){
        return Inertia::render(
            'Image/Index'
        );
    }
    public function store(Request $request){


        // for single image 
        // $request->validate([
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);

        // $imageName = '';
        //     if($image = $request->file('image')){
        //         $imageName = time()."-".uniqid().".".$image->getClientOriginalExtension();
        //         // $image->move('images', $imageName);
        //         $request->file('image')->storeAs('images', $imageName, 'public');
               
        //     }

        // for multiple image 
        $request->validate([
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = Service::create([
            'name' => $request->name
        ]);

        if($request->hasFile('image')){
            foreach($request->file('image') as $image){
                $imageName = time()."-".uniqid().".".$image->getClientOriginalExtension();
                // $image->move('images', $imageName);
                $image->storeAs('images', $imageName, 'public');
                Image::create([
                    'image' => $imageName,
                    'service_id'=>$data->id
                ]);
            }
        }
        
        
    }

    public function list(){
        $services = Service::all();

        return Inertia::render(
            'Image/List',
            [
                'services' => $services
            ]
        );
    }

    public function show(Request $request, $id){
        
        $images = Service::with('images')->find($id);
        return Inertia::render(
            'Image/View',
            [
                'imagesFile' => $images
                //'images' => $images
            ]
        );

        // another way 
        // $images = Image::where('service_id', $id)->get();
        // dd($images);


    }

    public function editShow($id){
       $imageFile = Service::with('images')->find($id);
        return Inertia::render(
            'Image/Edit',
            [
                'imageFile' => $imageFile
            ]
            );
    }

    public function updateImage($id){


        $data = Image::find($id);
       
        if(File::exists("storage/images/".$data->image)){
            File::delete("storage/images/".$data->image);
        }
        $data->delete();



        // for single image (video dekhe)
        // $product = Image::find($id);
        // $imageName = '';
        // $deleteOldImage = 'images/products/'.$product->image;
        // if($image = $request->file('image')){
        //     if(file_exists($deleteOldImage)){
        //         File::delete($deleteOldImage);
        //     }
        //     $imageName = time().'-'.uniqid().'.'.$image->getClientOriginalExtension();
        //     $image->move('images/products', $imageName);
        // }else{
        //     $imageName = $product->image;
        // }
        // Image::where('id', $id)->update([
        //     'name' => $request->name,
        //     'image' => $imageName
        // ]);
        
    }











}
