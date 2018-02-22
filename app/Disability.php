<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disability extends Model
{
  // Reverse relation of Doctor.
  public function doctorName()
  {
    return $this->belongsTo('App\Doctor', 'doctor', 'code');
  }

  // Reverse relation of DisabilityType.
  public function disabilityType()
  {
    return $this->belongsTo('App\DisabilityType', 'disability_type', 'disability_type_id');
  }

  // Reverse relation of Patient.
  public function patient()
  {
    return $this->belongsTo('App\Patient', 'hn', 'hn');
  }
}
