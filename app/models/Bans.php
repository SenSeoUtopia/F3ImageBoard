<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Bans extends Eloquent
{

    protected $fillable = array("ip","reason");

    public static function check_ban($ip){

        return Bans::where("ip",$ip)->exists();

    }

}