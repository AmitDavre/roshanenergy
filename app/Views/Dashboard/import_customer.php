<!-- add css -->
<style>
	#btn_upload
	{
        margin-top: 1em;
	    width: 50%;
	    float: right;
	    font-size: 15px;
        border-radius: 21px;
	}

	.download
	{
      float: right;
	}

	#download_file
	{
		margin-top: 0.5em;
	    width: 50%;
	    float: right;
	    font-size: 15px;
	    border-radius: 21px;
	}

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

        <div class="ui-pnotify stack_top_right" style="width: 290px; opacity: 1; display: block; overflow: visible; right: 8px; top: 70px;"><div class="alert ui-pnotify-container alert-success ui-pnotify-shadow" style="min-height: 16px; overflow: hidden;"><div class="ui-pnotify-closer" style="cursor: pointer; visibility: hidden;"><span class="glyphicon glyphicon-remove" title="Close"></span></div><div class="ui-pnotify-sticker" style="cursor: pointer; visibility: hidden;"><span class="glyphicon glyphicon-play" title="Stick"></span></div><div class="ui-pnotify-icon"><span class="glyphicon glyphicon-ok-sign"></span></div><h4 class="ui-pnotify-title">Success</h4><div class="ui-pnotify-text"> File Import  Sucessfully</div><div style="margin-top: 5px; clear: both; text-align: right; display: none;"></div></div></div>

<?php }
    else if($sessionError == 'error')
    { ?>
          <div class="ui-pnotify stack_top_right" style="width: 290px; opacity: 1; display: block; overflow: visible; right: 8px; top: 70px;"><div class="alert ui-pnotify-container alert-danger ui-pnotify-shadow" style="min-height: 16px; overflow: hidden;"><div class="ui-pnotify-closer" style="cursor: pointer; visibility: hidden;"><span class="glyphicon glyphicon-remove" title="Close"></span></div><div class="ui-pnotify-sticker" style="cursor: pointer; visibility: hidden;"><span class="glyphicon glyphicon-play" title="Stick"></span></div><div class="ui-pnotify-icon"><span class="glyphicon glyphicon-ok-sign"></span></div><h4 class="ui-pnotify-title">Error</h4><div class="ui-pnotify-text">Unable to Import the file</div><div style="margin-top: 5px; clear: both; text-align: right; display: none;"></div></div></div>

<?php }


    ?>
  <!-- end show message -->

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
                    <li class="crumb-trail">Import Customer</li>
                </ol>
            </div>
        </header>
    </div>
    <!-- End: Topbar -->

    <section id="content">
        <div class="main-section">
 
            <!-- File Uploaders -->
            <div class="admin-form">
           <form action="<?php echo base_url().'/Dashboard/importCsvToDb';?>" method="post" enctype="multipart/form-data">
                <div id="p1" class="panel heading-border">
                    <div class="panel-body bg-light">
                    	 <div class="section-divider mb40" id="spy1"><span>Import customer CSV file</span></div>
		                    <div class="row">
		                        <div class="col-md-6">
		                            <div class="section">
		                            	<label>Please select csv file :</label>
		                                <label class="field prepend-icon file">
				                            <span class="button">Choose File</span>
				                            <input type="file" class="gui-file" name="file2" id="file2" onChange="document.getElementById('uploader2').value = this.value;">
				                            <input type="text" class="gui-input" id="uploader2" placeholder="Please Select A File">
				                            <label class="field-icon"><i class="fa fa-upload"></i></label>
		                                 </label>
		                            </div>
		                        </div>
		                        <div class="col-md-6">
		                            <div class="section">
		                            	<button type="submit" class="btn btn-dark btn-block" name="upload_file" id="btn_upload"><i class="fa fa-upload"></i><span>  Upload File  </span></button> 
		                            </div>
		                        </div>
		                    </div>
		                    <div class= "row">
		                    	<div class="col-md-6 download">
		                    		<div class="section">
		                    			<a href='<?php echo base_url().'/csv_files/customer.csv' ?>'><button type="button" class="btn btn-dark btn-block" name="download_file" id="download_file"><i class="fa fa-download"></i><span>  Download  </span></button></a> 
		                    		</div>
		                    	</div>
		                    </div>
		                </div>
		            </div>
		        </div>
		 </div>

		 <!-- end file section -->

            <!-- data table -->
             <div class="row">
                <div class="col-md-12">
                	<div class="panel panel-visible">
			       	    <div class="panel-heading">
			                <div class="panel-title hidden-xs">
			                    <span class="glyphicon glyphicon-tasks"></span>Import CSV file
			                </div>
			             </div>
			                    <div class="panel-body pn">
			                        <table class="table table-striped table-bordered table-hover" 
			                            id="manage_customer" cellspacing="0" width="100%">
			                            <thead>
			                                <tr>
			                                    <th>Id</th>
			                                    <th>File Name</th>
			                                    <th>Date</th>
			                                   <!--  <th>Action</th> -->
			                                  </tr>
			                            </thead>
			                            <tfoot>
			                                <tr class="text-center">
			                                    <th>Id</th>
			                                    <th>File Name</th>
			                                    <th>Date</th>
			                                  <!--   <th>Action</th> -->
			                                </tr>
			                            </tfoot>
			                            <tbody>
			                            	<?php $i=1; foreach($table as $fetch_row)
			                            	{

			                            	?>
			                            	 <tr class="text-center">
			                            	  <td scope = "row"><?php echo $i++; ?></td>

			                                   <td><?php echo $fetch_row['file_name']; ?></td>
			                                   <td><?php echo $fetch_row['date']; ?></td>
			                                   
			                                    <!-- delete customer -->
			                                   <!-- <td><i class="fa fa-trash" style= "color: red;font-size: 17px;" ></i>
			                                   </td> -->

			                                 </tr>
			                                <?php } ?>
			                            </tbody>
			                         </table>
			                   </div>
			            </div>
			     </div>
			</div>
    </section>
</section>

 <script>
 	// MANAGE CUSTOMER DATATABLE 

    $('#manage_customer').dataTable({
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