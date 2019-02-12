<?php

class Form
{

    /*
     * Select box
     */
    public static function select($id,$options,$default)
    {
        return false;
    }


    /*
     * Create Input Buttons
     */
    public static function input($type = 'input',$name,$value)
    {
        $html = "";
        switch ($type)
        {
            case 'input':
                $html .= "<input type=\"text\" name=\"$name\" value=\"$value\">";
                break;
            case 'radio':
                $html .= "<input type=\"checkbox\" name=\"$name\" value=\"$value\">";
                break;
            case 'checkbox':
                $html .= "<input type=\"checkbox\" name=\"$name\" value=\"$value\">";
                break;
            case 'textarea':
                $html .= "<textarea name=\"$name\">$value</textarea>";
                break;
            case 'button':
                $html .= "<button type=\"button\" name=\"$name\">$value</button>";
                break;
            case 'submit':
                $html .= "<button type=\"submit\" name=\"$name\">$value</button>";
                break;
        }

        return $html;
    }

    /*
     * Create Buttons
     */
    public static function submit($value = "Submit",$class = [])
    {
        return self::input("sumbit",$value);
    }
}
