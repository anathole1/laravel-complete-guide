<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php
            function welcome(){
 
                if(date("H") < 12){

                return "Good Morning";

                }elseif(date("H") > 11 && date("H") < 18){

                return "Good Afternoon";

                }elseif(date("H") > 17){

                return "Good Evening";

                }

                }
            ?>

             <span class="text-teal-400 "> {{welcome()}} </span> <b>{{Auth::User()->name}}</b>
             <b class="float-end">Total Users <span class="badge rounded-pill bg-teal-300 text-white"> {{count($users)}} </span></b>
        </h2>
        
    </x-slot>

    <div class="py-12">
       <div class="container">
           <div class="row">
            <table class="table">
                <thead class="bg-teal-400">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Names</th>
                    <th scope="col">Email</th>
                    <th scope="col">Created_at</th>
                  </tr>
                </thead>
                <tbody>
                    @php($i =1)
                    @foreach ($users as $user)
                        
                    
                  <tr>
                    <th scope="row">{{$i++}}</th>
                    <td>{{ $user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->created_at->diffForHumans()}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
           </div>
        </div> 
    </div>
</x-app-layout>
