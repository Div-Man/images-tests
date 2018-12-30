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
            
            <div class="form-group">
              <img src="/{{$myInfo->image}}" alt="" class="img-responsive" width="100">
             <br>
             <br>
              <div class="custom-file" style="width:200px">
                <input type="file" class="custom-file-input" id="customFile">
                <label class="custom-file-label" for="customFile">Choose file</label>
              </div>
            </div>
                
                <table class="table table-bordered">
                <tbody>
                  <tr>
                    <th scope="row">Email</th>
                    <td>{{$myInfo->email}}</td>             
                  </tr>
                  <tr>
                    <th scope="row">Логин</th>
                    <td>{{$myInfo->name}}</td> 
                  </tr>
                  <tr>
                    <th scope="row">Роль</th>
                    <td>{{$myInfo->role}}</td>
                  </tr>
                </tbody>
              </table>
        </div>
    </div>
</div>
@endsection