<style>

.topbar-header
{
    margin-top: -1.5em;
}
.main-section
{
    width: 52%;
    margin-left: 26%;
    margin-top: 3%;
}
#test
{
    font-size: 75px;
    border: 5px solid white;
    padding: 15px;
    border-radius: 50%;
    color: white;
}
.main-section .panel-body 
{
    background: #3b3f4f!important;
}
.main-section .fs35 
{
    color: white!important;
}
.p12 button
{
    width: 35%;
    padding: 12px;
}

</style>

<!-- Start: Content -->
<section id="content_wrapper">
    <!-- Start: Topbar -->
    <div class="topbar-header">
        <header id="topbar">
            <div class="topbar-left">
                <ol class="breadcrumb">
                    <li class="crumb-active">
                         <a href="<?php echo base_url().'/dashboard'; ?>">Dashboard</a>
                    </li>

                    <li class="crumb-icon">
                         <a href="<?php echo base_url().'/dashboard'; ?>">
                            <span class="glyphicon glyphicon-home"></span>
                         </a>
                    </li>

                    <!--  <li class="crumb-link">
                         <a href="<?php //echo base_url().'/payments'; ?>">Payments</a>
                    </li> -->
                    
                    <li class="crumb-trail">Payment Success</li>
                </ol>
            </div>
        </header>
    </div>
<!-- End: Topbar -->
     <section id="content">
         <div class="main-section">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="panel panel-tile text-center br-a br-light">
                        <div class="panel-heading hidden">
                            <span class="panel-title"><i class="fa fa-pencil"></i> Title</span>
                        </div>
                        <div class="panel-body">
                            <h1 class="fs35 mbn">Your Payment Compeleted Sucessfully</h1><br>
                            <h3 class="text-system">Your Transaction Id Is : <?php echo $payment_message['payment_id']; ?>
                                
                            </h3><br>
                            <span><i class="fa fa-check" id="test"></i></span>
                        </div>
                        <div class="panel-footer br-t p12">
                            <a href ="<?php echo base_url().'/payments'; ?>"><button type="button" class="btn btn-dark">Go Back To Payment Tab</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
