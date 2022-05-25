<style>
 tfoot tr th
{
    text-align: center!important;
}
thead tr th 
{
    text-align: center!important;
}
 #row_id
{
    text-align: center!important;
}
.odd
{
    text-align: center!important;
}
.section-btn
{
  text-align: center;
}
#btn_save
{
  width: 20%;
}
#select_customers,#select_years,#select_months
{
    width: 100%!important;
    padding: 7px;
    margin-top: 2%; 
}
.prepend-icon
{
     margin-top: 2%!important;
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
div.dataTables_scrollBody table 
{
    width : 1100px!important;
}
.ui-datepicker 
{
  width: 24.2em!important;
}
</style>

<!-- start section -->
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
                    <li class="crumb-trail">Payments</li>
                </ol>
            </div>
        </header>
    </div>
    <!-- End: Topbar -->


    <section id="content">

<!-- success message when we update the customer -->
<?php
$ErrorMessage  = session()->get("Error");
if($ErrorMessage == 'Error')
{?>
    <div class="ui-pnotify stack_top_right" style="width: 290px; opacity: 1; display: block; overflow: visible; right: 8px; top: 70px;"><div class="alert ui-pnotify-container alert-danger ui-pnotify-shadow" style="min-height: 16px; overflow: hidden;"><div class="ui-pnotify-closer" style="cursor: pointer; visibility: hidden;"><span class="glyphicon glyphicon-remove" title="Close"></span></div><div class="ui-pnotify-sticker" style="cursor: pointer; visibility: hidden;"><span class="glyphicon glyphicon-play" title="Stick"></span></div><div class="ui-pnotify-icon"><span class="glyphicon glyphicon-ok-sign"></span></div><h4 class="ui-pnotify-title">Error</h4><div class="ui-pnotify-text">Payment Already Submit</div><div style="margin-top: 5px; clear: both; text-align: right; display: none;"></div></div></div>
<?php } 
?>


<!-- end success message when we update the customer -->
        <div class="main-section">
          <!--payment data section  -->
            <div class="row">
                <div class="col-md-12">
                        <div class="panel">
                             <div class="panel-heading">
                                    <div class="panel-title hidden-xs">
                                        <span class="glyphicon glyphicon-tasks"></span>Payment Data
                                    </div>
                                </div>
                            <!-- panel heading section -->
                            <div class="panel-heading">
                                <ul class="nav panel-tabs-border panel-tabs panel-tabs-left">
                                    <li class="active">
                                        <a href="#tab1" data-toggle="tab">Make A Payment</a>
                                    </li>
                                    <li>
                                        <a href="#tab2" data-toggle="tab">Payment History</a>
                                    </li>
                                </ul>
                            </div>
                             <!--end panel heading section -->

                             <!-- data table section -->
                            <div class="panel-body">
                                <div class="tab-content pn br-n">
                                    <!-- Tab-1 Make a paymnet datatable section -->
                                    <div id="tab1" class="tab-pane active">
                                        <div class="panel-heading">
                                            <div class="panel-title hidden-xs">
                                                <span class="glyphicon glyphicon-tasks"></span>Make A Payment 
                                            </div>
                                        </div>

                                        <!-- form for the payment -->
                                        <div class="admin-form">
                                            <div id="p1" class="panel heading-border">
                                                <div class="panel-body bg-light">
                                                    <form method="post" action="<?php echo base_url().'/Payments/payments' ?>" id="form-ui">
                                                        <div class="section-divider mb40" id="spy1">
                                                            <span>Account Information</span>
                                                        </div>
                                                        <!-- section-1 -->
                                                        <div class="row">
                                                           <div class="form-group">
                                                               <!-- select -customer sec -->
                                                               <div class="col-md-4">
                                                                <label id="text"><b>Select Customers : - </b></label><br>
                                                                <select id="select_customers" name="select_customers" onchange = "getYearName();">
                                                                <option value="select">Select Customers</option>
                                                                <?php
                                                                foreach ($customer_model_data as $key => $cus_value) 
                                                                {?>
                                                                     <option value='<?php echo $cus_value["account_number"]; ?>'><?php echo $cus_value['resident_name']; ?></option>
                                                                    
                                                               <?php }
                                                                ?>
                                                                </select>
                                                                </div>
                                                               <!-- end elect Months section  -->


                                                               <!-- select -month sec -->
                                                               <div class="col-md-4">
                                                                <label id="text"><b>Select Months : - </b></label><br>
                                                                <select id="select_months" name="select_months" onchange = "getYearName();" readonly>
                                                                <option value="select">Select Months</option>
                                                                 <?php 
                                                                foreach ($allMonths as $key => $value_months)
                                                                {?>
                                                                    <option value='<?php echo $value_months['month_numeric']; ?>'><?php echo $value_months['month_name']; ?></option>
                                                                <?php } ?>
                                                                </select>
                                                                </div>
                                                               <!-- end elect Months section  -->

                                                               <!-- select Years section  -->
                                                               <div class="col-md-4">
                                                                <label id="text"><b>Select Years : - </b></label><br>
                                                                <select id="select_years" name="select_years" onchange = "getYearName();" >
                                                                <option value="select">Select Years</option>
                                                                <?php 
                                                                foreach ($year_array as $key => $value_years)
                                                                {?>
                                                                    <option value='<?php echo $value_years; ?>'><?php echo $value_years; ?></option>
                                                                <?php } ?>
                                                                </select>
                                                              </div>
                                                          </div>
                                                        </div><br><hr>
                                                        <!--end section-1 -->

                                                    <!-- section-2  -->
                                                    <div class="row">
                                                    <!-- account number -->
                                                        <div class="col-md-4">
                                                            <div class="section">
                                                                <label>Account Number:</label>
                                                                <label class="field prepend-icon">
                                                                    <input type="text" name="account_number" id="account_number" class="gui-input" placeholder="Enter your account number" value="" readonly>
                                                                    <label for="account_number" class="field-icon"><i class="fa fa-user"></i></label>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <!-- account number -->
                                                        <div class="col-md-4">
                                                            <div class="section">
                                                                <label>Tenant Name:</label>
                                                                <label class="field prepend-icon">
                                                                    <input type="text" name="tenant_name" id="tenant_name" class="gui-input" placeholder="Enter your tenant name" value="" readonly>
                                                                    <label for="tenant_name" class="field-icon"><i class="fa fa-user"></i></label>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <!-- account number -->
                                                        <div class="col-md-4">
                                                            <div class="section">
                                                                <label>Date Billed:</label>
                                                            <label class="field prepend-icon">
                                                                <input type="text" name="date_billed" id="date_billed" class="gui-input" placeholder="Select your date billed" readonly required />
                                                                <label for="date_billed" class="field-icon"><i class="fa fa-calendar"></i></label>
                                                            </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end sec-2 -->

                                                    <!-- section-3  -->
                                                    <div class="row">
                                                    <!-- account number -->
                                                        <div class="col-md-4">
                                                            <div class="section">
                                                                <label>Bill Number:</label>
                                                                <label class="field prepend-icon">
                                                                    <input type="text" name="bill_number" id="bill_number" class="gui-input" placeholder="Enter your bill number" value="" readonly>
                                                                    <label for="bill_number" class="field-icon"><i class="fa fa-money"></i></label>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <!-- account number -->
                                                        <div class="col-md-4">
                                                            <div class="section">
                                                                <label>Total Amount:</label>
                                                                <label class="field prepend-icon">
                                                                    <input type="text" name="total_amount" id="total_amount" class="gui-input" placeholder="Enter your total amount" value="" readonly>
                                                                    <label for="total_amount" class="field-icon"><i class="fa fa-dollar"></i></label>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <!-- account number -->
                                                        <div class="col-md-4" style="display:none;">
                                                            <div class="section">
                                                                <label>Status:</label>
                                                                <label class="field prepend-icon">
                                                                    <input type="text" name="status" id="status" class="gui-input" placeholder="Enter your status" value="" readonly>
                                                                    <label for="status" class="field-icon"><i class="fa fa-spinner"></i></label>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div><hr>
                                                    <!-- end sec-3 -->

                                                    <!-- sec-4 -->
                                                    <div class="section-btn">
                                                        <button type="button" class="btn btn-dark" name="save" id="btn_save" value="submit_data" onclick = "InsertPayment();" disabled>Submit</button>
                                                    </div>
                                                    <!--end sec-4 -->
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                      <!--end section form for the payment -->
                                </div>
                                <!-- end tab-1 Make a paymnet datatable section -->

                                <!-- tab-2 payment history section  -->
                                    <div id="tab2" class="tab-pane">
                                        <div class="panel panel-visible">
                                            <div class="panel-heading">
                                                <div class="panel-title hidden-xs">
                                                    <span class="glyphicon glyphicon-tasks"></span>Payment History
                                                </div>
                                            </div>
                                            <div class="panel-body pn">
                                                <table class="table table-striped table-bordered table-hover" id="payment_history" cellspacing="0" width="100%">
                                                    <thead class="text-center">
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Account Number</th>
                                                            <th>Tenant Name</th>
                                                            <th>Date Billed</th>
                                                            <th>Bill Number</th>
                                                            <th>Total Amount</th>
                                                            <th>Transaction Id</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tfoot class="text-center">
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Account Number</th>
                                                            <th>Tenant Name</th>
                                                            <th>Date Billed</th>
                                                            <th>Bill Number</th>
                                                            <th>Total Amount</th>
                                                            <th>Transaction Id</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </tfoot>

                                                    <tbody>
                                                        <?php $i = 1; foreach($combine_payment_data as $fetch_row)
                                                        {
                                                        ?>

                                                        <tr class="text-center">
                                                            <td scope = "row"><?php echo $i++; ?></td>
                                                            <td><?php echo $fetch_row['account_number']; ?></td>
                                                            <td><?php echo $fetch_row['tenant_name']; ?></td>
                                                            <td><?php echo $fetch_row['date_billed']; ?></td>
                                                            <td><?php echo $fetch_row['bill_number']; ?></td>
                                                            <td><?php echo '$'.$fetch_row['total_amount']; ?></td>
                                                            <td><?php echo $fetch_row['payment_id']; ?></td>
                                                            <!-- edit biller -->
                                                            <td><a href="<?php echo site_url('edit-payments-status/').encrypt_decrypt($fetch_row['id'], 'encrypt');?>"><i class="fa fa-edit" style="font-size: 17px;"></i></a></td>
                                                        </tr>
                                                        <?php }?>
                                                     
                                                     </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    
                                 <!--end tab-2 payment history section -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end payment data section -->
        </div>
    </section>
</section>
<!-- end section -->

<script type="text/javascript">


jQuery(document).ready(function() 
{
    "use strict";

    // Init Theme Core    
    Core.init();

    // Init Demo JS
    Demo.init();

    // Populates theme styles for Tabs - Trash function 
    var tabOptions = [];
    var tabToggle = $(".toggle-tab-style .tab-style-option");
    var tabCount = $(tabToggle).length;

    $(tabToggle).each(function(index, element)
     {
        var optionVal = $(element).attr('opt');

        // gather options and push to array
        tabOptions.push(optionVal);

        // on last loop filter for uniques
        if (index == tabCount - 1)
        {
            jQuery.unique(tabOptions);
        }
    });

    // Changes theme style on Tabs - Trash function 
    $(tabToggle).click(function() 
    {
        var tabStyle = $(this).data('opt');
        var Options = tabOptions.join(" ");

        // GARBAGE JS - left tab navigation has styles widget outside of its menu.
        // Requires slightly different class detection
        if ($(this).parent().hasClass('tab-style-left')) 
        {
            $(this).parents("div.tab-block").children("ul").removeClass(Options).addClass(tabStyle);
        } else 
        {
            // Assign option to parent of clicked tab widget. Remove all other options
            $(this).parents("ul").removeClass(Options).addClass(tabStyle);
        }
        // remove active class from options and add
        // the class to the newly clicked option
        $(this).siblings().removeClass("active");
        $(this).addClass("active");

    });

});


// DATATABLE 
    $('#payment_history').dataTable({
         "scrollX": true,
        "aoColumnDefs": [{
            'bSortable': false,
            'aTargets': [-1]
        }],
        "oLanguage": {
            "oPaginate": {
                "sPrevious": "",
                "sNext": ""
            }
        },
        "iDisplayLength": 5,
        "aLengthMenu": [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
        ],
        "sDom": 'T<"dt-panelmenu clearfix"lfr>t<"dt-panelfooter clearfix"ip>',
         "oTableTools": {
            "sSwfPath": "vendor/plugins/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf"
        }
     
    });


// onchange for yearname===============>
function getYearName()
{   
    // convert numeric month to mane month +++++++++++++++++++++>
    var monthsArray = '<?php echo json_encode($allMonths) ?>';
    var monthData = JSON.parse(monthsArray);

    // remove the 0 key start key with the 1 
    monthData.unshift(null);


    var get_cus_val   = $("#select_customers").val();
    var get_month_val = $("#select_months").val();
    var get_year_val  = $("#select_years").val();

    $.ajax({
                 type : 'POST',
                 url : '<?php echo base_url()."/Payments/get_payment_details" ?>',
                 data : {
                            get_cus_val:   get_cus_val,
                            get_month_val: get_month_val,
                            get_year_val:  get_year_val
                        },
                 success : function(response)
                {
                    var data = JSON.parse(response);

                    // if both blank then return false
                    // if payment id blank and total amount is not blank then run the code 
                    // if total amount is blank then return false 

                    if((data['2']== null) && (data['6'] == null))
                    {   
                         console.log('1');


                         $("#btn_save").prop("disabled", true);

                         // show mssg+++++++++++++++++++++>
                         var title    = 'Error';
                         var message  = 'Error';
                         alertErrorNotify(title, message);
                         return false;

                     }
                    else if((data['2'] != null)  && (data['6'] == null))
                    {
                        // run the code 
                        console.log('2');
                        $("#btn_save").prop("disabled", false);

                        var account_number   = $("#account_number").val(data['0']);
                        var tenant_name      = $("#tenant_name").val(data['1']);
                        var bill_number      = $("#bill_number").val(data['5']);
                        var total_amount_due = $("#total_amount").val(data['2']);
                    }
                    else if(data['2'] == null)
                    {
                        console.log('3');


                        $("#btn_save").prop("disabled", true);

                         // amount blank mssg
                         var title    = 'Error';
                         var message  = 'Amount filled blank';
                         alertErrorNotify(title, message);
                        return false ;
                    }

                    else if((data['2']!= null) && (data['6'] != null))
                    {
                        console.log('4');


                        $("#btn_save").prop("disabled", true);
                        var account_number   = $("#account_number").val(data['0']);
                        var tenant_name      = $("#tenant_name").val(data['1']);
                        var bill_number      = $("#bill_number").val(data['5']);
                        var total_amount_due = $("#total_amount").val(data['2']);

                         // payment already exist
                         var title    = 'Error';
                         var message  = monthData[get_month_val]['month_name']+'month payment already submit';
                         alertErrorNotify(title, message);
                         return false ;
                     }
                     else
                     {
                         var title    = 'Error';
                         var message  = 'Error 404';
                         alertErrorNotify(title, message);                          
                         return false ;
                     }
                }
           });
}
// end onchange for yearname===============>

// when we submit the button inset the data in the database=====>
function InsertPayment()
{
    var get_cus_val         = $("#select_customers").val();
    var get_month_val       = $("#select_months").val();
    var get_year_val        = $("#select_years").val();
    var get_date_billed_val = $("#date_billed").val();

    // if(get_date_billed_val == 'null')
    // {
    //    // give error 
    //     $('#date_billed').html('Please fill the required field');
    // }


    $.ajax({
            type : 'POST',
            url  : '<?php echo base_url()."/Payments/insert_payment_data" ?>',
            data : {
                        get_cus_val:   get_cus_val,
                        get_month_val: get_month_val,
                        get_year_val:  get_year_val,
                        get_date_billed_val: get_date_billed_val
                    },
                    success : function(response)
                    {
                        if($.trim(response) == 'success')
                        {      
                            var title    = 'Success';
                            var message  = 'Sucessfully redirect to next page';
                            alertSuccessNotify(title, message);
                            // redirect to card-detail page------->
                            var base_url  = '<?php echo base_url() ?>';
                            window.location = base_url+'/card-details';
                        }

                        else
                        {
                            var title    = 'Error';
                            var message  = 'Unable to submit the data';
                            alertErrorNotify(title, message);
                        }
                        //console.log(response);
                        var data = JSON.parse(response);
                        //console.log(data);
                    }
            });
}
// end when we submit the button inset the data in the database=====>
</script>
              