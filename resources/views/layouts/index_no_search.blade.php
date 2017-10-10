@extends('layouts.app_no_search')

@section('link-css')
    <style>
        div.menu{
            background-color: #E9EBEE;
            width: 15%;
            height: 600px;
            float: left;
        }
        div.menu div.list-case{
            width: 100%;
            margin-top: 20px;
            text-align: left ;
        }
        div.menu div.list-case>span{
            height: 30px;
        }
        div.menu div.list-case h3{
            color: #90949c;
            display: block;
            height: 17px;
            line-height: 17px;
            overflow: hidden;
        }
        div.menu div.list-case>a{
            /* border-top: 1px solid #333; */
            font-size: 15px;
            padding-left: 30px;
            text-decoration-line: none;
            color:  black;
        }
        div.menu div.list-case>a:hover{
            background-color: #FFFFFF;
        }
        div.menu>div:hover:not(.list-case){
            background-color: #ffffff;
        }
        div.menu>div{
            margin-left: 10px;
        }
        .container1{
            width: 85%;
            float: right;
        }
    </style>
@endsection
@section('index')
<div style="padding: 0;margin: 0; width: 100%">
    <div class="menu">
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
    <div class="container1">
        @yield('content')
    </div>
</div>
@endsection
