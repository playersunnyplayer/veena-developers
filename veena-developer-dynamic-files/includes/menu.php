<div class="menuAllprojectsArea">
                      <div class="menuRight_Heading"> All Projects <img src="images/close-icon.svg" id="closeBtn" alt=""> </div>
                      <div class="accordion width" id="accordionHorizontalExample"> 
                        <!-- Accordion group creating-->
                        <div class="card">
                          <div class="card-header" data-toggle="collapse" data-target="#collapseOne"> Residential </div>
                          <div id="collapseOne" class="collapse show width" data-parent="#accordionHorizontalExample">
                            <div class="card-body">
                              <div class="menuSubHeading">
                                <div class="menuSubHeading_Active"> Ongoing </div>
                                <a href="projects/residential/upcoming.html" class="menuSubHeading_Link"> Upcoming <i class="fa fa-chevron-right"></i> </a> <a href="projects/residential/completed.html" class="menuSubHeading_Link"> COMPLETED <i class="fa fa-chevron-right"></i> </a> </div>
                              <ul class="ongoingLinks">
                              
                              <?php for($i=0;$i<count($this->rs_all_projects_ongoing);$i++){?>
                                <li> <a href="detail/<?=$this->rs_all_projects_ongoing[$i]['slug']?>.html"><?=$this->rs_all_projects_ongoing[$i]['name']?> <?php if($this->rs_all_projects_ongoing[$i]['subtitle']!=''){?><span class="blueText"><?=$this->rs_all_projects_ongoing[$i]['subtitle']?></span><?php }?></a> </li>
                                  
                                  <?php }?>
                                
                                
                                
                                
                                
                              </ul>
                            </div>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-header" data-toggle="collapse" data-target="#collapseTwo"> <span data-toggle="tooltip" data-placement="left" title="Click Here"> Commercial</span> </div>
                          <div id="collapseTwo" class="collapse width" data-parent="#accordionHorizontalExample">
                            <div class="card-body">
                              <div class="menuSubHeading">
                                <div class="menuSubHeading_Active"> Ongoing </div>
                                <a href="projects/commercial/upcoming.html" class="menuSubHeading_Link"> Upcoming <i class="fa fa-chevron-right"></i> </a> <a href="projects/commercial/completed.html" class="menuSubHeading_Link"> COMPLETED <i class="fa fa-chevron-right"></i> </a> </div>
                              <ul class="ongoingLinks">
                               <?php for($i=0;$i<count($this->rs_all_projects_ongoing_comm);$i++){?>
                                <li> <a href="detail/<?=$this->rs_all_projects_ongoing_comm[$i]['slug']?>.html"><?=$this->rs_all_projects_ongoing_comm[$i]['name']?> <?php if($this->rs_all_projects_ongoing_comm[$i]['subtitle']!=''){?><span class="blueText"><?=$this->rs_all_projects_ongoing_comm[$i]['subtitle']?></span><?php }?></a> </li>
                                  
                                  <?php }?>
                                
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>