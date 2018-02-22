@extends('layouts.main')

@section('content')
<div class="container">
  <div class="content">

    <ol class="breadcrumb">
      <li><a href="{{ url('/disabilities') }}"><i class="fa fa-home" aria-hidden="true"></i> หน้าหลัก</a></li>
      <li class="active">แบบบันทึกผู้พิการ</li>
    </ol>

    <?php //var_dump($errors->all()); ?>
    @if (count($errors) > 0)
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="container">
      <div class="row">
        <div class="col-md-10 col-md-offset-1">

          <form method="post" action="{{url('disability/update')}}" class="form-horizontal">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" value="{{$disability->id}}" id="_id" name="_id">

            <div class="form-group">
              <label>ปีที่ลงทะเบียน</label>
              <select class="form-control" id="cboYear" name="cboYear" readonly>
                <option value="">-- กรุณาเลือก --</option>
                @for($y=($year - 3); $y <= $year; $y++)
                  <option value="{{$disability->year}}" {{(($disability->year==$y) ? 'selected' : '')}}>{{ $y }}</option>
                @endfor
              </select>
            </div>
            <!-- <div class="form-group">
              <label>เลขที่ใบรับรอง</label>
              <input type="text" value="{{$disability->disability_no}}" class="form-control" id="txtDisabilityNo" name="txtDisabilityNo">
            </div> -->
            <div class="form-group">
              <label>เลขประจำตัวประชาชน</label>
              <input type="text" value="{{$disability->cid}}" class="form-control" id="txtCid" name="txtCid" readonly>
            </div>
            <div class="form-group">
              <label>ชื่อ-สกุล</label>
              <input type="text" value="{{$disability->name}}" class="form-control" id="txtName" name="txtName" readonly>
            </div>
            <div class="form-group">
              <label>HN</label>
              <input type="text" value="{{$disability->hn}}" class="form-control" id="txtHn" name="txtHn" readonly>
            </div>
            <div class="form-group">
              <label>ประเภทความพิการ :</label>
              <div id="cause" class="input-group">

                <?php $tmpTypes = explode(',', $disability->disability_type); ?>
                @foreach ($types as $type)
                  <?php $tmpChecked = ''; ?>
                  @for ($i = 0; $i < count($tmpTypes); $i++)
                    <?php if ($type->disability_type_id==$tmpTypes[$i]) {
                      $tmpChecked = 'checked';
                      break;
                    } ?>
                  @endfor

                  <input  type="checkbox"
                          id="{{$type->disability_type_id}}"
                          name="cboDisabilityType[]"
                          value="{{$type->disability_type_id}}" <?=$tmpChecked?>> {{$type->disability_type_name}} <br>
                @endforeach

              </div>
            </div>
            <div class="form-group">
              <label>สาเหตุความบกพร่อง/พิการ :</label>
              <div id="disabilityCause" class="input-group">
                <input type="radio" id="radDisabilityCause" name="radDisabilityCause" value="1" {{ (($disability->disability_cause=='1') ? 'checked' : '') }}> พันธุกรรม
                <input type="radio" id="radDisabilityCause" name="radDisabilityCause" value="2" {{ (($disability->disability_cause=='2') ? 'checked' : '') }}> อุบัติเหตุ
                <input type="radio" id="radDisabilityCause" name="radDisabilityCause" value="3" {{ (($disability->disability_cause=='3') ? 'checked' : '') }}> โรงติดเชื้อ
                <input type="radio" id="radDisabilityCause" name="radDisabilityCause" value="4" {{ (($disability->disability_cause=='4') ? 'checked' : '') }}> โรคอื่นๆ
                <input type="radio" id="radDisabilityCause" name="radDisabilityCause" value="5" {{ (($disability->disability_cause=='5') ? 'checked' : '') }}> ไม่ทราบสาเหตุ
              </div>
            </div>
            <div class="form-group" style="display: none;" id="causeText">
              <label>สาเหตุความบกพร่อง/พิการจากโรคอื่นๆ</label>
              <input type="text" value="{{$disability->cause_text}}" class="form-control" id="txtCuaseText" name="txtCuaseText">
            </div>
            <div class="form-group">
              <label>ระบุความพิการ</label>
              <textarea class="form-control" id="txtDisabilityDetail" name="txtDisabilityDetail" rows="5">{{$disability->disability_detail}}</textarea>
            </div>
            <div class="form-group">
              <label>แพทย์ผู้ออกใบรับรอง</label>
              <select class="form-control" id="cboDoctor" name="cboDoctor">
                <option value="">-- กรุณาเลือก --</option>
                @foreach ($doctors as $doctor)
                  <option value="{{$doctor->code}}" {{(($doctor->code==$disability->doctor) ? 'selected' : '')}}>
                    {{$doctor->name}}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                แก้ไข
              </button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    console.log('on ready...');
    if ($('#disabilityCause > input[type="radio"]:checked').val() == '4'){
      $('#causeText').show();
    } else {
      $('#causeText').hide();
    }
  });

  $('#disabilityCause > input[type="radio"]').click(function() {
    if ($(this).val() == '4') {
      $('#causeText').show();
    } else {
      $('#causeText').hide();
    }
  });
</script>
@endsection
