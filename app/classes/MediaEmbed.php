<?php
/**
 * Created by PhpStorm.
 * User: Waeyo
 * Date: 10/14/2018
 * Time: 4:10:53 PM
 */

class MediaEmbed
{
    /*
     * Sites
     */
    public function sites($video_id = null){
        /*
         * List of Sites and their embed code
         */
        //$sites = array();

        $sites = array(
            "youtube" => array(
                "website" => "https://www.youtube.com",
                "embed" => "https://www.youtube.com/embed/$video_id"
            ),
            "facebook" => array(
                "website" => "",
                "embed" => ""
            ),
            "twitter" => array(
                "website" => "https://twitter.com",
                "embed" => "https://twitter.com/i/status/1051651359789985792"
            ),
            "google+" => array(
                "website" => "",
                "embed" => ""
            ),
            "tumbler" => array(
                "website" => "",
                "embed" => ""
            ),
            "yahoo screen" => array(
                "website" => "",
                "embed" => ""
            ),
            "niconico" => array(
                "website" => "",
                "embed" => ""
            ),
        );

        return $sites;
    }

    /*
     * Parse and output Video
     */
    public function render($url)
    {

        if(empty($url)){
            return Response::json(["error" => true,"msg" => "no video url provided"]);
        }

        $get_url = parse_url($url);

        $scheme = $get_url["scheme"];
        $host = $get_url["host"];
        $query = explode("v=",$get_url["query"]);

        $video_id = ($query[1]) ? $query[1] : null;

        $website_url = "$scheme://$host";


        $site_list = $this->sites($video_id);

        $get_site = array_search($website_url,array_column($site_list, "website","embed"));

        print_r($get_site);

        //print_r($site_list[$get_site]);

        return false;
    }
}

