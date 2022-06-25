<div id="accordion">
										<div class="card">
											<div class="card-header collapsed" id="headingFour" data-toggle="collapse"
												data-target="#collapseFour" aria-expanded="true"
												aria-controls="collapseFour">
												Residential Projects
											</div>

											<div id="collapseFour" class="collapse" aria-labelledby="headingFour"
												data-parent="#accordion">
												<div class="card-body">
													<div class="menuSubHeading">
														<div class="menuSubHeading_Active">
															Ongoing
														</div>
														<a href="projects/residential/upcoming.html"
															class="menuSubHeading_Link">
															Upcoming <i class="fa fa-chevron-right"></i>
														</a>
														<a href="projects/residential/completed.html"
															class="menuSubHeading_Link">
															COMPLETED <i class="fa fa-chevron-right"></i>
														</a>
													</div>

													<ul class="ongoingLinks">
													 <?php for($i=0;$i<count($this->rs_all_projects_ongoing);$i++){?>
                                <li> <a href="detail/<?=$this->rs_all_projects_ongoing[$i]['slug']?>.html"><?=$this->rs_all_projects_ongoing[$i]['name']?> <?php if($this->rs_all_projects_ongoing[$i]['subtitle']!=''){?><span class="blueText"><?=$this->rs_all_projects_ongoing[$i]['subtitle']?></span><?php }?></a> </li>
                                  
                                  <?php }?>
														
                                                        
													</ul>
												</div>
											</div>
										</div>
										<div class="card">
											<div class="card-header collapsed" id="headingThree" data-toggle="collapse"
												data-target="#collapseThree" aria-expanded="false"
												aria-controls="collapseThree">
												Commercial Projects
											</div>
											<div id="collapseThree" class="collapse" aria-labelledby="headingThree"
												data-parent="#accordion">
												<div class="card-body">
													<div class="menuSubHeading">
														<div class="menuSubHeading_Active">
															Ongoing
														</div>
														<a href="projects/commercial/upcoming.html" class="menuSubHeading_Link">
															Upcoming <i class="fa fa-chevron-right"></i>
														</a>
														<a href="projects/commercial/completed.html"
															class="menuSubHeading_Link">
															COMPLETED <i class="fa fa-chevron-right"></i>
														</a>
													</div>

													<ul class="ongoingLinks">
														  <?php for($i=0;$i<count($this->rs_all_projects_ongoing_comm);$i++){?>
                                <li> <a href="detail/<?=$this->rs_all_projects_ongoing_comm[$i]['slug']?>.html"><?=$this->rs_all_projects_ongoing_comm[$i]['name']?> <?php if($this->rs_all_projects_ongoing_comm[$i]['subtitle']!=''){?><span class="blueText"><?=$this->rs_all_projects_ongoing_comm[$i]['subtitle']?></span><?php }?></a> </li>
                                  
                                  <?php }?>
													</ul>
												</div>
											</div>
										</div>
									</div>