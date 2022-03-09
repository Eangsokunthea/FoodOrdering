@extends('BackEnd.master')
@section('title')
    Home Page
@endsection

@section('content')
    <!-- /.card-header -->
    <div class="card-body">
        <h3 class="title_thongke text-center mb-3"><b>Thống kê đơn hàng doanh số</b></h3>
        <form autocomplete="off">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Từ ngày</label>
                        <input type="text" id="datepicker" class="form-control"><br>
                        <input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Đến ngày</label>
                        <input type="text" id="datepicker2" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Lọc theo</label>
                        <select class="dashboard-filter form-control select2" style="width: 100%;">
                            <option selected="selected">--Chọn--</option>
                            <option value="thang9">Trong tháng 9</option>
                            <option value="7ngay">7 ngày qua</option>
                            <option value="thangtruoc">tháng trước</option>
                            <option value="thangnay">tháng này</option>
                            <option value="365ngayqua">365 ngày qua</option>
                        </select>
                    </div>
                </div>
            </div>
        </form>
        <!-- /.col-md-6 -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="position-relative mb-4">
                        <canvas id="sales-chart" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-md-6 -->
    </div>
    <div class="col-md-12">
        <!-- <canvas id="chart" style="height: 250px;"></canvas> -->
        <div id="chart" style="height: 250px;"></div>
    </div>

@endsection