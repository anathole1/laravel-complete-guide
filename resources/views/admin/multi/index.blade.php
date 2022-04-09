<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           {{ __('Multi Picture')}}
        </h2>
        
    </x-slot>

    <div class="py-12">
       <div class="container">
           <div class="row">
             <div class="col-md-8">
                <div class="row">
                  @foreach ($images as $image)
                     <div class="col-sm-4 mb-2">
                       <div class="card">
                         <img src="{{asset($image->images)}}" alt="">
                        
                       </div>
                       {{-- <h6 class="text-center">CEO</h6> --}}
                       </div> 
                  @endforeach
                  
                </div>
                {{ $images->links()}}
             </div>
            
              <div class="col-md-4">
                  <div class="card">
                    <div class="card-header">
                      
                      <h3 class="card-title">Add Images</h3>
                    </div>
                    <div class="card-body">
                      {{-- <form action="{{ route('category.AddCat') }}" method="POST" enctype="multipart/form-data"> --}}
                        
                      <form action="{{route('store.image')}}" method="post" enctype="multipart/form-data">
                          @csrf
                        
                        <div class="form-group">
                          <label for="brand_image">Multi Images</label>
                          <input type="file" class="form-control"  name="image[]" multiple="">
                            @error('image')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div><br>
                        <button type="submit" class="btn bg-teal-500 text-green-200 hover:bg-teal-400">Add Images</button>
                      </form>
                    </div>
                  </div>
              </div>
           </div>


        </div> 
    </div>
</x-app-layout>
