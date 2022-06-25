<section id="our-services">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-6 top40">
            <div id="first-slider">
              <div id="carousel-example-generic" class="carousel slide carousel-fade">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                   <?php
                      $SliderNum = $Slider->GetSliderNum();
                      $SliderRes = $Slider->GetSliderRes();
                      
                      if ($SliderNum > 0)
                      {
                        $anju=0;
                        while ($SliderData = $Slider->dbfetch($SliderRes))
                        {
                          $SliderID = $SliderData["sliderid"];
                          if($anju==0){ $active='active';}else{ $active='';}
                        ?>
                  <li data-target="#carousel-example-generic" data-slide-to="<?=$anju;?>" class="<?=$active;?>"></li>
                  <?php
                      $anju++;
                      }
                    }
                  ?>
                 
                </ol>
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                  <!-- Item 1 -->
                  <?php
                      $SliderNum = $Slider->GetSliderNum();
                      $SliderRes = $Slider->GetSliderRes();
                      
                      if ($SliderNum > 0)
                      {
                        $anju=0;
                        while ($SliderData = $Slider->dbfetch($SliderRes))
                        {
                          $anju++;
                          $SliderID = $SliderData["sliderid"];
                          $SliderTitle = $SliderData["msp_title"];
                          $SliderImages = $SliderData["msp_image"];
                          if($anju==1){ $active='active';}else{ $active='';}
                        ?>
                  <div class="item <?=$active;?> slide<?=$anju;?>">
                    <img src="images/slider_images/<?=$SliderImages;?>">
                  </div>
                  <?php
                    }
                  }
                  ?>
                
                  <!-- Item 4 -->
                  <!-- End Item 4 -->
                </div>
                <!-- End Wrapper for slides-->
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <i class="fa fa-angle-left"></i><span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <i class="fa fa-angle-right"></i><span class="sr-only">Next</span>
                </a>
              </div>
            </div>
          </div>
          <?php
        $WebsiteTopRes = $Website->GetWebsiteHomeTopRes();
        $manoj8976191992=0;
        while ($WebsiteTopData = $Website->dbfetch($WebsiteTopRes))
          {
            $manoj8976191992++;
            $WebsiteTopName = $WebsiteTopData["website_sitename"];
            $WebsiteImage = $WebsiteTopData["website_image"];
            $Websiteshort_Address = $WebsiteTopData["website_short_address"];
            $CatTitSpaceRemove = _prepare_url_text($WebsiteTopData["website_url_title"]);
            $urlhtaccesstop = strtolower($siteurl.'/project/'. $CatTitSpaceRemove);
            if($manoj8976191992 <= 2){$topc='top40';}else{$topc="";}
          ?>
              <div class="col-md-3 col-sm-3 <?=$topc;?>">
                 <a href="<?=$urlhtaccesstop;?>" target="_blank" >
              <div class="property_item bottom40">
                <div class="image">
                    <img src="images/sitelogo_images/project/<?=$WebsiteImage;?>" class="img-responsive">
                    <div class="overlay">
                      <div class="centered" target="_blank">
                        <h4><?=$WebsiteTopName;?></h4>
                        <h5><?=$Websiteshort_Address;?></h5>
                      </div>
                    </div>
                 
                </div>
              </div>
               </a>
            </div>
          <?php
            
            }
          ?>
                  
            <div class="col-md-3 col-sm-3">
                 <a href="<?=$urlhtaccesstop;?>" target="_blank" >
              <div class="property_item bottom40">
                <div class="image">
                    <a href="#" >    <img src="images/project/Veena-28.jpg"  class="img-responsive"></a>
                    
                 
                </div>
              </div>
               </a>
            </div>
            
            
        </div>
      </div>
    </section>