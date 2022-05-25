<?php 

$successMessage  = session()->get("success");
$errorMessage  = session()->get("error");

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
#btn_save
{
   width: 20%;
}
.prepend-icon
{
     margin-top: 2%!important;
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
                    <li class="crumb-trail">Create Customer</li> 
                </ol>
            </div>
        </header>
    </div>
    <!-- End: Topbar -->

    <!-- Begin: Content -->
    <section id="content">
    <!-- success message when we insert the customer -->
     <?php 

    if($successMessage == 'success')
    { ?>

        <div class="ui-pnotify stack_top_right" style="width: 290px; opacity: 1; display: block; overflow: visible; right: 8px; top: 70px;"><div class="alert ui-pnotify-container alert-success ui-pnotify-shadow" style="min-height: 16px; overflow: hidden;"><div class="ui-pnotify-closer" style="cursor: pointer; visibility: hidden;"><span class="glyphicon glyphicon-remove" title="Close"></span></div><div class="ui-pnotify-sticker" style="cursor: pointer; visibility: hidden;"><span class="glyphicon glyphicon-play" title="Stick"></span></div><div class="ui-pnotify-icon"><span class="glyphicon glyphicon-ok-sign"></span></div><h4 class="ui-pnotify-title">Success</h4><div class="ui-pnotify-text">Insert the customer successfully</div><div style="margin-top: 5px; clear: both; text-align: right; display: none;"></div></div></div>


    <?php } else if($errorMessage == 'error')
    {?>
          <div class="ui-pnotify stack_top_right" style="width: 290px; opacity: 1; display: block; overflow: visible; right: 8px; top: 70px;"><div class="alert ui-pnotify-container alert-danger ui-pnotify-shadow" style="min-height: 16px; overflow: hidden;"><div class="ui-pnotify-closer" style="cursor: pointer; visibility: hidden;"><span class="glyphicon glyphicon-remove" title="Close"></span></div><div class="ui-pnotify-sticker" style="cursor: pointer; visibility: hidden;"><span class="glyphicon glyphicon-play" title="Stick"></span></div><div class="ui-pnotify-icon"><span class="glyphicon glyphicon-ok-sign"></span></div><h4 class="ui-pnotify-title">Error</h4><div class="ui-pnotify-text">Unable to insert customer</div><div style="margin-top: 5px; clear: both; text-align: right; display: none;"></div></div></div>

    <?php } ?>
 <!-- end success message when we insert the customer -->

        <div class="admin-form">
            <div id="p1" class="panel heading-border">
                <div class="panel-body bg-light">
                    <form method="post" action="<?php echo base_url('/insert');?>" id="form-ui">
                        <div class="section-divider mb40" id="spy1">
                            <span>Account Information</span>
                        </div>
                        <!-- section-1 -->
                        <div class="row">
                        <!-- account number -->
                            <div class="col-md-4">
                                <div class="section">
                                    <label>Account Number:</label>
                                        <label class="field prepend-icon">
                                            <input type="text" name="account_number" id="account_number" class="gui-input" placeholder="enter your account number" value="<?php echo set_value('account_number');?>">
                                           <label for="account_number" class="field-icon"><i class="fa fa-user"></i></label>
                                        </label>
                                        <!-- show error messages -->
                                        <small class="text-danger"><?= isset($validation['account_number']) ? $validation['account_number'] : null;  ?></small>
                                        <!-- end show error messages -->
                                </div>
                            </div>    

                            <div class="col-md-4">
                                <div class="section">
                                    <label>Landlord Full Name/Company Name:</label>
                                        <label class="field prepend-icon">
                                            <input type="text" name="landlord_or_company_name" id="landlord_or_company_name" class="gui-input" placeholder="enter landlord or company name"/>
                                           <label for="landlord_or_company_name" class="field-icon"><i class="fa fa-user"></i></label>
                                        </label>
                                        <!-- show error messages -->
                                        <small class="text-danger"><?= isset($validation['landlord_or_company_name']) ? $validation['landlord_or_company_name'] : null;  ?></small>
                                        <!-- end show error messages -->
                                </div>
                            </div>
                        <!--end  account number -->
                                                
                        <!-- account-type section -->
                            <div class="col-md-4" style="">
                                <label>Account Type:</label>
                                    <div class="option-group field section">
                                        <div class="row">
                                            <!-- water-checkbox-section -->
                                            <div class="col-md-4">
                                                <label class="option block mt15">
                                                    <input type="checkbox" name="Water" value="Water">
                                                        <span class="checkbox"></span>Water
                                                </label>
                                            </div>
                                            <!-- electricity-checkbox-section -->
                                            <div class="col-md-4">
                                                <label class="option block mt15">
                                                    <input type="checkbox" name="Electricity" value="Electricity">
                                                        <span class="checkbox"></span>Electricity</label>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <!--end account-type section -->
                         </div>
                        <!----end section-1 ---->
                        <h6>Please provide the required information about the account.</h6>
                            
                        <!-- section-2 -->
                        <div class="row">
                        <!-- fname section -->
                            <div class="col-md-4">
                                <div class="section">
                                    <label>First Name:</label>
                                        <label class="field prepend-icon">
                                            <input type="text" name="fname" id="fname" class="gui-input" placeholder="enter your first name" value="<?php echo set_value('fname');?>">
                                            <label for="fname" class="field-icon"><i class="fa fa-user"></i></label>
                                        </label>

                                        <!-- show error messages -->
                                        <small class="text-danger"><?= isset($validation['fname']) ? $validation['fname'] : null;  ?></small>
                                        <!-- end show error messages -->
                                </div>
                            </div>
                         <!-- end fname section -->

                         <!-- lname section -->
                            <div class="col-md-4">
                                <div class="section">
                                    <label>Last Name:</label>
                                        <label class="field prepend-icon">
                                            <input type="text" name="lname" id="lname" class="gui-input" placeholder="enter your last name" value="<?php echo set_value('lname');?>">
                                            <label for="lname" class="field-icon"><i class="fa fa-user"></i></label>
                                        </label>

                                        <!-- show error messages -->
                                        <small class="text-danger"><?= isset($validation['lname']) ? $validation['lname'] : null;  ?></small>
                                        <!-- end show error messages -->
                                </div>
                            </div>
                         <!-- end lname section -->

                        <!-- unit section -->
                            <div class="col-md-4">
                                <div class="section">
                                    <label>Unit:</label>
                                        <label class="field prepend-icon">
                                            <input type="text" name="unit" id="unit" class="gui-input" placeholder="enter unit" value="<?php echo set_value('unit');?>">
                                            <label for="unit" class="field-icon"><i class="fa fa-pie-chart"></i></label>
                                        </label>
                                        <!-- show error messages -->
                                        <small class="text-danger"><?= isset($validation['unit']) ? $validation['unit'] : null;  ?></small>
                                        <!-- end show error messages -->
                                </div>
                            </div>
                        <!-- end unit section -->

                        <!-- water-meter-section -->
                        <!-- <div class="col-md-4">
                                <div class="section-1">
                                    <button type ="button" class="btn btn-dark btn-lg mt-5"  data-effect="mfp-zoomIn" onclick ="openWaterModal();">Modify Water meter Config</button>
                                </div>
                            </div> -->
                        <!-- end water-meter-section -->
                        </div>
                        <!-- end section-2 -->

                        <!-- section-3 -->
                        <div class="row">

                        <!-- address section -->
                            <div class="col-md-4">
                                <div class="section">
                                    <label>Street Address:</label>
                                        <label class="field prepend-icon">
                                            <input type="text" name="street_address" id="street_address" class="gui-input" placeholder="enter address" value="<?php echo set_value('street_address');?>">
                                            <label for="address" class="field-icon"><i class="fa fa-map-marker"></i></label>
                                        </label>

                                        <!--show error messages  -->
                                        <small class="text-danger"><?= isset($validation['street_address']) ? $validation['street_address'] : null; ?></small>
                                       <!-- end show error messages -->
                                </div>
                            </div>
                        <!-- end address section -->

                        <!-- city section -->
                            <div class="col-md-4">
                                <div class="section">
                                    <label>City:</label>
                                        <label class="field prepend-icon">
                                            <input type="text" name="city" id="city" class="gui-input" placeholder="enter city" value="<?php echo set_value('city');?>">
                                            <label for="city" class="field-icon"><i class="fa  fa-location-arrow"></i></label>
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
                                            <input type="text" name="zip_code" id="zip_code" class="gui-input" placeholder="enter zip-code" value="<?php echo set_value('zip_code');?>">
                                            <label for="zip_code" class="field-icon"><i class="fa  fa-envelope-square"></i></label>
                                        </label>    

                                        <!-- show error messages -->
                                         <small class="text-danger"><?= isset($validation['zip_code']) ? $validation['zip_code'] : null;  ?></small>
                                        <!-- end show error messages -->
                                </div>
                            </div>
                        <!--end zip-code section  -->

                        <!-- electricity-section -->
                        <!--    <div class="col-md-4">
                                    <div class="section-1">
                                        <button type ="button" class="btn btn-dark btn-lg mt-5">Modify Electric meter Config</button>
                                    </div>
                                </div> -->
                        <!--end electricity-section -->
                        </div>
                        <!-- end section-3 -->
                        <!-- landlord sectiomn -->
                        <!-- <div class="col-md-4">
                            <div class="section-1">
                                <button type ="button" class="btn btn-dark btn-lg mt-5">Landlord or Property Mgmt. info </button>
                            </div>
                        </div> -->
                        <!--end landlord sectiomn --> 

                        <!-- section-4-->
                        <div class="row">

                        <!-- country section -->
                            <div class="col-md-4">
                                <div class="section">
                                    <label>Country:</label>
                                        <label class="field prepend-icon">
                                            <input type="text" name="country" id="country" class="gui-input" placeholder="enter country" value="<?php echo set_value('country');?>">
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
                                           <input type="email" name="email" id="email" class="gui-input" placeholder="enter email" value="<?php echo set_value('email');?>">
                                           <label for="email" class="field-icon"><i class="fa fa-envelope"></i></label>
                                        </label>

                                        <!-- show error meassage -->
                                        <small class="text-danger"><?= isset($validation['email']) ? $validation['email'] : null;  ?></small>
                                        <!-- end show error messages -->
                                </div>
                            </div>
                        <!--end email-section -->
                                               
                        <!-- phone section -->
                            <div class="col-md-4">
                                <div class="section">
                                    <label>Phone:</label>
                                        <label class="field prepend-icon">
                                            <input type="text" name="phone" id="phone" class="gui-input" placeholder="enter phone" value="<?php echo set_value('phone');?>">
                                            <label for="phone" class="field-icon"><i class="fa fa-phone"></i></label>
                                        </label>

                                        <!-- show error meassage -->
                                        <small class="text-danger"><?= isset($validation['phone']) ? $validation['phone'] : null;  ?></small>
                                        <!-- end show error messages -->
                                </div>
                            </div>
                        </div>
                        <!--end  section-5-->

                        <!-- section-6 -->
                        <div class="row">
                        <!-- end password section -->
                           <div class="col-md-4">
                                    <div class="section">
                                        <label>Password:</label>
                                            <label class="field prepend-icon">
                                                <input type="password" name="password" id="password" class="gui-input" placeholder="enter password" value="<?php echo set_value('password');?>">
                                                <label for="password" class="field-icon"><i class="fa fa-key"></i></label>
                                            </label>

                                            <!-- show error meassage -->
                                            <small class="text-danger"><?= isset($validation['password']) ? $validation['password'] : null;  ?></small>
                                            <!-- end show error messages -->
                                    </div>
                                </div>
                        <!-- password section -->
                        </div>
                        <!-- end section-6 -->
                        <hr>
                        <!-- submit button -->
                        <div class="section-btn">
                            <button type="submit" class="btn btn-dark" name="save" id="btn_save">Save</button>
                        </div>
                        <!-- end submit button -->
                    </div>
               </form>
           </div>
        </div>
    </div>
</section>
</section>                                     



