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
    #text
    {
      font-weight: 400!important;
      font-size: 13px!important;
      margin: 15px 0px 9px 12px!important;
    }
    #multiselect2
    {
      width: 60%!important;
      padding: 7px!important;
    }
    .daterangepicker td.active, .daterangepicker td.active:hover 
    {
      background:#3b3f4f!important;
      border-color:#3b3f4f!important;
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

        <div class="ui-pnotify stack_top_right" style="width: 290px; opacity: 1; display: block; overflow: visible; right: 8px; top: 70px;"><div class="alert ui-pnotify-container alert-success ui-pnotify-shadow" style="min-height: 16px; overflow: hidden;"><div class="ui-pnotify-closer" style="cursor: pointer; visibility: hidden;"><span class="glyphicon glyphicon-remove" title="Close"></span></div><div class="ui-pnotify-sticker" style="cursor: pointer; visibility: hidden;"><span class="glyphicon glyphicon-play" title="Stick"></span></div><div class="ui-pnotify-icon"><span class="glyphicon glyphicon-ok-sign"></span></div><h4 class="ui-pnotify-title">Success</h4><div class="ui-pnotify-text">Generate File Sucessfully</div><div style="margin-top: 5px; clear: both; text-align: right; display: none;"></div></div></div>

<?php }
    else if($sessionError == 'error')
    { ?>
          <div class="ui-pnotify stack_top_right" style="width: 290px; opacity: 1; display: block; overflow: visible; right: 8px; top: 70px;"><div class="alert ui-pnotify-container alert-danger ui-pnotify-shadow" style="min-height: 16px; overflow: hidden;"><div class="ui-pnotify-closer" style="cursor: pointer; visibility: hidden;"><span class="glyphicon glyphicon-remove" title="Close"></span></div><div class="ui-pnotify-sticker" style="cursor: pointer; visibility: hidden;"><span class="glyphicon glyphicon-play" title="Stick"></span></div><div class="ui-pnotify-icon"><span class="glyphicon glyphicon-ok-sign"></span></div><h4 class="ui-pnotify-title">Error</h4><div class="ui-pnotify-text">Unable to Generate the file</div><div style="margin-top: 5px; clear: both; text-align: right; display: none;"></div></div></div>

<?php }

?>
  <!-- end show message -->

<!-- DATERANGE FIELDS -->
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
                    <li class="crumb-trail">Generate Statement</li>
                </ol>
            </div>
        </header>
    </div>
    <!-- End: Topbar -->


  <section id="content">
    <div class="main-section">
      <div class="admin-form">
        <!-- <form method="post" action = "<?php //echo base_url().'/Statements/generate_statements' ?>" enctype="multipart/form-data"> -->
          <div class="panel heading-border">
            <div class="panel-body bg-light">
              <div class="section-divider mb40" id="spy1"><span>Generate Statements</span></div>
              <form method="post" action = "<?php echo base_url().'/Statements/generate_statements' ?>" enctype="multipart/form-data">
                <!-- daterange picker -->
                <div class="row">
                  <label id="text">Select Start Date And End Date : - </label>
                    <div class="form-group">
                      <div class="col-md-7">
                         <label class="field prepend-icon">
                        <input type="text" class="form-control pull-right" name="daterange" id="daterangepicker1" placeholder="Please select the date" required/>
                        <label for="" class="field-icon"><i class="fa fa-calendar"></i></label>
                         </label>
                      </div>
                    </div>
                </div>
                  <!-- end date range picker -->

                <!-- select section -->
                <div class="row">
                  <label id="text">Select Users</label>
                    <div class="form-group">
                      <div class="col-md-8">
                          <!-- <select id="multiselect2" multiple="multiple" name="multiselect2"> -->
                            <select id="multiselect2" name="multiselect2">
                            <!--<option value='0'>Select All</option> -->
                            <option value="select">Select Users</option>
                            <?php 
                            foreach ($customerData as $key => $value)
                            {?>
                              <option value='<?php echo $value["id"]; ?>'><?php echo $value['resident_name']; ?></option>
                           <?php }?>
                            
                          </select>
                      </div>
                  <!-- end select section -->

                     <!-- generate statement btn -->
                     <div class="col-md-3" style="float:right;">
                      <button  formtarget="_blank" type="submit" class="btn btn-dark btn-block" name="gen_statement" id="gen_statament">Generate Statement</button>
                     </div>
                  </div>
                  <!-- end generate statement btn -->
              </div>
              </form><br>
              
              <!-- show success message upload csv file-->
              <?php
                $sessionS  = session()->get("success");
                $sessionE = session()->get("error");
              ?>
              <!-- end show message -->
              <!-- show success message -->
               <?php

                  if($sessionS == 's')
                  { ?>

                      <div class="ui-pnotify stack_top_right" style="width: 290px; opacity: 1; display: block; overflow: visible; right: 8px; top: 70px;"><div class="alert ui-pnotify-container alert-success ui-pnotify-shadow" style="min-height: 16px; overflow: hidden;"><div class="ui-pnotify-closer" style="cursor: pointer; visibility: hidden;"><span class="glyphicon glyphicon-remove" title="Close"></span></div><div class="ui-pnotify-sticker" style="cursor: pointer; visibility: hidden;"><span class="glyphicon glyphicon-play" title="Stick"></span></div><div class="ui-pnotify-icon"><span class="glyphicon glyphicon-ok-sign"></span></div><h4 class="ui-pnotify-title">Success</h4><div class="ui-pnotify-text">Upload File Sucessfully</div><div style="margin-top: 5px; clear: both; text-align: right; display: none;"></div></div></div>

              <?php }
                  else if($sessionE == 'e')
                  { ?>
                        <div class="ui-pnotify stack_top_right" style="width: 290px; opacity: 1; display: block; overflow: visible; right: 8px; top: 70px;"><div class="alert ui-pnotify-container alert-danger ui-pnotify-shadow" style="min-height: 16px; overflow: hidden;"><div class="ui-pnotify-closer" style="cursor: pointer; visibility: hidden;"><span class="glyphicon glyphicon-remove" title="Close"></span></div><div class="ui-pnotify-sticker" style="cursor: pointer; visibility: hidden;"><span class="glyphicon glyphicon-play" title="Stick"></span></div><div class="ui-pnotify-icon"><span class="glyphicon glyphicon-ok-sign"></span></div><h4 class="ui-pnotify-title">Error</h4><div class="ui-pnotify-text">Unable to Upload the file</div><div style="margin-top: 5px; clear: both; text-align: right; display: none;"></div></div></div>

              <?php } ?>
             <!-- import/upload row data -->
              <form action="<?php echo base_url().'/Statements/upload_data';?>" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="form-group">
                  <div class="col-md-5">
                      <label>Please select csv file :</label><br>
                        <label class="field prepend-icon file">
                        <span class="button">Choose File</span>
                        <input type="file" class="gui-file" name="file11" id="file11" onChange="document.getElementById('uploader').value = this.value;">
                        <input type="text" class="gui-input" id="uploader" placeholder="Please Select A File">
                        <label class="field-icon"><i class="fa fa-upload"></i></label>
                         </label>
                    </div><br>

                    <div class="col-md-3" style="float:right;">
                      <button type="submit" class="btn btn-dark btn-block" name="upload_row_data" id="data">Upload Data</button>
                    </div>
                  </div>
              </div>
            </form>
              <!-- end import/upload row data -->
           </div>
        </div>
      </div>
    </div>

    <!-- data table -->
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-visible">
          <div class="panel-heading">
            <div class="panel-title hidden-xs">
              <span class="glyphicon glyphicon-tasks"></span>Generate Statements
            </div>
          </div>
              <div class="panel-body pn">
                <table class="table table-striped table-bordered table-hover" id="Statements" cellspacing="0" width="100%">
                   <thead class="text-center">
                      <tr class="text-center">
                        <th>ID</th>
                            <th>Account Number</th>
                            <th>Resident Name</th>
                            <th>Unit</th>
                            <th>Street Address</th>
                            <th>City</th>
                            <th>Zip Code</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Date Billed</th>
                            <th>Total Amount Due</th>
                            <th>Landlord Name</th>
                            <th>PDF Download</th>
                            <th>Action</th>
                      </tr>
                     </thead>
                        <tfoot>
                          <tr class="text-center">
                            <th>ID</th>
                            <th>Account Number</th>
                            <th>Resident Name</th>
                            <th>Unit</th>
                            <th>Street Address</th>
                            <th>City</th>
                            <th>Zip Code</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Date Billed</th>
                            <th>Total Amount Due</th>
                            <th>Landlord Name</th>
                            <th>PDF Download</th>
                            <th>Action</th>
                            </tr>
                          </tfoot>
                            <tbody>
                              <?php $i = 1; foreach($statement_record as $fetch_row)
                              {
                                // echo '<pre>';
                                // print_r($statement_record);
                                // echo '</pre>';
                                // die();
                              ?>
                              <tr class="text-center">
                                <td scope = "row"><?php echo $i++; ?></td>
                                <td><?php echo $fetch_row['account_number']; ?></td>
                                <td><?php echo $fetch_row['resident_name']; ?></td>
                                <td><?php echo $fetch_row['unit']; ?></td>
                                <td><?php echo $fetch_row['street_address']; ?></td>
                                <td><?php echo $fetch_row['city']; ?></td>
                                <td><?php echo $fetch_row['zip_code']; ?></td>
                                <td><?php echo $fetch_row['statement_start_date']; ?></td>
                                <td><?php echo $fetch_row['statement_end_date']; ?></td>
                                <td><?php echo $fetch_row['current_date_statement']; ?></td>
                                <td><?php echo'$'. $fetch_row['total_amount_due']; ?></td>
                                <td><?php echo $fetch_row['landlord_name']; ?></td>
                                <td><a href="<?php echo $fetch_row['statement_pdf_download']; ?>" target="_blank"><i class="fa fa-file-pdf-o" style="color:red; font-size:22px;"></i></a></td>
                                <!-- delete statement section-->
                                <td><i class="fa fa-trash" style= "color: red;font-size: 17px;" onclick= "modelOpen('<?php echo $fetch_row['id']?>')"></i></td>
                                <!-- end delete statement section -->
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
        Are you sure you want to delete your Statement?
      </h3>
      <div class="modal-footer">
        <button type="button" id="" class="btn btn-dark" onclick="deleteStatement();">Ok</button>
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




// add class to change the daterange apply button color+++++++>
$(document).ready(function(){
    $(".btn-success").addClass("demo");
    $(".btn-success").css({"background-color": "black"});
    // $('#multiselect2').multiselect({
    //     includeSelectAllOption: true
    //  });
  });
// end lass to change the daterange apply button color+++++++>

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
function deleteStatement()
{
  // hide the modal after ok 
    $("#exampleModal").modal('hide');
    var hiddenCustomerID = $('#hiddenCustomerID').val(); 

    $.ajax({
              type: 'POST',
              url: '<?php echo base_url()."/Statements/delete_gen_statement";?>',
              data: {
                      hiddenCustomerID: hiddenCustomerID,
                    },
              success: function(response)
              {
                if($.trim(response) == 'success')
                {      
                    var title    = 'Success';
                    var message  = 'Statement deleted successfully';
                    alertSuccessNotify(title, message);

                    setTimeout(function(){ 
                        location.reload();
                    }, 2000);

                }
                else
                {
                    var title    = 'Error';
                    var message  = 'Unable to delete the Statement';
                    alertErrorNotify(title, message);
                }
              }
            });
}
//end  when we click on model open button then delete the data


 </script> 
