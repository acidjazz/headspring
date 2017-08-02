<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Employee extends \Moloquent
{

  use SoftDeletes;

  protected $collection = 'employee';
  protected $primaryKey = '_id';

  protected $fillable = [ 'first_name', 'last_name', 'job title', 'location', 'email' ];

  protected $dateFormat = 'c';

  protected $dates = ['deleted_at'];

  /*
  public function phones()
  {
    return $this->hasmany('App\Models\Phone', 'employee.id', '_id');
  }
   */

}
