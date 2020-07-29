<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title> Ant App</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('backend/vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{asset('backend/vendors/css/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
   @yield('pagePluginStyle')
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('backend/css/vertical-layout-light/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('backend/images/favicon.png')}}" />
  @yield('pageLevelStyle')
  <style type="text/css">
     .loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('/gif/giphy.gif') 50% 50% no-repeat rgb(249,249,249);
    /*background: url('gif/giphy.gif') 50% 50% no-repeat rgb(249,249,249);*/
    opacity: .8;
}
  </style>
 
</head>
<body>
  <div class="loader" style="display: none;" id="loading_loader"></div>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
     @include('layouts.partials.admin.navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      @include('layouts.partials.admin.setting')
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
       @include('layouts.partials.admin.sidebar')
      <!-- partial -->
      <div class="main-panel">
       {{-- main content --}}
       <div class="content-wrapper">
        {{-- main content yeild --}}
        @yield('mainContent')
        {{-- main content yeild --}}
      </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
         @include('layouts.partials.admin.footer')
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{asset('backend/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  @yield('pagePluginScript')
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{asset('backend/js/off-canvas.js')}}"></script>
  <script src="{{asset('backend/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('backend/js/template.js')}}"></script>
  <script src="{{asset('backend/js/settings.js')}}"></script>
  <script src="{{asset('backend/js/todolist.js')}}"></script>
  <!-- endinject -->

  <!-- Custom js for this page-->
  <script type="text/javascript">
$(document)
  .ajaxStart(function () {
      $("#loading_loader").show();
  })
  .ajaxStop(function () {
    $("#loading_loader").hide();
  })
  .ajaxSuccess(function () {
    $("#loading_loader").hide();
  });
  </script>
  @yield('pageLevelScript')
  <!-- End custom js for this page-->
</body>

</html>

