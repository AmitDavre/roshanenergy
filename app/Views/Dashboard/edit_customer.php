<?php 
// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';
// die();

$session  = session()->get("success");
$successMessage = $session;

?>

<style>
   
/*create customer dashboard*/
.section-1
{
  margin-top: 5%!important;
}
.section-btn
{
  text-align: center;
}
#btn_update
{
  width: 20%;
}
.prepend-icon
{
     margin-top: 1%!important;
}

/*water-meter-form*/
.popup-basic
{
  max-width: 850px;
}
.admin-form .panel-heading 
{
  text-align: center;
}
.text
{
    font-size: 12px!important;
}
.topbar-header
{
     margin-top: -1.5em;
}

/*end create customer dashboard*/
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

                    <li class="crumb-link">
                         <a href="<?php echo base_url().'/create-customer'; ?>">Create Customer</a>
                    </li>

                    <li class="crumb-link">
                         <a href="<?php echo base_url().'/manage-customer'; ?>">Manage Customer</a>
                    </li>
                    <li class="crumb-trail">Edit Customer</li> 
                </ol>
            </div>
        </header>
    </div>
    <!-- End: Topbar -->

    <!-- Begin: Content -->
    <section id="content">

<!-- success message when we update the customer -->
 <?php 

    if($successMessage == 'success')
    { ?>

        <div class="ui-pnotify stack_top_right" style="width: 290px; opacity: 1; display: block; overflow: visible; right: 8px; top: 70px;"><div class="alert ui-pnotify-container alert-success ui-pnotify-shadow" style="min-height: 16px; overflow: hidden;"><div class="ui-pnotify-closer" style="cursor: pointer; visibility: hidden;"><span class="glyphicon glyphicon-remove" title="Close"></span></div><div class="ui-pnotify-sticker" style="cursor: pointer; visibility: hidden;"><span class="glyphicon glyphicon-play" title="Stick"></span></div><div class="ui-pnotify-icon"><span class="glyphicon glyphicon-ok-sign"></span></div><h4 class="ui-pnotify-title">Success</h4><div class="ui-pnotify-text">Update the customer successfully</div><div style="margin-top: 5px; clear: both; text-align: right; display: none;"></div></div></div>
<?php } ?>
<!-- end success message when we update the customer -->

        <div class="admin-form">
             <div id="p1" class="panel heading-border">
                 <div class="panel-body bg-light">
                    <form method="post" action="<?php echo base_url().'/edit-customer/'.$encryptID; ?>" id="form-ui">
                        <div class="section-divider mb40" id="spy1">
                            <span>Edit Account Information</span>
                        </div>
                        <!-- .section-divider -->
                        <!-- section-1 -->
                        <div class="row">

                        <!-- hidden-custommer-id -->
                            <input type="hidden" id="id" name="id" value="<?php echo $row['id'];?>">
                            <input type="hidden" id="encrypted_id" name="encrypted_id" value="<?php echo $encryptID;?>">
                        <!--end  hidden-custommer-id -->

                        <!-- account number -->
                            <div class="col-md-4">
                                <div class="section">
                                    <label>Account Number:</label>
                                    <label class="field prepend-icon">
                                        <input type="text" name="account_number" id="account_number" class="gui-input" placeholder="Enter your account number" value="<?php if(isset($_POST['update'])){ echo set_value('account_number');}else { echo $row['account_number']; }?>">
                                        <label for="account_number" class="field-icon"><i class="fa fa-user"></i></label>
                                    </label>
                                    <!--======= show error messages ========-->
                                    <small class="text-danger"><?= isset($validation['account_number']) ? $validation['account_number'] : null;  ?></small>
                                    <!--======= end show error messages======== -->
                                </div>
                            </div>    

                            <div class="col-md-4">
                                <div class="section">
                                    <label>Landlord Full Name/Company Name</label>
                                    <label class="field prepend-icon">
                                        <input type="text" name="landlord_or_company_name" id="landlord_or_company_name" class="gui-input" placeholder="enter landlord/company name" value="<?php if(isset($_POST['update'])){ echo set_value('landlord_or_company_name');}else { echo $row['landlord_or_company_name']; }?>">
                                        <label for="landlord_or_company_name" class="field-icon"><i class="fa fa-user"></i></label>
                                    </label>
                                    <!--======= show error messages ========-->
                                    <small class="text-danger"><?= isset($validation['landlord_or_company_name']) ? $validation['landlord_or_company_name'] : null;  ?></small>
                                    <!--======= end show error messages======== -->
                                </div>
                            </div>
                            <!--end  account number -->

                            <!-- account-type section -->
                            <div class="col-md-4" style="">
                                <label>Account Type:</label>
                                <div class="option-group field section">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="option block mt15">
                                             <?php  $explodeCheckbox = explode(',', $row['account_type']); ?>
                                             <input  type="checkbox" name="Water" value="Water"  <?php if($explodeCheckbox['0'] == 'Water') {echo 'checked="checked"' ; } ?>>
                                             <span class="checkbox"></span>Water
                                            </label>
                                            <!-- show error messages -->

                                            <!--end show error messages -->
                                        </div>

                                        <div class="col-md-4">
                                            <label class="option block mt15">
                                            <?php $explodeCheckbox = explode(',', $row['account_type']); ?>
                                            <input  <?php if($explodeCheckbox['0'] == 'Electricity' || $explodeCheckbox['1'] == 'Electricity') {echo 'checked="checked"' ; } ?>  type="checkbox" name="Electricity" value="Electricity">
                                            <span class="checkbox"></span>Electricity
                                            </label>
                                        <!-- show error messages -->

                                        <!--end show error messages -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end account-type section -->
                        </div>
                        <!----end section-1 ---->
                        <h6 class="text">Please provide the required information about the account.</h6>

                        <!-- section-2 -->
                        <div class="row">
                            <!-- name section -->
                            <div class="col-md-4">
                                <div class="section">
                                    <label>First Name:</label>
                                    <label class="field prepend-icon">
                                        <input type="text" name="fname" id="fname" class="gui-input" placeholder="Enter your first name" value="<?php if(isset($_POST['update'])) { echo set_value('fname');} else { echo $row['first_name']; } ?>">
                                        <label for="fname" class="field-icon"><i class="fa fa-user"></i></label>
                                    </label>

                                    <!-- show error messages -->
                                    <small class="text-danger"><?= isset($validation['fname']) ? $validation['fname'] : null;  ?></small>
                                    <!-- end show error messages -->
                                </div>
                            </div>
                            <!-- end name section -->

                            <!--last name section -->
                            <div class="col-md-4">
                                <div class="section">
                                    <label>Last Name:</label>
                                        <label class="field prepend-icon">

                                             <input type="text" name="lname" id="lname" class="gui-input" placeholder="Enter your last name" value="<?php if(isset($_POST['update'])) { echo set_value('lname');} else { echo $row['last_name']; } ?>">

                                             <label for="lname" class="field-icon"><i class="fa fa-user"></i></label>
                                        </label>

                                    <!-- show error messages -->
                                    <small class="text-danger"><?= isset($validation['lname']) ? $validation['lname'] : null;  ?></small>
                                    <!-- end show error messages -->
                                </div>
                            </div>
                            <!-- end name section -->

                            <!-- water-meter-section -->
                            <div class="col-md-4">
                                <div class="section-1">
                                    <div id="animation-switcher1" class="ph20 water_form">
                                        <button  type ="button" class="btn btn-dark btn-lg mt-5" data-effect="mfp-zoomIn">Modify Water meter Config</button>
                                    </div>
                                </div>
                            </div>
                            <!--end water-meter-section -->
                        </div>
                        <!-- end section-2 -->

                        <!-- section-3 -->
                        <div class="row">
                            <!-- unit section -->
                            <div class="col-md-4">
                                <div class="section">
                                    <label>Unit:</label>
                                        <label class="field prepend-icon">
                                        <input type="text" name="unit" id="unit" class="gui-input" placeholder="Enter unit" value="<?php if(isset($_POST['update'])) { echo set_value('unit'); } else { echo $row['unit']; }  ?>">
                                        <label for="unit" class="field-icon"><i class="fa fa-pie-chart"></i></label>
                                    </label>
                                    <!-- show error messages -->
                                    <small class="text-danger"><?= isset($validation['unit']) ? $validation['unit'] : null;  ?></small>
                                    <!-- end show error messages -->
                                </div>
                            </div>
                            <!-- end unit section -->

                            <!-- address section -->
                            <div class="col-md-4">
                                <div class="section">
                                    <label>Street Address:</label>
                                    <label class="field prepend-icon">
                                        <input type="text" name="street_address" id="address" class="gui-input" placeholder="enter address" value="<?php if(isset($_POST['update'])) { echo set_value('street_address'); } else {echo $row['street_address'];} ?>">
                                         <label for="address" class="field-icon"><i class="fa fa-map-marker"></i></label>
                                    </label>

                                    <!--show error messages  -->
                                    <small class="text-danger"><?= isset($validation['street_address']) ? $validation['street_address'] : null;  ?></small>
                                    <!-- end show error messages -->
                                </div>
                            </div>
                            <!-- end address section -->

                            <!-- electricity-meter-section -->
                            <div class="col-md-4">
                                <div class="section-1">
                                    <div id="animation-switcher2" class="ph20 electric_form">
                                         <button  type ="button" class="btn btn-dark btn-lg mt-5" data-effect="mfp-zoomIn">Modify Electric meter Config</button>
                                    </div>
                                </div>
                            </div>
                            <!--end electricity-meter-section -->
                        </div>
                        <!-- end section-3 -->

                        <!-- section-4 -->
                        <div class="row">
                            <!-- city section -->
                            <div class="col-md-4">
                                <div class="section">
                                    <label>City:</label>
                                    <label class="field prepend-icon">
                                        <input type="text" name="city" id="city" class="gui-input" placeholder="Enter city" value="<?php
                                        if(isset($_POST['update'])){ echo set_value('city'); } else { echo $row['city']; } ?>">
                                        <label for="city" class="field-icon"><i class="fa fa-location-arrow"></i></label>
                                    </label>

                                    <!--show error messages  -->
                                    <small class="text-danger"><?= isset($validation['city']) ? $validation['city'] : null;  ?></small>
                                    <!-- end show error messages -->
                                </div>
                            </div>
                            <!-- end city section -->

                            <!--zip-code section  -->
                            <div class="col-md-4">
                                <div class="section">
                                    <label>Zip Code:</label>
                                    <label class="field prepend-icon">
                                        <input type="text" name="zip_code" id="zip_code" class="gui-input" placeholder="enter zip-code" value="<?php if(isset($_POST['update'])) { echo set_value('zip_code'); } else {echo $row['zip_code'];} ?>">
                                        <label for="zip_code" class="field-icon"><i class="fa fa-envelope-square"></i></label>
                                    </label>

                                    <!-- show error messages -->
                                    <small class="text-danger"><?= isset($validation['zip_code']) ? $validation['zip_code'] : null;  ?></small>
                                    <!-- end show error messages -->
                                </div>
                            </div>
                            <!--end zip-code section  -->

                            <!-- Landlord-section -->
                            <!-- <div class="col-md-4">
                            <div class="section-1">
                            <button type ="button" class="btn btn-dark btn-lg mt-5">Landlord or Property Mgmt. info </button>
                            </div>
                            </div> -->
                            <!-- end-landlord section -->
                            </div>
                            <!-- end section-4 -->

                            <!-- section-5-->
                            <div class="row">
                                <!-- country section -->
                                <div class="col-md-4">
                                    <div class="section">
                                        <label>Country:</label>
                                        <label class="field prepend-icon">
                                            <input type="text" name="country" id="country" class="gui-input" placeholder="Enter country" value="<?php if(isset($_POST['update'])) { echo set_value('country'); } else { echo $row['country']; } ?>">
                                            <label for="country" class="field-icon"><i class="fa fa-globe"></i></label>
                                        </label>

                                        <!-- show error messages -->
                                        <small class="text-danger"><?= isset($validation['country']) ? $validation['country'] : null;  ?></small>
                                        <!-- end show error messages -->
                                    </div>
                                </div>
                                <!--end  country section -->

                                <!-- email-section -->
                                <div class="col-md-4">
                                    <div class="section">
                                        <label>Email:</label>
                                        <label class="field prepend-icon">
                                            <input type="email" name="email" id="email" class="gui-input" placeholder="enter email" value="<?php if(isset($_POST['update'])) { echo set_value('email'); } else { echo $row['email']; } ?>">
                                            <label for="email" class="field-icon"><i class="fa fa-envelope"></i></label>
                                        </label>

                                        <!-- show error meassage -->
                                        <small class="text-danger"><?= isset($validation['email']) ? $validation['email'] : null;  ?></small>
                                        <!-- end show error messages -->
                                    </div>
                                </div>
                                <!--end email-section -->

                                </div>
                                <!--end  section-5-->

                                <!-- section-6 -->
                                <!-- phone section -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="section">
                                            <label>Phone:</label>
                                                <label class="field prepend-icon">
                                                    <input type="text" name="phone" id="phone" class="gui-input" placeholder="Enter phone" value="<?php
                                                    if(isset($_POST['update'])) { echo set_value('phone'); } else { echo $row['phone']; } ?>">
                                                    <label for="phone" class="field-icon"><i class="fa fa-phone"></i></label>
                                                </label>

                                            <!-- show error meassage -->
                                            <small class="text-danger"><?= isset($validation['phone']) ? $validation['phone'] : null;  ?></small>
                                            <!-- end show error messages -->
                                        </div>
                                    </div>
                                </div>
                                <!-- end phone section -->

                                <!-- end section-6 -->
                                <hr>
                                <!-- submit button -->
                                <div class="section-btn">
                                    <button type="submit" class="btn btn-dark" name="update" id="btn_update">Update</button>
                                </div>
                                <!-- end submit button -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>

<!-- modal-open -->
<!-- Water-meter-form-modal -->

<div id="modal-form" class="water_form popup-basic admin-form mfp-with-anim mfp-hide">
    <div class="panel">
        <div class="panel-heading">
             <span class="panel-title">Water Meter Configuration</span>
        </div>
        <!-- form -->
        <form method="post"  id="comment">
            <div class="panel-body p25">
            <!-- header-fields-section -->
                <!-- section-1  -->
                <div class="section row">
                <!--Water Rate Per Unit  -->
                    <div class="col-md-4 col-sm-12">
                        <label>Account Number :</label>
                        <label for="account_number" class="field prepend-icon">
                            <input type="text" name="account_number" id="account_number" class="gui-input" readonly value="<?php if(isset($_POST['update'])){ echo set_value('account_number');}else { echo $row['account_number']; }?>">
                            <label for="account_number" class="field-icon"><i class="fa fa-user"></i></label>
                        </label>
                    </div>
                    <!-- end >Water Rate Per Unit -->

                    <!-- Other Service Fee Or Credit section  -->
                    <div class="col-md-4 col-sm-12">
                        <label>Name :</label>
                        <label for="name" class="field prepend-icon">
                            <input type="text" name="fname" id="fname" class="gui-input" readonly value="<?php if(isset($_POST['update'])) { echo set_value('fname');} else { echo $row['resident_name']; } ?>">
                            <label for="name" class="field-icon"><i class="fa fa-user"></i></label>
                        </label>
                    </div>
                    <!-- end Other Service Fee Or Credit sectiob -->

                    <!-- Other Service Fee Or Credit section  -->
                    <div class="col-md-4 col-sm-12">
                        <label>Address :</label>
                        <label for="address" class="field prepend-icon">
                            <input type="text" name="address" id="address" class="gui-input" readonly value="<?php if(isset($_POST['update'])) { echo set_value('street_address'); } else {echo $row['street_address'];} ?>">
                            <label for="address" class="field-icon"><i class="fa fa-map-marker"></i></label>
                        </label>
                    </div>
                    <!-- end Other Service Fee Or Credit section -->
                </div>
                <hr>
               <!-- end section 1 -->

                <!-- checkbox - section -->
                <div class="section row form-group">
                    <div class="col-md-12 col-sm-12">
                        <label>Water Unit :</label>

                            <label class="option">
                                <input type="checkbox" name="water_unit_val[] " class="unit_val kgal"  value="kgal" <?php if($row['water_reading_unit'] == 'kgal') {echo 'checked="checked"' ; } ?>>
                                <span class="checkbox"></span>{KGL}
                            </label>

                        <label class="option">
                            <input type="checkbox" name="water_unit_val[]" class="unit_val hcuf" value="hcuf"  <?php if($row['water_reading_unit'] == 'hcuf') {echo 'checked="checked"' ; } ?>>
                            <span class="checkbox"></span>{HCUF}
                        </label>

                        <label class="option">
                            <input type="checkbox" name="water_unit_val[]" class="unit_val m3" value="m3" <?php if($row['water_reading_unit'] == 'm3') {echo 'checked="checked"' ; } ?>>
                            <span class="checkbox"></span>{M3}
                        </label>
                    </div>
                </div>
                <!--end  checkbox - section -->
                 <!-- end header-fields-section -->

                <!-- section-1  -->
                <div class="section row">

                    <!--Water Rate Per Unit  -->
                    <div class="col-md-6 col-sm-12">
                        <label>Water Rate Per Unit :</label>
                        <label for="water_unit" class="field prepend-icon">
                            <input type="text" name="water_unit" id="water_unit" class="gui-input" value="<?php if(isset($_POST['update'])) { echo set_value('water_rate_per_unit'); } else {echo $row['water_rate_per_unit'];} ?>">
                            <label for="water_unit" class="field-icon"><i class="fa fa-pie-chart"></i></label>
                            <span id="water_unit_span" class="text-danger"></span>
                        </label>
                    </div>
                    <!-- end >Water Rate Per Unit -->

                    <!-- Other Service Fee Or Credit section  -->
                    <div class="col-md-6 col-sm-12">
                        <label>Other Service Fee Or Credit :</label>
                        <label for="other_service" class="field prepend-icon">
                            <input type="text" name="other_service" id="other_service" class="gui-input" value="<?php if(isset($_POST['update'])) { echo set_value('other_services_fee_or_credit'); } else {echo $row['other_services_fee_or_credit'];} ?>">
                            <label for="other_service" class="field-icon"><i class="fa fa-pie-chart"></i></label>
                        </label>
                    </div>
                    <!-- end Other Service Fee Or Credit sectio -->
                </div>
                <!-- end section 1 -->

                <!-- section-2 -->
                <div class="section row">

                    <!-- Sewer Rate Per Unit section  -->
                    <div class="col-md-6 col-sm-12">
                        <label>Sewer Rate Per Unit :</label>
                        <label for="sewer_unit" class="field prepend-icon">
                            <input type="text" name="sewer_unit" id="sewer_unit" class="gui-input" value="<?php if(isset($_POST['update'])) { echo set_value('sewer_rate_per_unit'); } else {echo $row['sewer_rate_per_unit'];} ?>">
                            <label for="email" class="field-icon"><i class="fa fa-pie-chart"></i></label>
                        </label>
                    </div>
                    <!-- end Sewer Rate Per Unit section -->

                    <!-- >water Meter End Point SN section -->
                    <div class="col-md-6 col-sm-12">
                        <label>Water Meter End Point SN :</label>
                        <label for="water_point" class="field prepend-icon">
                            <input type="text" name="water_point" id="water_point" class="gui-input" value="<?php if(isset($_POST['update'])) { echo set_value('water_meter_end_point_sn'); } else { echo 
                            $row['water_meter_end_point_sn'];} ?>">
                            <label for="water_point" class="field-icon"><i class="fa fa-pie-chart"></i></label>
                        </label>
                    </div>
                    <!-- end >water Meter End Point SN  -->
                </div>
                <!-- end section 2 -->

                <!-- section-3 -->
                <div class="section row">
                    <!-- Water Service Fee  -->
                    <div class="col-md-6 col-sm-12">
                        <label>Water Service Fee :</label>
                        <label for="water_service" class="field prepend-icon">
                            <input type="text" name="water_service" id="water_service" class="gui-input" value="<?php if(isset($_POST['update'])) { echo set_value('water_service_fee'); } else {echo $row['water_service_fee'];} ?>">
                            <label for="water_service" class="field-icon"><i class="fa fa-pie-chart"></i></label>
                        </label>
                    </div>
                    <!-- end Water Service Fee -->

                    <!-- state Discount in % -->
                    <div class="col-md-6 col-sm-12">
                        <label>State Discount in (%):</label>
                        <label for="state_discount" class="field prepend-icon">
                            <input type="text" name="state_discount" id="state_discount" class="gui-input" value="<?php if(isset($_POST['update'])) { echo set_value('state_discount_in'); } else {echo 
                            $row['state_discount_in'];} ?>">
                            <label for="state_discount" class="field-icon"><i class="fa fa-pie-chart"></i></label>
                        </label>
                    </div>
                    <!-- end state Discount in %  -->
                </div>
                <!-- end section 3 -->

                <!-- section-4 -->
                <div class="section row">
                    <!-- Trash And Recycling Fee -->
                    <div class="col-md-6 col-sm-12">
                        <label>Trash And Recycling Fee:</label>
                        <label for="trash_fee" class="field prepend-icon">
                            <input type="text" name="trash_fee" id="trash_fee" class="gui-input" value="<?php if(isset($_POST['update'])) { echo set_value('trash_and_recycling_fee'); } else {echo $row['trash_and_recycling_fee'];} ?>">
                            <label for="trash_fee" class="field-icon"><i class="fa fa-pie-chart"></i></label>
                        </label>
                    </div>
                    <!-- Trash And Recycling Fee -->
                </div>
                <!-- end section-4 -->
            </div>
            <!-- end .form-body section -->

            <div class="panel-footer" style="text-align: center;">
                <button type="button" id="modal_save" name="modal_save_btn" class="button btn-dark" onclick = "UpdateWaterModal();"  style = "width: 25%;">Update</button>
            <!-- <button type="submit" class="button btn-dark">Back</button> -->
            </div>
            <!-- end .form-footer section -->
        </form>
    </div>
    <!-- end: .panel -->
</div>
<!-- End Water Meter Form Modal -->

<!--=============== electricity-meter section====================-->

<div id="modal-form111" class="popup-basic admin-form mfp-with-anim mfp-hide">
    <div class="panel">
        <div class="panel-heading">
             <span class="panel-title">Electric Meter Configuration</span>
        </div>
        <!-- form -->
        <form method="post"  id="electric_meter">
            <div class="panel-body p25">
                <!-- header-fields-section -->
                <!-- section-1  -->
                <div class="section row">
                    <!--Account number section  -->
                    <div class="col-md-4 col-sm-12">
                        <label>Account Number :</label>
                        <label for="account_number" class="field prepend-icon">
                            <input type="text" name="account_number" id="account_number" class="gui-input" readonly value="<?php if(isset($_POST['update'])){ echo set_value('account_number');}else { echo $row['account_number']; }?>">
                            <label for="account_number" class="field-icon"><i class="fa fa-user"></i></label>
                        </label>
                    </div>
                    <!-- end Account number section -->

                    <!-- Name Section  -->
                    <div class="col-md-4 col-sm-12">
                        <label>Name :</label>
                        <label for="fname" class="field prepend-icon">
                            <input type="text" name="fname" id="fname" class="gui-input" readonly value="<?php if(isset($_POST['update'])) { echo set_value('fname');} else { echo $row['resident_name']; } ?>">
                            <label for="fname" class="field-icon"><i class="fa fa-user"></i></label>
                        </label>
                    </div>
                    <!-- end Name Section  -->

                    <!-- Address section  -->
                    <div class="col-md-4 col-sm-12">
                        <label>Address :</label>
                        <label for="address" class="field prepend-icon">
                            <input type="text" name="address" id="address" class="gui-input" readonly value="<?php if(isset($_POST['update'])) { echo set_value('street_address'); } else {echo $row['street_address'];} ?>">
                            <label for="address" class="field-icon"><i class="fa fa-map-marker"></i></label>
                        </label>
                    </div>
                    <!-- end Address section -->
                </div>
                <hr>
                <!-- end section 1 -->
                <!-- end header-fields-section -->

                <!-- section-1  -->
                <div class="section row">
                    <!--Water Rate Per Unit  -->
                    <div class="col-md-6 col-sm-12">
                        <label>Electric Rate off-peak per Kwh  :</label>
                        <label for="electric_rate_off" class="field prepend-icon">
                            <input type="text" name="electric_rate_off" id="electric_rate_off" class="gui-input" value="<?php if(isset($_POST['update'])) { echo set_value('electric_rate_off_peak_per_kwh'); } else {echo 
                            $row['electric_rate_off_peak_per_kwh'];} ?>">
                            <label for="electric_rate_off" class="field-icon"><i class="fa fa-pie-chart"></i></label>
                            <span id="electric_rate_offf" class="text-danger"></span>
                        </label>
                    </div>
                    <!-- end >Water Rate Per Unit -->

                    <!-- Other Service Fee Or Credit section  -->
                    <div class="col-md-6 col-sm-12">
                        <label>State Discount in (%) electricity :</label>
                        <label for="state_discount_electicity" class="field prepend-icon">
                            <input type="text" name="state_discount_electicity" id="state_discount_electicity" class="gui-input" value="<?php if(isset($_POST['update'])) { echo set_value('state_discount_in_electricity'); } else {echo $row['state_discount_in_electricity'];} ?>">
                            <label for="state_discount_electicity" class="field-icon"><i class="fa fa-pie-chart"></i></label>
                        </label>
                    </div>
                    <!-- end Other Service Fee Or Credit sectio -->
                </div>
                <!-- end section 1 -->

            <!-- section-2 -->
            <div class="section row">
                <!-- electric Rate On-peak per section  -->
                <div class="col-md-6 col-sm-12">
                    <label>Electric Rate On-peak per Kwh :</label>
                    <label for="electric_rate_on" class="field prepend-icon">
                        <input type="text" name="electric_rate_on" id="electric_rate_on" class="gui-input" value="<?php if(isset($_POST['update'])) { echo set_value('electric_rate_on_peak_per_kwh'); } else {echo $row['electric_rate_on_peak_per_kwh'];} ?>">
                        <label for="electric_rate_on" class="field-icon"><i class="fa fa-pie-chart"></i></label>
                    </label>
                </div>
                <!-- end electric Rate On-peak persection -->

                <!-- Other Service fee or credits  -->
                <div class="col-md-6 col-sm-12">
                    <label>Other Service fee or credits electricity :</label>
                    <label for="other_service_fee_electricity" class="field prepend-icon">
                        <input type="text" name="other_service_fee_electricity" id="other_service_fee_electricity" class="gui-input" value="<?php if(isset($_POST['update'])) {echo 
                        set_value(' other_service_fee_or_credits_electricity'); } else {echo 
                        $row['other_service_fee_or_credits_electricity'];} ?>">
                        <label for="other_service_fee_electricity" class="field-icon"><i class="fa fa-pie-chart"></i></label>
                    </label>
                </div>
                <!-- end Other Service fee or credits   -->
            </div>
            <!-- end section 2 -->

            <!-- section-3 -->
            <div class="section row">
                <!-- state Sucharge tax  section  -->
                <div class="col-md-6 col-sm-12">
                    <label>State Sucharge Tax :</label>
                    <label for="stata_tax" class="field prepend-icon">
                        <input type="text" name="state_tax" id="state_tax" class="gui-input" value="<?php if(isset($_POST['update'])) {echo set_value('state_sucharge_tax'); } else {echo 
                        $row['state_sucharge_tax'];} ?>">
                        <label for="state_tax" class="field-icon"><i class="fa fa-pie-chart"></i></label>
                    </label>
                </div>
                <!-- end state Sucharge tax  section -->

                <!-- Electric Meter end point SN  -->
                <div class="col-md-6 col-sm-12">
                    <label>Electric Meter end point SN :</label>
                        <label for="electric_meter_sn" class="field prepend-icon">
                        <input type="text" name="electric_meter_sn" id="electric_meter_sn" class="gui-input" value="<?php if(isset($_POST['update'])) {echo set_value('electric_meter_end_point_sn'); } else {echo 
                        $row['electric_meter_end_point_sn'];} ?>">
                        <label for="electric_meter_sn" class="field-icon"><i class="fa fa-pie-chart"></i></label>
                    </label>
                </div>
                <!-- end Electric Meter end point SN -->
            </div>
            <!-- end section 3 -->

            <!-- section-4 -->
            <div class="section row">
                <!--state Regulatory Fees section -->
                <div class="col-md-6 col-sm-12">
                    <label>State Regulatory Fees:</label>
                    <label for="state_reg_fee" class="field prepend-icon">
                        <input type="text" name="state_reg_fee" id="state_reg_fee" class="gui-input" value="<?php if(isset($_POST['update'])) {echo set_value('state_regulatory_fee'); } else {echo 
                        $row['state_regulatory_fee'];} ?>">
                        <label for="tstate_reg_fee" class="field-icon"><i class="fa fa-pie-chart"></i></label>
                    </label>
                </div>
                <!-- endstate Regulatory Fees section -->

                <!-- Sensors section-->
                <div class="col-md-6 col-sm-12">
                    <label>Sensors:</label>
                    <label for="sensors" class="field prepend-icon">
                        <input type="text" name="sensors" id="sensors" class="gui-input" value="<?php if(isset($_POST['update'])) {echo set_value('sensors'); } else {echo  $row['sensors'];} ?>">
                        <label for="sensors" class="field-icon"><i class="fa fa-pie-chart"></i></label>
                    </label>
                </div>
                <!-- Tend Sensors section -->
            </div>
            <!-- end section-4 -->

            <!-- section-5 -->
            <div class="section row">
                <!-- Electric Service Establishment Charge -->
                <div class="col-md-6 col-sm-12">
                    <label>Electric Service Establishment Charge:</label>
                    <label for="electric_service_charge" class="field prepend-icon">
                        <input type="text" name="electric_service_charge" id="electric_service_charge" class="gui-input" value="<?php if(isset($_POST['update'])) {echo set_value('electric_service_establishment_charge'); } else {echo $row['electric_service_establishment_charge'];} ?>">
                        <label for="electric_service_charge" class="field-icon"><i class="fa fa-pie-chart"></i></label>
                    </label>
                </div>
                <!--end Electric Service Establishment Charge -->
            </div>
        </div>
        <!-- panelbody section end -->

        <!-- end .form-body section -->
        <div class="panel-footer" style="text-align: center;">
             <button type="button" id="btn_update_electricity" name="btn_update_electricity" class="button btn-dark" 
        onclick = "UpdateElectricModal();" style = "width: 25%;">Update</button>
        </div>
        <!-- end .form-footer section -->
    </form>
</div>
<!-- end: .panel -->
</div>
<!-- end model-form section -->
<!-- End electricity Meter Form Modal -->

<script type="text/javascript">

jQuery(document).ready(function() {

    "use strict";

    // Init Theme Core    
    Core.init();

    // Init Demo JS     
    Demo.init();

    var modalContent = $('#modal-content');

    modalContent.on('click', '.holder-style', function(e) {
        e.preventDefault();

        modalContent.find('.holder-style').removeClass('holder-active');
        $(this).addClass('holder-active');
    });

    // water-meter-section
    $('#animation-switcher1 button').on('click', function() {


        $('#animation-switcher1').find('button').removeClass('active-animation');
        $(this).addClass('active-animation item-checked');


        var activeModal = '#modal-form';
        // Inline Admin-Form example 
        $.magnificPopup.open({
            removalDelay: 500, //delay removal by X to allow out-animation,
            items: {
                src: activeModal
            },
            // overflowY: 'hidden', // 
            callbacks: {
                beforeOpen: function(e) {
                    var Animation = $("#animation-switcher1").find('.active-animation').attr('data-effect');
                    this.st.mainClass = Animation;
                }
            },
            midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
        });

    }); //end water-meter-section   


// electrical- meter section========>
    $('#animation-switcher2 button').on('click', function() 
    {


        $('#animation-switcher2').find('button').removeClass('active-animation');
        $(this).addClass('active-animation item-checked');


        var activeModal = '#modal-form111';
        // Inline Admin-Form example 
        $.magnificPopup.open({
            removalDelay: 500, //delay removal by X to allow out-animation,
            items: {
                src: activeModal
            },
            // overflowY: 'hidden', // 
            callbacks: {
                beforeOpen: function(e) {
                    var Animation = $("#animation-switcher2").find('.active-animation').attr('data-effect');
                    this.st.mainClass = Animation;
                }
            },
            midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
        });

    });// end electrical- meter section========>



});

// watermodal function section====>

//when we click on water-meter-form update button then store data in the database using ajax

function UpdateWaterModal()
{
    var waterUnit =  $("#water_unit").val();
    if(waterUnit == '')
    {
        // give error 
        $('#water_unit_span').html('Please fill the required field');
    }

        var checkboxUnitWaterval = [];
          $('.unit_val:checked').each(function(i)
          {
            checkboxUnitWaterval.push($(this).val());
          });
           // alert(checkboxUnitWaterval);

           // console.log(checkboxUnitWaterval[0]);
           // return false;



    var formData = {
                      water_unit: $("#water_unit").val(),
                      other_service: $("#other_service").val(),
                      sewer_unit: $("#sewer_unit").val(),
                      water_point: $("#water_point").val(),
                      water_service: $("#water_service").val(),
                      state_discount: $("#state_discount").val(),
                      trash_fee: $("#trash_fee").val(),
                      customer_id: $("#id").val(),
                      water_reading_unit: checkboxUnitWaterval[0],
                   };

                 console.log(formData);


   

    $.ajax({
              type: 'POST',
              url: '<?php echo base_url()."/Dashboard/update_water_meter";?>',
              data: formData,
              success: function(response)
             { 
                if($.trim(response) == 'success')
                {      
                    var title    = 'Success';
                    var message  = 'Update water meter form successfully';
                    alertSuccessNotify(title, message);
                    // redirect 
                    var encrypted_id = $('#encrypted_id').val();
                    var base_url  = '<?php echo base_url() ?>';

                    // run after the message hides 
                    setTimeout(function(){ 
                        location.href = base_url+'/edit-customer/'+encrypted_id ; 
                    }, 2000);

                }

                else
                {
                    var title    = 'Error';
                    var message  = 'Unable to update the water meter form';
                    alertErrorNotify(title, message);
                }
              }
          }); // watermodal function section====> -->
}

//when we click on electric-meter-form update button then store data in the database using ajax

function UpdateElectricModal()
{
    var electric_rate_off =  $("#electric_rate_off").val();
    if(electric_rate_off == '')
    {
        // give error 

        $('#electric_rate_offff').html('Please fill the required field');
    }
    var formData = {
                     electric_rate_off: $("#electric_rate_off").val(),
                     state_discount_electicity: $("#state_discount_electicity").val(),
                     electric_rate_on: $("#electric_rate_on").val(),
                     other_service_fee_electricity: $("#other_service_fee_electricity").val(),
                     state_tax: $("#state_tax").val(),
                     electric_meter_sn: $("#electric_meter_sn").val(),
                     state_reg_fee: $("#state_reg_fee").val(),
                     sensors: $("#sensors").val(),
                     electric_service_charge: $("#electric_service_charge").val(),
                     customer_id: $("#id").val(),
                   };

     $.ajax({
              type: 'POST',
              url: '<?php echo base_url()."/Dashboard/update_electric_meter";?>',
              data: formData,
              success: function(response)
             { 
                if($.trim(response) == 'success')
                {      
                    var title    = 'Success';
                    var message  = 'Update electricity form successfully';
                    alertSuccessNotify(title, message);
                    // redirect 
                    var encrypted_id = $('#encrypted_id').val();
                    var base_url  = '<?php echo base_url() ?>';

                    // run after the message hides 
                   

                     setTimeout(function(){ 
                        location.href = base_url+'/edit-customer/'+encrypted_id ; 
                    }, 2000);


                }

                else
                {
                    var title    = 'Error';
                    var message  = 'Unable to update the electricity form';
                    alertErrorNotify(title, message);
                }
              }
          });
}


$(document).ready(function()
{
    $('.unit_val').change(function(){

        if($(this).is(':checked'))
        {
            $('.unit_val').attr("disabled", 'disabled');
            $(this).removeAttr("disabled");
        }
        else
        {
            $('.unit_val').removeAttr("disabled");
        }
    });

    // jquery on load 
// window.onload = (event) => {

//     var sList = "";
//     $('.unit_val').each(function () {
//         if(this.checked == true)
//         {
//             vatrtestttt =  $(this).val() ;

//         }
//     });


//     $('.unit_val:checked').each(function(i)
//           {
//             checkboxUnitWaterval.push($(this).val());

//             if($(this).val() == vatrtestttt)
//             {
//                  $('.'+vatrtestttt+'').removeAttr("disabled");

//             }
//             else
//             {
//                  $('.unit_val').attr("disabled", 'disabled');
//                  $('.unit_val').removeAttr("disabled");
//                  $('.'+vatrtestttt+'').removeAttr("disabled");
//             }
//           });


// };




});


</script>
<!-- // electric function section====> -->
    
 </section> 
