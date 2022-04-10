@extends('admin.admin_master')
   @section('admin')
   <div class="py-12">
       <div class="container">
           <div class="row">
             <div class="col-md-8">
               <div class="card">
                 <div class="card-header">
                  @if (session('success'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success')}}</strong> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  @endif
                   <h3 class="card-title">All Sliders</h3>
                 </div>
                 <div class="card-body">
                    <table class="table">
                      <thead class="bg-teal-400">
                        <tr>
                          <th scope="col">SL No</th>
                          <th scope="col">Title</th>
                          <th scope="col">Description</th>
                          <th scope="col">Image</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          
                          @foreach ($sliders as $slider)  
                            <tr>
                              <th scope="row">{{$sliders->firstItem()+$loop->index}}</th>
                              <td> {{ $slider->title }} </td>
                              <td> {{ $slider->description}}</td>
                              <td><img src="{{ asset($slider->image)}}" alt="Img" class="img-thumbnail" > </td>    
                              <td> 
                                <a href="{{ url('slider/edit/'.$slider->id)}}" class="btn btn-primary bg-blue-400"> Edit </a>
                                <a href="{{ url('slider/delete/'.$slider->id)}}" onclick="return confirm('Are you sure to Delete')" class="btn btn-danger bg-red-400"> Delete </a>
                              </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                    {{ $sliders->links()}}
                 </div>
               </div>
             </div>
            
              <div class="col-md-4">
                  <div class="card">
                    <div class="card-header">
                      
                      <h3 class="card-title">Add Slider</h3>
                    </div>
                    <div class="card-body">
                     
                        
                      <form action="{{route('store.slider')}}" method="post" enctype="multipart/form-data">
                          @csrf
                          
                        <div class="form-group">
                          <label for="brand_name">Title</label>
                          <input type="text" class="form-control" id="title" name="title" >
                            @error('title')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div><br>
                        <div class="form-group">
                          <label for="brand_name">Description</label>
                          <textarea class="form-control" id="description" rows="3" name="description" > </textarea>
                            @error('description')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div><br>
                        <div class="form-group">
                          <label for="image"> Image</label>
                          <input type="file" class="form-control" id="image" name="image" >
                            @error('image')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div><br>
                        <button type="submit" class="btn btn-primary">Add Slider</button>
                      </form>
                    </div>
                  </div>
              </div>
           </div>


        </div> 
    </div>
   @endsection