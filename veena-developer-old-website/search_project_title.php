<?
include 'includes_config/db.config.class.php';

//get search term
   
if(isset($_POST["query"]))  
 {
  if(!empty($_POST["query"]))  
  {
    $keyFindPost = $_POST['query'];
    
    $WebsiteSearchFilterNum = $Website->GetWebsiteFilterByTitleNumLimit($keyFindPost, 0, 12);
    $WebsiteSearchFilterRes = $Website->GetWebsiteFilterByTitleResLimit($keyFindPost, 0, 12);
    $output = '<ul class="list-styleds">'; 
    
    if ($WebsiteSearchFilterNum > 0)
    {
      while ($WebsiteSearchData = $Website->dbfetch($WebsiteSearchFilterRes))
      {
        $WebsiteID = $WebsiteSearchData["websiteid"];
        $WebsiteName = $WebsiteSearchData["website_sitename"];
        $output .= '<li class="srchli">'.$WebsiteName.'</li>';  
      }
    }
    $output .= '</ul>';   
    echo $output; 
  }
}
?>
