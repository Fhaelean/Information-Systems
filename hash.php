<?php
$user = get_current_user(); 
$computername = getenv("COMPUTERNAME"); 
$systemroot = $_SERVER['SystemRoot']; 
$systemfileroot = substr($_SERVER['COMSPEC'],0,19); 
$screenWidth='<script type="text/javascript">document.write(screen.width);</script>'; 
	
	$wmi = new COM("winmgmts://./root/cimv2"); 
	$names = $wmi->ExecQuery("Select * from Win32_PointingDevice");
	foreach ($names as $butt)
	{ 
		$button = $butt->NumberOfButtons;	
	} 
    $disks = $wmi->ExecQuery("Select * from Win32_LogicalDisk");
    foreach ($disks as $d)
    {
        $str=sprintf("%s %s %s bytes<br>", $d->Name,$d->FileSystem ,number_format($d->Size,0,'.',','));
    }
	
	$data = $user. $computername. $systemroot. $systemfileroot. $screenWidth. $button. $str; 
	$hash = hash('md5',$data);
	
	$regdat= new COM('WScript.Shell');
	$regdata= $regdat->regRead('HKEY_CURRENT_USER\SOFTWARE\Blynkov\BlynkovVova');
	
	if ($hash == $regdata)
	{
		echo 'Hash matches';
	}
	else
	{
		echo "Error hash doesn't matches";
	}
?>