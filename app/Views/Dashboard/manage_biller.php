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
    .export
    {
        float: right;
    }
    #export_file
    {
        margin-bottom: 0.5em;
        width: 30%;
        float: right;
        font-size: 15px;
        border-radius: 21px;
    }
    .topbar-header
    {
        margin-top: -1.5em;
    }
   /* div.dataTables_scrollBody table 
   {
      width : 1700px!important;
   }*/

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
                    <li class="crumb-link">
                         <a href="<?php echo base_url().'/create-biller'; ?>">Create Biller</a>
                    </li>
                    <li class="crumb-trail">Manage Biller</li>
                </ol>
            </div>
        </header>
    </div>
    <!-- End: Topbar -->
    
    <section id="content">
        <!-- export data -->
            <div class="col-md-6  export">
                <div class="section">
                    <a href='<?php echo base_url().'/Dashboard/exportData_biller' ?>'><button type="button" class="btn btn-dark btn-block" name="export_file" id="export_file"><i class="fa fa-file"></i><span> Export All </span></button></a>
                 </div>
            </div>
        <!-- end export data -->
                   <div class="col-md-12">
                        <div class="panel panel-visible">
                            <div class="panel-heading">
                                <div class="panel-title hidden-xs">
                                    <span class="glyphicon glyphicon-tasks"></span>Manage Billers</div>
                            </div>
                            <div class="panel-body pn">
                                <table class="table table-striped table-bordered table-hover" id="manage_biller" cellspacing="0" width="100%">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Id</th>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Last Name</th>
                                            <th>Username</th>
                                          <!--   <th>Password</th> -->
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                            <th>Date of Birth</th>
                                            <!-- <th>Gender</th> -->
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot class="text-center">
                                        <tr>
                                            <th>Id</th>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Last Name</th>
                                            <th>Username</th>
                                        <!-- <th>Password</th> -->
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                            <th>Date of Birth</th>
                                            <!-- <th>Gender</th> -->
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $i=1; foreach ($table as $fetch_row)
                                     {
                            
                                     ?>
                                        <tr class="text-center">
                                        <td scope = "row"><?php echo $i++; ?></td>
                                         
                                        <td><?php echo $fetch_row['first_name']; ?></td>
                                        <td><?php echo $fetch_row['middle_name']; ?></td>
                                        <td><?php echo $fetch_row['last_name']; ?></td>
                                        <td><?php echo $fetch_row['username']; ?></td>
                                    <!--<td><?php //echo $fetch_row['password']; ?></td> -->
                                        <td><?php echo $fetch_row['phone_number']; ?></td>
                                        <td><?php echo $fetch_row['address']; ?></td>
                                        <td><?php echo $fetch_row['date_of_birth']; ?></td>
                                        <!-- <td><?php echo $fetch_row['gender']; ?></td> -->

                                         <!-- edit biller -->

                                        <td><a href="<?php echo site_url('edit-biller/').encrypt_decrypt($fetch_row['id'], 'encrypt'); ?>"><i class="fa fa-edit" style="font-size: 17px;"></i></a>

                                        <!-- delete biller -->
                                         <i class="fa fa-trash" style= "color: red;font-size: 17px;" onclick= "modelOpen('<?php echo $fetch_row['id']?>')"></i>
                                        </td>

                                    </tr>
                                    <?php  } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
       </section>
</section>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <input type="hidden" name="hiddenBillerID" id="hiddenBillerID">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <h3 class="modal-body text-center">
        Are you sure you want to delete your Data?
      </h3>
      <div class="modal-footer">
        <button type="button" id="" class="btn btn-dark" onclick="deleteBiller();">Ok</button>
        <button type="button" class="btn btn-dark" class="close" data-dismiss="modal" aria-label="Close">Close</button>
      </div>
    </div>
  </div>
</div>




<script type="text/javascript">


//show modal when we click delete button and remove opacity===>
function modelOpen(id)
{
  $(".modal-backdrop").remove();

  // $("#exampleModal").modal('toggle');
  $("#exampleModal").modal({backdrop: false, show:true,});
  $('#hiddenBillerID').val(id);
}
//end show modal when we click delete button and remove opacity-->


// when we click on model open button then delete the data===>

function deleteBiller(){

    // hide the modal after ok

    $("#exampleModal").modal('hide');

    var hiddenBillerID = $('#hiddenBillerID').val(); 
    $.ajax({
              type: 'POST',
              url: '<?php echo base_url()."/Dashboard/delete_biller";?>',
              data: {
                     hiddenBillerID: hiddenBillerID,
                    },
             success: function(response)
             {
                if($.trim(response) == 'success')
                {      
                    var title    = 'Success';
                    var message  = 'Biller deleted successfully';
                    alertSuccessNotify(title, message);

                    setTimeout(function(){ 
                        location.reload();
                    }, 2000);

                }
                else
                {
                    var title    = 'Error';
                    var message  = 'Unable to delete the biller';
                    alertErrorNotify(title, message);
                }
              }
            });
}
//end  when we click on model open button then delete the data

        // MANAGE CUSTOMER DATATABLE 

     $('#manage_biller').dataTable({
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


</script>