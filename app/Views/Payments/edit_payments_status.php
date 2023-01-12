<style>
.section-btn
{
  text-align: center;
}
#btn_edit
{
  width: 20%;
}
.prepend-icon
{
     margin-top: 2%!important;
}
#select_customers,#select_years,#select_months
{
    width: 100%!important;
    padding: 7px;
    margin-top: 2%; 
}
.ui-datepicker-today a, .ui-datepicker-today a:hover, .ui-datepicker .ui-state-active, .ui-datepicker .ui-state-highlight 
{
    background: #3a3f4f !important;
}
.ui-datepicker .ui-datepicker-prev, .ui-datepicker .ui-datepicker-next 
{ 
    font-weight: 900!important;
}
.topbar-header
{
    margin-top: -1.5em;
}
</style>

<section id="content_wrapper">

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
                    <li class="crumb-link">
                         <a href="<?php echo base_url().'/payments'; ?>">Payments</a>
                    </li>
                    
                     <li class="crumb-trail">Edit Payments</li> 
                </ol>
            </div>
        </header>
    </div>


    <section id="content">
    <?php 
    $session  = session()->get("success");
    $successMessage = $session;

    $session = session()->get("error");
    $errorMessage = $session;

     if($successMessage == 'success')
    { ?>

        <div class="ui-pnotify stack_top_right" style="width: 350px; opacity: 1; display: block; overflow: visible; right: 8px; top: 70px;"><div class="alert ui-pnotify-container alert-success ui-pnotify-shadow" style="min-height: 16px; overflow: hidden;"><div class="ui-pnotify-closer" style="cursor: pointer; visibility: hidden;"><span class="glyphicon glyphicon-remove" title="Close"></span></div><div class="ui-pnotify-sticker" style="cursor: pointer; visibility: hidden;"><span class="glyphicon glyphicon-play" title="Stick"></span></div><div class="ui-pnotify-icon"><span class="glyphicon glyphicon-ok-sign"></span></div><h4 class="ui-pnotify-title">Success</h4><div class="ui-pnotify-text">Update the payment status successfully</div><div style="margin-top: 5px; clear: both; text-align: right; display: none;"></div></div></div>


    <?php } else if($errorMessage == 'error')
    {?>
          <div class="ui-pnotify stack_top_right" style="width: 350px; opacity: 1; display: block; overflow: visible; right: 8px; top: 70px;"><div class="alert ui-pnotify-container alert-danger ui-pnotify-shadow" style="min-height: 16px; overflow: hidden;"><div class="ui-pnotify-closer" style="cursor: pointer; visibility: hidden;"><span class="glyphicon glyphicon-remove" title="Close"></span></div><div class="ui-pnotify-sticker" style="cursor: pointer; visibility: hidden;"><span class="glyphicon glyphicon-play" title="Stick"></span></div><div class="ui-pnotify-icon"><span class="glyphicon glyphicon-ok-sign"></span></div><h4 class="ui-pnotify-title">Error</h4><div class="ui-pnotify-text">Status filled can not be empty</div><div style="margin-top: 5px; clear: both; text-align: right; display: none;"></div></div></div>

    <?php } ?>


        <div class="main-section">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-title hidden-xs">
                                <span class="glyphicon glyphicon-tasks"></span>Payment Data
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="panel-heading">
                                <div class="panel-title hidden-xs">
                                    <span class="glyphicon glyphicon-tasks"></span>Edit Payment Status
                                </div>
                            </div>

                            <div class="admin-form">
                                <div id="p1" class="panel heading-border">
                                    <div class="panel-body bg-light">
                                        <form method="post" action="<?php echo base_url().'/edit-payments-status/'.$encryptID;?>" id="form-ui">

                                            <div class="section-divider mb40" id="spy1">
                                                <span>Account Information</span>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="section">
                                                        <label>Account Number:</label>
                                                        <label class="field prepend-icon">
                                                           <input type="text" name="account_number" id="account_number" class="gui-input" placeholder="enter your account number" value="<?php if(isset($result_data)){ echo $result_data['account_number'];}else{echo '';}?>" readonly>
                                                            <label for="account_number" class="field-icon"><i class="fa fa-user"></i></label>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                     <div class="section">
                                                        <label>Tenant Name:</label>
                                                        <label class="field prepend-icon">
                                                            <input type="text" name="tenant_name" id="tenant_name" class="gui-input" placeholder="enter your tenant name" value="<?php if(isset($result_data)){ echo $result_data['tenant_name'];}else{echo '';}?>" readonly>
                                                            <label for="tenant_name" class="field-icon"><i class="fa fa-user"></i></label>
                                                        </label>
                                                    </div>
                                                 </div>

                                                <div class="col-md-4">
                                                    <div class="section">
                                                        <label>Date Billed:</label>
                                                        <label class="field prepend-icon">
                                                            <input type="text" name="date_billedd" id="date_billedd" class="gui-input" placeholder="enter your date billed" value="<?php if(isset($result_data)){ echo $result_data['date_billed'];}else{echo '';}?>" readonly>
                                                            <label for="date_billed" class="field-icon"><i class="fa fa-calendar"></i></label>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <!-- bill number -->
                                                <div class="col-md-4">
                                                    <div class="section">
                                                        <label>Bill Number:</label>
                                                        <label class="field prepend-icon">
                                                            <input type="text" name="bill_number" id="bill_number" class="gui-input" placeholder="enter your bill number" value="<?php if(isset($result_data)){ echo $result_data['bill_number'];}else{echo '';}?>" readonly>
                                                            <label for="bill_number" class="field-icon"><i class="fa fa-money"></i></label>
                                                        </label>
                                                    </div>
                                                </div>
                                                <!-- total amount -->
                                                <div class="col-md-4">
                                                    <div class="section">
                                                        <label>Total Amount:</label>
                                                        <label class="field prepend-icon">
                                                            <input type="text" name="total_amount" id="total_amount" class="gui-input" placeholder="enter your total amount" value="<?php if(isset($result_data)){ echo $result_data['total_amount'];}else{echo '';}?>" readonly>
                                                            <label for="total_amount" class="field-icon"><i class="fa fa-dollar"></i></label>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="section">
                                                        <label>Status:</label>
                                                        <label class="field prepend-icon">
                                                            <input type="text" name="status" id="status" class="gui-input" placeholder="enter your status" value="<?php if(isset($result_data)){ echo $result_data['status'];}else{echo '';}?>">
                                                            <label for="status" class="field-icon"><i class="fa fa-spinner"></i></label>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div><hr>

                                            <!-- sec-4 -->
                                            <div class="section-btn">
                                                <button type="submit" class="btn btn-dark" name="update" id="btn_edit" value="update_data">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
<!-- end section -->




