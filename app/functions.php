<?php
// Parse BBCodes
function convert_bb_to_html($text) {

// BBcode array
$find = array(
'~\[b\](.*?)\[/b\]~s',
'~\[i\](.*?)\[/i\]~s',
'~\[u\](.*?)\[/u\]~s',
'~\[code\](.*?)\[/code\]~s',
'~\[size=(.*?)\](.*?)\[/size\]~s',
'~\[color=(.*?)\](.*?)\[/color\]~s',
'~\[url\]((?:ftp|https?)://.*?)\[/url\]~s',
'~\[img\](https?://.*?\.(?:jpg|jpeg|gif|png|bmp))\[/img\]~s'
);

// HTML tags to replace BBcode
$replace = array(
'<b>$1</b>',
'<i>$1</i>',
'<u>$1</u>',
'<pre><code>$1</code></pre>',
'<font size="$1">$2</font>',
'<span style="color:$1;">$2</span>',
'<a href="$1">$1</a>',
'<img src="$1" alt="" />'
);

// Replacing the BBcodes with corresponding HTML tags
return preg_replace($find,$replace,$text);
}


// Bytes to Size in KB, MB, GB , TB, PB
function formatSizeUnits($bytes){
if ($bytes >= 1073741824){
$bytes = number_format($bytes / 1073741824, 2) . ' GB';
} elseif ($bytes >= 1048576)
{
$bytes = number_format($bytes / 1048576, 2) . ' MB';
} elseif ($bytes >= 1024) {
$bytes = number_format($bytes / 1024, 2) . ' KB';
} elseif ($bytes > 1)
{
$bytes = $bytes . ' bytes';
} elseif ($bytes == 1) {
$bytes = $bytes . ' byte';
} else {
$bytes = '0 bytes';
}
return $bytes;
}

// Get Directory Size
function dirSize($directory) {
$size = 0;
foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory)) as $file){
$size+=$file->getSize();
}
return $size;
} 

function explodeX($delimiters,$string) {
return explode(chr(1),str_replace($delimiters,chr(1),$string));
}

// Nice Time System
function nicetime($date){
if(empty($date)) {
return "No date provided";
}
$periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
$lengths         = array("60","60","24","7","4.35","12","10");
$now             = time();
$unix_date         = strtotime($date);
   
// check validity of date
if(empty($unix_date)) { return "Bad date"; }

// is it future date or past date
if($now > $unix_date) { $difference     = $now - $unix_date; $tense = "ago";      
} else { $difference = $unix_date - $now; $tense = "from now"; }
   
for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) { $difference /= $lengths[$j]; }
   
$difference = round($difference);
   
if($difference != 1) { $periods[$j].= "s"; }
  
return "$difference $periods[$j] {$tense}";
}

// Trip Code

function tripcode($name){
if(preg_match("/(#|!)(.*)/", $name, $matches)){
$cap  = $matches[2];
$cap  = strtr($cap,"&amp;", "&");
$cap  = strtr($cap,",", ",");
$salt = substr($cap."H.",1,2);
$salt = preg_replace("/[^\.-z]/",".",$salt);
$salt = strtr($salt,":;<=>?@[\\]^_`","ABCDEFGabcdef"); 
return substr(crypt($cap,$salt),-10)."";
}
}