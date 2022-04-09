<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           {{ __('Brand')}}
        </h2>
        
    </x-slot>

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
                   <h3 class="card-title">All Brand</h3>
                 </div>
                 <div class="card-body">
                    <table class="table">
                      <thead class="bg-teal-400">
                        <tr>
                          <th scope="col">SL No</th>
                          <th scope="col">Brand Name</th>
                          <th scope="col">Brand Image</th>
                          <th scope="col">Created_at</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          
                          @foreach ($allbrands as $brand)  
                            <tr>
                              <th scope="row">{{$allbrands->firstItem()+$loop->index}}</th>
                              <td> {{ $brand->brand_name }} </td>
                              <td><img src="{{ asset($brand->brand_image)}}" alt="Img" class="img-thumbnail" > </td>
                              <td> 
                                    @if ($brand->created_at == NULL) 
                                        <span class="text-danger">No Date Set</span> 
                                    @else   
                                        {{$brand->created_at->diffForHumans() }} </td>
                                    @endif 
                              <td> 
                                <a href="{{ url('brand/edit/'.$brand->id)}}" class="btn btn-primary bg-blue-400"> Edit </a>
                                <a href="{{ url('brand/delete/'.$brand->id)}}" onclick="return confirm('Are you sure to Delete')" class="btn btn-danger bg-red-400"> Delete </a>
                              </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                    {{ $allbrands->links()}}
                 </div>
               </div>
             </div>
            
              <div class="col-md-4">
                  <div class="card">
                    <div class="card-header">
                      
                      <h3 class="card-title">Add Brand</h3>
                    </div>
                    <div class="card-body">
                      {{-- <form action="{{ route('category.AddCat') }}" method="POST" enctype="multipart/form-data"> --}}
                        
                      <form action="{{ route('store.brand')}}" method="post" enctype="multipart/form-data">
                          @csrf
                          
                        <div class="form-group">
                          <label for="brand_name">Brand Name</label>
                          <input type="text" class="form-control" id="brand_name" name="brand_name" >
                            @error('brand_name')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div><br>
                        <div class="form-group">
                          <label for="brand_image">Brand Image</label>
                          <input type="file" class="form-control" id="brand_image" name="brand_image" >
                            @error('brand_image')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div><br>
                        <button type="submit" class="btn bg-teal-500 text-green-200 hover:bg-teal-400">Add Brand</button>
                      </form>
                    </div>
                  </div>
              </div>
           </div>


        </div> 
    </div>
</x-app-layout>
