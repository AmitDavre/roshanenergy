<style>

tfoot tr th
{
   text-align: center!important;
}

thead tr th
{
   text-align: center!important;
}

.odd
{
   text-align: center!important;
}

#master_sheet
{
   margin-bottom: 0.5em;
   width: 50%;
   font-size: 15px;
   border-radius: 21px;
   margin-top: 6%;
}

#select_months
{
    width: 50%!important;
    padding: 7px!important;
    margin-top: 2%;
}

#select_years
{
  width: 50%!important;
  padding: 7px!important;
  margin-top: 2%;  
}
div.dataTables_scrollBody table 
{
     width : 1700px!important;
}
.topbar-header
{
    margin-top: -1.5em;
}


</style>

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
                    <li class="crumb-trail">Utility Statements</li>
                </ol>
            </div>
        </header>
    </div>
    <!-- End: Topbar -->

  <section id="content">
    <div class="main-section">
<!-- show message -->
<?php 
$successMessage  = session()->get("success");
$errorMessage  = session()->get("error");
// echo '<pre>';
// print_r($errorMessage);
// echo '</pre>';
// die();
?>

 <?php 

    if($successMessage == 'success')
    { ?>

        <div class="ui-pnotify stack_top_right" style="width: 390px; opacity: 1; display: block; overflow: visible; right: 8px; top: 70px;"><div class="alert ui-pnotify-container alert-success ui-pnotify-shadow" style="min-height: 16px; overflow: hidden;"><div class="ui-pnotify-closer" style="cursor: pointer; visibility: hidden;"><span class="glyphicon glyphicon-remove" title="Close"></span></div><div class="ui-pnotify-sticker" style="cursor: pointer; visibility: hidden;"><span class="glyphicon glyphicon-play" title="Stick"></span></div><div class="ui-pnotify-icon"><span class="glyphicon glyphicon-ok-sign"></span></div><h4 class="ui-pnotify-title">Success</h4><div class="ui-pnotify-text">Generate Utility Statements Successfully</div><div style="margin-top: 5px; clear: both; text-align: right; display: none;"></div></div></div>


    <?php } else if($errorMessage == 'error')
    {?>
          <div class="ui-pnotify stack_top_right" style="width: 390px; opacity: 1; display: block; overflow: visible; right: 8px; top: 70px;"><div class="alert ui-pnotify-container alert-danger ui-pnotify-shadow" style="min-height: 16px; overflow: hidden;"><div class="ui-pnotify-closer" style="cursor: pointer; visibility: hidden;"><span class="glyphicon glyphicon-remove" title="Close"></span></div><div class="ui-pnotify-sticker" style="cursor: pointer; visibility: hidden;"><span class="glyphicon glyphicon-play" title="Stick"></span></div><div class="ui-pnotify-icon"><span class="glyphicon glyphicon-ok-sign"></span></div><h4 class="ui-pnotify-title">Error</h4><div class="ui-pnotify-text">Unable to Generate Utility Statements</div><div style="margin-top: 5px; clear: both; text-align: right; display: none;"></div></div></div>

    <?php } ?>
 <!-- end show message -->

      <div class="admin-form">
        <form method="post" action ="<?php echo base_url().'/Statements/utility_statements' ?>">
          <div class="panel heading-border">
            <div class="panel-body bg-light">
              <div class="section-divider mb40" id="spy1"><span>Utility Bill Master Sheet</span></div>
                <!-- select Months section  -->
                <div class="row">
                    <div class="form-group">
                      <div class="col-md-6">
                        <label id="text"><b>Select Months : - </b></label><br>
                        <select id="select_months" name="select_months">
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
                      <div class="col-md-6">
                        <label id="text"><b>Select Years : - </b></label><br>
                        <select id="select_years" name="select_years">
                            <option value="select">Select Years</option>
                             <?php 
                            foreach ($year_array as $key => $value_years)
                            {?>
                                <option value='<?php echo $value_years; ?>'><?php echo $value_years; ?></option>
                            <?php } ?>
                        </select>
                      </div>
                    </div>
                </div>
                <!-- end select Years section -->

                <!-- generate mastersheet btn -->
                <div class="row">
                    <div class="form-group">
                        <!-- generate statement button -->
                        <div class="col-md-6 sheet">
                            <div class="section">
                               <button type="submit" class="btn btn-dark btn-block" name="master_sheet" id="master_sheet"><i class="fa fa-file"></i><span> Generate Master Sheet </span></button>
                            </div>
                        </div>
                        <!-- end generate button -->
                    </div>
                </div>
                <!-- end generate mastersheet btn -->
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- data table -->

    <div class="row">

       <div class="col-md-12">

          <div class="panel panel-visible">

              <div class="panel-heading">

                <div class="panel-title hidden-xs">

                  <span class="glyphicon glyphicon-tasks"></span>Monthly Utility Bills Mater Sheet 

                </div>

              </div>

                    <div class="panel-body pn">

                       <table class="table table-striped table-bordered table-hover" id="Statements" cellspacing="0" width="100%">

                          <thead class="text-center">

                            <tr class="text-center">

                                <th>ID</th>

                                <th>Month</th>

                                <th>Year</th>

                                <th>Bill Date</th>

                                <th>Total Amount</th>

                                <th>Number of Unit</th>

                                <th>Link Excel File</th>

                                <th>Action</th>

                            </tr>

                            </thead>

                            <tfoot>

                                <tr class="text-center">

                                <th>ID</th>

                                <th>Month</th>

                                <th>Year</th>

                                <th>Bill Date</th>

                                <th>Total Amount</th>

                                <th>Number of Unit</th>

                                <th>Link Excel File</th>

                                <th>Action</th>

                                </tr>

                            </tfoot>

                                <tbody>
                                    <?php $i = 1; foreach($table as $fetch_row)
                                    {
                                        // echo '<pre>';
                                        // print_r($table);
                                        // echo '</pre>';
                                        // die();
                                    ?>

                                    <tr class="text-center">

                                    <td scope = "row"><?php echo $i++; ?></td>

                                    <td><?php echo $fetch_row['select_month']; ?></td>

                                    <td><?php echo $fetch_row['select_year']; ?></td>

                                    <td><?php echo $fetch_row['current_date']; ?></td>

                                    <td><?php echo'$'. $fetch_row['all_cus_total_amount']; ?></td>

                                    <td><?php echo $fetch_row['total_number_of_customer']; ?></td>

                                    <td><a href="<?php echo $fetch_row['excel_file_link'];?>"target="_blank"> <i class="fa fa-file-excel-o" style="color:green; font-size:22px;"></i></a></td>

                                    <!-- delete utility statement section-->
                                    <td><i class="fa fa-trash" style= "color: red;font-size: 17px;" onclick= "modelOpen('<?php echo $fetch_row['id']?>')"></i></td>
                                    <!-- end delete utility statement section -->

                                    </tr>
                                    <?php
                                    }
                                    ?>

                                </tbody>

                            </table>

                         </div>

                      </div>

                   </div>

                </div>

           </section>

    </section>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <input type="hidden" name="hiddenCustomerID" id="hiddenCustomerID">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <h3 class="modal-body text-center">
        Are you sure you want to delete your Utility Statement?
      </h3>
      <div class="modal-footer">
        <button type="button" id="" class="btn btn-dark" onclick="DeleteUtilityStatement();">Ok</button>
        <button type="button" class="btn btn-dark" class="close" data-dismiss="modal" aria-label="Close">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end modal -->




<script type="text/javascript">



 // MANAGE CUSTOMER DATATABLE 



$('#Statements').dataTable({

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

//show modal when we click delete button and remove opacity++++++++>
function modelOpen(id)
{
  $(".modal-backdrop").remove();

  // $("#exampleModal").modal('toggle');
  $("#exampleModal").modal({backdrop: false, show:true,});
  $('#hiddenCustomerID').val(id);
}
//end show modal when we click delete button and remove opacity+++++++++>



// when we click on model open button then delete the data
function DeleteUtilityStatement()
{
  // hide the modal after ok 
    $("#exampleModal").modal('hide');
    var hiddenCustomerID = $('#hiddenCustomerID').val(); 

    $.ajax({
                type: 'POST',
                url: '<?php echo base_url()."/Statements/delete_utility_statement";?>',
                data: 
                {
                     hiddenCustomerID: hiddenCustomerID,
                },
                success: function(response)
                {
                     if($.trim(response) == 'success')
                    {      
                        var title    = 'Success';
                        var message  = 'Monthly Utility Statement deleted successfully';
                        alertSuccessNotify(title, message);

                        setTimeout(function()
                        { 
                            location.reload();
                        }, 2000);
                    }
                    else
                    {
                        var title    = 'Error';
                        var message  = 'Unable to delete the Monthly Utility Statement';
                        alertErrorNotify(title, message);
                    }
                }
            });
}
//end  when we click on model open button then delete the data

</script> 

