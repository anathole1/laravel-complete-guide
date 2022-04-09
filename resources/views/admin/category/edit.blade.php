<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           {{ __('Update Category')}}
        </h2>
        
    </x-slot>

    <div class="py-12">
       <div class="container">
           <div class="row">
              <div class="col-md-8">
                  <div class="card">
                    <div class="card-header">
                      
                      <h3 class="card-title">Update category</h3>
                    </div>
                    <div class="card-body">
                      {{-- <form action="{{ route('category.AddCat') }}" method="POST" enctype="multipart/form-data"> --}}
                        
                      <form action="{{ url('category/update/'.$categories->id)}}" method="post">
                          @csrf
                          {{-- {!! csrf_field() !!} --}}
                        <div class="form-group">
                          <label for="category_name">Category Name</label>
                          <input type="text" class="form-control" id="category_name" name="category_name" value="{{ $categories->category_name}}" >
                            @error('category_name')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div><br>
                        <button type="submit" class="btn btn-primary text-dark">Update Category</button>
                      </form>
                    </div>
                  </div>
              </div>
           </div>
        </div> 
    </div>
</x-app-layout>
