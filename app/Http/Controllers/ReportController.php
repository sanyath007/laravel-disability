<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Patient;

class ReportController extends Controller
{
	public function listByType()
	{
		return view('reports.list-type');
	}

	public function getListByType()
	{
		$year = $req->input('year');

        if (!empty($year)) {
            $disabilities   = Disability::where('year', $year)
                                ->with('doctorName')
                                ->orderBy('year', 'DESC')
                                ->orderBy('disability_no', 'DESC')
                                ->paginate(10);
        } else {
            $disabilities   = Disability::with('doctorName')
                                ->orderBy('year', 'DESC')
                                ->orderBy('disability_no', 'DESC')
                                ->paginate(10);
        }

        $types = DisabilityType::all();

        return [
            'disabilities'  => $disabilities,
            'types'         => $types
        ];
	}
}
