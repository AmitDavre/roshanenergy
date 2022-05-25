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
/*div.dataTables_scrollHead table.table-bordered
{
    width : 1700px!important;
}*/
div.dataTables_scrollBody table 
{
    width : 1700px!important;
}
.topbar-header
{
    margin-top: -1.5em;
}


</style>

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

                    <li class="crumb-trail">Customer Statements</li> 
                </ol>
            </div>
        </header>
    </div>
    <!-- End: Topbar -->

    <section id="content">
    <?php
    // echo '<pre>';
    // print_r($_SESSION);
    // echo '</pre>';
    // die();
    ?>
    <!-- data table -->
    <div class="row">
       <div class="col-md-12">
          <div class="panel panel-visible">
              <div class="panel-heading">
                <div class="panel-title hidden-xs">
                  <span class="glyphicon glyphicon-tasks"></span>Customer Statements
                </div>
               </div>
                    <div class="panel-body pn">
                       <table class="table table-striped table-bordered table-hover" id="Statements" cellspacing="0" style="width:100%">
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
                                </tr>
                            </tfoot>
                              <tbody>
                                    <?php $i = 1; foreach($statement_record_cus as $fetch_row)
                                    { 
                                      if(isset($statement_record_cus))
                                      {
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
                                        </tr>
                                        <?php
                                       }
                                    }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
     </section>
</section>

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


 </script> 
