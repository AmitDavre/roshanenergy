<?php 
    if(session()->get('login_type') == "admin") 
    {    
    ?>
        <section id="content_wrapper">
            <section id="content">
                <div class="main-section">
                    <div class="row">
                        <!-- section-1 -->
                        <a href="account-control">
                            <div class="col-sm-4 col-md-4">
                                <div class="panel panel-tile text-center br-a br-light">
                                    <div class="panel-heading hidden">
                                        <span class="panel-title"><i class="fa fa-pencil"></i> Title</span>
                                    </div>
                                    <div class="panel-body">
                                        <h1 class="fs35 mbn">Account Control</h1>
                                        <h6 class="text-system">This is an address look-up or new entry </h6>
                                    </div>
                                    <div class="panel-footer br-t p12">
                                        <button type="button" class="btn btn-dark">Select</button>
                                    </div>
                                </div>
                            </div>
                        </a>

                <a href ="statements-view">
                    <div class="col-sm-4 col-md-4">
                        <div class="panel panel-tile text-center br-a br-light">
                            <div class="panel-heading hidden">
                                <span class="panel-title"><i class="fa fa-pencil"></i> Title</span>
                            </div>
                                <div class="panel-body">
                                    <h1 class="fs35 mbn">Statement View</h1>
                                    <h6 class="text-system">Utility statement,payment and payout report view</h6>
                                </div>
                                <div class="panel-footer br-t p12">
                                    <button type="button" class="btn btn-dark">Select</button>
                                </div>
                        </div>
                    </div>
                </a>
               

                <a href="create-upload-bills">
                    <div class="col-sm-4 col-md-4">
                        <div class="panel panel-tile text-center br-a br-light">
                            <div class="panel-heading hidden">
                                <span class="panel-title"><i class="fa fa-pencil"></i> Title</span>
                            </div>
                            <div class="panel-body">
                                <h1 class="fs35 mbn">Create/Upload bills</h1>
                                <h6 class="text-system">The create or upload new water and electricity bills</h6>
                            </div>
                            <div class="panel-footer br-t p12">
                                <button type="button" class="btn btn-dark">Select</button>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
</section>
</section>

<?php } 
    else if(session()->get('login_type') == "biller") 
    {?>

        <section id="content_wrapper">
            <section id="content">
                <div class="main-section">
                    <div class="row">
                        <!-- section-1 -->
                        <a href="account-control">
                            <div class="col-sm-4 col-md-4">
                                <div class="panel panel-tile text-center br-a br-light">
                                    <div class="panel-heading hidden">
                                        <span class="panel-title"><i class="fa fa-pencil"></i> Title</span>
                                    </div>
                                    <div class="panel-body">
                                        <h1 class="fs35 mbn">Account Control</h1>
                                        <h6 class="text-system">This is an address look-up or new entry </h6>
                                    </div>
                                    <div class="panel-footer br-t p12">
                                        <button type="button" class="btn btn-dark">Select</button>
                                    </div>
                                </div>
                            </div>
                        </a>

                <!--section-2-->
                <a href ="statements-view">
                    <div class="col-sm-4 col-md-4">
                        <div class="panel panel-tile text-center br-a br-light">
                            <div class="panel-heading hidden">
                                <span class="panel-title"><i class="fa fa-pencil"></i> Title</span>
                            </div>
                                <div class="panel-body">
                                    <h1 class="fs35 mbn">Statement View</h1>
                                    <h6 class="text-system">Utility statement,payment and payout report view</h6>
                                </div>
                                <div class="panel-footer br-t p12">
                                    <button type="button" class="btn btn-dark">Select</button>
                                </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
</section>
</section>

<?php } 
    else if(session()->get('login_type') == "customer") 
    {?>
        <section id="content_wrapper">
            <section id="content">
                <div class="main-section">
                    <div class="row">
                        <!--section-2-->
                        <a href ="statements-view">
                            <div class="col-sm-4 col-md-4">
                                <div class="panel panel-tile text-center br-a br-light">
                                    <div class="panel-heading hidden">
                                        <span class="panel-title"><i class="fa fa-pencil"></i> Title</span>
                                    </div>
                                        <div class="panel-body">
                                            <h1 class="fs35 mbn">Statement View</h1>
                                            <h6 class="text-system">Utility statement,payment and payout report view</h6>
                                        </div>
                                        <div class="panel-footer br-t p12">
                                            <button type="button" class="btn btn-dark">Select</button>
                                        </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </section>
        </section>
<?php } ?>

       
  










