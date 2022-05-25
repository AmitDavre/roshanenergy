<?php

$this->db = \Config\Database::connect();

$sql = "SELECT * FROM users WHERE login_type ='admin' AND id = '".$_SESSION['id']."'";

$query = $this->db->query($sql);
$statementTableData = $query->getResultArray();

?>
<!-- Admin Dashboard -->
<!DOCTYPE html>
<html>
<head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <title>DASHBOARD</title>
    <meta name="keywords" content="Roshan Energy" />
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font CSS (Via CDN) -->
    <link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700'>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">

    <!-- Theme CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/skin/default_skin/css/theme.css">

    <!-- Admin Panels CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/admin-tools/admin-plugins/admin-panels/adminpanels.css">

    <!-- Admin Forms CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/admin-tools/admin-forms/css/admin-forms.css">

    <!-- Custom admin form css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/admin-tools/admin-forms/custom-css/custom.css">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/img/favicon.ico">

</head>

<style>
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

<body class="dashboard-page sb-l-o sb-r-c">
<!-- Start: Header -->
 <!-- Start: Main -->
    <div id="main">

        <!-- Start: Header -->
        <header class="navbar navbar-fixed-top bg-light">
            <div class="navbar-branding">
                <a  href="dashboard"> 
                 <!-- <img src="assets/img/logos/logo.jpeg" title="" class="headerLogoDefaultHEight img-responsive w250"> -->
                 <img src="<?php echo base_url(); ?>/assets/img/logos/logo.jpeg" alt="logo" class="mw30 br64 mr15 logo">
                </a>
            </div>

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

<header id="topbar">
</header>