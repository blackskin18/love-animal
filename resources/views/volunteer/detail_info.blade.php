@extends('layouts.index_no_search')

@section('link-css')
    <link href="{{ asset('css/volunteer/detail_info.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="info-box">
    <input type="text" disabled hidden="" id="user_id" value="{{$user->id}}">
    <div class="avatar-box">
        @if($user->avatar)
            <img src="{{ asset('avatar/'.$user->id.'/'.$user->avatar) }}" alt="avatar">
        @else
            <img src="{{ asset('avatar/default_avatar/default_avatar.png') }}" alt="avatar">
        @endif
        @if($user->id == Auth::user()->id OR $level <= 3)
            <div class="button-edit-avatar">
                <b> Đổi ảnh </b>
                <form action="/volunteer/change-avatar/{{$user->id}}" enctype="multipart/form-data" id="change-avatar-form" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="file" id="change-avatar-input" name="photo" title="thay ảnh" style="position: absolute; top:0; left:0; margin: 0px; padding: 0px; cursor: pointer; opacity: 0; height: 100%; width: 100%">
                    </div>  
                </form>
            </div>
        @endif
    </div>
    <div class="button-show-log">
        <button id="button-show-log" class="btn btn-primary">
            nhật ký
        </button> <br>
        @if($user->id == Auth::user()->id OR $level <= 3)
            <button id="button-show-edit" class="btn btn-primary">
                sửa thông tin cá nhân
            </button>
        @endif
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
            <tr>
                <td>Quyền</td>
                <td id="note-value">
                    @foreach($user_roles as $user_role)
                        {{$user_role->role->role_description}} <br>
                    @endforeach

                </td>
            </tr>
        </table>
    </div>
   
    @if($user->id == Auth::user()->id OR $level <= 3)
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
        @endif
        @if($level<=3)
                    <tr>
                        <td>Sửa Quyền</td>
                        <td>
                            <div class="col-sm-8" style="padding: 0">
                                <select name="level[]" multiple id="user_roles" class="form-control">
                                    <option value="">-------chọn kiểu người dùng-----</option>
                                    @foreach($role_infos as $role_info)
                                        <option value="{{$role_info->id}}">{{$role_info->role_description}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                    </tr>
        @endif
        @if($user->id == Auth::user()->id OR $level <= 3)
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
    @endif
    <div class="log-box">
        <div class="log-content">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Ngày thay đổi</th>
                        <th>Người Dùng</th>
                        <th>Ghi Chú</th>
                        <th>Trước khi thay Đổi</th>
                        <th>Sau khi thay đổi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($histories as $key => $history)
                    <tr>
                        <td>{{$history->created_at}}</td>
                        <td>
                            <a href="{{ '/volunteer/info/'.$history->user_id }}">
                                {{$history->user->name}}
                            </a>
                        </td>
                        <td>{{$history->note}}</td>
                        <td>
                            @if ($history->attribute == 'image')
                            <img src="{{ asset('animal_image/'.$history->animal_id.'/'.$history->old_value) }}" width="75" height="50" alt="">
                            @elseif ($history->attribute == 'place' and $history->old_value == 'volunteer')
                                <a href="/volunteer/info/{{ $history->old_value_place->foster->id }}">
                                    {{ $history->old_value_place->foster->name }}
                                </a> 
                                <br>
                                {{ $history->old_value_place->note  }}
                            @elseif ($history->attribute == 'place' and $history->old_value == 'hospital')
                                <a href="/hospital/detail_info/{{ $history->old_value_place->hospital->id }}">
                                    {{ $history->old_value_place->hospital->name }}
                                </a> <br>
                                {{ $history->old_value_place->note }}
                            @elseif ($history->attribute == 'place' and $history->old_value == 'commonHome')
                                    Nhà Chung
                            @else
                                {{$history->old_value}}
                            @endif
                        </td>
                        <td>
                            @if ($history->attribute == 'image')
                            <img src="{{ asset('animal_image/'.$history->animal_id.'/'.$history->new_value) }}" width="75" height="50" alt="">
                            @elseif ($history->attribute == 'place' and $history->new_value == 'volunteer')
                                <a href="/volunteer/info/{{ $history->new_value_place->foster->id }}">
                                    {{ $history->new_value_place->foster->name }}
                                </a> 
                                <br>
                                {{ $history->new_value_place->note  }}
                            @elseif ($history->attribute == 'place' and $history->new_value == 'hospital')
                                <a href="/hospital/detail_info/{{ $history->new_value_place->hospital->id }}">
                                    {{ $history->new_value_place->hospital->name }}
                                </a> <br>   
                                {{ $history->new_value_place->note }}
                            @elseif ($history->attribute == 'place' and $history->new_value == 'commonHome')
                                    Nhà Chung
                            @else
                                {{$history->new_value}}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src = "{{ asset('js/volunteer/detail_info.js') }}"></script>
@endsection
