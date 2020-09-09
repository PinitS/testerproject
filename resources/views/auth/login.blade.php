<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v3.2.0
* @link https://coreui.io
* Copyright (c) 2020 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->
<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>Login</title>
    <link rel="apple-touch-icon" sizes="57x57" href="assets/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="assets/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="assets/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="assets/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="assets/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/favicon/manifest.json">

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Main styles for this application-->
    <link href="css/style.css" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics-->

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>
    <!-- fontawesome -->
    <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">

    <link href="vendors/@coreui/icons/css/free.min.css" rel="stylesheet">
    <link href="vendors/@coreui/icons/css/brand.min.css" rel="stylesheet">
    <link href="vendors/@coreui/icons/css/flag.min.css" rel="stylesheet">

    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() 
      {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      // Shared ID
      gtag('config', 'UA-118965717-3');
      // Bootstrap ID
      gtag('config', 'UA-118965717-5');
    </script>

  </head>

  <body class="c-app flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card-group">
            <div class="card p-4">
              <div class="card-body">

                <form method="POST" action="{{ route('login') }}">
                  {{ csrf_field() }}
                  
                  <h1>Login</h1>
                  <p class="text-muted">Sign In to your account</p>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <svg class="c-icon">
                          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                        </svg>
                      </span>
                    </div>
                    <input class="form-control" type="text" name = "username" id="username" value="{{ old('username') }}" placeholder="username" required>

                  </div>
                  <div class="input-group mb-4">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <svg class="c-icon">
                          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                        </svg>
                      </span>
                    </div>
                    <input class="form-control" type="password" name = "password" id="password" placeholder="Password" required>
                    
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <button class="btn btn-primary px-4 btn-block" type="submit">Login</button>
                    </div>
                    {{-- <div class="col-6 text-right">
                    <button class="btn btn-link" type="button" data-toggle="modal" data-target="#Register">Register</button>
                    </div> --}}
                  </div>
                </form>

              </div>
            </div>
            <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
              <div class="card-body text-center">
                <i class="c-icon c-icon-5xl mt-4 mb-3 cil-meh"></i>
                <div>TENT-OFFICIAL</div>

                  @if(Session::has('success'))
                    <div class="alert alert-success"> <h5 class="alert-heading"> {{Session::get('success')}} </h5> </div>
                  @elseif(Session::has('danger'))
                    <div class="alert alert-danger"> <h5 class="alert-heading"> {{Session::get('danger')}} </h5> </div>
                  @elseif(Session::has('warning'))
                    <div class="alert alert-warning"> <h5 class="alert-heading"> {{Session::get('warning')}} </h5> </div>  
                  @endif

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <form action="/member" method="post">
      {{ csrf_field() }}
      <div class="modal fade" id="Register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-danger" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Register</h4>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            
              <div class="modal-body">

                  <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="rgusername">Username</label>
                    <div class="col-md-9">
                      <input class="form-control" type="text" id="rgusername" name="rgusername" placeholder="Enter Username.." required><span class="help-block text-danger">Please enter your username</span>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="rgpassword">Password</label>
                    <div class="col-md-9">
                      <input class="form-control" type="text" id="rgpassword" name="rgpassword" placeholder="Enter Password.." required><span class="help-block text-danger">Please enter your password</span>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="rgcodeadmin">CodeAdmin</label>
                    <div class="col-md-9">
                      <input class="form-control" type="text" id="rgcodeadmin" name="rgcodeadmin" placeholder="Enter CodeAdmin.." ><span class="help-block text-danger">XCIX</span>
                    </div>
                  </div>
                
              </div>

              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                <button class="btn btn-danger" type="submit">Save changes</button>
              </div>
            
          </div>
          
                  <!-- /.modal-content-->
        </div>
        
                <!-- /.modal-dialog-->
      </div>   
    </form> 




    <!-- CoreUI and necessary plugins-->
    <script src="vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
    <!--[if IE]><!-->
    <script src="vendors/@coreui/icons/js/svgxuse.min.js"></script>
    <!--<![endif]-->
  </body>

</html>