<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           {{ __('Category')}}
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
                   <h3 class="card-title">All Categories</h3>
                 </div>
                 <div class="card-body">
                    <table class="table">
                      <thead class="bg-teal-400">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Category Name</th>
                          <th scope="col">Operator</th>
                          <th scope="col">Created_at</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          {{-- @php($i =1) --}}
                          @foreach ($categories as $category)  
                            <tr>
                              <th scope="row">{{$categories->firstItem()+$loop->index}}</th>
                              <td> {{ $category->category_name }} </td>
                              <td> {{$category->user->name }} </td>
                              <td> {{$category->created_at->diffForHumans() }} </td>
                              <td> 
                                <a href="{{ url('category/edit/'.$category->id)}}" class="btn btn-primary bg-blue-400"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <a href="{{ url('softdelete/category/'.$category->id)}}" class="btn btn-danger bg-red-400"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                              </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                    {{ $categories->links()}}
                 </div>
               </div>
             </div>
            
              <div class="col-md-4">
                  <div class="card">
                    <div class="card-header">
                      
                      <h3 class="card-title">Add category</h3>
                    </div>
                    <div class="card-body">
                      {{-- <form action="{{ route('category.AddCat') }}" method="POST" enctype="multipart/form-data"> --}}
                        
                      <form action="{{ route('store.category') }}" method="post">
                          @csrf
                          {{-- {!! csrf_field() !!} --}}
                        <div class="form-group">
                          <label for="category_name">Category Name</label>
                          <input type="text" class="form-control" id="category_name" name="category_name" >
                            @error('category_name')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div><br>
                        <button type="submit" class="btn bg-teal-500 text-green-200 hover:bg-teal-400">Add Category</button>
                      </form>
                    </div>
                  </div>
              </div>
           </div>
{{-- ______________________Start Trash __________________ --}}
           {{-- @if ($trashCat > '0') --}}
              <div class="row mt-1">
                <div class="col-md-8">
                  <div class="card">
                    <div class="card-header">

                      <h3 class="card-title">Trash List</h3>
                    </div>
                    <div class="card-body">
                      <table class="table">
                        <thead class="bg-teal-400">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Operator</th>
                            <th scope="col">Created_at</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            {{-- @php($i =1) --}}
                            @foreach ($trashCat as $category)  
                              <tr>
                                <th scope="row">{{$trashCat->firstItem()+$loop->index}}</th>
                                <td> {{ $category->category_name }} </td>
                                <td> {{$category->user->name }} </td>
                                <td> {{$category->created_at->diffForHumans() }} </td>
                                <td> 
                                  <a href="{{ url('category/restore/'.$category->id)}}" class="btn btn-warning">Restore</a>
                                  <a href="{{ url('pdelete/category/'.$category->id)}}" class="btn btn-danger"> Delete Permanently</a>
                                </td>
                              </tr>
                          @endforeach
                        </tbody>
                      </table>
                      {{ $trashCat->links()}}
                    </div>
                  </div>
              </div>
            {{-- @endif --}}
        {{-- ________________________________End Trash__________________________ --}}

        </div> 
    </div>
</x-app-layout>
