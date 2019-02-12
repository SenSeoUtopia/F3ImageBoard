<?php

class Helper extends Prefab
{

    /**
     * Country Code
     * @param $string
     * @return string
     */
    function country_flag($string)
    {
        $country_code = geoip_country_code_by_name($string);
        return strtolower($country_code);
    }

    /**
     * Limit Desc
     * @param $string
     * @param $length
     * @param string $dots
     * @return string
     */
    function crop($string, $length, $dots = "...")
    {
        return (strlen($string) > $length) ? mb_strcut($string, 0, $length - strlen($dots)) . $dots : $string;
    }

    /**
     * Remove Tags
     * @param $string
     * @return string
     */
    function remove_execute_code($string)
    {
        return htmlentities($string);
    }

    /**
     * Remove Html Tags for Title tags
     * @param $string
     * @return string
     */
    function remove_title_html_tags($string){

        $string = preg_replace("/<q>(.*?)<\/q>/i",'"$1"',$string);

        return strip_tags($string);
    }


    /**
     * Strip Tags
     * @param $val
     * @return string
     */
    function remove_tags($val)
    {
        return strip_tags($val);
    }


    /**
     * Strip Slashes
     * @param $val
     * @return string
     */
    function remove_slash($val)
    {
        return stripslashes($val);
    }


    /**
     * Remove WhiteSpaces
     * @param $string
     * @return string
     */
    function remove_spaces($string)
    {
        return trim($string);
    }

    /**
     * Covert Spaces to minus
     * @param $string
     * @return null|string|string[]
     */
    function remove_white_spaces($string)
    {
        return preg_replace("/\W+/isu", "-", $string);
    }


    /**
     * Replace Hashtag, Mentions, Emoji
     * @param $string
     * @return null|string|string[]
     */
    function replace_data($string)
    {

        $string = trim($string);

        $string = nl2br($string);

        $patterns = array(
            "/:(.*?):/", // Emoji
            "/&gt;&gt;(\d*)/is", // Quotes Posts
            "/&gt;(.*)/i", // Self Quotes
            "/(\s|>|^)(https?:[^\s<]*)/is", // oEmebed
            "/\[code\](.*?)\[\/code\]/", // Code
            "/\[size=(.*?)\](.*?)\[\/size\]/is", // Size
            "/\[color=(.*?)\](.*?)\[\/color\]/is", // Colour
            "/\[b\](.*?)\[\/b\]/is", // Bold
            "/\[i\](.*?)\[\/i\]/is", // Italic
            "/\[u\](.*?)\[\/u\]/is", // Underline
            "/\[s\](.*?)\[\/s\]/is", // Strikes
            "/\[spoiler\](.*?)\[\/spoiler\]/is", // Spoiler
            "/\[img\](.*?)\[\/img\]/is", // Image
        );
        $replacements = array(
            "<i class=\"twa twa-2x twa_$1\" title=\"$0\"></i>", //Emoji
            "<a href='#$1' class='quote'>>> $1</a>", // Post Quotes
            "<span class='quotes'>&gt; $1</span>", // Self Quotes
            "$1<a href=\"$2\" id=\"embed\" class=\"embed-responsive embed-responsive-16by9\">$2</a>", // oEmebed
            "<pre><code>$1</code></pre>", // Code
            "<font size=\"$1\">$2</font>", // Size
            "<span style=\"color:$1;\">$2</span>", // Colour
            "<strong>$1</strong>", // Bold
            "<em>$1</em>", // Italic
            "<u>$1</u>", // Underline
            "<strike>$1</strike>", // Strike
            "<span class=\"spoiler\">$1</span>", // Spoiler
            "<img class=\"post-image img-responsive\" src=\"$1\" alt=\"$1\"/>", // Image
        );

        $string = preg_replace($patterns, $replacements, $string);

        return $string;
    }

}