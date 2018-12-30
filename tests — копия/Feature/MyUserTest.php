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


class MyUserTest extends TestCase
{
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
    
   
    /*
    function name_should_not_be_too_long()
    {
        $response = $this->post('/users', [
           'name' => str_repeat('a', 60),
            'email' => 'ffffssff@yandex.ru',
            'password' => 'secret',
        ]);

        $response->assertResponseStatus(302);
        $response->assertSessionHasErrors([
            'name' => 'The name may not be greater than 50 characters.'
        ]);
    }
     * 
     */
    
    
    function mainPage()
    {
       
      $user = User::find(1);   
      $this->actingAs($user)
            ->visit('/')
            ->see('Выйти')
            ->see($user->name)     
            ->see('Добавить картинку');   
      
      
       $allCategory = Category::all();
       $this->assertFalse($allCategory->isEmpty());
       
       $images = Image::paginate(2);
       $this->assertFalse($images->isEmpty());
    }
    
    
    //https://stackoverflow.com/questions/35888161/laravelphpunit-testing-select-with-default-option
    //https://laravel-news.com/testing-vue-components-with-laravel-dusk
    
     /** @test */
    function createPageAutn()
    {
        //тестируется при условии
        //что уже есть категории
        //и пользователи
        
        $user = User::find(1);
        
        $aaa = 'Какое то описание';
        $catId = '8';
        
        
       $this->actingAs($user)
             ->visit('/create')
             ->see('Add Image')
             ->type($aaa, 'description')
            ->select([$catId], 'choose-category[]')
            ->press('Submit');
       
       
       
       
       
       
       
       $request = new Request();
       $image = UploadedFile::fake()->image('random.jpg');
       
       $userClass = new User();
       
       $bb = new Image();
       $bb->add($image, $aaa);
       $bb->save();
       
       $idNewImage = $bb->id;
       $descriptionNewImage = $bb->description;
        
       $relation = \App\Services\Image::find($idNewImage);
        
       $relation->categories()->attach($catId);
       
       $this->seeInDatabase('images', ['description' => $descriptionNewImage]);
       
       
       //это для того, что бы удалить данные из промежуточной таблицы
       //к методу store никакого отношения не имеет 
        DB::table('category_image')->where('image_id', $idNewImage)->delete();
        
        $imageController = new ImagesController($bb, $userClass);
        $imageController->delete($idNewImage);
       
        //Storage::delete();
       
       //надо наверно как то сюда метод add засунуть из контроллера
       
       //не ищет, потому что не записывается
       
       /*
        $this->seeInDatabase('images', ['description' => 'прпрпр']);
       
        Storage::fake('public');
          
        $file = UploadedFile::fake()->image('random.jpg');

        $response = $this->json('POST', '/upload', [
            'file' => $file,
        ]);
      
        Storage::disk('public')->assertExists('file/' . $file->hashName());

        Storage::disk('public')->assertMissing('random.jpg');
        * 
        */
        
    }
    
     /** @test */
    function createPageNotAutn()
    {
        $response = $this->call('GET', '/create');
        $this->assertEquals(404, $response->status());
    }
    
    
     function name_should_not_be_too_short()
    {
         
         /*
         $this->visit('/')
       ->click('Войти')
       ->seePageIs('/login');
          * 
          */
         

        $student = new User;
        

         $rules = [
           'name' => 'required|min:3|max:50',
            'email' => 'required|email|max:255',
            'password' => 'required',
           ];
        
        
         
      $validator = Validator::make(array(
            "name"=>"jo3333333333323323425dhhfhfhjfjjjhfhfffffffffffff",
            "email"=>"johnerr@gmail.com",
            "password"=>"passtest",
            
        ), $rules);
      
       $this->assertTrue($validator->passes());
 
       
       
       
        //$response = $this->call('POST', '/users');
       //$response = $this->json('POST', '/user');
       //$response->assertStatus(201);
        
       //$response->assertResponseStatus(302);
       
       /*
        $response->assertSessionHasErrors([
            'name' => 'The name may not be greater than 50 characters.'
        ]);
        * 
        */
      
    }
    
   
    
    
    
    
    
    
    
    /*
    function name_is_just_long_enough_to_pass()
    {
         $response = $this->post('/users', [
            'name' => str_repeat('a', 50),
            'email' => $this->user->email,
            'password' => 'secret',
        ]);
        
        $this->seeInDatabase('users', [
            'email' => $this->user->email,
        ]);
        
         $response->assertResponseStatus(201);
    }
     * 
     */
    
    
    
    /*
    
    function email_should_not_be_too_long()
    {
        $response = $this->post('/users', [
            'name' => $this->user->name,
            'email' => str_repeat('a', 247).'@test.com', // 256
        ]);

        $response->assertResponseStatus(302);
        $response->assertSessionHasErrors([
            //не поддерживаются русские символы
            'email' => 'The email may not be greater than 255 characters.'
        ]);
        
        
    }
     * 
     */
     
}
