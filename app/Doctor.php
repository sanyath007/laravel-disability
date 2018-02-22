<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
  protected $connection = 'mysql2';

  protected $table = 'doctor';

  public function disability()
  {
    return $this->hasMany('App\Disability', 'code', 'doctor');
  }
}
