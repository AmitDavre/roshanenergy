<?php 
$session  = session()->get("success");
$successMessage = $session;
?>
 
<!-- // get data from the session++++++++===> -->
<?php
$session_data = $_SESSION['combine_payment_Alldata'];
?>
<!-- // end+++++++++++++++++++++++++++++++++>
 -->
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
#pay_btn
{
    width: 20%;
}
.topbar-header
{
    margin-top: -1.5em;
}
.prepend-icon
{
     margin-top: 2%!important;
}
#form-container 
{
  transform: translateY(-0%);
}
.label
{
  color: #fafafa!important;
}
.button-credit-card 
{
    background: #fafafa!important;
    color: #000000!important;
   /* border-radius: 14px!important;*/
}
#form-container 
{
    width: 700px!important;
    padding: 50px 90px!important;
    background: black!important;
    border-radius: 50px!important;
}
.sq-input 
{
  border: 1px solid #fafafa!important;
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
                         <a href="<?php echo base_url().'/payments'; ?>">Payments</a>
                    </li>
                    
                    <li class="crumb-trail">Card Details</li>
                </ol>
            </div>
        </header>
    </div>
    <!-- End: Topbar -->

    <section id="content">
     <!-- card detail form -->
        <div class="admin-form">
             <div id="p1" class="panel heading-border">
                <div class="panel-body bg-light"> 
                    <div class="section-divider mb40" id="spy1">
                        <span>Card Details</span>
                    </div> 
                    <div id="form-container">
                        <div id="sq-ccbox">
                            <form id="nonce-form" novalidate action="<?php echo base_url().'/Payments/payment_process'?>" method="post">
                                <fieldset>
                                    <span class="label">Card Number</span>
                                    <div id="sq-card-number"></div>

                                    <div class="third">
                                        <span class="label">Expiration</span>
                                        <div id="sq-expiration-date"></div>
                                    </div>

                                    <div class="third">
                                        <span class="label">CVV</span>
                                        <div id="sq-cvv"></div>
                                    </div>

                                    <div class="third">
                                        <span class="label">Postal</span>
                                        <div id="sq-postal-code"></div>
                                    </div>
                                </fieldset>
                                <button id="sq-creditcard" class="button-credit-card" onclick="requestCardNonce(event)"><b>Pay &nbsp;<?php echo '$'.  $session_data['total_amount']; ?></b></button>

                                <div id="error"></div>
                                <!--After a nonce is generated it will be assigned to this hidden input field-->
                                <input type="hidden" id="amount" name="amount" value="<?php echo $session_data['total_amount']; ?>">
                                <input type="hidden" id="card-nonce" name="nonce">
                            </form>
                        </div> 
                        <!-- end #sq-ccbox -->
                    </div> <!-- end #form-container -->
                </div>
            </div>
        </div>
    </section>
</section>

<!-- script -->

<script type="text/javascript">

  document.addEventListener("DOMContentLoaded", function(event) 
  {
    if (SqPaymentForm.isSupportedBrowser()) 
    {
      paymentForm.build();
      paymentForm.recalculateSize();
    }
  });

</script>

<!-- end script -->



    


                                        




                                     
                                       
                                      
