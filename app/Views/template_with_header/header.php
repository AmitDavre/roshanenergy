<?php

// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';
// die();

 $this->db = \Config\Database::connect();

$sql = "SELECT * FROM users WHERE login_type ='admin' AND id = '".$_SESSION['id']."'";

$query = $this->db->query($sql);
$statementTableData = $query->getResultArray();

// echo '<pre>';
// print_r($statementTableData);
// echo '</pre>';
// die();

?>
<!DOCTYPE html>
<html>

<head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <title>Dashboard</title>
    <meta name="keywords" content="Roshan Energy" />
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font CSS (Via CDN) -->
    <link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700'>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">


<!--  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/admin-tools/admin-forms/custom-css/datepicker.css"> -->

    <!-- date range picker -->
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/vendor/plugins/daterange/daterangepicker.css">

    <!-- Theme CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/skin/default_skin/css/theme.css">

    <!-- App.css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/skin/default_skin/css/app.css">

    <!-- Admin Panels CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/admin-tools/admin-plugins/admin-panels/adminpanels.css">

    <!-- Admin Forms CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/admin-tools/admin-forms/css/admin-forms.css">

     <!-- Required Plugin CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/vendor/plugins/datatables/media/css/dataTables.bootstrap.css">


    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/vendor/plugins/datepicker/css/bootstrap-datetimepicker.css">


     <!-- Admin Modals CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/admin-tools/admin-plugins/admin-modal/adminmodal.css">

      <!-- Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/vendor/plugins/magnific/magnific-popup.css">
    

    <!-- Custom admin form css -->
   <!--  <link rel="stylesheet" type="text/css" href="assets/admin-tools/admin-forms/custom-css/custom.css"> -->
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/admin-tools/admin-forms/custom-css/datepicker.css">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/img/favicon.ico">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
   <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
   <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
   <![endif]-->


    <!-- jQuery -->
    <script type="text/javascript" src="<?php echo base_url(); ?>/vendor/jquery/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/vendor/jquery/jquery_ui/jquery-ui.min.js"></script>

    <!-- Bootstrap -->
    <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/bootstrap/bootstrap.min.js"></script>

    <!-- Datatables -->
    <script type="text/javascript" src="<?php echo base_url(); ?>/vendor/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/vendor/plugins/datatables/media/js/dataTables.bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/vendor/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>

    <!-- payment process link -->

    <!-- link to the SqPaymentForm library -->
    <script type="text/javascript" src="https://js.squareupsandbox.com/v2/paymentform">
    </script>

    <!-- link to the local SqPaymentForm initialization -->
    <script type="text/javascript" src="<?php echo base_url(); ?>/payment_files/sqpaymentform.js">
    </script>

    <!-- link to the custom styles for SqPaymentForm -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/payment_files/sqpaymentform.css">
    
      <!--end  payment process link -->

    <!-- // API ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++> -->
    <script type="text/javascript" src="https://sandbox.web.squarecdn.com/v1/square.js"></script>



    <style>
    .img-responsive
    {
        max-width: 65%!important;
    }
    .logo
    {
        max-width: 127px!important;
    }
    .navbar .nav > li.dropdown.open .dropdown-menu 
    {
        /* margin-top: 10px; */
        border-radius: 6px;
        width: 0%!important;
    }
    </style>

</head>
<body class="dashboard-page sb-l-o sb-r-c">
<!-- Start: Main -->
    <div id="content">
<!-- Start: Header -->
        <header class="navbar navbar-fixed-top bg-light">
            <div class="navbar-branding">

             <!--  <a class="navbar-brand" href="dashboard.html"> <b>Admin</b>Designs </a> -->
               <a class="navbar-brand"  href="dashboard"> 
                 <!-- <img src="assets/img/logos/logo.jpeg" title="" class="headerLogoDefaultHEight img-responsive w250"> -->
                 <img src="<?php echo base_url(); ?>/assets/img/logos/logo.jpeg" alt="logo" class="mw30 br64 mr15 logo">

                </a> 
                <span id="toggle_sidemenu_l" class="glyphicons glyphicons-show_lines"></span>
                <ul class="nav navbar-nav pull-right hidden">
                    <li>
                        <a href="#" class="sidebar-menu-toggle">
                            <span class="octicon octicon-ruby fs20 mr10 pull-right "></span>
                        </a>
                    </li>
                </ul>
            </div>
             <!-- navbar -->
            <?php 
            if(session()->get('login_type') == "admin") 
            {    
            ?>
              
            <ul class="nav navbar-nav navbar-right">
               <li class="dropdown">
                    <a href="#" class="dropdown-toggle fw600 p15" data-toggle="dropdown"> <img src="<?php echo base_url().'/profile_img/'.$statementTableData[0]['upload_img']; ?>" alt="avatar" class="mw30 br64 mr15">

                         <!-- get first name using session -->
                        <span><?php echo session()->get('firstname'); ?></span>
                        
                        <span class="caret caret-tp"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-persist pn w250 bg-white" role="menu">
                        <li class="br-t of-h">
                            <a href="Authentication/logout" class="fw600 p12 animated animated-short fadeInDown">
                                <span class="fa fa-power-off pr5"></span> Logout </a>
                        </li>
                    </ul>
                </li>
            </ul>
           <?php } 
               else if(session()->get('login_type') == "biller") 
               {
                ?>
                <ul class="nav navbar-nav navbar-right">
                   <li class="dropdown">
                        <a href="#" class="dropdown-toggle fw600 p15" data-toggle="dropdown"> <img src="assets/img/avatars/9.jpg" alt="avatar" class="mw30 br64 mr15">
                            <!-- get first name using session -->
                            <span><?php echo session()->get('firstname'); ?></span>
                            <span class="caret caret-tp"></span>
                         </a>
                        <ul class="dropdown-menu dropdown-persist pn w250 bg-white" role="menu">
                            <li class="br-t of-h">
                                <a href="Authentication/logout" class="fw600 p12 animated animated-short fadeInDown">
                                    <span class="fa fa-power-off pr5"></span> Logout </a>
                            </li>
                        </ul>
                    </li>
                 </ul>
            <?php } 
            
            else if(session()->get('login_type') == "customer") 
            {
            ?>
             <ul class="nav navbar-nav navbar-right">
                   <li class="dropdown">
                        <a href="#" class="dropdown-toggle fw600 p15" data-toggle="dropdown"> <img src="assets/img/avatars/11.jpg" alt="avatar" class="mw30 br64 mr15">
                            <!-- get first name using session -->
                            <span><?php echo session()->get('firstname'); ?></span>
                            <span class="caret caret-tp"></span>
                         </a>
                        <ul class="dropdown-menu dropdown-persist pn w250 bg-white" role="menu">
                            <li class="br-t of-h">
                                <a href="Authentication/logout" class="fw600 p12 animated animated-short fadeInDown">
                                    <span class="fa fa-power-off pr5"></span> Logout </a>
                            </li>
                        </ul>
                    </li>
                 </ul>
            <?php }?>
        </header>
        <!-- End: Header -->
        
<!-- Start: Sidebar -->
 <?php 
    if(session()->get('login_type') == "admin") 
    {    
    ?>
       <aside id="sidebar_left" class="nano nano-primary">
            <div class="nano-content">
                <!-- sidebar menu -->
                <ul class="nav sidebar-menu">
                    <!-- sec-1 -->
                     <li class="sidebar-label pt20">Menu</li>
                        <li>
                            <a href="<?php echo base_url(); ?>/dashboard">
                                <span class="glyphicons glyphicons-home"></span>
                                <span class="sidebar-title">Dashboard</span>
                            </a>
                        </li>
                    <!--end sec-1 -->

                 <!-- sec-2 -->
                <li class="sidebar-label pt20">Manage Customer</li>
                    <li>
                        <a href="<?php echo base_url(); ?>/create-customer">
                            <span class="glyphicons glyphicons-user"></span>
                            <span class="sidebar-title">Create Customer</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>/manage-customer">
                            <span><i class="fa fa-users"></i></span>
                            <span class="sidebar-title">Manage Customer</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo base_url(); ?>/import-customer">
                            <span class="glyphicon glyphicon-cloud-upload"></span>
                            <span class="sidebar-title">Import Customer</span>
                        </a>
                    </li>
                <!--end sec-2 -->

                <!-- sec-3 -->
                    <li class="sidebar-label pt20">Manage Biller</li>
                    <li>
                        <a href="<?php echo base_url(); ?>/create-biller">
                            <span class="glyphicons glyphicons-user"></span>
                            <span class="sidebar-title">Create Biller</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>/manage-biller">
                            <span><i class="fa fa-users"></i></span>
                            <span class="sidebar-title">Manage Biller</span>
                        </a>
                    </li>
                <!-- end sec-3 -->

                <!-- sec-4 -->
                    <li class="sidebar-label pt20">Generate Statemants</li>
                    <li>
                        <a href="<?php echo base_url(); ?>/generate-statements">
                            <span class="fa fa-book"></span>
                            <span class="sidebar-title">Generate Statements</span>
                        </a>
                    </li>
                <!-- end sec-4 -->


                 <!-- sec-5 -->
                <li class="sidebar-label pt20">Customer Statements</li>
                    <li>
                        <a href="<?php echo base_url(); ?>/customer-statements">
                            <span class="glyphicons glyphicons-user"></span>
                            <span class="sidebar-title">Customer Statements</span>
                        </a>
                    </li>
                <!--end sec-5 -->

                  <!-- sec-6 -->
                <li class="sidebar-label pt20">Monthly Utility Bills</li>
                    <li>
                        <a href="<?php echo base_url(); ?>/utility-statements">
                            <span class="fa fa-book"></span>
                            <span class="sidebar-title">Utility Statements</span>
                        </a>
                    </li>
                <!--end sec-6 -->

                 <!-- sec-7 -->
                <li class="sidebar-label pt20">Payments</li>
                    <li>
                        <a href="<?php echo base_url(); ?>/payments">
                            <span><i class="fa fa-money"></i></span>
                            <span class="sidebar-title">Payments</span>
                        </a>
                    </li>
                <!--end sec-7 -->

                <!-- sec-8 -->
                    <li class="sidebar-label pt20">Settings</li>
                    <li>
                        <a href="<?php echo base_url(); ?>/edit-profile">
                            <span class="glyphicons glyphicons-settings"></span>
                            <span class="sidebar-title">Edit Profile</span>
                        </a>
                    </li>
                <!-- end sec-8 -->
               </ul>
            </div>
        </aside> <!-- end aside bar menu -->
    <?php } 
    else if(session()->get('login_type') == "biller") 
    {?>
          <aside id="sidebar_left" class="nano nano-primary">
            <div class="nano-content">
                <!-- sidebar menu -->
                <ul class="nav sidebar-menu">
                    <!-- sec-1 -->
                     <li class="sidebar-label pt20">Menu</li>
                        <li>
                            <a href="<?php echo base_url(); ?>/dashboard">
                                <span class="glyphicons glyphicons-home"></span>
                                <span class="sidebar-title">Dashboard</span>
                            </a>
                        </li>
                    <!--end sec-1 -->

                 <!-- sec-2 -->
                <li class="sidebar-label pt20">Manage Customer</li>
                    <li>
                        <a href="<?php echo base_url(); ?>/create-customer">
                            <span class="glyphicons glyphicons-user"></span>
                            <span class="sidebar-title">Create Customer</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>/manage-customer">
                            <span><i class="fa fa-users"></i></span>
                            <span class="sidebar-title">Manage Customer</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo base_url(); ?>/import-customer">
                            <span class="glyphicon glyphicon-cloud-upload"></span>
                            <span class="sidebar-title">Import Customer</span>
                        </a>
                    </li>
                <!--end sec-2 -->


                 <!-- sec-3 -->
                <li class="sidebar-label pt20">Customer Statements</li>
                    <li>
                        <a href="<?php echo base_url(); ?>/customer-statements">
                            <span class="glyphicons glyphicons-user"></span>
                            <span class="sidebar-title">Customer Statements</span>
                        </a>
                    </li>
                <!--end sec-3 -->

                 <!-- sec-4 -->
                <li class="sidebar-label pt20">Monthly Utility Bills</li>
                    <li>
                        <a href="<?php echo base_url(); ?>/utility-statements">
                            <span class="fa fa-book"></span>
                            <span class="sidebar-title">Utility Statements</span>
                        </a>
                    </li>
                <!--end sec-4 -->

                 <!-- sec-5 -->
                <li class="sidebar-label pt20">Payments</li>
                    <li>
                        <a href="<?php echo base_url(); ?>/payments">
                            <span><i class="fa fa-money"></i></span>
                            <span class="sidebar-title">Payments</span>
                        </a>
                    </li>
                <!--end sec-5 -->


                <!-- sec-6 -->
                    <li class="sidebar-label pt20">Settings</li>
                    <li>
                        <a href="<?php echo base_url(); ?>/edit-profile">
                            <span class="glyphicons glyphicons-settings"></span>
                            <span class="sidebar-title">Edit Profile</span>
                        </a>
                    </li>
                <!-- end sec-6 -->
               </ul>
            </div>
        </aside> <!-- end aside bar menu -->

   <?php }

    else if(session()->get('login_type') == "customer") 
    {?>
          <aside id="sidebar_left" class="nano nano-primary">
            <div class="nano-content">
                <!-- sidebar menu -->
                <ul class="nav sidebar-menu">
                    <!-- sec-1 -->
                     <li class="sidebar-label pt20">Menu</li>
                        <li>
                            <a href="<?php echo base_url(); ?>/dashboard">
                                <span class="glyphicons glyphicons-home"></span>
                                <span class="sidebar-title">Dashboard</span>
                            </a>
                        </li>
                    <!--end sec-1 -->

                 <!-- sec-2 -->
                <li class="sidebar-label pt20">Customer Statements</li>
                    <li>
                        <a href="<?php echo base_url(); ?>/customer-statements">
                            <span class="glyphicons glyphicons-user"></span>
                            <span class="sidebar-title">Customer Statements</span>
                        </a>
                    </li>
                <!--end sec-2 -->
               </ul>
            </div>
        </aside> <!-- end aside bar menu -->

   <?php }?>
       

</div>  <!-- End: Main -->

  

   

 