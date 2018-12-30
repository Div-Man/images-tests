<?php

namespace Tests\Feature;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Validator;
use App\Category;
use App\Services\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ImagesController;
use App\Services\TrateRulesMessage;

class MyUserTest extends TestCase
{
      use TrateRulesMessage;
    /**
     * A basic test example.
     *
     * @return void
     */
     public function setUp()
    {
       
        parent::setUp();
        
        $this->user = factory(User::class)->make();
    }
    
     /** @test */
    
    //проверить, что бы после авторизации 
    //был доступ к добавлению изображений
    
    function mainPage()
    {
       
      $user = User::find(1);   
      $this->actingAs($user)
            ->visit('/')
            ->see('Выйти')
            ->see($user->name)     
            ->see('Добавить картинку');    
    }
    
    
     /** @test */
    
    //Тест для проверки добавления изображения пользователем
    function createPageAutn()
    {
        $testCategory = Category::create([
            'name' => 'test'
        ]);

        $user = User::find(1);
        
        $aaa = 'Какое то описание';
        $catId = [$testCategory->id];
        
       $this->actingAs($user)
             ->visit('/create')
             ->see('Add Image')
             ->type($aaa, 'description')
            ->select($catId, 'choose-category[]')
            ->press('Submit');
       
        $image = UploadedFile::fake()->image('random.jpg');
       
      $validator = Validator::make(array(
            "description" => $aaa,
            "image" => $image,
            "choose-category" => $catId,
            
        ), $this->rulesData(), $this->messagesData());
      
       $this->assertTrue($validator->passes());
       
       $bb = new Image();
       $bb->add($image, $aaa);
       $bb->save();
       
       $idNewImage = $bb->id;
       $descriptionNewImage = $bb->description;
        
       $relation = \App\Services\Image::find($idNewImage);
        
       $relation->categories()->attach($catId);
       
       $this->seeInDatabase('images', ['description' => $descriptionNewImage]);
       
       
       //Теперь идёт отчистка 
       
       //это для того, что бы удалить данные из промежуточной таблицы
       //к методу store никакого отношения не имеет 
        DB::table('category_image')->where('image_id', $idNewImage)->delete();
        DB::table('categories')->where('id', $testCategory->id)->delete();
        
        //это класс требуется в качестве аргумента для конструктора
        $userClass = new User();
        
        $imageController = new ImagesController($bb, $userClass);
        
        //За одно и метод delete протестируется
        $imageController->delete($idNewImage);
       
    }
    
     /** @test */
    
    //проверить, что бы не авторизированным пользователям
    //не открывалась страница create
    function createPageNotAutn()
    {
        $response = $this->call('GET', '/create');
        $this->assertEquals(404, $response->status());
    }
      
}
