<?php

namespace awase;

use Illuminate\Database\Eloquent\Model;

class Privilages extends Model
{
    //
    protected $table = "privilages";
    protected $primaryKey = "id";
    protected $fillable = array(
      'name'
    );



    public $timestamps = false;
}
