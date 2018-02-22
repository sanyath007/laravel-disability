@extends('layouts.main')

@section('content')
<div class="container">
  <div class="content">

    <ol class="breadcrumb">
      <li><a href="{{ url('/disabilities') }}"><i class="fa fa-home" aria-hidden="true"></i> หน้าหลัก</a></li>
      <li class="active">ทะเบียนผู้พิการ</li>
    </ol>

    <div class="row" style="margin-bottom: 10px;">
      <div class="col-md-12">
        <a href="{{ url('/disability/create') }}" class="btn btn-primary">
          <i class="fa fa-user-plus" aria-hidden="true"></i>
          ลงทะเบียนผู้พิการใหม่
        </a>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th style="text-align: center;">ลำดับ</slot></th>
                <th style="text-align: center;">เลขที่ใบรับรอง</th>
                <th style="text-align: center;">ชื่อ-สกุล</th>
                <th style="text-align: center;">เลขประจำตัวประชาชน</th>
                <th style="text-align: center;">ประเภทความพิการ</th>
                <th style="text-align: center;">ระบุความพิการ</th>
                <th style="text-align: center;">แพทย์ผู้ออกใบรับรอง</th>
                <th style="text-align: center;">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php $cx = 0; ?>
              @foreach($disabilities as $disability)
                <tr>
                  <td style="text-align: center;">{{++$cx}}</td>
                  <td style="text-align: center;">{{$disability->year}}/{{$disability->disability_no}}</td>
                  <td>{{$disability->name}}</td>
                  <td style="text-align: center;">{{$disability->cid}}</td>
                  <td>
                    <ul style="margin-left: 8px; padding: 0px;">
                      <?php $tmpTypes = explode(',', $disability->disability_type); ?>
                      @foreach ($types as $type)
                        @for ($i = 0; $i < count($tmpTypes); $i++)
                          <?php if ($type->disability_type_id==$tmpTypes[$i]) {
                            echo '<li>' . $type->disability_type_name . '</li>';
                            break;
                          } ?>
                        @endfor
                      @endforeach
                    </ul>
                  </td>
                  <td>{{$disability->disability_detail}}</td>
                  <td>{{$disability->doctorName->name}}</td>
                  <td style="text-align: center;">
                    <a href="{{url('disability/edit', ['id' => $disability->id])}}" class="btn btn-warning">
                      <i class="fa fa-edit" aria-hidden="true"></i>
                    </a>
                    <!-- <a href="{{url('disability/delete', ['id' => $disability->id])}}" class="btn btn-danger" onclick="return confirm('ยืนยันการลบข้อมูล ?')">
                      <i class="fa fa-times" aria-hidden="true"></i>
                    </a> -->
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div class="pagination"> {{ $disabilities->links() }} </div>

      </div>
    </div>
  </div>
</div>
@endsection
