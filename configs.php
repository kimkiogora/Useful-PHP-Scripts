<?php
$main_url = "http://localhost/safindex.php?msisdn=254736465333";

$shortcodes = array(
	"*275#"=>"$main_url&service_code=275&",
	"*778#"=>"$main_url&service_code=778&",
	"*699#"=>"$main_url&service_code=699&",
);

$mnoregex = array(
	"(^2547)(11){1}[0-9]{6}"=>"safaricom"
);
