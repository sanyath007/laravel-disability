@extends('layouts.main')

@section('content')

    <div class="content" ng-controller="reportController" ng-init="getListType()">
        <div class="container-fluid" style="margin: 0 20px;">

            <ol class="breadcrumb">
                <li><a href="{{ url('/disabilities') }}"><i class="fa fa-home" aria-hidden="true"></i> หน้าหลัก</a></li>
                <li class="active">รายงานผู้พิการตามประเภท</li>
            </ol>

            <!-- /** ===== Filter ===== */ -->
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div style="display: flex; align-items: center;">
                                <label for="">ปีงบประมาณ :</label>
                                <div class="col-md-6">
                                    <input type="text" id="dtpYear" ng-model="dtpYear" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div style="display: flex; align-items: center;">
                                <label for="">ประเภทความพิการ :</label>
                                <div class="col-md-6">
                                    <select id="cboType" ng-model="cboType" class="form-control" ng-change="getListType()">
                                        <option value="">-- กรุณาเลือก --</option>
                                        @foreach($types as $type)
                                            <option value="{{ $type->disability_type_id }}">
                                                {{ $type->disability_type_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /** ===== Filter ===== */ -->

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 3%; text-align: center;">ลำดับ</slot></th>
                                    <th style="width: 8%; text-align: center;">เลขที่ใบรับรอง</th>
                                    <th>ชื่อ-สกุล</th>
                                    <th style="width: 10%; text-align: center;">เลขประจำตัวประชาชน</th>
                                    <th style="width: 20%; text-align: center;">ประเภทความพิการ</th>
                                    <th style="width: 20%; text-align: center;">ระบุความพิการ</th>
                                    <th style="width: 15%; text-align: center;">แพทย์ผู้ออกใบรับรอง</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="(index, disability) in disabilities">
                                    <td style="text-align: center;">@{{ index + 1 }}</td>
                                    <td style="text-align: center;">@{{ disability.year}}/@{{ disability.disability_no}}</td>
                                    <td>@{{ disability.name}}</td>
                                    <td style="text-align: center;">@{{ disability.cid}}</td>
                                    <td>
                                        <ul class="tags">
                                            <li ng-repeat="(index, dtype) in disability.disability_type" class="tag-list">
                                                @{{ renderType(dtype) }}
                                            </li>
                                        </ul>
                                    </td>
                                    <td>@{{ disability.disability_detail }}</td>
                                    <td>@{{ (disability.doctor_name) ? disability.doctor_name.name : '' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="row" ng-show="pager.last_page > 1">
                        <div class="col-md-4">
                            หน้า @{{ pager.current_page }} จาก @{{ pager.last_page }}
                        </div>
                        <div class="col-md-4" style="text-align: center;">
                            จำนวน @{{ pager.total }} รายการ
                        </div>
                        <div class="col-md-4">
                            <ul class="pagination pagination-sm pull-right" style="margin: 0;">
                                <li ng-if="pager.current_page !== 1">
                                    <a href="#" ng-click="getDataWithUrl($event, '{{ url('/disabilities/list') }}' + '?page=1', setDisabilities)" aria-label="Previous">
                                        <span aria-hidden="true">First</span>
                                    </a>
                                </li>
                            
                                <li ng-class="{'disabled': (pager.current_page==1)}">
                                    <a href="#" ng-click="getDataWithUrl($event, pager.prev_page_url, setDisabilities)" aria-label="Prev">
                                        <span aria-hidden="true">Prev</span>
                                    </a>
                                </li>

                                <!-- <li ng-repeat="i in debtPages" ng-class="{'active': pager.current_page==i}">
                                    <a href="#" ng-click="getDataWithUrl(pager.path + '?page=' +i)">
                                        @{{ i }}
                                    </a>
                                </li> -->

                                <!-- <li ng-if="pager.current_page < pager.last_page && (pager.last_page - pager.current_page) > 10">
                                    <a href="#" ng-click="pager.path">
                                        ...
                                    </a>
                                </li> -->

                                <li ng-class="{'disabled': (pager.current_page==pager.last_page)}">
                                    <a href="#" ng-click="getDataWithUrl($event, pager.next_page_url, setDisabilities)" aria-label="Next">
                                        <span aria-hidden="true">Next</span>
                                    </a>
                                </li>

                                <li ng-if="pager.current_page !== pager.last_page">
                                    <a href="#" ng-click="getDataWithUrl($event, '{{ url('/disabilities/list') }}' + '?page=' +pager.last_page, setDisabilities)" aria-label="Previous">
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
