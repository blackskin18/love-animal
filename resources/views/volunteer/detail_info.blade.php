@extends('layouts.index')

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

    div.avatar-box{
        position: relative;
        margin-top: 15px;
        width: 175px;
        height: 175px;
        display: inline-block;
    }

    div.avatar-box>img{
        width: 100%;
        height: 100%;
    }

    div.avatar-box>div.button-edit-avatar{
        height: 30%;
        width: 100%;
        background-color: black;
        color: white;
        text-align: center;
        padding: 12px;
        opacity: 0.7;
        background-color: black;
        position: absolute;
        bottom: 0;
        display: none;
    }
    div.avatar-box:hover div.button-edit-avatar{
        display: block;
    }
    div.info-box{
        position: relative;
    }
    div.detail-info{
        /* padding-top: ; */
        margin-top:  15px;
        width: 80%;
        display: inline-block;
        position: absolute;
        top: 0;
        left: 200px;
        margin-left: 10px;

    }
    table>tbody>tr>td{
        text-align: center;
    }
    table>tbody>tr>td:nth-of-type(1){
        color: rgb(144, 148, 156);
        text-align: left;
    }
    table>tbody>tr>td:nth-of-type(2){
        color: black;
        font-weight: bold;
    }
    div.detail-info>span{
        color: rgb(144, 148, 156);
    }
    
    div.log-box{
        width: 82%;
        position: absolute;
        top: 0;
        left: 200px;
        float: right;
    }
    div.log-box>div.log-content{
        width: 100%;
        height: 500px;
        border: 1px solid red;
        display: none;
    }

    div.button-show-log{
        position: fixed;
        top: 100px;
        right: 0;
    }
</style>
@endsection

@section('content')
<div class="container info-box">
    <div class="avatar-box">
        <img src="https://scontent.fhan2-3.fna.fbcdn.net/v/t1.0-9/20638091_757607134419193_4430446300429056495_n.jpg?oh=0b027c93edb08c6f14ca9f008eb4ef66&oe=5A4040CF" alt="avatar">
        <div class="button-edit-avatar">
            <b> Đổi ảnh </b>
        </div>
    </div>
    <div class="detail-info" >
        <span>thông tin cơ bản</span>
        <table class="table">
            <tr>
                <td>Tên</td>
                <td>{{$user->name}}</td>
            </tr>
            <tr>
                <td>email</td>
                <td>{{$user->email}}</td>
            </tr>
            <tr>
                <td>giới tính</td>
                <td> 
                    @if( $user->gender == "G")
                        nữ
                    @elseif( $user->gender == "M" )
                        nam
                    @endif 
                </td>
            </tr>
            <tr>
                <td> số điện thoại</td>
                <td>{{$user->phone}}</td>
            </tr>
            <tr>
                <td> địa chỉ</td>
                <td>{{$user->address}}</td>
            </tr>
            <tr>
                <td>ghi chú</td>
                <td>{{$user->note}}</td>
            </tr>
        </table>
    </div>
    
    <div class="log-box">
        <div class="button-show-log">
            <button>
                nhật ký
            </button>
        </div>
        <div class="log-content">
            
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $(function () {
            $('div.button-show-log').click(function(){
                // alert('khanh');
                $('div.log-content').slideToggle( "slow");
            })
        });
    </script>
@endsection
