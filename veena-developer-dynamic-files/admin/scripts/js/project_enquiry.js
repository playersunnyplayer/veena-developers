<!-- Start: project_enquiry List  -->
$(document).ready(function(){
	var data_type=$('#data_type').val();
	$('#table_project_enquiry').DataTable({
		"order": [[ 1, "desc" ]],
		"columnDefs": [ { 'targets': [0,1,6,7],"orderable": false } ],
  		'autoWidth':false,
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',
		'ajax': {
			'url':'scripts/ajax/index.php?method=project_enquiry&actionType=project_enquiry_list&data_type='+data_type,
		},
		'columns': [
		 	{ "data": "checkbox" },
				{ "data": "id" },
		  	{ "data": "project_id" },
			{ "data": "data_type" },
            { "data": "name" },
			{ "data": "phone" },
			{ "data": "email" },
			{ "data": "added_date" },
            { "data": "btn" }
		],
		 language: 
		 {
			searchPlaceholder: 'Search...',
			sSearch: '',
			lengthMenu: '_MENU_ items/page',
	    }
	});
	
	$('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
	 $('body').tooltip({selector: '[data-toggle="tooltip"]'});
});
<!-- End: project_enquiry List -->


<!-- Start:  project_enquiry addedit modal-->
$(document).on("click",".project_enquiry_addedit_onclick", function ()
{
	getId=$(this).data("id");
	$('#custom_ajax_preloader').show();
	$.ajax({
	type: 'POST',
	url: 'scripts/modal/index.php?method=project_enquiry_addedit&id='+getId,
	dataType : 'html',
	data: $(this).serialize()
	})
	.done(function(data)
	{
		// show the response
		$('#ajax_modal_container').html(data);
		$('#modal_project_enquiry_addedit').modal('show');
		$('#custom_ajax_preloader').hide();
		
		$('#project_enquiry_form').parsley();
		$.getScript("scripts/js/ajax.js");
		
	})
	.fail(function()
	{
		// just in case posting your form failed
		alert( "Try again." );
		$('#custom_ajax_preloader').hide();
	});
});
<!-- End:  project_enquiry addedit modal -->

<!-- Start: modal project_enquiry addedit submit  -->
$(document).on("click",".project_enquiry_modal_submit", function ()
{
    $('#project_enquiry_form').validate({
		rules:
		{
			name: {
					required: true,
			},
		},
		submitHandler: function (form)
		{
			$('.project_enquiry_modal_submit').html('<span class="spinner-border spinner-border-sm mg-r-5" role="status" aria-hidden="true"></span> Loading...');
			$(".project_enquiry_modal_submit").attr("disabled", true);
			var dataString = new FormData(form);
			dataString.append('method', 'project_enquiry');
			dataString.append('actionType', 'project_enquiryAddEdit');
			$.ajax({
                dataType: 'json',
                type: "POST",
				url: "scripts/ajax/index.php",
				data: dataString,
				cache:false,
          	  	contentType: false,
           	 	processData: false,
	 			success: function (responseData)
				{
					$('.project_enquiry_modal_submit').html('Submit');
					$(".project_enquiry_modal_submit").attr("disabled", false);
				
				  if(responseData.RESULT==1)
				  {
							$.bootstrapGrowl('<h4><strong>Notification</strong></h4> <p>'+responseData.msg+'</p>', {type:'danger',delay: 3000,allow_dismiss: true,offset: {from: 'top', amount: 20} });
				  }
				  else  if(responseData.RESULT==0)
				  {
							$.bootstrapGrowl('<h4><strong>Notification</strong></h4> <p>'+responseData.msg+'</p>', {type:'success',delay: 3000,allow_dismiss: true,offset: {from: 'top', amount: 20} });
							$('#modal_project_enquiry_addedit').modal('hide');
							var oTable = $('#table_project_enquiry').dataTable( );
							oTable.api().ajax.reload(null, false);
				  }
                },
                error: function (responseData) {
                    console.log('Ajax request not recieved!');
                }
            });
            return false;
        }
    });
});
<!-- End: modal project_enquiry addedit submit -->

<!-- Start: project_enquiry  delete  -->
$(document).on("click",".project_enquiry_delete_onclick", function ()
{
	var getid=$(this).data('id');
	if(getid!='')
	{
		 swal({
                title: "Are you sure?",
                text: "You will not be able to undo after this action!",
                type: "warning",
                showCancelButton: true,
				cancelButtonClass: 'btn-primary',
                confirmButtonClass: 'btn-warning',
                confirmButtonText: "Yes, delete it!",
				confirmButtonClass: "confirm btn btn-lg btn-warning xyz",
                closeOnConfirm: true
            }, function (r)
			{
				if(r == true)
				{
					$.ajax(
					{
						  type: "POST",
						  dataType: 'json',
						  url: "scripts/ajax/index.php",
						  data: "method=project_enquiry&actionType=project_enquiryDelete&getid="+getid,
						  success: function(responseData)
						  {
								  if(responseData.RESULT==0)
								  {
									var oTable = $('#table_project_enquiry').dataTable( );
									oTable.api().ajax.reload(null, false);
									$.bootstrapGrowl('<h4><strong>Notification</strong></h4> <p>Record Deleted Successfully.</p>', {type:'warning',delay: 3000,allow_dismiss: true,offset: {from: 'top', amount: 20} });
 									return false;
								  }
								  else
								  {
									  swal({ title: "Try Again...",
									  text: data.msg,
									  type: "warning",
									   timer: 1000
									  });
									  return false;
								  }
							  }
						  }
					  );
				}
				else
				{
					return false;
				}
            });
	}
	else
	{
		swal({ title: "Try Again...",
                text: "Oops Something gone wrong...",
                type: "warning",
				 timer: 1500
            });
			return false;
	}
});
<!-- End: project_enquiry single delete  -->

<!-- Start: project_enquiry Multi delete  -->
function mulitple_project_enquiry_select()
{
			var chk_vals=[];
	  	    $('input[name="del[]"]:checked').each(function() {chk_vals.push($(this).val());});
			if(chk_vals.length>0)
			{
				var ids=chk_vals.join(',');
				swal({
					title: "Are you sure?",
					text: "you want to delete records?",
					type: "warning",
					showCancelButton: true,
					cancelButtonClass: 'btn-primary',
					confirmButtonClass: 'btn-warning',
					confirmButtonText: "Yes, delete it!",
					confirmButtonClass: "confirm btn btn-lg btn-warning xyz",
					closeOnConfirm: true
					},
					function (r){
						if(r == true)
						  {
							  $.ajax({
							  type: "POST",
							  dataType: 'json',
							  url: "scripts/ajax/index.php",
							  data: "method=project_enquiry&actionType=project_enquiryMultiDelete&ids="+ids,
							  success: function(responseData){
								  if(responseData.RESULT==0)
								  {
									  $.bootstrapGrowl('<h4><strong>Notification</strong></h4> <p>'+responseData.msg+'</p>', {type:'success',delay: 3000,allow_dismiss: true,offset: {from: 'top', amount: 20}});
								  }
								  else
								  {
									  $.bootstrapGrowl('<h4><strong>Notification</strong></h4> <p>'+responseData.msg+'</p>', {type:'danger',delay: 3000,allow_dismiss: true,offset: {from: 'top', amount: 20}});
								  }
								  var oTable = $('#table_project_enquiry').dataTable( );
								  oTable.api().ajax.reload(null, false);
							  }
						  });
						 }
						else
						{
							return false;
						}
					}
				);
			}
			else
			{
				swal({
						 title:"Please Select Record",
						 type:"warning",
              			 timer: 1500
           			 });
			return false;
			}
}
<!-- End: project_enquiry Multi delete  -->

