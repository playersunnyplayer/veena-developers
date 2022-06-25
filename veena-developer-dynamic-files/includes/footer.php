<style>
input.error
{
	border:1px solid red !important;
	
}
label.error
{
	display:none !important;
	
}
p.whileText
{
	color:#fff;
	
}
</style>
<footer>
  <div class="footerThumbArea">
    <?php if($this->gs['address']!=''){?>
    <a class="footerThumb animate__animated animate__zoomIn" href="javascript:void();" target="_blank">
    <figure> <img src="images/location-icon.svg" alt="" /> </figure>
    <figcaption>
      <?=$this->gs['address']?>
    </figcaption>
    </a>
    <?php }?>
    <?php if($this->gs['contact_email']!=''){?>
    <a class="footerThumb animate__animated animate__zoomIn" href="mailto:<?=$this->gs['contact_email']?>" target="_blank">
    <figure> <img src="images/email-icon.svg" alt="" /> </figure>
    <figcaption>
      <?=$this->gs['contact_email']?>
    </figcaption>
    </a>
    <?php }?>
    <?php if($this->gs['contact_number']!=''){?>
    <a class="footerThumb animate__animated animate__zoomIn" href="tel:<?=$this->gs['contact_number']?>" target="_blank">
    <figure> <img src="images/telecom-icon.svg" alt="" /> </figure>
    <figcaption>
      <?=$this->gs['contact_number']?>
    </figcaption>
    </a>
    <?php }?>
    <?php if($this->gs['contact_number1']!=''){?>
    <a class="footerThumb animate__animated animate__zoomIn" href="https://wa.me/91<?=$this->gs['contact_number1']?>?text=I%27m%20interested%20to%20know%20about%20your%20project%20" target="_blank">
    <figure> <img src="images/whatsapp-icon.svg" alt="" /> </figure>
    <figcaption>
      <?=$this->gs['contact_number1']?>
    </figcaption>
    </a>
    <?php }?>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-sm-7">
        <h3>Quick Links</h3>
        <ul class="footerLinks">
          <li><a href="index.html">Home</a> </li>
          <li><a href="about-us.html">About Us</a> </li>
          <li><a href="careers.html">Careers</a> </li>
          <li><a href="csr.html">CSR</a> </li>
          <li><a href="blog.html">Blog</a> </li>
          <li><a href="#" data-toggle="modal" data-target="#disclaimerModel">Disclaimer</a> </li>
          <li><a href="projects/residential/ongoing.html">Residential</a> </li>
          <li><a href="projects/commercial/ongoing.html">Commercial</a> </li>		  <li><a href="privacy-policy.html">Privacy Policy</a> </li>
          
          
         <!-- <li><a href="privacy.html">Privacy Policy</a> </li>
          <li><a href="terms.html">Terms & Conditions</a> </li>-->
          
          		  <!-- <li><a href="projects/commercial/ongoing.html">Commercial</a> </li> -->
        </ul>
        <ul class="socialMedia socialFooter">
          <?php if($this->gs['facebook_link']!=''){?>
          <li> <a target="_blank" href="<?=$this->gs['facebook_link']?>" class="facebook_sm"><i
                                    class="fa fa-facebook"></i></a> </li>
          <?php }?>
          <?php if($this->gs['twitter_link']!=''){?>
          <li> <a href="<?=$this->gs['twitter_link']?>" class="twitter_sm" target="_blank"><i
                                    class="fa fa-twitter"></i></a> </li>
          <?php }?>
          <?php if($this->gs['instagram_link']!=''){?>
          <li> <a href="<?=$this->gs['instagram_link']?>" class="instagram_sm" target="_blank"><i class="fa fa-instagram"></i></a> </li>
          <?php }?>
          <?php if($this->gs['linkedin_link']!=''){?>
          <li> <a href="<?=$this->gs['linkedin_link']?>" class="linkedin_sm" target="_blank"><i class="fa fa-linkedin"></i></a> </li>
          <?php }?>
          <?php if($this->gs['youtube_link']!=''){?>
          <li> <a href="<?=$this->gs['youtube_link']?>" class="youtube_sm" target="_blank"><i class="fa fa-youtube"></i></a> </li>
          <?php }?>
          <?php if($this->gs['contact_number1']!=''){?>
          <li> <a target="_blank" href="https://wa.me/91<?=$this->gs['contact_number1']?>?text=I%27m%20interested%20to%20know%20about%20your%20project%20" class="whatsapp_sm"><i class="fa fa-whatsapp"></i></a></li>
          <?php }?>
        </ul>
        <div>
          <?=$this->gs['footer_text']?>
        </div>
      </div>
      <div class="col-sm-5">
        <form class="headerForm" id="ContactForm1" name="ContactForm1" method="post">
        
        <?php
		
		$fno=rand(1,9);
		$sno=rand(1,9);
		
		?>
        
         <input type="hidden" class="form-control" name="fno" id="fno" value="<?=$fno?>"/>
          <input type="hidden" class="form-control" name="sno" id="sno" value="<?=$sno?>"  />
          <h3>Quick Enquiry</h3>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <input type="text" class="form-control required" name="name" id="name"  placeholder="Name" />
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <input class="form-control required" name="mobile" id="mobile"  placeholder="Mobile No" type="text" maxlength="10" />
              </div>
            </div>
          </div>
          <div class="form-group">
            <input class="form-control required" name="email" id="email"  placeholder="Email ID" type="text" />
          </div>
          <div class="form-group">
            <textarea name="message" class="form-control" id="comment" cols="30" rows="5" placeholder="Your query"></textarea>
          </div>
          <div class="row capta-css">
            <div class="col-sm-5 offset-lg-4 sleft">
              <div class="form-group" style="color:#fff">
                
                
                
                 <span class="numbers"><?=$fno?></span>
                 
                 
                 <span class="sign"> + </span>
                 
                  <span class="numbers"><?=$sno?></span>
                  
                  <span class="sign"> = </span>
                 
                
                 
                 
              </div>
            </div>
            <div class="col-sm-3 pl-0">
              <div class="form-group">
                <input type="text" id="UserCaptchaCode" name="UserCaptchaCode" class="form-control CaptchaTxtField required number"  placeholder='Enter Total'>
                <div id="WrongCaptchaError" class="error"></div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-trinary" id="apifootersubmit" name="apifootersubmit">Submit</button>
          
          <div class="ContactMsg"></div>
        </form>
        
      </div>
    </div>
  </div>
  <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-angle-up"></i></button>
</footer>

<?php if($this->gs['loder_file']!='' && file_exists(ABS_PATH."/uploads/logo/".$this->gs['loder_file']))
  {
    $loder="uploads/logo/".$this->gs['loder_file'];
  }
  else
  {
    $loder="uploads/logo/default_loder.svg";
  }?>


<?php if($this->gs['loder_icon']!='' && file_exists(ABS_PATH."/uploads/logo/".$this->gs['loder_icon']))
  {
    $loder_icon="uploads/logo/".$this->gs['loder_icon'];
  }
  else
  {
    $loder_icon="uploads/logo/default_loder_icon.svg";
  }?>


<div class="loader" id="veenaloader">
  <div class="loaderInner"> <img src="<?=$loder_icon?>" class="veenaStar" alt=""> <img src="<?=$loder?>" alt=""> 
  </div>
</div>


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