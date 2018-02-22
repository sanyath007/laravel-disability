<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DisabilityType extends Model
{
  public function disability()
  {
    return $this->hasMany('App\Disability', 'disability_type_id', 'disability_type');
  }
}
