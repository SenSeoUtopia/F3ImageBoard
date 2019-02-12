<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Reports extends Eloquent{

    protected $table = "reports";

    /**
     * @var array
     */
    protected $fillable = ["post_id","reason"];

}