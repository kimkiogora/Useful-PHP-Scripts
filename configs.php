<?php
$main_url = "http://localhost/ussd_index.php?msisdn=254736465333";

$shortcodes = array(
	"*xxx#"=>"$main_url&service_code=275&",
	"*yyy#"=>"$main_url&service_code=778&",
	"*zzz#"=>"$main_url&service_code=699&",
);

$mnoregex = array(
	"(^2547)(11){1}[0-9]{6}"=>"mno_y"
);
