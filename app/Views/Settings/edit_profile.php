<?php 
// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';
// die();
$session  = session()->get("success");
$successMessage = $session;
?>

<style>

.section-1
{
  margin-top: 5%!important;
}
.section-btn
{
    text-align: center;
}
.topbar-header
{
    margin-top: -1.5em;
}
#btn_save
{
  width: 46%!important;
  margin-top: 3%;
  color: black!important;
}

.prepend-icon
{
    margin-top: 2%!important;
}

.bg-light.dark 
{
    background-color: #30363e!important;
}
.admin-form label, .admin-form input, .admin-form button, .admin-form select, .admin-form textarea
{
    color: #ffffff!important;
}
.admin-form .btn-dark
 {
    background-color: #ffffff!important;
}
.main-section
{
    padding-top: 31px !important;
}
.admin-form .prepend-icon > input, .admin-form .prepend-icon > textarea
{
   color: black!important;
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
                    <li class="crumb-trail">Edit Profile</li>
                </ol>
            </div>
        </header>
    </div>
    <!-- End: Topbar -->

    <!-- Begin: Content -->
    <section id="content">

        <!-- show success message -->
<?php
  $sessionSucess  = session()->get("success");
  $sessionError  = session()->get("error");
?>
<!-- end show message -->
<!-- show success message -->
 <?php 
    
    if($sessionSucess == 'success')
    { ?>

        <div class="ui-pnotify stack_top_right" style="width: 390px; opacity: 1; display: block; overflow: visible; right: 8px; top: 70px;"><div class="alert ui-pnotify-container alert-success ui-pnotify-shadow" style="min-height: 16px; overflow: hidden;"><div class="ui-pnotify-closer" style="cursor: pointer; visibility: hidden;"><span class="glyphicon glyphicon-remove" title="Close"></span></div><div class="ui-pnotify-sticker" style="cursor: pointer; visibility: hidden;"><span class="glyphicon glyphicon-play" title="Stick"></span></div><div class="ui-pnotify-icon"><span class="glyphicon glyphicon-ok-sign"></span></div><h4 class="ui-pnotify-title">Success</h4><div class="ui-pnotify-text">Edit profile sucessfully</div><div style="margin-top: 5px; clear: both; text-align: right; display: none;"></div></div></div>

<?php }
    else if($sessionError == 'error')
    { ?>
          <div class="ui-pnotify stack_top_right" style="width: 390px; opacity: 1; display: block; overflow: visible; right: 8px; top: 70px;"><div class="alert ui-pnotify-container alert-danger ui-pnotify-shadow" style="min-height: 16px; overflow: hidden;"><div class="ui-pnotify-closer" style="cursor: pointer; visibility: hidden;"><span class="glyphicon glyphicon-remove" title="Close"></span></div><div class="ui-pnotify-sticker" style="cursor: pointer; visibility: hidden;"><span class="glyphicon glyphicon-play" title="Stick"></span></div><div class="ui-pnotify-icon"><span class="glyphicon glyphicon-ok-sign"></span></div><h4 class="ui-pnotify-title">Error</h4><div class="ui-pnotify-text">Unable to edit the profile</div><div style="margin-top: 5px; clear: both; text-align: right; display: none;"></div></div></div>

<?php }

?>
  <!-- end show message -->

        <!-- card detail form -->
        <div class="admin-form">
             <div id="p1" class="panel heading-border">
                <div class="panel-body bg-light"> 
                    <form method="post" action="<?php echo base_url().'/Settings/edit_profile'?>" id="form-ui" accept-charset="utf-8" enctype="multipart/form-data">
                        <div class="section-divider mb40" id="spy1">
                            <span>Edit Profile</span>
                        </div> 
                        <div class="pv30 ph40 bg-light dark br-b br-grey posr">
                            <div class="table-layout">
                                <div class="w200 text-center pr30">
                                    <!-- <img src="assets/img/avatars/profile_avatar.jpg" class="responsive"> -->
                                    <img src="<?php echo base_url().'/profile_img/'.$user_info['upload_img'] ?>" class="responsive">
                                    
                                </div>
                                <div class="main-section">
                                    <!-- sec-1 -->
                                    <div class="row">
                                        <!-- password section -->
                                        <div class="col-md-6">
                                                <div class="section">
                                                    <label>Password:</label>
                                                        <label class="field prepend-icon">
                                                            <input type="password" name="password" id="password" class="gui-input" placeholder="Enter password" value= "">
                                                            <label for="password" class="field-icon"><i class="fa fa-key"></i></label>
                                                    </label>
                                                </div>
                                            </div>
                                        <!-- end  password section -->

                                        <!-- confirm password section -->
                                        <div class="col-md-6">
                                            <div class="section">
                                                <label>Confirm Password:</label>
                                                <label class="field prepend-icon">
                                                    <input type="password" name="confirm_password" id="confirm_password" class="gui-input" placeholder="Enter confirm password" value= "" onkeyup="checkPasswordMatch();">
                                                    <label for="confirm_password" class="field-icon"><i class="fa fa-key"></i></label>
                                                </label>
                                                  <!-- <span style="color:red; font-size: 17px;" class="registrationFormAlert" id="divCheckPasswordMatch"></span> -->
                                                  <span id="message"></span>
                                            </div>
                                        </div>
                                        <!-- end  password section -->
                                    </div>
                                    <!-- end sec-1 -->

                                    <!-- sec-2 -->
                                    <div class="row">
                                         <!-- upload-img -->
                                        <div class="col-md-6">
                                            <div class="section">
                                                <label>Upload Image: :</label>
                                                <label class="field prepend-icon file">
                                                    <span class="button">Choose File</span>
                                                    <input type="file" class="gui-file" name="file2" id="file2">
                                                    <input type="text" class="gui-input" id="uploader2" placeholder="Upload the image">
                                                    <label class="field-icon"><i class="fa fa-upload"></i></label>
                                                 </label>
                                            </div>
                                        </div>
                                        <!-- end upload img -->
                                    </div>
                                    <!--end  sec-2 -->

                                    <!-- submit button -->
                                    <div class="section-btn">
                                        <button type="submit" class="btn btn-dark" name="btn_save" id="btn_save" value="submit"><b>Edit Profile</b> </button>
                                    </div>
                                    <!-- end submit button -->
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </section>
    </section>

<script>

    // function checkPasswordMatch() 
    // {
    //     var password = $("#password").val();
    //     var confirmPassword = $("#confirm_password").val();

    //     if (password != confirmPassword)
    //         $("#divCheckPasswordMatch").html("*Passwords do not match!");
    //         //$("#btn_save").prop("disabled", true);
    //     else
    //         $("#divCheckPasswordMatch").html("Passwords match.");
    //         //$("#btn_save").prop("disabled", false);

    // }

       $('#password, #confirm_password').on('keyup', function() 
        {
           var password = $("#password").val();
           var confirmPassword = $("#confirm_password").val();


          if(password != confirmPassword)  
          {
            $('#message').html('*Password do not matching').css('color', 'red');
            $('#btn_save').prop('disabled', true);
          } 
          else 
          {
            $('#message').html('').css('color', 'green');
            $('#btn_save').prop('disabled', false);
          }
    });




</script>


                                        


                    
                                       
