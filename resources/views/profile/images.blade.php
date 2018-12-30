@extends('layout')

@section('content')



<div class="container">

    <div class="row">
       <div class="col-sm-3" style="border: 1px solid">
            <ul class="list-group">
                <li class="list-group-item"><a href="/myprofile/info">Мои данные</a></li>
                <li class="list-group-item"><a href="/myprofile/images">Мои изображения</a></li>   
            </ul>
        </div>
        
         <div class="col-sm-9" style="border: 1px solid">
        @foreach($myImage as $image)
      
       <div style="
            display: inline-block; 
            width: 350px; 
            margin-right: 20px">
            <div>
                <img src="/{{$image->image}}" class="img-thumbnail">
                <p style="text-align: center;">{{$image->description}}<p>
            </div>
          <a href="/show/{{$image->id}}" class="btn btn-info my-button">Show</a>
          <a href="/myprofile/images/edit/{{$image->id}}" class="btn btn-warning my-button">Edit</a>
          <a href="/myprofile/images/delete/{{$image->id}}" onclick="return confirm('Точно удалить?')"class="btn btn-danger my-button">Delete</a>
        </div>
        @endforeach
        
        
    </div>
    
    
    <div style="
        display: table; 
        margin: 0 auto; 
        text-align: center
         ">
        
        {{$myImage->links()}}
        </div>
    </div>  
 
    
</div>

@endsection
    