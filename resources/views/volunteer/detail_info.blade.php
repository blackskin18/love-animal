@extends('layouts.index_no_search')

@section('link-css')
    <link href="{{ asset('css/volunteer/detail_info.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="info-box">
    <input type="text" disabled hidden="" id="user_id" value="{{$user->id}}">
    <div class="avatar-box">
        <img src="https://scontent.fhan2-3.fna.fbcdn.net/v/t1.0-9/20638091_757607134419193_4430446300429056495_n.jpg?oh=0b027c93edb08c6f14ca9f008eb4ef66&oe=5A4040CF" alt="avatar">
        <div class="button-edit-avatar">
            <b> Đổi ảnh </b>
        </div>
        
    </div>
    <div class="button-show-log">
        <button class="btn btn-primary">
            nhật ký
        </button> <br>
        <button class="btn btn-primary">
            sửa thông tin cá nhân
        </button>
    </div>
    <div class="detail-info" >
        <span>thông tin cơ bản</span>
        <table class="table">
            <tr>
                <td>Tên</td>
                <td id="name-value">{{$user->name}}</td>
            </tr>
            <tr>
                <td>email</td>
                <td id="email-value">{{$user->email}}</td>
            </tr>
            <tr>
                <td>giới tính</td>
                <td id="gender-value"> 
                    @if( $user->gender == "G") 
                        <p>nữ</p>
                    @elseif( $user->gender == "M" )
                        <p>nam</p>
                    @endif 
                </td>
            </tr>
            <tr>
                <td> số điện thoại</td>
                <td id="phone-value">{{$user->phone}}</td>
            </tr>
            <tr>
                <td> địa chỉ</td>
                <td id="address-value">{{$user->address}}</td>
            </tr>
            <tr>
                <td>ghi chú</td>
                <td id="note-value">{{$user->note}}</td>
            </tr>
        </table>
    </div>
    <div class="log-box">
        <div class="log-content">
        </div>
    </div>

    <div class="edit-info-box">
        <div class="content">
            <span>thông tin cơ bản</span>
            <table class="table">
                <tr>
                    <td >Tên</td>
                    <td ><input type="text" class="form-edit" id="input-name"></td>
                </tr>
                <tr>
                    <td>email</td>
                    <td><input type="mail" class="form-edit" id="input-email"> </td>
                </tr>
                <tr>
                    <td>giới tính</td>
                    <td> 
                        <select name="" id="input-gender">
                            <option value="G">Nữ</option>
                            <option value="M">Nam</option>
                        </select>
                        <!-- <input type="text" class="form-edit" id="input-gender"> -->
                    </td>
                </tr>
                <tr>
                    <td> số điện thoại</td>
                    <td><input type="number" class="form-edit" id="input-phone"></td>
                </tr>
                <tr>
                    <td> địa chỉ</td>
                    <td><input type="text" class="form-edit" id="input-address"></td>
                </tr>
                <tr>
                    <td>ghi chú</td>
                    <td><input type="text" class="form-edit" id="input-note"></td>
                </tr>
            </table>
            <div class="row">
                <div class="col-md-2 col-md-offset-5">
                    <button class="btn btn-primary" id="submit-edit">
                        Gửi
                    </button>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
@section('script')
    <script>
        $(function () {
            $('div.button-show-log>button:first-of-type').click(function(){
                $('div.log-content').slideToggle( "slow");
            });
            var check = true;
            $('div.button-show-log>button:last-of-type').click(function(){
                if(check == true){
                    $('div.detail-info').slideToggle( "slow", function(){
                        $('div.edit-info-box').slideToggle( "slow");
                        $('input#input-name').val($('td#name-value').text());
                        $('input#input-email').val($('td#email-value').text());
                        $('input#input-phone').val($('td#phone-value').text());
                        $('input#input-address').val($('td#address-value').text());
                        $('input#input-note').val($('td#note-value').text());
                        if( $('select#gender-value').val() == "Nữ" ){
                            $('select#input-gender').val("G");
                        } else {
                            $('select#input-gender').val("M");
                        }
                        check = false;
                    });
                } else {
                    $('div.edit-info-box').slideToggle( "slow", function(){
                        $('div.detail-info').slideToggle( "slow");
                        check = true;
                    });
                }
            });

            $('button#submit-edit').click(function(){
                var data = {
                    'name'      : $('input#input-name').val(),
                    'email'     : $('input#input-email').val(),
                    'phone'     : $('input#input-phone').val(),
                    'address'   : $('input#input-address').val(),
                    'note'      : $('input#input-note').val(),
                    'gender'    : $('select#input-gender').val()
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        // 'accepts': 'application/json',
                    }
                });
                 $.ajax({
                    url: window.location.origin + "/volunteer/edit_info/" + $('input#user_id').val(),
                    dataType:'json',
                    async:false,
                    type:'post',
                    data:{
                        data,
                    },
                    success:function(data){
                        $('td#name-value').text(data.name);
                        $('td#email-value').text(data.enail);
                        $('td#phone-value').text(data.phone);
                        $('td#address-value').text(data.address);
                        $('td#note-value').text(data.note);
                        if(data.gender == "M"){
                            $('td#gender-value').text("Nữ");
                        } else {
                            $('td#gender-value').text("Nam");
                        }
                        $('div.edit-info-box').slideToggle( "slow", function(){
                            $('div.detail-info').slideToggle( "slow");
                            check = true;
                        });
                    },
                    error:function() {
                        alert('abc')
                    }
                });

            });

        });
    </script>
@endsection
