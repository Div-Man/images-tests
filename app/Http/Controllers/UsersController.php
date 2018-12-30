<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Image;
use App\User;

class UsersController extends Controller
{
    private $imageClass;
    private $role;
    
    public function __construct(Image $imageClass, User $role) { 
        $this->imageClass = $imageClass;
        $this->role = $role;
    }
    
    public function info()
    {
        $id = Auth::user()->id;
        
        
        $myInfo = User::find($id);
        $userRole = $this->role->isRole();
        return view('profile.index', [
            'myInfo' => $myInfo,
           
            'userRole' => $userRole
        ]);
    }
    
    public function images()
    {
        $userRole = $this->role->isRole();
        $id = Auth::user()->id;
        $myImage = Image::where('id_user', $id)->paginate(2);
         return view('profile.images', [
            'myImage' => $myImage,
            'userRole' => $userRole
        ]);
    }
}
