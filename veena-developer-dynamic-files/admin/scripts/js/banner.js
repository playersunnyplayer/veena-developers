<!-- Start: Active Banner List  -->

$(document).ready(function(){

	$('#table_banner').DataTable({

		"order": [[ 1, "desc" ]],

		"columnDefs": [ { 'targets': [0,1,2,5],"orderable": false } ],

  		'autoWidth':false,

		'processing': true,

		'serverSide': true,

		'serverMethod': 'post',

		'ajax': {

			'url':'scripts/ajax/index.php?method=banner&actionType=banner_list',

		},

		'columns': [

		 	{ "data": "checkbox" },

				

		  	{ "data": "id" },

            { "data": "image" },

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

	
	 $('body').tooltip({selector: '[data-toggle="tooltip"]'});

});

<!-- End: Active banner List -->





<!-- Start: Active banner addedit modal-->

$(document).on("click",".banner_addedit_onclick", function ()

{

	getId=$(this).data("id");

	$('#custom_ajax_preloader').show();

	$.ajax({

	type: 'POST',

	url: 'scripts/modal/index.php?method=banner_addedit&id='+getId,

	dataType : 'html',

	data: $(this).serialize()

	})

	.done(function(data)

	{

		// show the response

		$('#ajax_modal_container').html(data);

		$('#modal_banner_addedit').modal('show');

		$('#custom_ajax_preloader').hide();

		

		$('#banner_form').parsley();

		$.getScript("scripts/js/ajax.js");

		

	})

	.fail(function()

	{

		// just in case posting your form failed

		alert( "Try again." );

		$('#custom_ajax_preloader').hide();

	});

});

<!-- End: Active banner addedit modal -->



<!-- Start: modal banner addedit submit  -->

$(document).on("click",".banner_modal_submit", function ()

{

    $('#banner_form').validate({

		rules:

		{

			banner: {

					required: true,

					minlength:5,

					maxlength:5

			},

		},

		submitHandler: function (form)

		{

			$('.banner_modal_submit').html('<span class="spinner-border spinner-border-sm mg-r-5" role="status" aria-hidden="true"></span> Loading...');

			$(".banner_modal_submit").attr("disabled", true);

			var dataString = new FormData(form);

			dataString.append('method', 'banner');

			dataString.append('actionType', 'bannerAddEdit');

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

					$('.banner_modal_submit').html('Submit');

					$(".banner_modal_submit").attr("disabled", false);

				

				  if(responseData.RESULT==1)

				  {

							$.bootstrapGrowl('<h4><strong>Notification</strong></h4> <p>'+responseData.msg+'</p>', {type:'danger',delay: 3000,allow_dismiss: true,offset: {from: 'top', amount: 20} });

				  }

				  else  if(responseData.RESULT==0)

				  {

							$.bootstrapGrowl('<h4><strong>Notification</strong></h4> <p>'+responseData.msg+'</p>', {type:'success',delay: 3000,allow_dismiss: true,offset: {from: 'top', amount: 20} });

							$('#modal_banner_addedit').modal('hide');

							var oTable = $('#table_banner').dataTable( );

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

<!-- End: modal banner addedit submit -->



<!-- Start: banner single delete  -->

$(document).on("click",".banner_delete_onclick", function ()

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

						  data: "method=banner&actionType=bannerDelete&getid="+getid,

						  success: function(responseData)

						  {

								  if(responseData.RESULT==0)

								  {

									var oTable = $('#table_banner').dataTable( );

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

<!-- End: banner single delete  -->



<!-- Start: banner Multi delete  -->

function mulitple_banner_select()

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

							  data: "method=banner&actionType=bannerMultiDelete&ids="+ids,

							  success: function(responseData){

								  if(responseData.RESULT==0)

								  {

									  $.bootstrapGrowl('<h4><strong>Notification</strong></h4> <p>'+responseData.msg+'</p>', {type:'success',delay: 3000,allow_dismiss: true,offset: {from: 'top', amount: 20}});

								  }

								  else

								  {

									  $.bootstrapGrowl('<h4><strong>Notification</strong></h4> <p>'+responseData.msg+'</p>', {type:'danger',delay: 3000,allow_dismiss: true,offset: {from: 'top', amount: 20}});

								  }

								  var oTable = $('#table_banner').dataTable( );

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

<!-- End: banner Multi delete  -->



