<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
  protected $connection = 'mysql2';

  protected $table = 'patient';

  public function disability()
  {
    return $this->hasMany('App\Disability', 'hn', 'hn');
  }
}
