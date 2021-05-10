<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{config('app.name','NSU Smart Print Zone')}}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/iconfonts/ionicons/dist/css/ionicons.css">
    <link rel="stylesheet" href="assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/iconfonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.addons.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/shared/style.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('assets/css/demo_1/style.css')}}">
    <!-- End Layout styles -->
    <link rel="shortcut icon" href="{{asset('assets/images/nsu_logo_title.png')}}" />
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('inc._navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        @include('inc._student_sidebar')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">

                {{--Page Content Begins--}}
                @include('inc._messages')
                @yield('content')







            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            @include('inc._footer')
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="assets/vendors/js/vendor.bundle.base.js"></script>
<script src="assets/vendors/js/vendor.bundle.addons.js"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="assets/js/shared/off-canvas.js"></script>

{{--
<script>
    var btnContainer = document.getElementById("sidebar");


    // Get all buttons with class="btn" inside the container
    var btns = btnContainer.getElementsByClassName("nav-link");

    // Loop through the buttons and add the active class to the current/clicked button
    for (var i = 0; i < btns.length; i++) {

        btns[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("bg-dark");
            console.log(current);
            current[0].className = current[0].className.replace(" bg-dark", "");
            this.className += " bg-dark";
        });
    }
</script>
--}}

@yield('welcome_message')
@yield('filename_bootstrap_js')


<!-- endinject -->
<!-- Custom js for this page-->
<script src="assets/js/demo_1/dashboard.js"></script>
<!-- End custom js for this page-->
<script src="assets/js/shared/jquery.cookie.js" type="text/javascript"></script>
</body>
</html>
