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

    <title>CPS Registration</title>
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
              <h3>Create Account</h3>
              <p class="mb-4">Create an account and start your inventory tracking.</p>
            </div>

            <form action="{{ route('register.post') }}" method="POST">
              @csrf
              <div class="form-group first">
                <label for="username">Username @if ($errors->has('name')) <span class="text-danger"> {{ $errors->first('name') }} </span> @endif </label>
                <input type="text" id="name" class="form-control" name="name" required autofocus>
              </div>

              <div class="form-group">
                <label for="username">Email @if ($errors->has('email')) <span class="text-danger"> {{ $errors->first('email') }} </span> @endif </label>
                <input type="text" id="email_address" class="form-control" name="email" required autofocus>
              </div>

              <div class="form-group last mb-4">
                <label for="password">Password @if ($errors->has('password')) <span class="text-danger"> {{ $errors->first('password') }} </span> @endif </label>
                <input type="password" id="password" class="form-control" name="password" required>
              </div>

              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">I agree to the terms & services</span>
                  <input type="checkbox" checked="checked"/>
                  <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"><a href="login" class="forgot-pass">Login Account</a></span>
              </div>

              <input type="submit" value="Register" style="background-color:#2B2B2B; color:#FEFEFE;" class="btn btn-block">

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