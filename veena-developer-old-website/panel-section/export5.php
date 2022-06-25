<?php
 
include 'includes-class/db.config.class.php';
include 'sessions_file.php';
 
$SQL = "SELECT  * from msp_enquiry_career";
$header = '';
$result ='';
$exportData = mysqli_query ($con,$SQL ) or die ( "Sql error : " . mysqli_error($con ) );
 
$fields = mysqli_num_fields ( $exportData );
 
for ( $i = 0; $i < $fields; $i++ )
{
    $header .= mysqli_field_name( $exportData , $i ) . "\t";
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
header("Content-Disposition: attachment; filename=Career Form.xls");
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$result";
 
?>