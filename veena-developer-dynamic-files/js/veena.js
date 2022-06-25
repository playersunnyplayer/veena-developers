
	$("input.numbers").keypress(function(event) {

	return /\d/.test(String.fromCharCode(event.keyCode));

});
	
	
	$(document).on("click",".careerApplyClick", function ()
{
	
	$('.careerMsg').html('');
	$(".careerBtns").attr("disabled", false);
	getId=$(this).data("id");
	getTitle=$(this).data("title");
	
	
	$('#jobId').val(getId);
	$('#jobTitle').val(getTitle);
	
	
	$('#careerModel').modal('show');
});

$(document).ready(function () 
{
    $('#CareerForm').validate({
		rules: {
        userzip: {
            required: true, 
			minlength: 5,
			maxlength: 5   
        },
	},

	submitHandler: function (form)
	{
		$('.careerMsg').html('');
		
		$(".careerBtns").attr("disabled", true);
			
			
			//var dataString ='method=CareerForm&'+$('#CareerForm').serialize();
			
			
			
			var dataString = new FormData(form);
			dataString.append('method', 'CareerForm');
			
			
			

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
					
						$(".careerBtns").attr("disabled", false);
						if(responseData.RESULT==0)
						{
							//window.location.href = 'index.html';
							
							//location.reload();
							
							$('.careerMsg').html('<p class="blueText">Thank you, our team will contact you soon.</p>');
							
							$("#name").val('');
							$("#email").val('');
							$("#phone").val('');
							
						}
						else
						{
							
							$('.careerMsg').html('<p class="redText">'+responseData.MSG+'</p>');
							
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


$(document).ready(function () {

    $('#ContactForm1').validate({
        rules:
        {
            name: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true
            },
            mobile: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10
            },
            message: {
                required: true,
            }
        },
        submitHandler: function (form)
        {
            
			
			
			$("#WrongCaptchaError").html('');
			
			$(".ContactMsg").html('');
			
			
			
			var Total_data=parseInt($("#fno").val())+parseInt($("#sno").val());
			
			var captcha=parseInt($("#UserCaptchaCode").val());
			
			
			
			
			
		 /* var result = ValidateCaptcha();
		  if( $("#UserCaptchaCode").val() == "" || $("#UserCaptchaCode").val() == null || $("#UserCaptchaCode").val() == "undefined") {
			  
			  
			  
			$('#WrongCaptchaError').text('Please Enter Code Given Below In a Picture.').show();
			$('#UserCaptchaCode').focus();
			
			return false;
			
			
		  } else {
			if(result == false) { 
			  IsAllowed = false;
			  $('#WrongCaptchaError').text('Invalid Captcha! Please Try Again.').show();
			 // CreateCaptcha();
			  $('#UserCaptchaCode').focus().select();
			  
			  return false;
			}
			else { 
			  
			  
			}
		  } 
		  */
		  
		  
		  
		   if(Total_data!=captcha) 
		   {
			  
			  
			  
			$('#WrongCaptchaError').text('Invalid Captcha! Please Try Again.').show();
			$('#UserCaptchaCode').focus();
			
			return false;
			
			
		  }
		  
		  


			
			$('#apifootersubmit').html('Loading...');
            $("#apifootersubmit").attr("disabled", true);
			

            var dataString = new FormData(form);
            dataString.append('method', 'contact_enquiry');
            $.ajax({
                dataType: 'html',
                type: "POST",
                url: "scripts/ajax/index.php",
                data: dataString,
                cache:false,
                contentType: false,
                processData: false,
                success: function (responseData)
                {
                    $('#apifootersubmit').html('Submit');
                    $("#apifootersubmit").attr("disabled", false);
                  if(responseData==1)
                  {
					  $('.ContactMsg').html('<p class="whileText">Try again!</p>');

                  }
                  else  if(responseData==0)
                  {
					  
					  window.location.href = 'thankyou.html';
					// $('.ContactMsg').html('<p class="whileText">Thank you.</p>');

                  }
				  
                },
                error: function (responseData)
                {
                    console.log('Ajax request not recieved!');
                }
            });
            return false;
        }
    });
});


	$(document).on("click",".projectApplyClick", function ()
{
	
	$('.projectsMsg').html('');
	$(".projectsBtns").attr("disabled", false);
	getId=$(this).data("id");
	getType=$(this).data("type");
	getTitle=$(this).data("title");
	
	
	$('#data_id').val(getId);
	$('#data_type').val(getType);
	$('#data_value').val(getTitle);
	
	
	$('#exampleModal').modal('show');
});




$(document).ready(function () 
{
    $('#ProjectContactForm').validate({
		rules: {
        userzip: {
            required: true, 
			minlength: 5,
			maxlength: 5   
        },
	},

	submitHandler: function (form)
	{
		$('.projectsMsg').html('');
		
		$(".projectsBtns").attr("disabled", true);
			
			
			var dataString ='method=ProjectForm&'+$('#ProjectContactForm').serialize();

			$.ajax({
			    dataType: 'json',
                type: "POST",
				url: "scripts/ajax/index.php",
				data: dataString,
                success: function (responseData) 
				{
					
						$(".projectsBtns").attr("disabled", false);
						if(responseData.RESULT==0)
						{
							//window.location.href = 'index.html';
							
							//location.reload();
							
							$('.projectsMsg').html('<p class="blueText">Thank you</p>');
							
							$("#name").val('');
							$("#email").val('');
							$("#phone").val('');
							
							
							var data_type=$("#data_type").val();
							var data_id=$("#data_id").val();
							
							if(data_type=='Download')
							{
								var files=$("#b_file_"+data_id).val();
								
								
								
								
								
								var filename="https://www.veenadevelopers.com/uploads/project/"+files;
								
								
								var element = document.createElement('a');
								   element.setAttribute('href', filename);								  
								  element.setAttribute('download', files);								
								  element.style.display = 'none';
								  document.body.appendChild(element);								
								  element.click();								
								  document.body.removeChild(element);
								  
								  
								  
								  
								  
								  
								  
								
							}
							
						}
						else
						{
							
							$('.projectsMsg').html('<p class="redText">Try again!</p>');
							
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


