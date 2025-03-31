 <!DOCTYPE html>
 <html lang="en">

 <head>

     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <meta name="description" content="">
     <meta name="author" content="">

     <title>SB Admin 2 - Login</title>
 
     <!-- fontawesome-->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
         integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
         crossorigin="anonymous" referrerpolicy="no-referrer" />

     <link
         href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
         rel="stylesheet">

     <!-- Custom styles for this template-->
     <link href="css/sb-admin-2.min.css" rel="stylesheet">

 </head>

 <body class="bg-gradient-primary">

     <div class="container">

         <!-- Outer Row -->
         <div class="row justify-content-center">

             <div class="col-xl-10 col-lg-12 col-md-9">

                 <div class="card o-hidden border-0 shadow-lg my-5">
                     <div class="card-body p-0">
                         <!-- Nested Row within Card Body -->
                         <div class="row">
                             <div class="col-lg-6 d-none d-lg-block bg-login-image">

                                 <img src="img/160-3200x2119.jpg" alt="..." height="500px" width="460px">

                             </div>
                             <div class="col-lg-6">
                                 <div class="p-5">
                                     <div class="text-center">
                                         <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                     </div>

                                     <form method="POST" action="{{ route('login') }}" class="user">
                                         @csrf

                                         <div class="form-group">
                                             <input id="exampleInputEmail" type="text"
                                                 class="form-control form-control-user @error('username') is-invalid @enderror"
                                                 name="username"
                                                 value="{{ old('username', request()->cookie('remembered_username')) }}"
                                                 required autocomplete="username" autofocus>

                                             @error('username')
                                                 <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                 </span>
                                             @enderror
                                         </div>

                                         <div class="form-group">
                                             <input id="password" type="password"
                                                 class="form-control form-control-user @error('password') is-invalid @enderror"
                                                 name="password" required autocomplete="current-password">

                                             @error('password')
                                                 <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                 </span>
                                             @enderror
                                         </div>

                                         <div class="form-group">
                                             <div class="custom-control custom-checkbox small">
                                                 <input type="checkbox" class="custom-control-input" id="customCheck"
                                                     name="remember"
                                                     {{ old('remember') || request()->cookie('remembered_username') ? 'checked' : '' }}>

                                                 <label class="custom-control-label" for="customCheck">Remember
                                                     Me</label>
                                             </div>
                                         </div>

                                         <button class="btn btn-primary btn-user btn-block" type="submit">
                                             Login
                                         </button>
                                     </form>

                                     <hr>
                                     <div class="text-center">
                                         <a class="small" href="forgot-password.html">Forgot Password?</a>
                                     </div>
                                     <div class="text-center">
                                         <a class="small" href="register.html">Create an Account!</a>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>

             </div>

         </div>

     </div>

 </body>

 </html>
