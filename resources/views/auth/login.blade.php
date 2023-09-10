<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="{{asset('assets/img/logo.png')}}">
  <title>
    Login-Register 
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="{{asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('assets/css/material-dashboard.css?v=3.1.0')}}" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
 
</head>

<body class="">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4">
          <div class="container-fluid ps-2 pe-0">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="#">
             Sistem Informasi Persediaan Barang - Toko Ragil Jaya
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
              <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                  <a class="nav-link me-2" href="{{url('/register')}}">
                    <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                    Sign Up
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2" href="{{url('/login')}}">
                    <i class="fas fa-key opacity-6 text-dark me-1"></i>
                    Sign In
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('../assets/img/login.jpg'); background-size: cover;">
              </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
          <!-- first alert -->
          @if(Session::has('failed'))
          <div style="width: 50%" class="alert alert-danger alert-dismissible text-white mx-3" role="alert" id="myAlert">
            <span class="text-sm">Failed {{Session::get('failed')}}.</span>
          </div>
          @elseif(Session::has('success'))
          <div style="width: 50%" class="alert alert-success alert-dismissible text-white" role="alert" id="myAlert">
            <span class="text-sm">Success {{Session::get('success')}}.</span>
          </div>
          @elseif(Session::has('session'))
          <div style="width: 50%" class="alert alert-success alert-dismissible text-white" role="alert" id="myAlert">
            <span class="text-sm">{{Session::get('session')}}.</span>
          </div>
          @else
          @endif
          <!-- end alert -->
              <div class="card card-plain">
                <div class="card-header">
                  <h4 class="font-weight-bolder">Sign In</h4>
                  <p class="mb-0">Silahkan Login</p>
                </div>
                <div class="card-body">
                  <form action="{{url('/login')}}" method="POST" role="form">
                    @csrf
                    @error('username')
                    <div class="form-text text-danger">{{$message}}.</div>
                    @enderror
                    <div class="input-group input-group-outline mb-3">
                      <input type="text" name="username" class="form-control  @error('username') is-invalid @enderror" value="{{old('username')}}" placeholder="username">
                    </div>
                    @error('password')
                    <div class="form-text text-danger">{{$message}}.</div>
                    @enderror
                    <div class="input-group input-group-outline mb-3">
                      <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror" value="{{old('password')}}" placeholder="password">
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Sign In</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-2 text-sm mx-auto">
                    Don't have an account?
                    <a href="{{url('/register')}}" class="text-primary text-gradient font-weight-bold">Sign Up</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!--   Core JS Files   -->
  <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
  <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('assets/js/material-dashboard.min.js?v=3.1.0')}}"></script>
  <script>
    // Ambil elemen alert
    var alertElement = document.getElementById('myAlert');

    // Tampilkan alert
    alertElement.style.display = 'block';

    // Setelah 3 detik, sembunyikan alert
    setTimeout(function() {
        alertElement.style.display = 'none';
    }, 3000); // 3000 milidetik = 3 detik
</script>
</body>

</html>