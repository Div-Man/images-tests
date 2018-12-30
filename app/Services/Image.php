<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

use Illuminate\Support\Facades\Auth;

use App\Category;


class Image extends Model
{   

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    
    public function add($image, $description)
    {
        $fileName = $image->store('uploads');
        $this->image = $fileName;
        $this->description = $description;
        $this->id_user = Auth::id();
    }
       
    public function updateImage($image, $imgOld)
    {
        //если пользователь загрузил новую картинку, то заменить её
        //если нет, то оставить старую
         if($image) {
            Storage::delete($imgOld->image);
            $fileName = $image->store('uploads');
            
            $this->image = $fileName;
         }                
    }
    
    public function deleteImage($image)
    {    
      Storage::delete($image->image);
      $this->destroy($image->id);
      
      DB::table('category_image')->where('image_id', $image->id)->delete();
    }
}
