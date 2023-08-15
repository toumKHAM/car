<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('vendors')}}/feather/feather.css">
    <link rel="stylesheet" href="{{asset('vendors')}}/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="{{asset('vendors')}}/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="{{asset('vendors')}}/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{asset('vendors')}}/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="{{asset('vendors')}}/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="{{asset('vendors')}}/select2/select2.min.css">
    <link rel="stylesheet" href="{{asset('vendors')}}/select2-bootstrap-theme/select2-bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css')}}/flatpickr.min.css">
    <link rel="stylesheet" href="{{asset('css')}}/vertical-layout-light/style.css">

		<!-- Favicon -->
		<link rel="shortcut icon" href="{{asset('images/newfavicon.ico')}}" type="image/x-icon" />
    
    <style>
        @font-face{
          font-family:Lao;
          src: url('/fonts/PhetsarathOT.woff');
        }
        .fontLao{
          font-family:Lao;
        }
        .swal-title, .swal-text, .swal-button {
          font-family: Lao;
        }
        .sidebar{
          background-color: <?php use Illuminate\Support\Facades\Auth;
                                if(Auth::user()->role == "A") echo "#000"; else echo "#fff"; 
                            ?>;
        }
        a.nav-link, .menu-icon{
          color: <?php if(Auth::user()->role == "A") echo "#fff !important"; else echo "#000 !important"; ?>; 
        }
    </style>

    @stack('css')
</head>
<body>
  <div class="container-scroller">
<!-- <<-- Header start -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="index.html"><img src="{{asset('/images/book_car_logo.png')}}" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="/images/logo-mini.svg" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <span class="input-group-text" id="search">
                  <!-- <i class="icon-search"></i> -->
                </span>
              </div>
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right" id="user-name">
          <li class="nav-item nav-profile">
            {{ Auth::user()->name }} ( <span class="fontLao">{{ Auth::user()->dept->name }}</span> )
          </li>
          <li class="nav-item nav-profile dropdown">
            
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="{{asset('/images/faces/face23.jpg')}}" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" id="change-password">
                <i class="ti-settings text-primary"></i>
                <span class="fontLao">ປ່ຽນລະຫັດຜ່ານ</span>
              </a>
              <a class="dropdown-item" href="{{url('logout')}}">
                <i class="ti-power-off text-primary"></i>
                <span class="fontLao">ອອກຈາກລະບົບ</span>
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
<!-- <<-- Header end -->

    <div class="container-fluid page-body-wrapper">
      <div id="right-sidebar" class="settings-panel">
        <i class="settings-close ti-close"></i>
      </div>
<!-- <<-- sidebar menu start -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <img src="{{asset('/images/bol_logo.png')}}" alt="" width="100%">
          
          <!-- Admin role -->
          @if(Auth::user()->role == "A")
          <li class="nav-item">
            <a class="nav-link" href="{{url('admin/home')}}">
              <i class="mdi mdi-home menu-icon"  style="font-size:20px;"></i>
              <span class="menu-title fontLao">ໜ້າຫຼັກ</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{url('admin/booking')}}">
              <i class="mdi mdi-view-dashboard menu-icon"  style="font-size:20px;"></i>
              <span class="menu-title fontLao">ຂໍ້ມູນຈອງລົດ</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{url('admin/car')}}">
              <i class="mdi mdi-car menu-icon"  style="font-size:20px;"></i>
              <span class="menu-title fontLao">ຂໍ້ມູນລົດ</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{url('admin/driver')}}">
              <i class="mdi mdi-account-key menu-icon"  style="font-size:20px;"></i>
              <span class="menu-title fontLao">ຂໍ້ມູນຄົນຂັບລົດ</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{url('admin/booker')}}">
              <i class="mdi mdi-account-convert menu-icon"  style="font-size:20px;"></i>
              <span class="menu-title fontLao">ຂໍ້ມູນຜູ້ຈອງລົດ</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{url('admin/workplans')}}">
              <i class="mdi mdi-calendar-text menu-icon"  style="font-size:20px;"></i>
              <span class="menu-title fontLao">ຂໍ້ມູນຕາຕະລາງງານ</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{url('admin/history')}}">
              <i class="mdi mdi-history menu-icon"  style="font-size:20px;"></i>
              <span class="menu-title fontLao">ປະຫວັດການອະນຸມັດລົດ</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{url('admin/report')}}">
              <i class="mdi mdi-chart-bar menu-icon"  style="font-size:20px;"></i>
              <span class="menu-title fontLao">ເບິ່ງລາຍງານ</span>
            </a>
          </li>
          @endif
          <!-- End Admin role -->



          <!-- User role -->
          @if(Auth::user()->role == "U")
          <li class="nav-item">
            <a class="nav-link" href="{{url('user/home')}}">
              <i class="mdi mdi-home menu-icon"  style="font-size:20px;"></i>
              <span class="menu-title fontLao">ໜ້າຫຼັກ</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{url('user/booking')}}">
              <i class="mdi mdi-table-edit menu-icon"  style="font-size:20px;"></i>
              <span class="menu-title fontLao">ຈອງລົດ</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{url('user/history')}}">
              <i class="mdi mdi-history menu-icon"  style="font-size:20px;"></i>
              <span class="menu-title fontLao">ປະຫວັດຈອງລົດ</span>
            </a>
          </li>
          @endif
          <!-- End User role -->

          
        </ul>
      </nav>
<!-- <<-- sidebar menu end -->

      <!-- main-panel start -->
      <div class="main-panel">
        <div class="content-wrapper">

          @yield('content')

        </div>

        <!-- change password modal -->
        @include("component.changepwd.changepwd")

        <!-- end modal -->

<!-- <<-- footer start -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023. </span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"><span class="fontLao">ທະນາຄານແຫ່ງ ສປປ ລາວ</span> <i class="ti-heart text-danger ml-1"></i></span>
          </div>
        </footer> 
<!-- <<-- footer end -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{asset('vendors')}}/js/vendor.bundle.base.js"></script>
  <!-- endinject -->

  <!-- inject:js -->
  <script src="{{asset('js')}}/off-canvas.js"></script>
  <script src="{{asset('js')}}/hoverable-collapse.js"></script>
  <script src="{{asset('js')}}/template.js"></script>
  
  <script src="{{asset('js')}}/sweetalert.js"></script>
  <script src="{{asset('vendors')}}/datatables.net/jquery.dataTables.js"></script>
  <script src="{{asset('vendors')}}/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="{{asset('vendors')}}/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="{{asset('vendors')}}/select2/select2.min.js"></script>
  <script src="{{asset('js')}}/select2.js"></script>
  <script src="{{asset('js')}}/flatpickr.js"></script>
  
  <!-- endinject -->

  <!-- script for every page -->
  <script>
    var changepwd_msg = $('#changepwd_msg').val();
    var changepwd_icon = $('#changepwd_icon').val();
    if(changepwd_msg !== ''){
        swal({
            title: changepwd_msg,
            icon: changepwd_icon,
        });
    }
    $(document).on("click","#change-password",function(){
      $("#changepwd-modal").modal('toggle');
    })
    $(document).on("click",".btn-close-changepwd",function(){
        $("#changepwd-modal").modal('hide');
    })
    $(document).on("click","#savepass",function(e){
      e.preventDefault()
      var valid =  document.querySelector('#changepwd-form').reportValidity()
      if(valid){
        var newpass = $("#newpass").val()
        var confirmnewpass = $("#confirmnewpass").val()
        if(newpass == confirmnewpass){
          $("#changepwd-form").submit()
        }else{
          swal({
              title: "ລະຫັດຜ່ານໃໝ່ບໍ່ຄືກັບຂ້າງເທິງ",
              icon: "error",
          })
        }
      }
    })
  </script>

@stack('scripts')
</body>

</html>

