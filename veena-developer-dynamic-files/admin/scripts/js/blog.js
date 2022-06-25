<!-- Start: team List  -->
$(document).ready(function(){
	$('#table_blog').DataTable({
		"order": [[ 1, "desc" ]],
		"columnDefs": [ { 'targets': [0,1,6],"orderable": false } ],
  		'autoWidth':false,
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',
		'ajax': {
			'url':'scripts/ajax/index.php?method=blog&actionType=blog_list',
		},
		'columns': [
		 	{ "data": "checkbox" },
		  	{ "data": "id" },
			{ "data": "category_id" },
            { "data": "title" },
			{ "data": "sort_order" },
			{ "data": "status" },
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
<!-- End: team List -->



<!-- Start: team  delete  -->
$(document).on("click",".blog_delete_onclick", function ()
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
						  data: "method=blog&actionType=blogDelete&getid="+getid,
						  success: function(responseData)
						  {
								  if(responseData.RESULT==0)
								  {
									var oTable = $('#table_blog').dataTable( );
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
<!-- End: team single delete  -->

<!-- Start: team Multi delete  -->
function mulitple_blog_select()
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
							  data: "method=blog&actionType=blogMultiDelete&ids="+ids,
							  success: function(responseData){
								  if(responseData.RESULT==0)
								  {
									  $.bootstrapGrowl('<h4><strong>Notification</strong></h4> <p>'+responseData.msg+'</p>', {type:'success',delay: 3000,allow_dismiss: true,offset: {from: 'top', amount: 20}});
								  }
								  else
								  {
									  $.bootstrapGrowl('<h4><strong>Notification</strong></h4> <p>'+responseData.msg+'</p>', {type:'danger',delay: 3000,allow_dismiss: true,offset: {from: 'top', amount: 20}});
								  }
								  var oTable = $('#table_blog').dataTable( );
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
<!-- End: team Multi delete  -->

