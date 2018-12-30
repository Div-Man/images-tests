<?php

namespace Tests\Feature;

use App\Upload;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UploadTest extends TestCase
{
    /** @test */
    function upload_file_test()
    {
        
        /*
        Storage::fake('public');
 
        
        $this->json('post', '/upload', [
            'file' => $file = UploadedFile::fake()->image('random.jpg')
        ]);
         
        $this->assertEquals('file/' . $file->hashName(), Upload::latest()->first()->file);
        Storage::disk('public')->assertExists('file/' . $file->hashName());
         * 
         */
        
        
        
       
        
        
        
        /*
        Storage::fake('public');
          
        $file = UploadedFile::fake()->image('random.jpg');

        $response = $this->json('POST', '/upload', [
            //здесь должен быть такой же ключ, как и в контроллере
            'file' => $file,
        ]);
        
        
        //до делал указал путь
        Storage::disk('public')->assertExists('file/' . $file->hashName());

        Storage::disk('public')->assertMissing('random.jpg');
         * 
         */
        
    }
}
