<!-- Start: Active projects_gallery List  -->

$(document).ready(function(){
	
	
	
	
	
	
	
	var project_id=$("#project_id").val();

	$('#table_projects_gallery').DataTable({

		"order": [[ 1, "desc" ]],

		"columnDefs": [ { 'targets': [0,1,7],"orderable": false } ],

  		'autoWidth':false,

		'processing': true,

		'serverSide': true,

		'serverMethod': 'post',

		'ajax': {

			'url':'scripts/ajax/index.php?method=projects_gallery&actionType=projects_gallery_list&project_id='+project_id,

		},

		'columns': [

		 	{ "data": "checkbox" },

				

		  	{ "data": "id" },

            { "data": "image" },
			 { "data": "title" },
			  { "data": "projects_gallery_category_id" },

            { "data": "sort_id" },

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

	$('[data-toggle="tooltip"]').tooltip();

});

<!-- End: Active projects_gallery List -->





<!-- Start: Active projects_gallery addedit modal-->

$(document).on("click",".projects_gallery_addedit_onclick", function ()

{

	getId=$(this).data("id");
	
	var project_id=$("#project_id").val();

	$('#custom_ajax_preloader').show();

	$.ajax({

	type: 'POST',

	url: 'scripts/modal/index.php?method=projects_gallery_addedit&id='+getId+'&project_id='+project_id,

	dataType : 'html',

	data: $(this).serialize()

	})

	.done(function(data)

	{

		// show the response

		$('#ajax_modal_container').html(data);

		$('#modal_projects_gallery_addedit').modal('show');

		$('#custom_ajax_preloader').hide();

		

		$('#projects_gallery_form').parsley();

		$.getScript("scripts/js/ajax.js");

		

	})

	.fail(function()

	{

		// just in case posting your form failed

		alert( "Try again." );

		$('#custom_ajax_preloader').hide();

	});

});

<!-- End: Active projects_gallery addedit modal -->



<!-- Start: modal projects_gallery addedit submit  -->

$(document).on("click",".projects_gallery_modal_submit", function ()

{

    $('#projects_gallery_form').validate({

		rules:

		{

			projects_gallery: {

					required: true,

					minlength:5,

					maxlength:5

			},

		},

		submitHandler: function (form)

		{

			$('.projects_gallery_modal_submit').html('<span class="spinner-border spinner-border-sm mg-r-5" role="status" aria-hidden="true"></span> Loading...');

			$(".projects_gallery_modal_submit").attr("disabled", true);

			var dataString = new FormData(form);

			dataString.append('method', 'projects_gallery');

			dataString.append('actionType', 'projects_galleryAddEdit');

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

					$('.projects_gallery_modal_submit').html('Submit');

					$(".projects_gallery_modal_submit").attr("disabled", false);

				

				  if(responseData.RESULT==1)

				  {

							$.bootstrapGrowl('<h4><strong>Notification</strong></h4> <p>'+responseData.msg+'</p>', {type:'danger',delay: 3000,allow_dismiss: true,offset: {from: 'top', amount: 20} });

				  }

				  else  if(responseData.RESULT==0)

				  {

							$.bootstrapGrowl('<h4><strong>Notification</strong></h4> <p>'+responseData.msg+'</p>', {type:'success',delay: 3000,allow_dismiss: true,offset: {from: 'top', amount: 20} });

							$('#modal_projects_gallery_addedit').modal('hide');

							var oTable = $('#table_projects_gallery').dataTable( );

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

<!-- End: modal projects_gallery addedit submit -->



<!-- Start: projects_gallery single delete  -->

$(document).on("click",".projects_gallery_delete_onclick", function ()

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

						  data: "method=projects_gallery&actionType=projects_galleryDelete&getid="+getid,

						  success: function(responseData)

						  {

								  if(responseData.RESULT==0)

								  {

									var oTable = $('#table_projects_gallery').dataTable( );

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

<!-- End: projects_gallery single delete  -->



<!-- Start: projects_gallery Multi delete  -->

function mulitple_projects_gallery_select()

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

							  data: "method=projects_gallery&actionType=projects_galleryMultiDelete&ids="+ids,

							  success: function(responseData){

								  if(responseData.RESULT==0)

								  {

									  $.bootstrapGrowl('<h4><strong>Notification</strong></h4> <p>'+responseData.msg+'</p>', {type:'success',delay: 3000,allow_dismiss: true,offset: {from: 'top', amount: 20}});

								  }

								  else

								  {

									  $.bootstrapGrowl('<h4><strong>Notification</strong></h4> <p>'+responseData.msg+'</p>', {type:'danger',delay: 3000,allow_dismiss: true,offset: {from: 'top', amount: 20}});

								  }

								  var oTable = $('#table_projects_gallery').dataTable( );

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

<!-- End: projects_gallery Multi delete  -->



