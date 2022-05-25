<!-- Start: Content -->
<section id="content_wrapper">
    <section id="content">
        <div class="main-section">
            <div class="row">
                <?php 
                if(session()->get('login_type') == "customer")
                { ?>
                <!-- section-1 -->
                <a href="customer-statements">
                    <div class="col-sm-4 col-md-4">
                        <div class="panel panel-tile text-center br-a br-light">
                            <div class="panel-heading hidden">
                                <span class="panel-title"><i class="fa fa-pencil"></i> Title</span>
                            </div>
                            <div class="panel-body">
                                <h1 class="fs35 mbn">Customer Statements</h1>
                                <h6 class="text-system">Utility Statements</h6>
                            </div>
                            <div class="panel-footer br-t p12">
                                <button type="button" class="btn btn-dark">Select</button>
                            </div>
                        </div>
                    </div>
                </a>
                <?php }

                 else if(session()->get('login_type') == "admin" || session()->get('login_type') == "biller")
                {?>

                <!-- section-1 -->
                <a href="customer-statements">
                    <div class="col-sm-4 col-md-4">
                        <div class="panel panel-tile text-center br-a br-light">
                            <div class="panel-heading hidden">
                                <span class="panel-title"><i class="fa fa-pencil"></i> Title</span>
                            </div>
                            <div class="panel-body">
                                <h1 class="fs35 mbn">Customer Statements</h1>
                                <h6 class="text-system">Utility Statements</h6>
                            </div>
                            <div class="panel-footer br-t p12">
                                <button type="button" class="btn btn-dark">Select</button>
                            </div>
                        </div>
                    </div>
                </a>
                 <!-- section-2 -->
                <a href="utility-statements">
                    <div class="col-sm-4 col-md-4">
                        <div class="panel panel-tile text-center br-a br-light">
                            <div class="panel-heading hidden">
                                <span class="panel-title"><i class="fa fa-pencil"></i> Title</span>
                            </div>
                            <div class="panel-body">
                                <h1 class="fs35 mbn">Utility Statements</h1>
                                <h6 class="text-system"> Monthly Utility Statements</h6>
                            </div>
                            <div class="panel-footer br-t p12">
                                <button type="button" class="btn btn-dark">Select</button>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- section-3 -->
                <a href="payments">
                    <div class="col-sm-4 col-md-4">
                        <div class="panel panel-tile text-center br-a br-light">
                            <div class="panel-heading hidden">
                                <span class="panel-title"><i class="fa fa-pencil"></i> Title</span>
                            </div>
                            <div class="panel-body">
                                <h1 class="fs35 mbn">Payments</h1>
                                <h6 class="text-system">Invoice</h6>
                            </div>
                            <div class="panel-footer br-t p12">
                                <button type="button" class="btn btn-dark">Select</button>
                            </div>
                        </div>
                    </div>
                </a>
            <?php } ?>
            </div>
        </div>
    </section>
</section>
       