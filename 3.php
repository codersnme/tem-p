<?php
@error_reporting(0);
@ini_set('display_errors', 0);@error_reporting(0);
@set_time_limit(0);
@clearstatcache();
@ini_set('error_log',NULL);
@ini_set('log_errors',0);
@ini_set('max_execution_time',0);
@ini_set('output_buffering',0);
@ini_set('display_errors', 0);
/**
* @author Ardzz [Z0NK3X] https://web.facebook.com/z0nk3x
* Github 	 : https://github.com/ardzz
* BC0 TEAM (Ardzz) © 2018
*/
function banner(){
	system('clear');
	echo "
 ____                           ____
 \ \ \                         / / /
  \ \ \                       / / / 
   > > >  [ Pr0Xy Checker ]  < < <  
  / / /                       \ \ \ 
 /_/_/                         \_\_\
+-----------[ Z0NK3X ]--------------+             
	\n";
}
banner();
echo "1) Grab Proxy\n";
echo "2) Check Proxy\n";
echo "Choose Option      : ";
$opsi = trim(fgets(STDIN, 1024));
if ($opsi == "1") {
	echo "Save result to txt file : ";
$save_proxy = trim(fgets(STDIN, 1024));
function curl($url) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $res = curl_exec($ch);
  curl_close($ch);
  return $res;
}
  $get = curl("https://free-proxy-list.net/");
      preg_match("/<tbody>(.*?)<\/tbody>/", $get, $res);
  preg_match_all("/<tr>(.*?)<\/tr>/", $res[1], $match);
    foreach($match[1] as $val)
    {
    $hm = str_replace("<td>", "", $val);
    $ip = explode("</td>", $hm);
$jud = fopen($save_proxy,"a");
fwrite($jud, $ip[0].":".$ip[1]."\n");
}
fclose($jud);
$count = count(file($save_proxy));
echo "Done! Total ($count) Proxy\n";
}

if ($opsi == "2") {
banner();
echo "Your Proxy List Text File : ";
$id = trim(fgets(STDIN, 1024));
echo "Save result to txt file : ";
$save = trim(fgets(STDIN, 1024));
$myfile = fopen($id, "r") or die("file not found!");
$hasil = fread($myfile,filesize($id));
$proxys=explode("\n",$hasil);
$proxys=array_unique($proxys);
$count = count(file($id));
echo "\n($count) Proxy Loaded! \n";
sleep(1);
echo "[+] Checking Proxy.... Please Wait....\n";
foreach($proxys AS $ipx){
  $pisah = explode(":", $ipx);
//echo $pisah[0] ."|". $pisah[1]."\n";
$ip = $pisah[0];
$url = 'http://proxycheck.io/v2/'.$ip.'?key=407f62-jb7358-545207-ha293s&vpn=0&asn=1&node=1&time=1&inf=0&port=1&seen=1&days=7&tag=msg';
$response = file_get_contents($url);
$response = json_decode($response, TRUE);
//echo $response;
//sleep(1);
if ($response[$ip]['proxy'] == "yes"){
	echo "\n+---------------[ Info Detail ]------------------+\n";	
	echo "IP 		: $ip:".$response[$ip]['port']."\n";
	echo "ISP 		: ".$response[$ip]['provider']."\n";
	echo "COUNTRY 	: ".$response[$ip]['country']."\n";
	echo "+---------------[ Proxy Live! ]------------------+\n";
$jud = fopen($save,"a");
fwrite($jud, $pisah[0].':'.$response[$ip]['port']."\n");
fclose($jud);
}
else {
	echo $ip." [ DIE ]\n";
	$save1 = "die.txt";
$jud1 = fopen($save1,"a");
fwrite($jud1, $ip.':'.$response[$ip]."\n");
fclose($jud1);
	}
}
$die = count(file($save1));
$live = count(file($save));
echo "\nDone! Total Proxy Live [$live], Die [$die] Saved! to [$save]\n";
}
?>
