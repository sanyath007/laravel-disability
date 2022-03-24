<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Disability;
use App\DisabilityType;
use App\Patient;

class ReportController extends Controller
{
	public function listByType()
	{
		return view('reports.list-type', [
			'types'	=> DisabilityType::all()
		]);
	}

	public function getListByType(Request $req)
	{
		$year = $req->input('year');
		$type = $req->input('type');

		$disabilities = Disability::with('doctorName')
							->orderBy('year', 'ASC')
							->orderBy('disability_no', 'ASC');

        if (!empty($year)) {
            $disabilities->where('year', $year);
        }

		if (!empty($type)) {

		}

        return [
            'disabilities' 	=> $disabilities->get(),
			'types' 		=> DisabilityType::all(),
        ];
	}
}
