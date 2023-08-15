<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ລະບົບຈອງລົດ ທຫລ</title>
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
        .swal-title {
          font-family: Lao;
        }
        .sidebar{
          background-color: <?php if(1) echo "#000"; else echo "#fff"; ?>;
        }
        a.nav-link, .menu-icon{
          color: <?php if(1) echo "#fff !important"; else echo "#000 !important"; ?>; 
        }
    </style>

    @stack('css')
</head>
<body>

<?php
    $username_error = session()->pull("username_error");
    $password_error = session()->pull("password_error");
?>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <center>
                                <div class="brand-logo">
                                    <img src="{{asset('images/bol_logo.png')}}" alt="logo"/>
                                </div>
                            
                                <h4 class="fontLao">ເຂົ້າສູ່ລະບົບ</h4>
                                <h6 class="font-weight-light fontLao">ລະບົບບໍລິຫານພາຫະນະ ທະນາຄານແຫ່ງ ສປປລາວ.</h6>
                            
                            </center>

                            <form class="pt-3 mb-4" action="{{url('checklogin')}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <input type="text" name="username" id="username" value="{{old('username')}}" class="form-control form-control-lg" required="required" autofocus="on"  placeholder="Username" autocomplete="off">
                                    <span class="fontLao text-danger">{{$username_error }}</span>
                                </div>

                                <div class="form-group">
                                    <input type="password" name="password" id="password" value="{{old('password')}}" class="form-control form-control-lg" required="required" placeholder="Password" autocomplete="off">
                                    <span class="fontLao text-danger">{{$password_error }}</span>
                                </div>

                                <div class="mt-3">
                                    <input type="submit" value="ເຂົ້າສູ່ລະບົບ" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn fontLao" />
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

</body>

</html>

