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

          <form method="post" action="{{ url('/disability') }}" class="form-horizontal">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
              <label>ปีที่ลงทะเบียน <span style="color: red;">(ปีงบประมาณ)</span></label>
              <select class="form-control" id="cboYear" name="cboYear">                
                <option value="{{$year}}">{{ $year }}</option>                
              </select>
            </div>
            <!-- <div class="form-group">
              <label>เลขที่ใบรับรอง</label>
              <input type="text" class="form-control" id="txtDisabilityNo" name="txtDisabilityNo">
            </div> -->
            <div class="form-group">
                <label>HN <span style="color: red;">(ตัวเลข 7 ตัว)</span></label>

                <div class="input-group">
                    <input type="text" class="form-control" id="txtHn" name="txtHn" onkeypress="getPatientFromHn(this)">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-primary" id="btnSearch" data-toggle="modal" data-target="#myModal">
                            <i class="fa fa-search" aria-hidden="true"></i>
                            ค้นหา
                        </button>
                    </div>
                </div>
            </div>

            <div class="form-group">
              <label>เลขประจำตัวประชาชน</label>
              <input type="text" class="form-control" id="txtCid" name="txtCid">
            </div>

            <div class="form-group">
              <label>ชื่อ-สกุล</label>
              <input type="text" class="form-control" id="txtName" name="txtName">
            </div>
            
            <div class="form-group">
              <label>ประเภทความพิการ :</label>
              <div id="cause" class="input-group">

                @foreach ($types as $type)
                  <input type="checkbox" id="{{$type->disability_type_id}}" name="cboDisabilityType[]" value="{{$type->disability_type_id}}"> {{$type->disability_type_name}} <br>
                @endforeach

              </div>
            </div>
            <div class="form-group">
              <label>สาเหตุความบกพร่อง/พิการ :</label>
              <div id="disabilityCause" class="input-group">
                <input type="radio" name="radDisabilityCause" value="1"> พันธุกรรม
                <input type="radio" name="radDisabilityCause" value="2"> อุบัติเหตุ
                <input type="radio" name="radDisabilityCause" value="3"> โรคติดเชื้อ
                <input type="radio" name="radDisabilityCause" value="4"> โรคอื่นๆ
                <input type="radio" name="radDisabilityCause" value="5"> ไม่ทราบสาเหตุ
              </div>
            </div>
            <div id="causeText" class="form-group" style="display: none;">
              <label>สาเหตุความบกพร่อง/พิการจากโรคอื่นๆ</label>
              <input type="text" class="form-control" id="txtCuaseText" name="txtCuaseText">
            </div>
            <div class="form-group">
              <label>ระบุความพิการ</label>
              <textarea class="form-control" id="txtDisabilityDetail" name="txtDisabilityDetail" rows="5"></textarea>
            </div>
            <div class="form-group">
              <label>แพทย์ผู้ออกใบรับรอง</label>
              <select class="form-control selectpicker" id="cboDoctor" name="cboDoctor" data-live-search="true">
                <option value="">-- กรุณาเลือกแพทย์ --</option>
                @foreach ($doctors as $doctor)
                  <option value="{{$doctor->code}}">{{$doctor->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">
                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                บันทึก
              </button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">ข้อมูลผู้ป่วย</h4>
      </div>
      <div class="modal-body">
        <div class="spinner">
          <img src="{{ asset('/spinner.gif') }}" alt="Spinner loading...">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div id="popupMsg" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Information</h4>
            </div>
            <div class="modal-body">
                <p>
                    <div class="alert alert-info" role="alert">
                        <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                        เนื่องจากตอนนี้ได้เปลี่ยนเป็นงบประมาณ 2561 แล้ว กรุณาเลือกปีงบประมาณให้ถูกต้อง&hellip; !!!
                    </div>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
  var patients = '';
  var url = "{{ url('/patients') }}";
  var url2 = "{{ url('/patient') }}/";
  var param = "?name=";
  var cond = "";

  $(document).ready(function () {
   /* $('#popupMsg').modal('show');*/
  });

  $('#btnSearch').click(function(){
    getPatient(url);
  });

  $('#disabilityCause > input[type="radio"]').click(function() {
    if ($(this).val() == '4') {
      $('#causeText').show();
    } else {
      $('#causeText').hide();
    }
  });

  var getPatient = function(url){
    $(".spinner").show();
    $.getJSON(url, function(data) {
      console.log(data);
      patients = data.data;

      var html = '<div class="row" style="text-align: center;"><form class="form-inline">';
        html += '<div class="form-group">';
          html += '<label for="">ชื่อผู้ป่วย  :</label> ';
          html += '<input type="text" id="searchPt" name="searchPt" value="" class="form-control"> ';
          html += '<button type="button" id="btnSearchPt" name="btnSearchPt" class="btn btn-primary" onclick="searchPatient()">ค้นหา</button>';
        html += '</div>';
      html += '</form></div><hr />';

      html += '<div class="table-responsive">';
      html += '<table class="table table-hover">';
      html += '<thead><tr><th>HN</th><th>CID</th><th>ชื่อ-สกุล</th><th>Actions</th></tr></thead>';
      html += '<tbody>';

      $.each(data.data, function(index,value){
        html += '<tr><td>' +value.hn+ '</td>';
        html += '<td>' +value.cid+ '</td>';
        html += '<td>' +value.pname+value.fname+ '  ' +value.lname+ '</td>';
        html += '<td class="actions">';
          html += '<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="selectedPatient(' +index+ ');">';
            html += '<i class="fa fa-user-plus" aria-hidden="true"></i> เลือก';
          html += '</button>';
        html += '</td></tr>';
      });

      html += '</tbody></table></div>';

      html += setPagination(data);

      $('#myModal .modal-body').html(html);
      $(".spinner").hide();
    });
  }

  var setPagination = function(pager){
    var html = "";
    var pages = pager.current_page + 5;

    if(pager.last_page > 1){
      html += '<ul class="pagination">';
      html += '<li class="' +((pager.current_page == 1) ? "disabled" : "")+ '">';
        html += '<a href="' +url+param+cond+ '&page=1" onclick="paginationLink(this)">First</a>';
      html += '</li>';
        html += '<li class="' +((pager.current_page == 1) ? "disabled" : "")+ '">';
          html += '<a href="' +url+param+cond+ '&page=' +(pager.current_page - 1)+ '" onclick="paginationLink(this)">Previous</a>';
        html += '</li>';

        if(pages < pager.last_page){
          for (i = pager.current_page;i <= pages;i++)
          {
            html += '<li class="' +((pager.current_page == i) ? "active" : "")+ '">';
              html += '<a href="' +url+param+cond+ '&page=' +i+ '" onclick="paginationLink(this)">' +i+ '</a>';
            html += '</li>';
          }
        }

        html += '<li class="' +((pager.current_page == pager.last_page) ? "disabled" : "")+ '">';
          html += '<a href="' +url+param+cond+ '&page=' +(pager.current_page + 1)+ '" onclick="paginationLink(this)">Next</a>';
        html += '</li>';

        html += '<li class="' +((pager.current_page == pager.last_page) ? "disabled" : "")+ '">';
          html += '<a href="' +url+param+cond+ '&page=' +pager.last_page+ '" onclick="paginationLink(this)">Last</a>';
        html += '</li>';
      html += '</ul>';
    }

    return html;
  }

  var paginationLink = function(link){
    event.preventDefault();
    event.stopPropagation();

    getPatient($(link).attr('href'));
  }

  var selectedPatient = function(index){
    if($('#txtCid').val()==''){
      $('#txtCid').val(patients[index].cid);
    }

    $('#txtHn').val(patients[index].hn);
    $('#txtName').val(patients[index].pname+patients[index].fname+ '  ' +patients[index].lname);
  };

  var searchPatient = function(){
    cond = $('#searchPt').val();
    console.log(url+ param + cond);
    getPatient(url+ param + cond);
  }

    var getPatientFromHn = function (txtHn) {
        let hn = $(txtHn).val();

        if (event.keyCode == 13) {
            event.preventDefault();
            console.log(url2 + hn);

            $.get(url2 + hn, function(res) {
                console.log(res);
                $('#txtCid').val(res.cid);
                $('#txtHn').val(res.hn);
                $('#txtName').val(res.pname + res.fname + '  ' + res.lname);
            });
        }    
    }

    $('.selectpicker').selectpicker({
      size: 10
    });

</script>
@endsection
