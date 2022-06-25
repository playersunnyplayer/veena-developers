<!DOCTYPE html>
<html lang="en">

<head>
	<title>Veena Developer Palghar - Mhada Lottery 2020</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" charset=utf-8 />

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
	<!-- Global site tag (gtag.js) - Google Analytics --><script async src="https://www.googletagmanager.com/gtag/js?id=UA-138366461-2"></script><script>  window.dataLayer = window.dataLayer || [];  function gtag(){dataLayer.push(arguments);}  gtag('js', new Date());  gtag('config', 'UA-138366461-2');</script><!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '541000763358853');
fbq('track', 'PageView');
</script>

<!-- Global site tag (gtag.js) - Google Analytics - Inspium -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-157771085-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-157771085-1');
</script>
	 <style type="text/css">
       .error1 {color: #FF0000;}
	   
	   .validate{
	        border:1px solid red !important;
	    }
	    .error{
	        background:red;
            color:white;
            padding: 3px 4px;
            font-size: 11px;
	    }
	</style>
</head>

<body>
	<header>
		<div class="topHeader">
			<ul class="container">
				<li><i class="fa fa-language"></i></li>
				<li><a href="hindi.php">Hindi</a></li>
				<li><a href="index.php" class="active">English</a></li>
				<li><a href="marathi.php">Marathi</a></li>
			</ul>
		</div>

		<div class="headerContainer">
			<div class="container">
				<div class="row">
					<figure class="mahada-logo col-xs-4">
						<img src="images/mahada-logo.jpg" alt="">
					</figure>
					<figure class="veena-samrajya-logo col-xs-4">
						<img src="images/veena-samrajya-logo.png" alt="">
					</figure>
					<figure class="ps-logo col-xs-4">
						<img src="images/ps-logo.png" alt="">
					</figure>
				</div>
			</div>
		</div>
	</header>

	<section class="pageWrap">
		<div class="container">
			<ul class="bulletPoints">
				<li>1 RK / 1 BHK Near Palghar(West) Near Station</li>
				<li><i class="fa fa-rupee"></i> 2.50 Lakhs Subsidy Under PMAY</li>
				<li>MHADA Lottery Scheme</li>
				<!--<li>RERA NO P99000021726</li>-->
			</ul>

			<section class="mainForm">
				<h2>Are You Interested !!</h2>
				<form action="sendmail.php" method="post" class="d-form" id="quickForm">
					<div class="form-group">
						<label for="name">Name:</label><span class = "error1">* </span>
						<input type="text" class="form-control" id="name" placeholder="Enter your name" name="name">
					</div>
					<div class="form-group">
						<label for="phone">Mobile:</label><span class = "error1">* <?php echo $mobileErr;?></span>
						<input type="text" class="form-control" id="phone" placeholder="Enter your mobile number"
							name="mobile">
							
					</div>
					<!--<div class="form-group">-->
					<!--	<label for="email">Email:</label>-->
						<!--<span class = "error1">* <?php echo $emailErr;?></span>-->
					<!--	<input type="text" class="form-control" id="email" placeholder="Enter email" name="email">-->
						
					<!--</div>-->
					<div class="form-group">
						<label for="Interested">Interested:</label>
						<div class="radio">
							<label>
								<input type="radio" name="optradio" value="1RK" checked>
								1 RK
							</label>
							
							<label>
								<input type="radio" value="1BHK"  name="optradio">
								1 BHK
							</label>
							
							<label>
								<input type="radio" value="Not Interested"  name="optradio">
								Not Interested
							</label>
						</div>
					</div>

					<button type="submit" name="submit" class="btn btn-default" id="">Submit</button>
					
				</form>
			</section>
		</div>
	</section>

	<footer>
		<a href="tel:8970407040" class="dialBtn">Call for Enquiry <span>@ 8970407040</span></a>
		
		<div class="disclaimer">Disclaimer: Veena Samrajya is registered under <img class="mahareraLogoSmall" src="images/mahada-logo-small.jpg" /> MahaRERA Registration No: P99000021726 | Available at website: <a href="http://maharera.mahaonline.gov.in">http://maharera.mahaonline.gov.in</a> | Project is under Public Private Partnership Model between Veena Developers & MHADA</div>
	</footer>

	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>

</html>

<script>
    $(document).ready(function(){
        $(".d-form").submit(function(e){
            
            var mobile = $("input[name='mobile']");
            var email = $("input[name='email']");
            var name = $("input[name='name']");
            
            var mob_v = /^[1-9]{1}[0-9]{9}$/;
            var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            
            $("input").removeClass('validate');
            $(".error").remove();
            var error = true;
            if(mobile.val() == ""){
                error = false;
                mobile.addClass('validate');
                mobile.parent().append('<span class="error">Mobile Required</span>');
            }else if(mob_v.test(mobile.val()) == false){
                error = false;
                mobile.addClass('validate');
                mobile.parent().append('<span class="error">Mobile must be number & 10 digit</span>');
            }
            
            // if(email.val() == ""){
            //     error = false;
            //     email.addClass('validate');
            //     email.parent().append('<span class="error">Email Required</span>');
            // }else if(reg.test(email.val()) == false){
            //     error = false;
            //     email.addClass('validate');
            //     email.parent().append('<span class="error">Check Email</span>');
            // }
            if(name.val() == ""){
                error = false;
                name.addClass('validate');
                name.parent().append('<span class="error">Name Required</span>');
            }
            if(!error){
                e.preventDefault();
            }
            
        });
    });
</script>