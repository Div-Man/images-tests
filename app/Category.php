<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Services\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{   
     protected $fillable = ['name'];
     public $timestamps = false;
     
     
     public function article()
    {
        return $this->belongsToMany('App\Services\Image');
    }
     
    public static function deleteCategory($id)
    {
        $posts = collect(DB::table('category_image')->select('image_id')->
          where('category_id', $id)->get()->implode('image_id', ','));     
        
       $deletePivot = explode(',', $posts->values()->first());
       $relation = Category::find($id);
       $relation->article()->detach($deletePivot);
       $relation->delete();

       $notCategories = Image::doesntHave('categories')->get();
       
       $notCategories->each(function($item, $key){
            Storage::delete($item->image);
            $item->delete();
       });   
    }
     
}
