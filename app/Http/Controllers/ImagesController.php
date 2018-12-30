<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

use App\Services\Image;
use App\Category;
use App\User;

use Illuminate\Support\Facades\Auth;

use App\Services\TrateRulesMessage;

class ImagesController extends Controller 
{
   
    use TrateRulesMessage;
    
    private $imageClass;
    private $role;
    
    public function __construct(Image $imageClass, User $role) { 
        $this->imageClass = $imageClass;
        $this->role = $role;
    }
    
    public function index()      
    {
        $userRole = $this->role->isRole();
        
        $allCategory = Category::all();
        
      
       return view('welcome', [
           'imagesInView' =>  $this->imageClass::paginate(2),
           'allCategory' => $allCategory,
           'userRole' => $userRole
               ]);
    }
    
    public function categoryShow($id)
    {
        $userRole = $this->role->isRole();
        $allCategory = Category::all();
        $targetCateory = Category::find($id)->article()->paginate(2);
        
       
       return view('welcome', [
           'imagesInView' =>  $targetCateory,
           'allCategory' => $allCategory,
           'userRole' => $userRole
               ]);
    }
    
    public function create()
    { 
        $userRole = $this->role->isRole();
        $category = Category::all();
       
        return view('create', [
            'category' => $category,
            'userRole' => $userRole
        ]);
    }
    
    public function store(Request $request)
    {
      
    
        Validator::make(
            $request->all(), 
            $this->rulesData() ,
            $this->messagesData()
              )->validate(); 
     
      $image = $request->file('image');
      
      $description = $request->input('description');
      
      $this->imageClass->add($image, $description);
  
      $this->imageClass->save();

      $idNewImage = $this->imageClass->id;
      $categories = $request->input('choose-category');
      
      $relation = \App\Services\Image::find($idNewImage);
        
      $relation->categories()->attach($categories);
      
      return redirect('/');
    }
    
    public function show($id)
    {
         $userRole = $this->role->isRole();
        $myImage = $this->imageClass::find($id);
        return view('show', [
            'imageInView' => $myImage,
             'userRole' => $userRole
                ]);
    }
    
    public function edit($id)
    {
        $userRole = $this->role->isRole();
        $myImage = $this->imageClass::find($id);
         return view('edit', [
             'imageInView' => $myImage,
             'userRole' => $userRole
                 ]);
    }
    
    public function update(Request $request, $id)
    { 
        $imgOld = $this->imageClass::find($id);
        
        //Назвать метод update нелья, так как будет конфликт с ларавеловскими готовыми методами. 
        
        $imgOld->updateImage($request->image, $imgOld);
        $imgOld->description = $request->description;
        $imgOld->save();
        
         return redirect('/myprofile/images');
    }
    
     public function delete($id) {
       
      $currentImage = $this->imageClass::find($id);
      $this->imageClass->deleteImage($currentImage);
    
     return redirect('/myprofile/images');
    }
    
    
}

