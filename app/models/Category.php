<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Category extends Eloquent{

protected $table = "categories";

// Relationship Photos
public function boards(){
return $this->hasOne("Boards");
}

}