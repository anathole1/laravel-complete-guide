@extends('admin.admin_master')
   @section('admin')

    <div class="py-12">
       <div class="container">
           <div class="row">
              <div class="col-md-8"> 
                  <div class="card">
                    <div class="card-header">
                      
                      <h3 class="card-title">Update Brand</h3>
                    </div>
                    <div class="card-body">
                      {{-- <form action="{{ route('category.AddCat') }}" method="POST" enctype="multipart/form-data"> --}}
                        
                      <form action="{{ url('brand/update/'.$brands->id)}}" method="post" enctype="multipart/form-data">
                          @csrf
                          
                          {{-- {!! csrf_field() !!} --}}
                          <input type="hidden" name="old_image" value="{{$brands->brand_image}}">
                        <div class="form-group">
                          <label for="brand_name">Update Brand Name</label>
                          <input type="text" class="form-control" id="brand_name" name="brand_name" value="{{ $brands->brand_name}}" >
                            @error('brand_name')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div><br>
                        <div class="form-group">
                          <label for="brand_Image">Update Brand Image</label>
                          <input type="file" class="form-control" id="brand_image" name="brand_image" value="{{ $brands->brand_image}}">
                            @error('brand_image')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div><br>
                        <div class="mb-3">
                            <img src="{{asset($brands->brand_image)}}" class="img-thumbnail" height="150" width="150">
                        </div>
                        <button type="submit" class="btn btn-primary text-dark">Update Brand</button>
                      </form>
                    </div>
                  </div>
              </div>
           </div>
        </div> 
    </div>
@endsection
