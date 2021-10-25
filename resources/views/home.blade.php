@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{url('/getData')}}" method="POST" enctype="multipart/form-data" >
                        @csrf

                        <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text" class="form-control" id="name" name="name"  placeholder="Enter name" value="{{old('name')}}">
                            @error('name')
                              <small id="name_help" class="form-text text-danger">{{$message}}</small>   
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name_bangla">Name(Bangla)</label>
                            <input type="text" class="form-control" id="name_bangla" name="name_bangla"  placeholder="Enter name">
                            @error('name_bangla')
                              <small id="name_bangla_help" class="form-text text-danger">{{$message}}</small>   
                            @enderror
                          </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" cols="30" rows="10"></textarea>
                            @error('description')
                              <small id="description_help" class="form-text text-danger">{{$message}}</small>   
                            @enderror
                          </div>

                          <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" name="image" id="image">
                            @error('image')
                              <small id="image_help" class="form-text text-danger">{{$message}}</small>   
                            @enderror
                          </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>

                     
                </div>
                
                
            </div>
            
        </div>
    </div>

    <div class="row">
      <div class="col-sm-12 col-md-6 col-lg-4">
        @foreach ($post as $key)
                          
                <div class="card my-3" >
                  <img class="card-img-top img-fluid" style="height: 300px;width:100%;" src="/images/{{$key->image}}" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">{{$key->name}}</h5>
                    <h5 class="card-title">{{$key->name_bangla}}</h5>
                    <p class="card-text">{{$key->description}}</p>
                  </div>
                  <div class="card-footer d-flex justify-content-between">
                    <button class="btn btn-primary update" id="{{$key->id}}">Update</button>
                    <button class="btn btn-danger delete text-right" id="{{$key->id}}">Delete</button>
                  </div>
                </div>
            @endforeach
      </div>
    </div>
</div>

@include('/modal/addArticleModal')
@endsection
@section('script')
<script>

// $(document).ready(function(){  
//  $( "#name" ).blur(function() {
//   alert( "Lose focus from name" );
// });
// }); 
  // $(document).ready(function () {
  //   $( "#name" ).blur(function(){
  //     event.preventDefault();
      
  //     if($("#name").val()!==''){ 
  //       $("#name_help").val('fillup');
  //     }

  //   });
  // });

  $( document ).ready(function() {
    // event for click on input (also you can use click)
    //better to change form to .yourFormClass
    $('form input,form textarea').focus(function(){
    // get selected input error container
    $(this).siblings("#name_help").hide();
    $(this).siblings("#name_bangla_help").hide();
    $(this).siblings("#description_help").hide();
    });
});
</script>
    
@endsection