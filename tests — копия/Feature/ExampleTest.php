<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        //use DatabaseMigrations;
        
        /*
        $response = $this->get('/');

        $response->assertStatus(200);
         * 
         */
        
     
        
        $response = $this->call('GET', '/');

        $this->assertEquals(200, $response->status());
      
        
        
        /*
        $user = User::find(1);
        
       $this->actingAs($user)
             ->visit('/create');
         * 
         */
         
        
        
        /*
        
         Storage::fake('avatars');
         
           $file = UploadedFile::fake()->image('avatar.jpg');
           
         

        
        $response = $this->json('POST', '/store', [
            'avatar' => $file,
        ]);
             
              
            dd($response);  

        // Assert the file was stored...
        Storage::disk('avatars')->assertExists($file->hashName());

        // Assert a file does not exist...
        Storage::disk('avatars')->assertMissing('missing.jpg');
          
        
         * 
         */
        
      
    }
}
