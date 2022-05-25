<?php 
// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';
// die();

?>
<!DOCTYPE html>

<html>

<head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="keywords" content="Roshan Energy" />
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font CSS (Via CDN) -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800'>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto:400,500,700,300">

    <!-- Theme CSS -->
    <link rel="stylesheet" type="text/css" href="assets/skin/default_skin/css/theme.css">

    <!-- Admin Forms CSS -->
    <link rel="stylesheet" type="text/css" href="assets/admin-tools/admin-forms/css/admin-forms.css">

    <!-- Custom admin form css -->
    <link rel="stylesheet" type="text/css" href="assets/admin-tools/admin-forms/custom-css/custom.css">


    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/img/favicon.ico">

</head>

<body class="external-page sb-l-c sb-r-c">

<!-- Start: Settings Scripts -->
    <script>
        var boxtest = localStorage.getItem('boxed');

        if (boxtest === 'true') {
            document.body.className += ' boxed-layout';
        }
    </script>
    <!-- End: Settings Scripts -->

<!-- Start: Main -->
<div id="main" class="animated fadeIn">

    <!-- begin canvas animation bg -->
            <div id="canvas-wrapper">
                <canvas id="demo-canvas"></canvas>
            </div>

    <section id="content">
         <div class="admin-form theme-info" id="login1">
              <div class="panel panel-info">
                   <div class="inner-sec">

    <!--  <form method="post" > -->
           <form method="post" action="Authentication/login_form">
               <div class="panel-body bg-light">

                    <div class="row">
                                    
                    <!-- Main section -->
                    <div class="col-md-12 col-lg-12 col-sm-12">

                                <!-- logo image -->
                                      <div class="text-center">
                                        <img src="assets/img/logos/logo.jpeg" title="" class="img-responsive w250">
                                       </div>
                                 <!-- end logo image -->

                            <!-- show error messsage -->
                                <?php
                                    if(session('message')){
                                ?> 
                                                                 
                                <div class="alert alert-danger light alert-dismissable" id="alert-demo-2">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <i class="fa fa-info pr10"></i>
                                    <?php echo session('message'); ?>
                                </div>

                            <?php } ?>
                            <!--end show error messsage -->


                                 <!-- section-1 -->
                                    <div class="section">
                                            <label for="username" class="field-label text-muted fs18 mb10">Username</label>
                                            <label for="username" class="field prepend-icon">
                                                <input type="text" name="username" id="username" class="gui-input" placeholder="Enter username">
                                                <label for="username" class="field-icon"><i class="fa fa-user"></i>
                                                </label>
                                            </label>
                                        </div>
                                    <!--end section-1 -->

                                    <!-- section-2 -->
                                        <div class="section">
                                            <label for="username" class="field-label text-muted fs18 mb10">Password</label>
                                            <label for="password" class="field prepend-icon">
                                                <input type="password" name="password" id="password" class="gui-input" placeholder="Enter password">
                                                <label for="password" class="field-icon"><i class="fa fa-lock"></i>
                                                </label>
                                            </label>
                                        </div>
                                    <!-- end section-2 -->

                                    <!-- section-3 -->
                                     
                                     <!-- remember me -->

                                    <!-- <label class="switch block switch-dark pull-left input-align mt10">
                                        <input type="checkbox" name="remember" id="remember" checked>
                                        <label for="remember" data-on="YES" data-off="NO"></label>
                                        <span>Remember me</span>
                                   </label> -->


                                <button type="submit" class="btn btn-dark btn-lg" name="submit_btn">Login</button>
                                <!-- end section-3 -->
                    </div>
                    <!-- end main section -->
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</section>
</section>
 </div>

 
  

    <!-- Google Map API -->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>

    <!-- jQuery -->
    <script type="text/javascript" src="vendor/jquery/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="vendor/jquery/jquery_ui/jquery-ui.min.js"></script>

    <!-- Bootstrap -->
    <script type="text/javascript" src="assets/js/bootstrap/bootstrap.min.js"></script>

    <!-- Page Plugins -->
    <script type="text/javascript" src="assets/js/pages/login/EasePack.min.js"></script>

    <script type="text/javascript" src="assets/js/pages/login/rAF.js"></script>

    <script type="text/javascript" src="assets/js/pages/login/TweenLite.min.js"></script>
    <script type="text/javascript" src="assets/js/pages/login/login.js"></script>

    <!-- Theme Javascript -->
    <script type="text/javascript" src="assets/js/utility/utility.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>
    <script type="text/javascript" src="assets/js/demo.js"></script>

     <!-- Page Javascript -->
    <script type="text/javascript">
        jQuery(document).ready(function() {

            "use strict";

            // Init Theme Core      
            Core.init();

            // Init Demo JS
            Demo.init();

            // Init CanvasBG and pass target starting location
            CanvasBG.init({
                Loc: {
                    x: window.innerWidth / 2,
                    y: window.innerHeight / 3.3
                },
            });


        });
    </script>

    <!-- END: PAGE SCRIPTS -->

</body>

</html>
