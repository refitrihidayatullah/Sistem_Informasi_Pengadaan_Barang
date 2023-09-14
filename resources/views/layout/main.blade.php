<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{asset('assets/img/logo.png')}}">
    <title>
        Toko Ragil Jaya
    </title>
    <style>
        .activLink{
            background-color: greenyellow;
        }
    </style>
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
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <!-- <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script> -->
</head>

<body class="g-sidenav-show  bg-gray-200">

<!--first sidebar -->
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-success" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{url('/dashboard')}}">
            <img src="{{asset('assets/img/logo.png')}}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-dark">Toko Ragil Jaya</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white @if(request()->is('dashboard')) active @endif" href="{{url('/dashboard')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Master Data</h6>
            </li> 
            <li class="nav-item">
                <a class="nav-link text-white @if(request()->is('supplier')) active @endif" href="{{url('/supplier')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Supplier</span>
                </a>
            </li>          
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle @if(request()->is('barang') || request()->is('barang/create') || request()->is('kategori') || request()->is('kategori/create') || request()->is('satuan') || request()->is('satuan/create')) active @endif" href="#" id="masterData" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">table_view</i>
                </div>
                <span class="nav-link-text ms-1">Barang</span>
                </a>
                
                <ul class="dropdown-menu" aria-labelledby="masterData">
                  <li><a class="dropdown-item" href="{{url('/kategori')}}">Data Kategori</a></li>
                  <li><a class="dropdown-item" href="{{url('/satuan')}}">Data Satuan</a></li>
                  <li><a class="dropdown-item" href="{{url('/barang')}}">Data Barang</a></li>
                </ul>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Transaksi</h6>
            </li> 
            <li class="nav-item">
                <a class="nav-link text-white @if(request()->is('barang-masuk')) active @endif " href="{{url('/barang-masuk')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <span class="nav-link-text ms-1">Barang Masuk</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link text-white " href="{{url('/barang-keluar')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Barang Keluar</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white " href="{{url('/riwayat-transaksi')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Riwayat Transaksi</span>
                </a>
            </li>
            {{-- <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Management Account</h6>
            </li>
            <li class="nav-item dropdown">
                
                <a class="nav-link dropdown-toggle" href="#" id="laporan" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">table_view</i>
                </div>
                <span class="nav-link-text ms-1">Account</span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="laporan">
                  <li><a class="dropdown-item" href="#">DataUsers</a></li>
                  <li><a class="dropdown-item" href="#">Profile</a></li>
                  <li><a class="dropdown-item" href="#">Change Password</a></li>
                  <li><a class="dropdown-item" href="{{url('/logout')}}">Logout</a></li>
                </ul>
            </li> --}}
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Laporan</h6>
            </li>
            <li class="nav-item dropdown">
                
                <a class="nav-link dropdown-toggle" href="#" id="laporan" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">table_view</i>
                </div>
                <span class="nav-link-text ms-1">Laporan</span>
                </a>
                
                <ul class="dropdown-menu" aria-labelledby="laporan">
                  <li><a class="dropdown-item" href="#">Laporan Barang Masuk</a></li>
                  <li><a class="dropdown-item" href="#">Laporan Barang Keluar</a></li>
                </ul>
            </li>
        </ul>
    </div>
</aside>
<!--end sidebar -->
    
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- first Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Page</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">@yield('title')</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">@yield('title')</h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    </div>
                    <ul class="navbar-nav  justify-content-end">
                        <li class="nav-item d-flex align-items-center">
                            <a class="btn btn-outline-primary btn-sm mb-0 me-3"  href="#">Online {{Auth::user()->name ?:'user'}}</a>
                        </li>
                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
            
                        <li class="nav-item dropdown pe-2 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-bell cursor-pointer"></i>
                            </a>
                            <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="my-auto">
                                                <img src="../assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    <span class="font-weight-bold">New message</span> from Laur
                                                </h6>
                                                <p class="text-xs text-secondary mb-0">
                                                    <i class="fa fa-clock me-1"></i>
                                                    13 minutes ago
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                
                            </ul>
                        </li>
                        <li class="nav-item d-flex align-items-center">
                            <a href="{{url('/logout')}}" class="nav-link text-body font-weight-bold px-0">
                                <i class="fa fa-user me-sm-1"></i>
                                <span class="d-sm-inline d-none">Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- end Navbar -->
   
        
        <div class="container-fluid py-4">

    <!-- first content -->
   
    @yield('content')
    <!-- end content -->

           <!-- first footer -->

           <footer class="footer py-4  ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            © <script>
                                document.write(new Date().getFullYear())
                            </script>,
                            
                            <a href="#" class="font-weight-bold">Sistem Informasi Persediaan Barang</a>
                            Toko Pertanian Ragil Jaya
                        </div>
                    </div>
                  
                </div>
            </div>
        </footer>
           <!-- end footer -->
        </div>
    </main>

   <!-- first js -->
    <!--   Core JS Files   -->
 <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
 <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
 <script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
 <script src="{{asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
 <script src="{{asset('assets/js/plugins/chartjs.min.js')}}"></script>
 <script>
     var ctx = document.getElementById("chart-bars").getContext("2d");

     new Chart(ctx, {
         type: "bar",
         data: {
             labels: ["M", "T", "W", "T", "F", "S", "S"],
             datasets: [{
                 label: "Sales",
                 tension: 0.4,
                 borderWidth: 0,
                 borderRadius: 4,
                 borderSkipped: false,
                 backgroundColor: "rgba(255, 255, 255, .8)",
                 data: [50, 20, 10, 22, 50, 10, 40],
                 maxBarThickness: 6
             }, ],
         },
         options: {
             responsive: true,
             maintainAspectRatio: false,
             plugins: {
                 legend: {
                     display: false,
                 }
             },
             interaction: {
                 intersect: false,
                 mode: 'index',
             },
             scales: {
                 y: {
                     grid: {
                         drawBorder: false,
                         display: true,
                         drawOnChartArea: true,
                         drawTicks: false,
                         borderDash: [5, 5],
                         color: 'rgba(255, 255, 255, .2)'
                     },
                     ticks: {
                         suggestedMin: 0,
                         suggestedMax: 500,
                         beginAtZero: true,
                         padding: 10,
                         font: {
                             size: 14,
                             weight: 300,
                             family: "Roboto",
                             style: 'normal',
                             lineHeight: 2
                         },
                         color: "#fff"
                     },
                 },
                 x: {
                     grid: {
                         drawBorder: false,
                         display: true,
                         drawOnChartArea: true,
                         drawTicks: false,
                         borderDash: [5, 5],
                         color: 'rgba(255, 255, 255, .2)'
                     },
                     ticks: {
                         display: true,
                         color: '#f8f9fa',
                         padding: 10,
                         font: {
                             size: 14,
                             weight: 300,
                             family: "Roboto",
                             style: 'normal',
                             lineHeight: 2
                         },
                     }
                 },
             },
         },
     });


     var ctx2 = document.getElementById("chart-line").getContext("2d");

     new Chart(ctx2, {
         type: "line",
         data: {
             labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
             datasets: [{
                 label: "Mobile apps",
                 tension: 0,
                 borderWidth: 0,
                 pointRadius: 5,
                 pointBackgroundColor: "rgba(255, 255, 255, .8)",
                 pointBorderColor: "transparent",
                 borderColor: "rgba(255, 255, 255, .8)",
                 borderColor: "rgba(255, 255, 255, .8)",
                 borderWidth: 4,
                 backgroundColor: "transparent",
                 fill: true,
                 data: [50, 40, 300, 320, 500, 350, 200, 230, 500],
                 maxBarThickness: 6

             }],
         },
         options: {
             responsive: true,
             maintainAspectRatio: false,
             plugins: {
                 legend: {
                     display: false,
                 }
             },
             interaction: {
                 intersect: false,
                 mode: 'index',
             },
             scales: {
                 y: {
                     grid: {
                         drawBorder: false,
                         display: true,
                         drawOnChartArea: true,
                         drawTicks: false,
                         borderDash: [5, 5],
                         color: 'rgba(255, 255, 255, .2)'
                     },
                     ticks: {
                         display: true,
                         color: '#f8f9fa',
                         padding: 10,
                         font: {
                             size: 14,
                             weight: 300,
                             family: "Roboto",
                             style: 'normal',
                             lineHeight: 2
                         },
                     }
                 },
                 x: {
                     grid: {
                         drawBorder: false,
                         display: false,
                         drawOnChartArea: false,
                         drawTicks: false,
                         borderDash: [5, 5]
                     },
                     ticks: {
                         display: true,
                         color: '#f8f9fa',
                         padding: 10,
                         font: {
                             size: 14,
                             weight: 300,
                             family: "Roboto",
                             style: 'normal',
                             lineHeight: 2
                         },
                     }
                 },
             },
         },
     });

     var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");

     new Chart(ctx3, {
         type: "line",
         data: {
             labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
             datasets: [{
                 label: "Mobile apps",
                 tension: 0,
                 borderWidth: 0,
                 pointRadius: 5,
                 pointBackgroundColor: "rgba(255, 255, 255, .8)",
                 pointBorderColor: "transparent",
                 borderColor: "rgba(255, 255, 255, .8)",
                 borderWidth: 4,
                 backgroundColor: "transparent",
                 fill: true,
                 data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                 maxBarThickness: 6

             }],
         },
         options: {
             responsive: true,
             maintainAspectRatio: false,
             plugins: {
                 legend: {
                     display: false,
                 }
             },
             interaction: {
                 intersect: false,
                 mode: 'index',
             },
             scales: {
                 y: {
                     grid: {
                         drawBorder: false,
                         display: true,
                         drawOnChartArea: true,
                         drawTicks: false,
                         borderDash: [5, 5],
                         color: 'rgba(255, 255, 255, .2)'
                     },
                     ticks: {
                         display: true,
                         padding: 10,
                         color: '#f8f9fa',
                         font: {
                             size: 14,
                             weight: 300,
                             family: "Roboto",
                             style: 'normal',
                             lineHeight: 2
                         },
                     }
                 },
                 x: {
                     grid: {
                         drawBorder: false,
                         display: false,
                         drawOnChartArea: false,
                         drawTicks: false,
                         borderDash: [5, 5]
                     },
                     ticks: {
                         display: true,
                         color: '#f8f9fa',
                         padding: 10,
                         font: {
                             size: 14,
                             weight: 300,
                             family: "Roboto",
                             style: 'normal',
                             lineHeight: 2
                         },
                     }
                 },
             },
         },
     });
 </script>
 <script>
     var win = navigator.platform.indexOf('Win') > -1;
     if (win && document.querySelector('#sidenav-scrollbar')) {
         var options = {
             damping: '0.5'
         }
         Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
     }
 </script>
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const harga = document.getElementById('harga');
    
        harga.addEventListener('input', function () {
            const value = harga.value.replace(/\D/g, '');
            const formattedValue = new Intl.NumberFormat('id-ID').format(value);
    
            harga.value = formattedValue;
        });
    });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const harga_jual = document.getElementById('harga_jual');
        
            harga_jual.addEventListener('input', function () {
                const value = harga_jual.value.replace(/\D/g, '');
                const formattedValue = new Intl.NumberFormat('id-ID').format(value);
        
                harga_jual.value = formattedValue;
            });
        });
        </script>
        <script>
            function hitungKembalian()
            {
                var grandtotal = parseFloat(document.getElementById('grandtotal').value);
                var pembayaran = parseFloat(document.getElementById('pembayaran').value);
                // hitung kembalian
                var kembalian = pembayaran - grandtotal;
                if (!isNaN(kembalian) && kembalian >= 0) {
                document.getElementById('kembalian').textContent ="Rp"+ kembalian;
            } else {
                document.getElementById('kembalian').textContent = 0;
            }
            }
        </script>
        <script>
            const grandtotalElement = document.getElementById('grandtotal');
            const pembayaranElement = document.getElementById('pembayaran');
            const btnbayarElement = document.getElementById('btnbayar');

            function checkPembayaran()
            {
                const grandtotal = parseFloat(document.getElementById('grandtotal').value);
                const pembayaran = parseFloat(document.getElementById('pembayaran').value);
                if(pembayaran >= grandtotal && grandtotal != 0)
                {
                    btnbayarElement.style.display = 'block';
                }else{
                    btnbayarElement.style.display = 'none';
                }
            }
            // Panggil fungsi checkPembayaran() saat input pembayaran berubah
            pembayaranElement.addEventListener('input', checkPembayaran);
            // Panggil fungsi checkPayment() saat halaman dimuat untuk mengatur status awal tombol "Bayar"
            checkPembayaran();
        </script>


 <!-- Github buttons -->
 <script async defer src="https://buttons.github.io/buttons.js"></script>
 <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
 <script src="{{asset('assets/js/material-dashboard.min.js?v=3.1.0')}}"></script>
   <!-- end js -->
</body>

</html>