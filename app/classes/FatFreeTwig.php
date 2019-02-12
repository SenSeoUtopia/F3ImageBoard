<?php
/**
 * Created by PhpStorm.
 * User: Waeyo
 * Date: 5/6/2018
 * Time: 1:29 AM
 */

class FatFreeTwig extends Twig_Extension implements Twig_Extension_GlobalsInterface
{

    public function getGlobals()
    {
        $f3 = Base::instance();
        $home_url = $f3->get('SCHEME') . '://' . $f3->get('HOST') . $f3->get('BASE');

        $get_auth = $f3->get('SESSION.user');

        $logged_in = false;
        $users = false;

        if ($get_auth) {

            $logged_in = true;

            $users = $get_auth;

        }

        /* Set Boards List */
        $board_list = Boards::all();

        return array(
            "site_title" => $f3->get('site_title'),
            "active_menu" => $f3->get('PATH'),
            "home_url" => $home_url,
            "current_style" => $f3->exists('COOKIE.style') ? $f3->get('COOKIE.style') : 'style',
            "recaptcha_key" => $f3->get("recaptcha_key"),
            "enable_recaptcha" => $f3->get('enable_recaptcha'),
            "Form" => new Form,
            "logged_in" => $logged_in,
            "users" => $users,
            "board_list" => $board_list
        );

    }

    /*
     * Register Functions
     */
    public function getFunctions()
    {
        return array(
            new Twig_Function('formatSizeUnits', formatSizeUnits($value = null)),
        );
    }

    /*
     * Filters
     */
    public function getFilters()
    {
        return array(
            new Twig_Filter('replace_data', array(Helper::instance(), 'replace_data')),
        );
    }
}