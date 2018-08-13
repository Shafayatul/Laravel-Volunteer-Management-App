<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Volunteer Web-app</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ URL::asset('home-asset/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ URL::asset('home-asset/css/one-page-wonder.css')}}" rel="stylesheet">

    <!-- Bootstrap core JavaScript -->
    <script src="{{ URL::asset('home-asset/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ URL::asset('home-asset/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <style type="text/css">
      #login-btn{
        padding: 6px 28px;
      }
      @media only screen and (max-width: 892px) {
          .btn-secondary {
            margin-bottom: 10px;
          }
      }      
      @media only screen and (min-width: 893px) {
          .btn-secondary {
            margin-right: 10px;
          }
      }

    </style>

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Volunteer Web-app</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <!-- <a class="nav-link" href="#">Sign Up</a> -->
              <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Sign Up
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#">Teacher Sign Up</a>
                  <a class="dropdown-item" href="#">Volunteer Sign Up</a>
                </div>
              </div>
            </li>
            <li class="nav-item">
              <div class="dropdown">
              	<a href="{{url('/login')}}">
	                <button class="btn btn-secondary" id="login-btn" type="button">
	                  Login
	                </button>              		
              	</a>

              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>


    @yield('content')


    <!-- Footer -->
    <footer class="py-5 bg-black">
      <div class="container">
        <p class="m-0 text-center text-white small">Copyright &copy; Your Website 2018</p>
      </div>
      <!-- /.container -->
    </footer>



  </body>

</html>
