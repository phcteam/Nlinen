 @extends('layouts.app')
 @section('title', 'Profile')

 @section('content')
  
         @if (session('status'))
             <div class="alert alert-success" role="alert">
                 {{ session('status') }}
             </div>
         @endif

         @include('auth.profile.components.profile')

         @include('auth.profile.components.password')

         @include('auth.profile.components.2FA')
 
 @endsection
