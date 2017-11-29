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
@extends('layouts.app')

@section('index')
<div style="padding: 0;margin: 0; width: 100%">
    <div class="menu">
        <nav>
            <ul>
                <li>
                    <a href="#">
                         <img src="{{ asset('icon/danhSach_64.png') }}" width="25" height="25"> Danh Sách Case
                    </a>
                    <ul class="drop-mneu">
                        <li><a href="/home" title="">Tất Cả</a></li>
                        <li><a href="/animal/list-in-common-home" title="">Nhà Chung</a></li>
                        <li><a href="/animal/list_ready_to_find_the_owner" title="">Tìm Chủ</a></li>
                        <li><a href="/animal/list_has_owner" title="">Đã Tìm Chủ</a></li>
                        <li><a href="/animal/list_die" title="">Đi Lạc/ Đã Chết</a></li>
                    </ul>
                </li>
                <li>
                    <a href="/hospital/list"> 
                    <img  src="{{ asset('icon/phongKham_64.png') }}" width="25" height="25">
                        Phòng Khám
                    </a>
                    @if($check_admin == 1)
                    <ul>
                        <li><a href="/hospital/list">Danh Sách</a></li>
                        <li><a href="/admin/create_hospital">Tạo Bệnh Viện</a></li>
                    </ul>
                    @endif
                </li>
                <li>
                    <a href="/volunteer/list">
                        <img  src="{{ asset('icon/TNV_64.png') }}" width="25" height="25">
                        Tình Nguyện Viên
                    </a>
                    
                    <ul>
                        <li><a href="/volunteer/list">Tất Cả</a></li>
                        <li><a href="/volunteer/list_owner">Chủ Nuôi</a></li>
                        @if($check_admin == 1)
                        <li>
                            <a href="/admin/create_user">Thêm Tài Khoản</a>
                        </li>
                        @endif

                    </ul>
                </li>
                <li>
                    <a href="/animal/list_image/all">
                        <img  src="{{ asset('icon/albumAnh_96.png') }}"  width="25" height="25">
                        Ảnh
                    </a>

                </li>
                <li>
                    <a href="/histories">
                        <img src="{{ asset('icon/lichSu_96.png') }}" width="25" height="25">
                        Lịch Sử Hoạt Động
                    </a>
                </li>
                @if($check_admin == 1)
                <li>
                    <a href="/admin/create_case">
                        <img src="{{ asset('icon/taoCase_64.png') }}"  width="25" height="25">
                        Tạo case
                    </a>
                </li>
                @endif

            </ul>
        </nav>
    </div>
    <div class="container1">
        @yield('content')
    </div>
</div>
<script src="{{ asset('/js/layouts/index.js') }}"></script>

@endsection
