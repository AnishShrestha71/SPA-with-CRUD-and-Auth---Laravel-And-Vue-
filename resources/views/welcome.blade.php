@extends('layouts.app')
@section('content')
   <div >
       <router-link to="/" exact><p  class="text-3xl">Home</p></router-link>
       <router-link to="/About"><p class="text-3xl">About</p> </router-link>
   </div>
   <div>
    <router-link to="/login" ><p  class="text-3xl">Login</p></router-link>
    <router-link to="/register"><p class="text-3xl">Regitster</p> </router-link>
   </div>
        <router-view></router-view>

@endsection