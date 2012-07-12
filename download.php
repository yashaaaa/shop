<?php ob_start();
 include_once 'connect.php';
 
 function decode($string,$key) {
    $key = sha1($key);
    $strLen = strlen($string);
    $keyLen = strlen($key);
    for ($i = 0; $i < $strLen; $i+=2) {
        $ordStr = hexdec(base_convert(strrev(substr($string,$i,2)),36,16));
        if ($j == $keyLen) { $j = 0; }
        $ordKey = ord(substr($key,$j,1));
        $j++;
        $hash .= chr($ordStr - $ordKey);
    }
    return $hash;
}
function printhello2()
{
	print "hello to git";
}
function downloadFile( $fullPath ){ 

  // Must be fresh start 
  if( headers_sent() ) 
    die('Headers Sent'); 

  // Required for some browsers 
  if(ini_get('zlib.output_compression')) 
    ini_set('zlib.output_compression', 'Off'); 

  // File Exists? 
  if( file_exists($fullPath) ){ 
    
    // Parse Info / Get Extension 
    $fsize = filesize($fullPath); 
    $path_parts = pathinfo($fullPath); 
    $ext = strtolower($path_parts["extension"]); 
    
    // Determine Content Type 
    switch ($ext) { 
      case "pdf": $ctype="application/pdf"; break; 
      case "exe": $ctype="application/octet-stream"; break; 
      case "zip": $ctype="application/zip"; break; 
      case "doc": $ctype="application/msword"; break; 
      case "xls": $ctype="application/vnd.ms-excel"; break; 
      case "ppt": $ctype="application/vnd.ms-powerpoint"; break; 
      case "gif": $ctype="image/gif"; break; 
      case "png": $ctype="image/png"; break; 
      case "jpeg": 
      case "jpg": $ctype="image/jpg"; break; 
      default: $ctype="application/force-download"; 
    } 

    header("Pragma: public"); // required 
    header("Expires: 0"); 
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
    header("Cache-Control: private",false); // required for certain browsers 
    header("Content-Type: $ctype"); 
    header("Content-Disposition: attachment; filename=\"".basename($fullPath)."\";" ); 
    header("Content-Transfer-Encoding: binary"); 
    header("Content-Length: ".$fsize); 
    ob_clean(); 
    flush(); 
    readfile( $fullPath ); 

  } else 
    die('File Not Found'); 

}







 



 if(isset($_GET['download']))
 {
    
    $id =  decode($_GET['two'], 'YashaX3Asadpoor' );
    $transactionID =  decode($_GET['one'], 'YashaX3Asadpoor' );
    
    $re = mysql_query("select datee from payment where id='$id' and ref='$transactionID'  ");
    $num = mysql_num_rows($re);
    
    if($_GET['code']=='download')
    {
    $directory="../../gra/";
    $dirhandler = opendir($directory);
    $nofiles=0;
    while ($file = readdir($dirhandler)) {
        if ($file != '.' && $file != '..')
        {
			$files[$nofiles]='../../gra/'.$file;  $nofiles++;               
        }   
    }
    include("admin/functions.php");
	$ziper = new zipfile();
	$ziper->addFiles($files);  
	$ziper->output("../../gra/download.zip");
    downloadFile('../../gra/download.zip');
    
    }
    
    
    
    if($num > 0)
    {
        list($date) = mysql_fetch_array($re);
        $now = strtotime('now');
        $date = strtotime($date);
        $date = $date + 259200;
        
        if($date > $now)
        {
            
            $re = mysql_query("select project_id from payment where id='$id' ")or die(mysql_error());
            list($project_id) = mysql_fetch_array($re);
    
            $re = mysql_query("select project from product where id='$project_id' ")or die(mysql_error());;
            list($project) = mysql_fetch_array($re);
            
                $filepath = '../../gra/'.$project;
                downloadFile($filepath);
        }
        else
        {
            include_once 'header.php';
            print '<table cellpadding="0" cellspacing="0" width="100%" >

		<tbody><tr>
	<td valign="top" class="main_box_top_middle">
	<img border="0" src="images/main_box_tr.gif" width="7" height="7"/></td>
			<td valign="top" class="main_box_top_middle">
			</td>
		<td valign="top" height="7" class="main_box_top_middle" align="left">
		<img border="0" src="images/main_box_tl.gif" width="7" height="7"/></td>
		</tr>
		<tr>
			<td valign="top" colspan="3" class="main_box_body" align="center" >	
            <br / ><br />
            <p><font face="Tahoma" size="2">&nbsp;زمان دانلود پروژه به پايان رسيده. </font></p>
             <br / ><br />
            </td>
		</tr>
		<tr>
			<td valign="top" width="7" class="main_box_bt">
			<img border="0" src="images/main_box_br.gif" width="7" height="6"/></td>
			<td valign="top" width="100%" class="main_box_bt">
			</td>
			<td valign="top" height="6" width="7" class="main_box_bt" align="left">
			<img border="0" src="images/main_box_bl.gif" width="7" height="6"/></td>
		</tr>
	</tbody></table>';
            
            include_once 'footer.php';
        }
        
        
        
    }
    else
    {
        include_once 'header.php';
            print '<table cellpadding="0" cellspacing="0" width="100%" >

		<tbody><tr>
	<td valign="top" class="main_box_top_middle">
	<img border="0" src="images/main_box_tr.gif" width="7" height="7"/></td>
			<td valign="top" class="main_box_top_middle">
			</td>
		<td valign="top" height="7" class="main_box_top_middle" align="left">
		<img border="0" src="images/main_box_tl.gif" width="7" height="7"/></td>
		</tr>
		<tr>
			<td valign="top" colspan="3" class="main_box_body" align="center" >	
            <br / ><br />
            <p><font face="Tahoma" size="2">صفحه مورد نظر شما وجود ندارد. </font></p>
             <br / ><br />
            </td>
		</tr>
		<tr>
			<td valign="top" width="7" class="main_box_bt">
			<img border="0" src="images/main_box_br.gif" width="7" height="6"/></td>
			<td valign="top" width="100%" class="main_box_bt">
			</td>
			<td valign="top" height="6" width="7" class="main_box_bt" align="left">
			<img border="0" src="images/main_box_bl.gif" width="7" height="6"/></td>
		</tr>
	</tbody></table>';
            
            include_once 'footer.php';
    }
    
 }
 

?>
