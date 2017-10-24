@extends('layouts.app_no_search')

@section('index')
<div class="col-lg-12">
    <div class="row">
        <div class="menu col-lg-2">
            <div class="list-case">
                <span><h3>danh sách</h3></span>
                <a href="/animal/list-in-common-home" style="display: block; width: 100%; height: 100%"><div> <span>nhà chung </span> </div> </a>
                <a href="#" style="display: block; width: 100%; height: 100%"><div> <span>TNV </span> </div> </a>
                <a href="/animal/list_ready_to_find_the_owner" style="display: block; width: 100%; height: 100%"><div> <span>Tìm Chủ </span> </div> </a>
                <a href="/animal/list_has_owner" style="display: block; width: 100%; height: 100%"><div> <span>Đã Tìm Chủ</span> </div> </a>
                <a href="/animal/list_die" style="display: block; width: 100%; height: 100%"><div> <span>đi lạc/ đã chết </span> </div> </a>
            </div>
            <div class="hospital">
                <a href="/hospital/list"><span><h3>phòng khám</h3></span></a>
            </div>
            <div class="volunteer">
                <a href='/volunteer/list'><span><h3>tình nguyện viên</h3></span></a>
            </div>
            <div class="owner">
               <span><h3>chủ nuôi</h3></span>
            </div>
            <div class="album">
                <span><h3>ảnh</h3></span>
            </div>
        </div>
        <div class="col-lg-10">
            @yield('content')
        </div>
    </div>
</div>
@endsection
