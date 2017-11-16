<?php
function getBrowser() 
{ 
    $u_agent = $_SERVER['HTTP_USER_AGENT']; 
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Internet Explorer'; 
        $ub = "MSIE"; 
    } 
    elseif(preg_match('/Firefox/i',$u_agent)) 
    { 
        $bname = 'Mozilla Firefox'; 
        $ub = "Firefox"; 
    } 
    elseif(preg_match('/Chrome/i',$u_agent)) 
    { 
        $bname = 'Google Chrome'; 
        $ub = "Chrome"; 
    } 
    elseif(preg_match('/Safari/i',$u_agent)) 
    { 
        $bname = 'Apple Safari'; 
        $ub = "Safari"; 
    } 
    elseif(preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Opera'; 
        $ub = "Opera"; 
    } 
    elseif(preg_match('/Netscape/i',$u_agent)) 
    { 
        $bname = 'Netscape'; 
        $ub = "Netscape"; 
    } 
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
    }
    $i = count($matches['browser']);
    if ($i != 1) {
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }
    if ($version==null || $version=="") {$version="?";}
    
    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
} 
$ua=getBrowser();
$yourbrowser= "<b>Your browser: </b>" . $ua['name'] . " " . $ua['version'] . " on " .$ua['platform'];
print_r($yourbrowser);
echo "<br>"; 
echo "<br>"; 
//------------------------------------------------------------------------------------------------------
	$user = get_current_user(); 
	echo "<b>Username: </b>" .$user; 
	echo "<br>"; 
	$computername = getenv("COMPUTERNAME"); 
	echo "<b>Computer name: </b>".$computername; 
	echo "<br>"; 

	$systemroot = $_SERVER['SystemRoot']; 
	echo "<b>System folder: </b>".$systemroot; 
	echo "<br>"; 
	$systemfileroot = substr($_SERVER['COMSPEC'],0,19); 
	echo "<b>System files folder: </b>".$systemfileroot; 
	echo "<br>"; 

	$screenWidth='<script type="text/javascript">document.write(screen.width);</script>'; 
	echo "<b>Screen width: </b>".$screenWidth; 
	echo "<br>"; 
	$wmi = new COM("winmgmts://./root/cimv2"); 
	$names = $wmi->ExecQuery("Select * from Win32_PointingDevice");
	foreach ($names as $butt)
	{ 
		$button = $butt->NumberOfButtons;	//gwmi	
	} 
	echo "<b>Number of buttons: </b>".$button;
	echo "<br>"; 	
	
	echo "<b>Memory: </b><br>";
    $disks = $wmi->ExecQuery("Select * from Win32_LogicalDisk");
    foreach ($disks as $d)
    {
        $str=sprintf("%s %s %s bytes<br>", $d->Name,$d->FileSystem ,number_format($d->Size,0,'.',','));
        echo $str;
    }
	
	$data = $user. $computername. $systemroot. $systemfileroot. $screenWidth. $button. $str; 
	$hash = hash('md5',$data); 
	echo "<b>Hash md5: </b>".$hash; 
	
	echo "<br>"; 
	echo "<br>"; 
	$WshShell = new COM("WScript.Shell"); 

	$registry = "HKEY_CURRENT_USER\\SOFTWARE\\" . "Blynkov" . "\\" . "BlynkovVova"; 
	try
	{ 
		$result = $WshShell->RegWrite($registry, $hash, 'REG_SZ'); 
		echo "<b>Successfully written at: </b>".$registry; 
		echo " <b>Value: </b>".$hash; 
		return($result); 
	} 
	catch(Exception $e)
	{ 
		echo "Some Exception in Registry writing".$e; 
		print_r($e); 
	}
?>
