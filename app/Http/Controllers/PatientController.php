<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Patient;

class PatientController extends Controller
{
  	public function index ()
  	{
	    if(empty(Input::get('name'))){
	      	$patients = Patient::paginate(10);
	    }else{
	    	$fullname = explode(' ', Input::get('name'));

	    	if (count($fullname) > 1) {
	      		$patients = Patient::where('fname', 'like', '%' .$fullname[0]. '%')
	      							->where('lname', 'like', '%' .$fullname[1]. '%')
	      							->paginate(10);
	    	} else {
	    		$patients = Patient::where('fname', 'like', '%' .Input::get('name'). '%')
	    							->paginate(10);
	    	}
	    }

	    return $patients;
  	}

  	public function findByHn ($hn)
  	{
    	return Patient::where(['hn' => $hn])->first();
  	}
}
