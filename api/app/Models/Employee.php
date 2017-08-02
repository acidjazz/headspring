<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Employee extends \Moloquent
{

  use SoftDeletes;

  protected $collection = 'employee';
  protected $primaryKey = '_id';
  protected $fillable = [ 'firstname', 'lastname', 'title', 'address', 'email' ];
  protected $dateFormat = 'c';
  protected $dates = ['deleted_at'];

  /*
  public function phones()
  {
    return $this->hasmany('App\Models\Phone', 'employee.id', '_id');
  }
   */

}
