<?php 

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
#update
{
width: 20%;
}
.topbar-header
{
     margin-top: -1.5em;
}
.ui-datepicker-today a, .ui-datepicker-today a:hover, .ui-datepicker .ui-state-active, .ui-datepicker .ui-state-highlight 
{
    background: #3a3f4f !important;
}
.ui-datepicker 
{
  width: 24.5em!important;
}
</style>

<!-- /*end edit biller dashboard*/ -->

 <!-- success message when we update the customer -->
 <?php 

    if($successMessage == 'success')
    { ?>

        <div class="ui-pnotify stack_top_right" style="width: 290px; opacity: 1; display: block; overflow: visible; right: 8px; top: 70px;"><div class="alert ui-pnotify-container alert-success ui-pnotify-shadow" style="min-height: 16px; overflow: hidden;"><div class="ui-pnotify-closer" style="cursor: pointer; visibility: hidden;"><span class="glyphicon glyphicon-remove" title="Close"></span></div><div class="ui-pnotify-sticker" style="cursor: pointer; visibility: hidden;"><span class="glyphicon glyphicon-play" title="Stick"></span></div><div class="ui-pnotify-icon"><span class="glyphicon glyphicon-ok-sign"></span></div><h4 class="ui-pnotify-title">Success</h4><div class="ui-pnotify-text">Update the biller successfully</div><div style="margin-top: 5px; clear: both; text-align: right; display: none;"></div></div></div>


    <?php }
    ?>
<!-- end success message when we update the biller -->


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
                         <a href="<?php echo base_url().'/create-biller'; ?>">Create Biller</a>
                    </li>
                    <li class="crumb-link">
                         <a href="<?php echo base_url().'/manage-customer'; ?>">Manage Billler</a>
                    </li>
                    <li class="crumb-trail">Edit Biller</li>
                </ol>
            </div>
        </header>
    </div>
    <!-- End: Topbar -->


<!-- Begin: Content -->
    <section id="content">

    <!-- edit biller form -->
    <div class="admin-form">
        <div id="p1" class="panel heading-border">
             <div class="panel-body bg-light">
                    <form method="post" action="<?php echo base_url().'/edit-biller/'.$encryptID; ?>" id="form-ui">
                        <div class="section-divider mb40" id="spy1">
                            <span>Biller Information</span>
                        </div>
                        <!-- .section-divider -->

                <!-- section-1 -->
                        
                    <div class="row">
                        <!-- hidden-biller-id -->
                       <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                        <!--end hidden-biller-id -->

                            <!-- fname section -->
                            <div class="col-md-4">
                                <div class="section">
                                    <label>First Name:</label>

                                    <label class="field prepend-icon">

                                        <input type="text" name="fname" id="fname" class="gui-input" placeholder="Enter your first name" value="<?php if(isset($_POST['update'])){ echo set_value('fname');}else { echo $row['first_name']; } ?>">

                                        <label for="fname" class="field-icon"><i class="fa fa-user"></i>
                                        </label>
                                    </label>

                                    <!-- show error messages -->
                                     <small class="text-danger"><?= isset($validation['fname']) ? $validation['fname'] : null;  ?></small>
                                    <!-- end show error messages -->
                                     
                                </div>
                            </div>
                             <!-- end fname section -->

                          <!-- m-name section -->
                            <div class="col-md-4">
                                <div class="section">
                                    <label>Middle Name:</label>

                                    <label class="field prepend-icon">

                                        <input type="text" name="m_name" id="m_name" class="gui-input" placeholder="Enter  your Middle name" value="<?php if(isset($_POST['update'])) { echo set_value('m_name'); } else { echo $row['middle_name']; } ?>">

                                        <label for="m_name" class="field-icon"><i class="fa fa-user"></i>
                                        </label>
                                    </label>
                                    <!-- show error messages -->
                                    <small class="text-danger"><?= isset($validation['m_name']) ? $validation['m_name'] : null;  ?></small>
                                    <!-- end show error messages -->

                                  
                                </div>
                                 
                            </div>
                             <!-- end m-name section -->

                            <!-- lname section -->
                            <div class="col-md-4">
                                <div class="section">
                                    <label>Last Name:</label>

                                    <label class="field prepend-icon">

                                        <input type="text" name="lname" id="lname" class="gui-input" placeholder="Enter  your last name"  value="<?php if(isset($_POST['update'])){
                                            echo set_value('lname'); } else { echo $row['last_name']; } ?>">

                                        <label for="lname" class="field-icon"><i class="fa fa-user"></i>
                                        </label>
                                    </label>
                                    <!-- show error messages -->
                                    <small class="text-danger"><?= isset($validation['lname']) ? $validation['lname'] : null;  ?></small>
                                    <!-- end show error messages -->
                                  
                                </div>

                            <!--end lname section -->
                        </div>
                    </div>
                        <!-- end section-1 -->

                        <!-- section-2 -->
                    <!-- username section -->
                        <div class= "row">
                            <div class="col-md-4">
                                <div class="section">
                                    <label>Username:</label>

                                    <label class="field prepend-icon">

                                        <input type="text" name="uname" id="uname" class="gui-input" placeholder="enter  your username"  value="<?php if(isset($_POST['update'])) { echo set_value('uname'); } else { echo $row['username']; } ?>">

                                        <label for="uname" class="field-icon"><i class="fa fa-user"></i>
                                        </label>
                                    </label>

                                    <!--show error messages  -->
                                    <small class="text-danger"><?= isset($validation['uname']) ? $validation['uname'] : null;  ?></small>
                                    <!-- end show error messages -->
                                  
                                </div>

                            </div>
                            <!-- end username section -->
                            
                            <!-- phone number section -->
                            <div class="col-md-4">
                                <div class="section">
                                    <label>Phone Number:</label>

                                    <label class="field prepend-icon">

                                        <input type="text" name="phone" id="phone" class="gui-input" placeholder="Enter your phone number"  value="<?php if(isset($_POST['update'])) { echo set_value('phone'); } else { echo $row['phone_number']; } ?>">

                                        <label for="phone" class="field-icon"><i class="fa fa-phone"></i>
                                        </label>
                                    </label>

                                    <!--show error messages  -->
                                    <small class="text-danger"><?= isset($validation['phone']) ? $validation['phone'] : null;  ?></small>
                                    <!-- end show error messages -->
                                    
                                </div>
                                
                            </div>
                             <!--end phone number section -->
                     
                           <!--address section  -->
                            <div class="col-md-4">
                                <div class="section">
                                    <label>Address:</label>

                                    <label class="field prepend-icon">

                                        <input type="text" name="address" id="address" class="gui-input" placeholder="enter your password"  value="<?php if(isset($_POST['update'])) { echo set_value('address'); } else { echo $row['address']; } ?>">

                                        <label for="address" class="field-icon"><i class="fa fa-map-marker"></i>
                                        </label>
                                    </label>

                                     <!-- show error messages -->
                                     <small class="text-danger"><?= isset($validation['address']) ? $validation['address'] : null;  ?></small>
                                    <!-- end show error messages -->
                                   

                                </div>
                            </div>
                            <!--end addresse section  -->
                        </div>
                        <!-- end section-3 -->
                            

                        <!-- section-4 -->
                        <div class="row">
                               <!-- dob section -->
                            <div class="col-md-4">
                                <div class="section">

                                    <label>Date Of Birth:</label>

                                    <label class="field prepend-icon">

                                      <!--   <input type="text" name="dob" id="dob" class="gui-input" placeholder="Enter your date of birth"> -->
                                          <input type="text" class="form-control" id="dob" name="dob"  value="<?php if(isset($_POST['update'])) { echo set_value('dob'); } else {echo $row['date_of_birth']; } ?>">


                                        <label for="dob" class="field-icon"><i class="fa fa-calendar"></i>
                                        </label>
                                    </label>

                                    <!-- show error messages -->
                                    <small class="text-danger"><?= isset($validation['dob']) ? $validation['dob'] : null;  ?></small>
                                    <!-- end show error messages -->
                                </div>
                            </div>
                            <!--end  dob section -->

                           <!-- gender section -->
                            <div class="col-md-4">
                                <div class="section">
                                    <label>Gender:</label>

                                 <label class="field select">
                                        <select id="gender" name="gender"  value="<?php if(isset($_POST['update'])) {
                                            echo set_value('gender'); } else { echo $row['gender']; } ?>">

                                            <option value="">Select Your Gender</option>
                                            <option  <?php if($row['gender'] == '1'){echo 'selected '; }?>value="1">Male</option>

                                            <option <?php if($row['gender'] == '2'){ echo 'selected '; } ?>value="2">Female</option>

                                            <option <?php if($row['gender'] == '3'){ echo 'selected '; } ?>value="3">Other</option>
                                        </select>
                                        <i class="arrow"></i>
                                    </label>

                                    <!-- show error messages -->
                                    <small class="text-danger"><?= isset($validation['gender']) ? $validation['gender'] : null;  ?></small>
                                    <!-- end show error messages -->
                                  
                                </div>
                            </div>
                             <!--end  gender section -->
                        </div>
                        <!-- end section-4 -->
                        <hr>

                        <!-- submit button -->

                            <div class="section-btn">
                                <button type="submit" class="btn btn-dark" name="update" id="update">Update</button>
                            </div>

                        <!-- end submit button -->

                     </div>
                 </form>
             </div>
         </div>
     </div>
    </section>
</section>


                                        




                                     
                                       
                                      
