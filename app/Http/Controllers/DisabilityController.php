<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Disability;
use App\DisabilityType;
use App\Patient;
use App\Doctor;

class DisabilityController extends Controller
{
    public function index()
    {
        $d  = Disability::orderBy('year', 'DESC')
                        ->orderBy('disability_no', 'DESC')
                        ->paginate(10);
        $types    = DisabilityType::all();

        return view('disability._list', [
            'disabilities' => $d,
            'types'   => $types
        ]);
    }

    public function getDisabilities(Request $req)
    {
        $disabilities   = Disability::orderBy('year', 'DESC')
                            ->orderBy('disability_no', 'DESC')
                            ->paginate(10);
        $types          = DisabilityType::all();

        return [
            'disabilities'  => $disabilities,
            'types'         => $types
        ];
    }

    public function create()
    {
        $types    = DisabilityType::all();
        $doctors  = Doctor::where(['active' => 'Y', 'position_id' => '1'])
                        ->whereNotIn('code', [168,158,157,007,734,685,625,528,529,530,531,532,533,534])->get();
        $month    = (int)date('m');
        $year     = (date('Y') + 543);

        if($month >= 10 && $month <= 12) {
        $year = $year + 1;
        }

        return view('disability._form', [
            'types'   => $types,
            'doctors' => $doctors,
            'year'    => $year,
        ]);
    }

    public function store(Request $req)
    {
        $this->validate($req, [
            'cboYear'             => 'bail|required',
            'txtCid'              => 'required',
            'txtName'             => 'required',
            'cboDisabilityType'   => 'required',
            'radDisabilityCause'  => 'required',
            'cboDoctor'           => 'required',
        ],[
            'cboYear.required' => ' The year field is required.',
            // 'cboYear.min' => ' The year must be at least 5 characters.',
            // 'cboYear.max' => ' The year may not be greater than 35 characters.',
            'txtCid.required' => ' The cid field is required.',
            // 'txtCid.min' => ' The cid must be at least 5 characters.',
            // 'txtCid.max' => ' The cid may not be greater than 35 characters.',
            'txtName.required' => ' The name field is required.',
            // 'txtName.min' => ' The name must be at least 5 characters.',
            // 'txtName.max' => ' The name may not be greater than 35 characters.',
            'cboDisabilityType.required' => ' The disability type field is required.',
            // 'cboDisabilityType.min' => ' The disability must be at least 5 characters.',
            // 'cboDisabilityType.max' => ' The disability may not be greater than 35 characters.',
            'radDisabilityCause.required' => ' The disability cause field is required.',
            // 'radDisabilityCause.min' => ' The disability must be at least 5 characters.',
            // 'radDisabilityCause.max' => ' The disability may not be greater than 35 characters.',
            'cboDoctor.required' => ' The doctor field is required.',
            // 'cboDoctor.min' => ' The doctor must be at least 5 characters.',
            // 'cboDoctor.max' => ' The doctor may not be greater than 35 characters.',
        ]);

        $newd = new Disability();
        $newd->year               = $req['cboYear'];
        // $newd->disability_no      = $req['txtDisabilityNo'];
        $newd->hn                 = $req['txtHn'];
        $newd->name               = $req['txtName'];
        $newd->cid                = $req['txtCid'];
        $newd->disability_type    = $this->setDisabilityType2Str($req['cboDisabilityType']);
        $newd->disability_cause   = $req['radDisabilityCause'];
        $newd->cause_text        = $req['txtCuaseText'];
        $newd->disability_detail  = $req['txtDisabilityDetail'];
        $newd->doctor             = $req['cboDoctor'];
        $newd->disability_no      = $this->getAutoId($req['cboYear']);
        $newd->save();

        return redirect()->action('DisabilityController@index');
    }

    public function edit($id)
    {
        $d        = Disability::find($id);
        $types    = DisabilityType::all();
        $doctors  = Doctor::where(['active' => 'Y', 'position_id' => '1'])->get();
        $year     = (date('Y') + 543);

        return view('disability._edit', [
            'disability'  => $d,
            'types'       => $types,
            'doctors'     => $doctors,
            'year'        => $year,
        ]);
    }

    public function update(Request $req)
    {
        $this->validate($req, [
        // 'cboYear'             => 'bail|required',
        // 'txtCid'              => 'required',
        // 'txtName'             => 'required',
        'cboDisabilityType'   => 'required',
        'radDisabilityCause'  => 'required',
        'cboDoctor'           => 'required',
        ],[
            // 'cboYear.required' => ' The year field is required.',
            // 'cboYear.min' => ' The year must be at least 5 characters.',
        // 'cboYear.max' => ' The year may not be greater than 35 characters.',
            // 'txtCid.required' => ' The cid field is required.',
            // 'txtCid.min' => ' The cid must be at least 5 characters.',
        // 'txtCid.max' => ' The cid may not be greater than 35 characters.',
        // 'txtName.required' => ' The name field is required.',
            // 'txtName.min' => ' The name must be at least 5 characters.',
            // 'txtName.max' => ' The name may not be greater than 35 characters.',
        'cboDisabilityType.required' => ' The disability type field is required.',
            // 'cboDisabilityType.min' => ' The disability must be at least 5 characters.',
            // 'cboDisabilityType.max' => ' The disability may not be greater than 35 characters.',
        'radDisabilityCause.required' => ' The disability cause field is required.',
            // 'radDisabilityCause.min' => ' The disability must be at least 5 characters.',
            // 'radDisabilityCause.max' => ' The disability may not be greater than 35 characters.',
        'cboDoctor.required' => ' The doctor field is required.',
            // 'cboDoctor.min' => ' The doctor must be at least 5 characters.',
            // 'cboDoctor.max' => ' The doctor may not be greater than 35 characters.',
        ]);

        $editd                    = Disability::find($req['_id']);
        // $editd->year              = $req['cboYear'];
        // $editd->disability_no     = $req['txtDisabilityNo'];
        // $editd->hn                = $req['txtHn'];
        // $editd->name              = $req['txtName'];
        // $editd->cid               = $req['txtCid'];
        $editd->disability_type   = $this->setDisabilityType2Str($req['cboDisabilityType']);
        $editd->disability_cause  = $req['radDisabilityCause'];
        $editd->cause_text        = $req['txtCuaseText'];
        $editd->disability_detail = $req['txtDisabilityDetail'];
        $editd->doctor            = $req['cboDoctor'];
        $editd->save();

        return redirect()->action('DisabilityController@index');
    }

    public function destroy($id)
    {
        $d = Disability::find($id);
        $d->delete();

        return redirect()->action('DisabilityController@index');
    }

    private function getAutoId($year)
    {
        $d = Disability::where(['year' => $year])->limit(1)->offset(0)->orderBy('disability_no', 'DESC')->get();
        var_dump($d);
        if ($d->count() > 0) {
        $newid = $d[0]->disability_no + 1;
        } else {
        $newid = 1;
        }

        return $newid;
    }

    private function setDisabilityType2Str($data=[])
    {
        $str = '';
        if (count($data)) {
        for ($i=0; $i < count($data); $i++) {
            $str .= $data[$i];

            if (($i + 1) != count($data)) {
            $str .= ',';
            }
        }
        }

        return $str;
    }
}
