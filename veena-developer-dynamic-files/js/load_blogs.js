

$(document).ready(function() 
{
	
	
	
	
    var nextload=$('#results').find('.isload').val();
	var track_load = 1; //total loaded record group(s)
	var loading  = false; //to prevents multipal ajax loads
	var catv=$("#catv").val();
   var subcatv=$("#subcatv").val();
   var subsubcatv=$("#subsubcatv").val();
   
     var size_v=$("#size_v").val();
    var style_v=$("#style_v").val();
    var price_v=$("#price_v").val();
    var brand_v=$("#brand_v").val();
    var order_v=$("#order_v").val();
	
	var serach_keyword=$("#serach_keyword").val();
	var serach_cat=$("#serach_cat").val();
	
	var product_new=$("#product_new").val();
	
	
	
	var total_products=$("#total_products").val();
	
	
	
	
	
	
	

	

	$('#results').load("scripts/ajax/index.php", 
					{
						'method':'blogs',
						'page':track_load,
						'actionType':'list',
						'cat':catv,
						'subcat':subcatv,
						'subsubcat':subsubcatv,
						'size_v':size_v,
						'style_v':style_v,
						'price_v':price_v,
						'brand_v':brand_v,
						'serach_keyword':serach_keyword,
						'serach_cat':serach_cat,
						'product_new':product_new,
						'order_v':order_v,
						'total_products':total_products
					}, 
	function() {
		
		
		
		
									
								var c=$('#results').find('.nextload_total').val();
								
								
								var total_all_datas=$('#results').find('.total_all_datas').val();
								
								if(total_all_datas>0)
								{
									 $('.noData').hide();
									  $('.AddedData').show();
									
								}
								else
								{
									 $('.noData').show();
									  $('.AddedData').hide();
									
								}
								
								
								 var total_datas=$('#results').find('.total_datas').val();
								  
								  $('.total_result').html(total_datas);
								
								//alert(c);
								$('#load_more_total').html(c);
								
								 var nextload1=$('#results').find('.isload').val();
								  
								  if(nextload1=='false')
								  {

										$('.animation_image').hide(); 
								  }
		
		
		track_load++;
		
		
	}); //load first group




/*$(window).scroll(function() 
{ */
//detect page scroll

$(window).scroll(function() 
{ 


//alert("hi");

	var catv=$("#catv").val();
   var subcatv=$("#subcatv").val();
   var subsubcatv=$("#subsubcatv").val();
   
     var size_v=$("#size_v").val();
    var style_v=$("#style_v").val();
    var price_v=$("#price_v").val();
    var brand_v=$("#brand_v").val();
    var order_v=$("#order_v").val();
	
	var serach_keyword=$("#serach_keyword").val();
	var serach_cat=$("#serach_cat").val();
	
	var product_new=$("#product_new").val();
	
	
	var track_load = $('#results').find('.nextpage').val();
	
	var total_products=$("#total_products").val();
	


    var nextload=$('#results').find('.isload').val();
	
	
	
	
	

		if(nextload=='true' && loading==false) //there's more data to load
		{
			
			
					loading = true; //prevent further ajax loading
					
					

					$('.animation_image').hide(); //show loading image

					$.post('scripts/ajax/index.php',
						{'method':'blogs',	'actionType':'list','page': track_load,'cat':catv,'subcat':subcatv,'subsubcat':subsubcatv,'size_v':size_v,'style_v':style_v,'price_v':price_v,'brand_v':brand_v,'serach_keyword':serach_keyword,'serach_cat':serach_cat,'product_new':product_new,'order_v':order_v,'total_products':total_products}, 
							function(data)
							{
								
								
								   $('#results').find('.nextpage').remove();
		   							$('#results').find('.isload').remove();
									
									$('#results').find('.nextload_total').remove();
									
									$('#results').find('.total_all_datas').remove();
									
									
									
									
									
								$("#results").append(data);
								
								
								var total_all_datas=$('#results').find('.total_all_datas').val();
								
								if(total_all_datas>0)
								{
									 $('.noData').hide();
									  $('.AddedData').show();
									
								}
								else
								{
									 $('.noData').show();
									  $('.AddedData').hide();
									
								}
								
								
								//alert($('#results').find('.nextload_total').val());
									
								var c=$('#results').find('.nextload_total').val();
								
								//alert(c);
								$('#load_more_total').html(c);
									
								
								 //append received data into the element
								 
								  var nextload1=$('#results').find('.isload').val();
								  
								  if(nextload1=='true')
								  {

								$('.animation_image').show(); 
								  }//hide loading image once data is received

								track_load++; //loaded group increment
								
								
								
								
								loading = false;
						
								$(".pro_a").hover(function() 
								{
								
								},
								function()
								{
									 
								}
					
							);
					
							
							var pim=$(".product_item").length;
					
							$('#item_per_page').html(pim); 
					
							
								
							}).fail(function(xhr, ajaxOptions, thrownError) 
							{
									alert(thrownError); //alert with HTTP error
									$('.animation_image').show(); //hide loading image
									loading = false;
									
							});

				
			}
		
	});
	
});





$( "#search_btn" ).click(function() {
	
	 var searct_text=$("#search_keyword").val();
	 if(searct_text!='')
	 {
		 
		 $("#serach_keyword").val(searct_text);
	 }
	 else
	 {
		 $("#serach_keyword").val(searct_text);
		 
		 
	  }
	  
	  get_filtered_data();
	

});


function search_data()
{
	var searct_text=$("#search_keyword").val();
	 if(searct_text!='')
	 {
		 
		 $("#serach_keyword").val(searct_text);
	 }
	 else
	 {
		 $("#serach_keyword").val(searct_text);
		 
		 
	  }
	  
	  get_filtered_data();
	
}



	
	  
	  
	  
	  
	
	
		
	



//general function call evrytime
function get_filtered_data()
{
	//$('#results').html('');
	var catv=$("#catv").val();
	var subcatv=$("#subcatv").val();
    var subsubcatv=$("#subsubcatv").val();
    var size_v=$("#size_v").val();
    var style_v=$("#style_v").val();
    var price_v=$("#price_v").val();
    var brand_v=$("#brand_v").val();
    var order_v=$("#order_v").val();
	
	
	var serach_keyword=$("#serach_keyword").val();
	var serach_cat=$("#serach_cat").val();
	
	var product_new=$("#product_new").val();
	
	
	var total_products=$("#total_products").val();
	
	

 	$.ajax({

	     url:"scripts/ajax/index.php",
         type:"POST",
         data:"method=blogs&actionfunction=showData&page=1&actionType=list&cat="+catv+"&subcat="+subcatv+"&subsubcat="+subsubcatv+"&size_v="+size_v+"&style_v="+style_v+"&price_v="+price_v+"&brand_v="+brand_v+"&serach_keyword="+serach_keyword+"&serach_cat="+serach_cat+"&product_new="+product_new+"&order_v="+order_v+"&total_products="+total_products,
		 
		

        cache: false,
        success: function(response)
		{
		 // $('.animation_image').hide();
		  $('#results').html(response);
		  
		  
		  
		  
		  
		  
								var total_all_datas=$('#results').find('.total_all_datas').val();
								
								if(total_all_datas>0)
								{
									 $('.noData').hide();
									  $('.AddedData').show();
									
								}
								else
								{
									 $('.noData').show();
									  $('.AddedData').hide();
									
								}
								
		  
		  
		  
		  
		  
		 						
								 var c=$('#results').find('.nextload_total').val();
								
								//alert(c);
								$('#load_more_total').html(c);
								
								 var nextload1=$('#results').find('.isload').val();
								 
								  var total_datas=$('#results').find('.total_datas').val();
								  
								  $('.total_result').html(total_datas);
								  
								  if(nextload1=='false')
								  {

										$('.animation_image').hide(); 
										
								  }
								  else
								  {
									  $('.animation_image').show(); 
									  
								   }
		  
		}
	});  

}



