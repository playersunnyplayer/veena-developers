


	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
		integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

	<link rel="stylesheet" href="css/about-us.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
	<!-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
	<link rel="stylesheet" href="css/menu.css" />
	<link rel="stylesheet" href="css/style.css" />




	
      <?php include'includes/header1.php';?>

	<section class="breadcrumbSec">
		<div class="container">
			<div class="row">
				<div class="breadcrumbHeading">Thank you</div>

				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.html">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Thank you</li>
					</ol>
				</nav>
			</div>
		</div>
	</section>

	<section class="thankyouSec">
		<img src="images/thankyou.gif" alt="" style="margin: 0 auto;display: inherit;">
		<h3>Thank you</h3>
		<p>Thankyou for contacting us. We will get back to you soon.</p>
		<p><a href="index.html" class="btn btn-primary">Back to home page</a></p>
	</section>

	<!-- disclaimer Model -->
	<div class="modal fade" id="disclaimerModel" tabindex="-1" role="dialog" aria-labelledby="disclaimerModelLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<h3><span class="blueText">Disclaimer</span> <img src="images/close-icon.svg" data-dismiss="modal"
						aria-label="Close" alt=""></h3>
				<div class="modal-body">
					<p>This disclaimer ("disclaimer") will be applicable whoever further navigate through to the website
						www.veenadevelopers.com and such other links to other website. By using or accessing the website
						you agree with the disclaimer without any qualification or limitation. <br>
						<br>
						The websites and all its content are provided with all faults on an "as is" and "as available"
						basis. No information given under this website creates a warranty or expand the scope of any
						warranty that cannot be disclaimed under applicable law. Your use of the website is solely at
						your own risk. This website is for guidance only. It does not constitute part of an offer or
						contract. Design &amp; specifications are subject to change without prior notice. Computer
						generated images are the artist's impression and are an indicative of the actual designs. The
						company reserves the right to add, alter or delete material from the website at any time and
						may, at any time, revise these terms without notifying you. You are bound by any such amendments
						and the company therefore advise that you periodically visit this page to review the current
						terms. <br>
						<br>
						All information (including but not limited to, project/ apartments/flats, amenities,
						presentations brochures etc.) On the website is provided as convenience to you and accordingly
						may not be fully in line thereof as of date so you are therefore required to verify all the
						details, including area, amenities, services, terms of sales and payments and other relevant
						terms independently with the sales team/ company prior to concluding any decision for buying any
						unit(s) in any of the said projects. Till such time the details are fully updated, the said
						information will not be construed as an advertisement. To find out more about a project /
						development, please telephone our sales centres or visit our sales office during opening hours
						and speak to one of our sales staff. <br>
						<br>
						All information under "buyers guide" tab is of a general nature, for informational purposes
						only, and is not to be relied upon or construed as real estate, legal, accounting or other
						professional advice or a substitute therefore. You should not use any information contained on
						the website as a substitute for consultation with legal or accounting professionals or other
						professional advisors. You should not act or abstain from acting based upon information obtained
						from the website without first consulting appropriate professional advisors. Since all real
						estate transactions are unique, diligence and prudence are essential. <br>
						<br>
						In no event will the company be liable for claim made by the users including seeking any
						cancellation for any of the inaccuracies in the information provided in this website, though all
						efforts have been made to ensure accuracy. The company will no circumstance will be liable for
						any expense, loss or damage including, without limitation, indirect or consequential loss or
						damage, or any expense, loss or damage whatsoever arising from use, or loss of use, of data,
						arising out of or in connection with the use of this website.
					</p>

				</div>
			</div>
		</div>
	</div>
	
   
        <?php include'includes/footer.php';?>
    
    <script>
    setTimeout(function() {
        $("#veenaloader").fadeOut();
    }, 2000);
    </script> 

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<!-- <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"
		integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
		crossorigin="anonymous"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
		integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
		crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
		integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
		crossorigin="anonymous"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
	<script src="js/script.js"></script>

	<script>
		var horizontalAccordions = $(".accordion.width");

		horizontalAccordions.each(function () {
			var accordion = $(this);
			var collapse = accordion.find(".collapse");
			var bodies = collapse.find("> *");
			accordion.height(accordion.height());
			bodies.width(bodies.eq(0).width());
			collapse.not(".show").each(function () {
				$(this)
					.parent()
					.find("[data-toggle='collapse']")
					.addClass("collapsed");
			});
		});

		//FUNCTION AUTO-CLICK
		// var $ = jQuery.noConflict();
		var i = 2; // premier switch vers image 2

		function switchImage() {
			$(".current").removeAttr("checked");
			$(".current").removeClass("current");

			$("#select-img-" + i).addClass("current");
			$("#select-img-" + i).attr("checked", true);

			if (i == 4) {
				i = 1; // retour au debut sur image 1
			} else {
				i++; // image suivante
			}
		}

		$(document).ready(function () {
			$('[data-toggle="tooltip"]').tooltip()
			//on lance l"annimation en boucle toute les 5 secondes (5000 miliseconde)
			setInterval("switchImage();", 2000);
		});

		$("#testimonial-carousel").owlCarousel({
			loop: true,
			margin: 10,
			dots: true,
			nav: false,
			responsive: {
				0: {
					items: 1,
				},
				600: {
					items: 3,
				},
				1000: {
					items: 2.2,
				},
			},
		});
		$("#residential-carousel , #commercial-carousel").owlCarousel({
			loop: true,
			margin: 50,
			dots: false,
			nav: true,
			responsive: {
				0: {
					items: 1,
				},
				600: {
					items: 3,
				},
				1000: {
					items: 2.5,
				},
			},
		});
	</script>

<script language='JavaScript' type='text/javascript'>
    function refreshCaptcha() {
        var img = document.images['captchaimg'];
        img.src = img.src.substring(0, img.src.lastIndexOf("?")) + "?rand=" + Math.random() * 1000;
    }
    </script> 

<script src="js/form_validator.js"></script> 
<script src="js/sideform.js"></script> 
<script src="js/function.js"></script> 


    <script src="js/jquery.validate.js"></script> 
<script src="js/veena.js"></script> 

