<?php 
    $user_id = Auth::user()->id;
    $user_roles = App\UserRole::where('user_id', $user_id)->get();
    $check_admin = 0;
    foreach ($user_roles as $key => $user_role) {
        if($user_role->role_id <= 3){
            $check_admin = 1;
        }
    }
?>
@extends('layouts.app_no_search')

@section('index')
<div class="col-lg-12">
    <div class="row">
        <div class="menu">
            <div class="list-case">
                <div>
                    <div style="display: inline-block; margin-left: 10px">
                        <img src="{{ asset('icon/danhSach_64.png') }}" width="35" height="35">
                    </div >
                    <div style="display: inline-block;">
                        <h3 style="margin:0;display: inline-block; position: absolute; top:23px">Danh Sách</h3>
                    </div>
                </div>
                <a class="atag_index" href="/home" style="display: block; width: 100%; height: 100%"><div> <span>Tất Cả </span> </div> </a>
                <a class="atag_index" href="/animal/list-in-common-home" style="display: block; width: 100%; height: 100%"><div> <span>Nhà Chung </span> </div> </a>
                <a class="atag_index" href="/animal/list_ready_to_find_the_owner" style="display: block; width: 100%; height: 100%"><div> <span>Tìm Chủ </span> </div> </a>
                <a class="atag_index" href="/animal/list_has_owner" style="display: block; width: 100%; height: 100%"><div> <span>Đã Tìm Chủ</span> </div> </a>
                <a class="atag_index" href="/animal/list_die" style="display: block; width: 100%; height: 100%"><div> <span>Đi Lạc/ Đã Chết </span> </div> </a>
            </div>
            <div class="hospital">
                <div style="display: inline-block; margin-left: 10px">
                    <img src="{{ asset('icon/phongKham_64.png') }}" width="35" height="35">
                </div >
                <div style="display: inline-block;">
                    <a class="atag_index" href="/hospital/list"><span><h3>Phòng Khám</h3></span></a>
                </div>
            </div>
            @if($check_admin == 1)
            <div >
                <div style="height: 21px; margin-left: 35px">
                    <a class="atag_index" href="/admin/create_hospital"><span><h3 style="margin: 0">Tạo Bệnh Viện</h3></span></a>
                </div>
            </div>
            @endif


            <div class="volunteer">
                <a class="atag_index" class="khanh" href='/volunteer/list'><div>
                    <div style="display: inline-block; margin-left: 10px">
                        <img src="{{ asset('icon/TNV_64.png') }}" width="35" height="35">
                    </div >
                    <div style="display: inline-block;">
                        <span style="font-weight: normal; font-size: 15px"> Tình Nguyện Viên</span> </div>
                    </div>
                </a>
            </div>
            <div >
                <div style="height: 21px; margin-left: 35px">
                    <a class="atag_index" href="/volunteer/list_owner"><span><h3 style="margin: 0">Chủ Nuôi</h3></span></a>
                </div>
            </div>

            @if($check_admin == 1)
            <div >
                <div style="height: 21px; margin-left: 35px">
                    <a class="atag_index" href="/admin/create_user"><span><h3 style="margin: 0">Thêm Tài Khoản</h3></span></a>
                </div>
            </div>
            @endif

            <div class="album">
                <div style="display: inline-block; margin-left: 10px">
                    <img src="{{ asset('icon/albumAnh_96.png') }}" width="35" height="35">
                </div >
                <div style="display: inline-block;">
                    <a class="atag_index" href="/animal/list_image/all">
                        <span><h3>Ảnh</h3></span>
                    </a>
                </div>  
            </div>
            <div class="histories">
                 <div style="display: inline-block; margin-left: 10px">
                    <img src="{{ asset('icon/lichSu_96.png') }}" width="35" height="35">
                </div >
                <div style="display: inline-block;">
                    <a class="atag_index" href="/histories">
                        <span><h3>Lịch sử hoạt động</h3></span>
                    </a>
                </div>  
            </div>
            @if($check_admin == 1)
                <div class="owner">
                     <div style="display: inline-block; margin-left: 10px">
                        <img src="{{ asset('icon/taoCase_64.png') }}" width="35" height="35">
                    </div >
                    <div style="display: inline-block;">
                        <a class="atag_index" href="/admin/create_case"><span><h3>Tạo Case</h3></span></a>
                    </div>  
                </div>
            @endif
        </div>

        <div class="col-sm-10">
            @yield('content')
        </div>
    </div>
</div>
@endsection
