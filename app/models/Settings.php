<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Settings extends Eloquent
{
    protected $table = "settings";

    protected $fillable = ["title","value"];

    public static function get_settings($setting){
        $result = self::where('title',$setting)->first();

        return $result->value ?? false;
    }

}