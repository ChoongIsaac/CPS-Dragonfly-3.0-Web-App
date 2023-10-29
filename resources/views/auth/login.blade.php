<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

    <title>CPS Sign In</title>
    <link rel="shortcut icon" href="css/iconcss/favicon2.png" type="image/x-icon">
  </head>
  
  
  <body>

  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <img src="images/loginimage.svg" alt="Image" class="img-fluid">
        </div>

        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
              <h3>Sign In Account</h3>
              <p class="mb-4">Welcome to CPS Inventory Tracking System</p>
            </div>

            @if (session()->has('invalid'))
                <div class="alert alert-danger" role="alert">
                    {{ session()->get('invalid') }}
                </div>
            @endif

            @if (session()->has('registered'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('registered') }}
                </div>
            @endif

            @if (session()->has('noaccess'))
                <div class="alert alert-danger" role="alert">
                    {{ session()->get('noaccess') }}
                </div>
            @endif


            <form action="{{ route('login.post') }}" method="POST">
              @csrf
              <div class="form-group first">
                <label for="username">Username</label>
                <input type="text" id="name" class="form-control" name="name" required autofocus>
              </div>

              <div class="form-group last mb-4">
                <label for="password">Password</label>
                <input type="password" id="password" class="form-control" name="password" required>
              </div>

              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                  <input type="checkbox" checked="checked"/>
                  <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"><a href="registration" class="forgot-pass">Create New Account</a></span>
              </div>

              <input type="submit" value="Sign In" style="background-color:#2B2B2B; color:#FEFEFE;" class="btn btn-block">

            </form>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>