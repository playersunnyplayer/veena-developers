
$(document).ready(function () {
    $("#SidebarEnquiryForm").validate({

    	rules: {
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
				required: true
			},
			captcha: {
				required: true,
				number: true,
				//minlength: 5
				equalTo : '[name="hidTotal"]'
			},
			project: "required",
			visit_date: "required",
			visit_time: "required",
			location: "required"
		},
		messages: {
			name: {
				required: "Invalid name",
				minlength: "Invalid name"
			},
			email: {
				required: "Invalid email",
				email: "Invalid email"
			},
			mobile: {
				required: "Invalid mobile number",
				number: "Invalid mobile number",
				minlength: "Invalid mobile number",
				maxlength: "Invalid mobile number"
			},
			message: {
				required: "Invalid message"
			},
			captcha: {
				required: "Invalid captcha code",
				number: "Your captcha code. must be numeric value",
				//minlength: "Your captcha code. must be atleast 5 characters"
				equalTo : "Your captcha code. not matched"
			},
			project: "Please select project",
			visit_date: "Please select date",
			visit_time: "Please enter time",
			location: "Please select location"
		}


        /*submitHandler : function () {
            // your function if, validate is success
            $.ajax({
                type : "POST",
                url : "sendmail.php",
                data : $('#SidebarEnquiryForm').serialize(),
                success : function (response) {
                	
					if (response == 1)
					{
						
						/*document.getElementById("alert_message_head").style.display = "";
						document.getElementById("alert_message_head").innerHTML = "<center ><img src='images/thankyou.png'><br><div style='padding:5px; margin-top:50px;  background:#3B6800; color:#fff;'>Thank You For Submitting Enquiry Form. We Will Get Back To You Soon !!!</div></center>";
						document.getElementById("SidebarEnquiryForm").style.display= "none";*/
					//	window.location.href = '../thank-you'
					//}else if(response == 2){

						//$('#alert_message_head').hide();
					//	document.getElementById("alert_message_head").innerHTML = "<center ><br><div style='padding:5px; margin-top:1px;  background:#f00; color:#fff;'>Error: Please enter valid captcha code.. !!! </div> <br><br></center>";
						//$('#SidebarEnquiryForm').hide();
				//	}else{
				//		document.getElementById("alert_message_head").innerHTML = "<center ><br><div style='padding:5px; margin-top:1px;  background:#f00; color:#fff;'>Error: Mail Not sent Please resend !!! </div> <br><br></center>";
				//	}
            //    }
        //    });
        //}*/
    });
});

$(document).ready(function () {
    $("#ProjectContactForm").validate({

    	rules: {
			name: {
				required: true,
				minlength: 2
			},
			email: {
				required: true,
				email: true
			},
			phone: {
				required: true,
				number: true,
				minlength: 10,
				maxlength: 10
			},
		
			captcha: {
				required: true,
				number: true
			},
			budget: "required",
			nationality: "required"
		},
		messages: {
			name: {
				required: "Invalid name",
				minlength: "Invalid name"
			},
			email: {
				required: "Invalid email",
				email: "Invalid email"
			},
			phone: {
				required: "Invalid mobile number",
				number: "Invalid mobile number",
				minlength: "Invalid mobile number",
				maxlength: "Invalid mobile number"
			},
			message: {
				required: "Invalid message"
			},
		
			captcha: {
				required: "Please validate captcha"
			},
			budget: "Please select budget",
			nationality: "Please select nationality"
		}


        /*submitHandler : function () {
            // your function if, validate is success
            
            $.ajax({
                type : "POST",
                url : "https://veenaapi.nltx.in/api/v1/lead/register/",
                data : $('#ProjectContactForm').serialize(),
                headers: {"Authorization": "Token 764e235a22fb38fb278d32e001f4a860fe2117cf"},
                success : function (response) {
                //	alert(response);return;
                  // $('#alert_message').html(response);
                  // $('#ProjectContactForm').hide();
					if (response.success)
					{
					    
					    var loc = window.location.pathname;
					    
                        loc.match( 'veena-crest|veenaserenity');
                        
                        var currentPage = ( loc.match( 'veena-crest|veenaserenity') )[0];
                        
					    window.location.href = 'https://veenadevelopers.com/thank-you?ref=' + currentPage;
						
					}else if(response == 2){

						//$('#alert_message').hide();
						document.getElementById("alert_message").innerHTML = "<center ><br><div style='padding:5px; margin-top:50px;  background:#f00; color:#fff;'>Error: Please enter valid captcha code.. !!! </div> <br><br></center>";
						//$('#ProjectContactForm').hide();
					}else{
						
						document.getElementById("alert_message").innerHTML = "<center ><br><div style='padding:5px; margin-top:50px;  background:#f00; color:#fff;'>Error: Mail Not sent Please resend !!! </div> <br><br></center>";
					}
                }
            });
        }*/
    });
});

$(document).ready(function () {
    $("#ContactForm").validate({
    	rules: {
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
			},
		},
		messages: {
			name: {
				required: "Invalid name",
				minlength: "Invalid name"
			},
			email: {
				required: "Invalid email",
				email: "Invalid email"
			},
			mobile: {
				required: "Invalid mobile number",
				number: "Invalid mobile number",
				minlength: "Invalid mobile number",
				maxlength: "Invalid mobile number"
			},
			message: {
				required: "Invalid message"
			},
		}
        /*submitHandler : function () {
            // your function if, validate is success
            $.ajax({
                type : "POST",
                url : "sendmail.php",
                data : $('#ContactForm').serialize(),
                success : function (response) {
                	//alert(response);
                  // $('#alert_message').html(response);
                  // $('#ContactForm').hide();
                  console.log(response);
                  return false;
                  /*
					if (response == 1)
					{
						//document.getElementById("alert_message").style.display = "";
						//document.getElementById("alert_message").innerHTML = "<center ><img src='images/thankyou.png'><br><div style='padding:5px; margin-top:50px;  background:#3B6800; color:#fff;'>Thank You For Submitting Enquiry Form. We Will Get Back To You Soon !!!</div></center>";
						//document.getElementById("ContactForm").style.display= "none";
						
						window.location.href = '../thank-you'
					}else if(response == 2){

						//$('#alert_message').hide();
						document.getElementById("alert_message").innerHTML = "<center ><br><div style='padding:5px; margin-top:10px;  background:#f00; color:#fff;'>Error: Please enter valid captcha code.. !!! </div> <br><br></center>";
						//$('#ContactForm').hide();
					}else{
						document.getElementById("alert_message").innerHTML = "<center ><br><div style='padding:5px; margin-top:10px;  background:#f00; color:#fff;'>Error: Mail Not sent Please resend !!! </div> <br><br></center>";
					}
					*/
               // }
           // });
            //return false;
        //}
    });
});


$(document).ready(function () {
    $("#EnquiryForm").validate({

ignore: ".ignore",
    	rules: {
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
				required: true
			},
			hiddenRecaptcha: {
                required: function () {
                    if (grecaptcha.getResponse() === '') {
                        return true;
                    } else {
                        return false;
                    }
                }
            },
			select_box: "required"
		},
		messages: {
			name: {
				required: "Invalid name",
				minlength: "Invalid name"
			},
			email: {
				required: "Invalid email",
				email: "Invalid email"
			},
			mobile: {
				required: "Invalid mobile number",
				number: "Invalid mobile number",
				minlength: "Invalid mobile number",
				maxlength: "Invalid mobile number"
			},
			message: {
				required: "Invalid message"
			},
		hiddenRecaptcha:{
			    required: "Please validate captcha",
			},
			select_box: "Please select"
		},


        submitHandler : function () {
            // your function if, validate is success
            $.ajax({
                type : "POST",
                url : "sendmail.php",
                data : $('#EnquiryForm').serialize(),
                success : function (response) {
                	
					if (response == 1)
					{
						
					/*	document.getElementById("alert_message_foot").style.display = "";
						document.getElementById("alert_message_foot").innerHTML = "<center ><img src='images/thankyou.png'><br><div style='padding:5px; margin-top:50px;  background:#3B6800; color:#fff;'>Thank You For Submitting Enquiry Form. We Will Get Back To You Soon !!!</div></center>";
						document.getElementById("EnquiryForm").style.display= "none";*/
						window.location.href = '../thank-you'
					}else if(response == 2){

						//$('#alert_message_foot').hide();
						document.getElementById("alert_message_foot").innerHTML = "<center ><br><div style='padding:5px; margin-top:1px;  background:#f00; color:#fff;'>Error: Please enter valid captcha code.. !!! </div> <br><br></center>";
						//$('#EnquiryForm').hide();
					}else{
						document.getElementById("alert_message_foot").innerHTML = "<center ><br><div style='padding:5px; margin-top:1px;  background:#f00; color:#fff;'>Error: Mail Not sent Please resend !!! </div> <br><br></center>";
					}
                }
            });
        }
    });
});



$(document).ready(function () {
  
    $("#CareerForm").validate({

    	rules: {
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
				required: true
			},
			
			
			project: "required",
			visit_date: "required",
			visit_time: "required",
			location: "required"
		},
		messages: {
			name: {
				required: "Invalid name",
				minlength: "Invalid name"
			},
			email: {
				required: "Invalid email",
				email: "Invalid email"
			},
			mobile: {
				required: "Invalid mobile number",
				number: "Invalid mobile number",
				minlength: "Invalid mobile number",
				maxlength: "Invalid mobile number"
			},
			message: {
				required: "Invalid message"
			},
			
			project: "Please select project",
			visit_date: "Please select date",
			visit_time: "Please enter time",
			location: "Please select location"
		},


        submitHandler : function () {
            // your function if, validate is success
            $.ajax({
                type : "POST",
                url : "../sendcareermail.php",
                data : $('#CareerForm').serialize(),
                success : function (response) {
                	
					if (response == 1)
					{
						
					/*	document.getElementById("alert_message").style.display = "";
						document.getElementById("alert_message").innerHTML = "<center ><img src='images/thankyou.png'><br><div style='padding:5px; margin-top:50px;  background:#3B6800; color:#fff;'>Thank You For Submitting Enquiry Form. We Will Get Back To You Soon !!!</div></center>";
						document.getElementById("CareerForm").style.display= "none";*/
						window.location.href = '../thank-you'
					}else if(response == 2){

						//$('#alert_message').hide();
						document.getElementById("alert_message").innerHTML = "<center ><br><div style='padding:5px; margin-top:1px;  background:#f00; color:#fff;'>Error: Please enter valid captcha code.. !!! </div> <br><br></center>";
						//$('#CareerForm').hide();
					}else{
						document.getElementById("alert_message").innerHTML = "<center ><br><div style='padding:5px; margin-top:1px;  background:#f00; color:#fff;'>Error: Mail Not sent Please resend !!! </div> <br><br></center>";
					}
                }
            });
        }
    });
});

$(document).ready(function () {
    $("#PartnerForm").validate({

    	rules: {
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
				minlength: 10
			},
			message: {
				required: true
			},
			captcha: {
				required: true,
				number: true,
				minlength: 5
			},
			
			project: "required",
			visit_date: "required",
			visit_time: "required",
			location: "required"
		},
		messages: {
			name: {
				required: "Invalid name",
				minlength: "Invalid name"
			},
			email: {
				required: "Invalid email",
				email: "Invalid email"
			},
			mobile: {
				required: "Invalid mobile number",
				number: "Invalid mobile number",
				minlength: "Invalid mobile number"
			},
			message: {
				required: "Invalid message"
			},
			captcha: {
				required: "Invalid captcha code",
				number: "Your captcha code. must be numeric value",
				minlength: "Your captcha code. must be atleast 5 characters"
			},
		
			project: "Please select project",
			visit_date: "Please select date",
			visit_time: "Please enter time",
			location: "Please select location"
		},


        submitHandler : function () {
            // your function if, validate is success
            $.ajax({
                type : "POST",
                url : "sendmail.php",
                data : $('#PartnerForm').serialize(),
                success : function (response) {
                	
					if (response == 1)
					{
						
					/*	document.getElementById("alert_message").style.display = "";
						document.getElementById("alert_message").innerHTML = "<center ><img src='images/thankyou.png'><br><div style='padding:5px; margin-top:50px;  background:#3B6800; color:#fff;'>Thank You For Submitting Enquiry Form. We Will Get Back To You Soon !!!</div></center>";
						document.getElementById("PartnerForm").style.display= "none";*/
                        window.location.href = '../thank-you'
					}else if(response == 2){

						//$('#alert_message').hide();
						document.getElementById("alert_message").innerHTML = "<center ><br><div style='padding:5px; margin-top:1px;  background:#f00; color:#fff;'>Error: Please enter valid captcha code.. !!! </div> <br><br></center>";
						//$('#PartnerForm').hide();
					}else{
						document.getElementById("alert_message").innerHTML = "<center ><br><div style='padding:5px; margin-top:1px;  background:#f00; color:#fff;'>Error: Mail Not sent Please resend !!! </div> <br><br></center>";
					}
                }
            });
        }
    });
});




$(document).ready(function () {
    $(".DownloadForm").validate({
     
    	rules: {
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
			
		},
		messages: {
			name: {
				required: "Invalid name",
				minlength: "Invalid name"
			},
			email: {
				required: "Invalid email",
				email: "Invalid email"
			},
			mobile: {
				required: "Invalid mobile number",
				number: "Invalid mobile number",
				minlength: "Invalid mobile number",
				maxlength: "Invalid mobile number"
			},
			
		}
    });
});