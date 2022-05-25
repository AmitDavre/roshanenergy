<!-- Start: Content -->
<section id="content_wrapper">
    <section id="content">
        <div class="main-section">

            <?php 
            if (session()->get('login_type') == "admin") 
            {?>
            <div class="row">

        <!-- section-1 -->
            <a href="create-customer">
                <div class="col-sm-4 col-md-4">
                    <div class="panel panel-tile text-center br-a br-light">
                        <div class="panel-heading hidden">
                            <span class="panel-title"><i class="fa fa-pencil"></i> Title</span>
                        </div>
                        <div class="panel-body">
                            <h1 class="fs35 mbn">Create Customer</h1>
                            <h6 class="text-system">This is an address look-up or new entry </h6>
                        </div>
                        <div class="panel-footer br-t p12">
                            <button type="button" class="btn btn-dark">Select</button>
                        </div>
                    </div>
                </div>
             </a>

        <!--section-2-->
            <a href="create-biller">
                <div class="col-sm-4 col-md-4">
                    <div class="panel panel-tile text-center br-a br-light">
                        <div class="panel-heading hidden">
                            <span class="panel-title"><i class="fa fa-pencil"></i> Title</span>
                        </div>
                        <div class="panel-body">
                            <h1 class="fs35 mbn">Create Biller</h1>
                            <h6 class="text-system">Utility statement,payment and payout report view</h6>
                        </div>
                        <div class="panel-footer br-t p12">
                             <button type="button" class="btn btn-dark">Select</button>
                        </div>
                    </div>
                </div>
            </a>
           
        <!-- section-3 -->
            <a href="manage-both">
                <div class="col-sm-4 col-md-4">
                    <div class="panel panel-tile text-center br-a br-light">
                        <div class="panel-heading hidden">
                            <span class="panel-title"><i class="fa fa-pencil"></i> Title</span>
                        </div>
                        <div class="panel-body">
                            <h1 class="fs35 mbn">Manage Customer/Biller</h1>
                            <h6 class="text-system">The create or upload new water and electricity bills</h6>
                        </div>
                        <div class="panel-footer br-t p12">
                            <button type="button" class="btn btn-dark">Select</button>
                        </div>
                    </div>
                 </div>
             </a>
         </div>
   <?php } 
   else if(session()->get('login_type') == "biller") 
   {?>
    <!-- section-1 -->
         <div class= "row">
            <a href="create-customer">
                <div class="col-sm-5 col-md-5">
                    <div class="panel panel-tile text-center br-a br-light">
                        <div class="panel-heading hidden">
                            <span class="panel-title"><i class="fa fa-pencil"></i> Title</span>
                        </div>
                        <div class="panel-body">
                            <h1 class="fs35 mbn">Create Customer</h1>
                            <h6 class="text-system">This is an address look-up or new entry </h6>
                        </div>
                        <div class="panel-footer br-t p12">
                            <button type="button" class="btn btn-dark">Select</button>
                        </div>
                    </div>
                </div>
             </a>
             </div>
     <?php }?>
    
</div>
</section>
</section>
 
<!-- End: Main -->




















