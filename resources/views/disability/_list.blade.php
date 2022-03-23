@extends('layouts.main')

@section('content')

    <div class="container" ng-controller="disabilityController" ng-init="search()">
        <div class="content">

            <ol class="breadcrumb">
                <li><a href="{{ url('/disabilities') }}"><i class="fa fa-home" aria-hidden="true"></i> หน้าหลัก</a></li>
                <li class="active">ทะเบียนผู้พิการ</li>
            </ol>

            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-6">
                    <div style="display: flex; align-items: center;">
                        <label for="">ปีงบประมาณ :</label>
                        <div class="col-md-4">
                            <input type="text" id="cboYear" ng-model="cboYear" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <a href="{{ url('/disability/create') }}" class="btn btn-primary pull-right">
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
                                <th>ชื่อ-สกุล</th>
                                <th style="text-align: center;">เลขประจำตัวประชาชน</th>
                                <th style="text-align: center;">ประเภทความพิการ</th>
                                <th style="text-align: center;">ระบุความพิการ</th>
                                <th>แพทย์ผู้ออกใบรับรอง</th>
                                <th style="text-align: center;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="(index, disability) in disabilities">
                                    <td style="text-align: center;">@{{ pager.from + index }}</td>
                                    <td style="text-align: center;">@{{ disability.year}}/@{{ disability.disability_no}}</td>
                                    <td>@{{ disability.name}}</td>
                                    <td style="text-align: center;">@{{ disability.cid}}</td>
                                    <td>
                                    <ul style="margin-left: 8px; padding: 0px;">
                                        @{{ disability.disability_type }}
                                        
                                    </ul>
                                    </td>
                                    <td>@{{  disability.disability_detail }}</td>
                                    <td>@{{ (disability.doctorName) ? disability.doctorName.name : '' }}</td>
                                    <td style="text-align: center;">
                                        <a
                                            href="{{ url('disability/edit', ['id' => '']) }}"
                                            class="btn btn-warning"
                                        >
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                        </a>
                                    <!-- <a href="{{url('disability/delete', ['id' =>  ''])}}" class="btn btn-danger" onclick="return confirm('ยืนยันการลบข้อมูล ?')">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </a> -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            หน้า @{{ pager.current_page }} จาก @{{ pager.last_page }}
                        </div>
                        <div class="col-md-4" style="text-align: center;">
                            จำนวน @{{ pager.total }} รายการ
                        </div>
                        <div class="col-md-4">
                            <ul class="pagination pagination-sm no-margin pull-right" ng-show="pager.last_page > 1">
                                <li ng-if="pager.current_page !== 1">
                                    <a href="#" ng-click="getDataWithURL($event, pager.path+ '?page=1', setLeaves)" aria-label="Previous">
                                        <span aria-hidden="true">First</span>
                                    </a>
                                </li>
                            
                                <li ng-class="{'disabled': (pager.current_page==1)}">
                                    <a href="#" ng-click="getDataWithURL($event, pager.prev_page_url, setLeaves)" aria-label="Prev">
                                        <span aria-hidden="true">Prev</span>
                                    </a>
                                </li>

                                <!-- <li ng-repeat="i in debtPages" ng-class="{'active': pager.current_page==i}">
                                    <a href="#" ng-click="getDataWithURL(pager.path + '?page=' +i)">
                                        @{{ i }}
                                    </a>
                                </li> -->

                                <!-- <li ng-if="pager.current_page < pager.last_page && (pager.last_page - pager.current_page) > 10">
                                    <a href="#" ng-click="pager.path">
                                        ...
                                    </a>
                                </li> -->

                                <li ng-class="{'disabled': (pager.current_page==pager.last_page)}">
                                    <a href="#" ng-click="getDataWithURL($event, pager.next_page_url, setLeaves)" aria-label="Next">
                                        <span aria-hidden="true">Next</span>
                                    </a>
                                </li>

                                <li ng-if="pager.current_page !== pager.last_page">
                                    <a href="#" ng-click="getDataWithURL($event, pager.path+ '?page=' +pager.last_page, setLeaves)" aria-label="Previous">
                                        <span aria-hidden="true">Last</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- /.row -->

                </div>
            </div>
        </div>
    </div>

@endsection
