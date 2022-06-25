<?php
 
include 'includes-class/db.config.class.php';
include 'sessions_file.php';
 $con=mysqli_connect('127.0.0.1','veena3oh_dbuser','igD*]e!vYC{y','veena3oh_demo')or die('can\'t establish connection with mysqli servver');
            $mySelectDB=mysqli_select_db($con,'veena3oh_demo') or die('could not connect to the database');
$SQL = "SELECT  * from msp_enquiry_sidebar";
$header = '';
$result ='';
$exportData = mysqli_query ($con,$SQL ) or die ( "Sql error : "  );
 
$fields = mysqli_num_fields ( $exportData );
 
for ( $i = 0; $i < $fields; $i++ )
{
    $header .= mysql_field_name( $exportData , $i ) . "\t";
}
 
while( $row = mysqli_fetch_row( $exportData ) )
{
    $line = '';
    foreach( $row as $value )
    {                                            
        if ( ( !isset( $value ) ) || ( $value == "" ) )
        {
            $value = "\t";
        }
        else
        {
            $value = str_replace( '"' , '""' , $value );
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
    }
    $result .= trim( $line ) . "\n";
}
$result = str_replace( "\r" , "" , $result );
 
if ( $result == "" )
{
    $result = "\nNo Record(s) Found!\n";                        
}
 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Schedule a Visit.xls");
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$result";
 
?>