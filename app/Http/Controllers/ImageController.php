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

    public function updateImageInsert(Request $request, $id){
        // $id = $request->id;
        // dd($request->file('images')[0]);
        // $request->all();
        // $request->file('key')
        // $request->file('key')[0]
       
       
        // $id = $request->id; //another way
        $id = $id; // ai line ta na likhleo hoto
        if($request->hasFile('images')){
            foreach($request->file('images') as $image){
                $imageName = time()."-".uniqid().".".$image->getClientOriginalExtension();
                $image->storeAs('images', $imageName, 'public');
                Image::where('service_id', $id)->create([
                    'image' => $imageName,
                    'service_id' => $id
                ]);
            }
        }
        Service::where('id', $id)->update([
            'name' => $request->name
        ]);
    
    }
    


    public function imageDelte($id){
        
        $imageData = Image::where('service_id', $id)->get();
        if(count($imageData) > 0){
            foreach($imageData as $item){
                if(File::exists("storage/images/".$item->image)){
                    File::delete("storage/images/".$item->image);
                }
                $oneImage = Image::where('service_id', $id)->first();
                $oneImage->delete();  //another way
            }
        }
        $serviceData = Service::with('images')->find($id);
        $serviceData->delete();

        // $data = Service::with('images')->find($id);
        // $data->delete();  // another way

        // $serviceDeleteData = Service::find($id);  
        // $serviceDeleteData->delete();  //another way

        // $imgDeleteData = Image::find($id);
        // $imgDeleteData->delete();  //another way

        // $imageDeleteWhData = Image::where('service_id', $id)->get();
        // $imageDeleteWhData->delete();  //another way

        
    }











}
