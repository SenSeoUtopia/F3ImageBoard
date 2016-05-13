<?php
class Helper extends Prefab {

/* Limit Desc */
function crop($string,$length,$dots = "...") {
return (strlen($string) > $length) ? mb_strcut($string, 0, $length - strlen($dots)) . $dots : $string;
}

/* Remove Tags */
function remove_execute_code($string){
return htmlentities($string);
}


/* Strip Tags */
function remove_tags($val){
return strip_tags($val);
}

/* Strip Slashes */
function remove_slash($val){
return stripslashes($val);
}

/* Remove WhiteSpaces */
function remove_spaces($string){
return trim($string);
}

/* Covert Spaces to minus */
function remove_white_spaces($string){
return preg_replace("/\W+/isu","-",$string);
}

/* Replace Hashtag, Mentions, Emoji */
function replace_data($string){
$home_url = Base::instance()->get("home_url");

$patterns = array(
"/:(.*?):/i", //Emoji
"/&amp;gt;&amp;gt;(\d*)/i", // Quotes Posts
"/(\s|>|^)(https?:[^\s<]*)/i", // oEmebed
"/^&amp;gt;(.*)/i", // Quotes
"/&lt;br \/&gt;/i" // Br Tag
);
$replacements = array(
"<i class=\"twa twa-lg twa_$1\" title=\"$1\"></i>", //Emoji
"<a href='#$1' class='quote btn btn-success btn-xs'>&gt;&gt; $1</a>", // Post Quotes
"$1<a href=\"$2\" id=\"embed\" class=\"embed-responsive embed-responsive-16by9\">$2</a>", // oEmebed
"<span class='quotes'>&gt; <q>$1</q></span>", // Self Quotes
"<br/>" // Self Quotes
);

return preg_replace($patterns,$replacements,$string);
}

}