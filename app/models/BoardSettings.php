<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class BoardSettings extends Eloquent{

	protected $table = "boards_settings";

	protected $fillable = ["name","board_id"];

	// Relationship Post
	public function boards(){
		return $this->belongsTo("Boards");
	}


}