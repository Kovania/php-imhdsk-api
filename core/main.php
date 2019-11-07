<?php

class Main extends Controller {

	function Index($lang = 'sk', $city = '0', $zd = '0', $za = '0', $time = 'teraz') {

	$url = "https://imhd.sk/".$city."/api/".$lang."/cp-mob-app?op=rp&key=imhd-mob-app-android";

	if($city == "ba") {
		$stopnum = "210";
	} else {
		$stopnum = "111";
	}
	
    $fromLocation = "z".$stopnum.sprintf('%04u',$zd);
	
    $toLocation = "z".$stopnum.sprintf('%04u',$za);
	
	$apikey = "o7e45df7104feght75sjbmzy9920135b";

	if($time == "teraz") {
		
		$date = new DateTime(null, new DateTimeZone('Europe/Bratislava'));
		$timestamp = $date->getTimestamp();
		
	} else {

		$timestamp = $time;
	}

    $json = json_decode(
				file_get_contents(
					$url.
					"&date=".$timestamp.
					"&sign=".sha1("imhd-mob-app-android:".$fromLocation.":".$toLocation.":".$timestamp.":".$apikey).
					"&str=".$fromLocation.
					"&dst=".$toLocation)
				, true);    
		
	unset($json['data']);
	
	print_r(json_encode($json, JSON_PRETTY_PRINT));

	}

}

?>