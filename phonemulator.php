#!/usr/bin/php
<?php
require "configs.php"; 

if( !isset($shortcodes) or empty($shortcodes)) {
    die("Please add the Shortcodes and Menus in the configurations files -> configs.php !");
}

echo "\nPhone Emulator\nAvailable USSD menus are:- \n";

$menus = null;
$i=1;

$mn = array();

foreach($shortcodes as $sc=>$val) {
    if(empty($menus)) { 
	$menus=$i."-".$sc."\n";
    } else {
	$menus .= $i."-".$sc."\n";
    }
    $mn[$i] = $sc;
    $i++;
}

echo "\n$menus\nSelect from the list: ";

$in = fgets(STDIN);

$in = (int)$in;

if($in > count($mn)) {
    echo "\nInvalid option selected. Aborted.\n"; return;
}

if( empty($in) or !is_numeric($in)) {
   die("Invalid selection made ! exit");
} else {
    $shortcode  = $mn[$in];
    $menuurl = $shortcodes[$shortcode];

    #create the session
    $sessionID = uniqid();
    $init_menuurl = $menuurl . "session_id=$sessionID&ussd_string=";     

    $result = getPage($init_menuurl);

    $mI = countMenuItems($result);      
    echo "\nActual menu items are $mI\n" ;

    echo $result;

    if( strcmp($result,"") != 0 ){
	while(1) {
	    //break;
	    echo "\n\nYour input : ";

	    $in = fgets(STDIN);
	    $in = (int)$in;
	    if( !empty($in) AND is_numeric($in)) {
		$init_menuurlc = $menuurl . "session_id=$sessionID&ussd_string=$in";
	    	$response = getPage($init_menuurlc);
		$mI = countMenuItems($result);
            
                echo "\nActual menu items are $mI\n" ;

		echo "\n$response\n";

		$endcheck = substr($response,0,3);
		if (strcasecmp(trim($endcheck),"END") == 0) { 
		    echo"\n\n";break;
		} 		
	    }
	}
    }
}

/**
 * Get a count of the menu item.
*/
function countMenuItems($result) {
   $xarr = explode("\n",$result);
   $cnt = count($xarr);
   if ($cnt > 1){
        $cnt = $cnt - 1 ; 
   }
   return $cnt;
}

/**
 * load the USSD Page.
*/
function getPage($url) {
    return trim(join('', file($url)));
}
?>
