@extends('layouts.index_no_search')

@section('link-css')
    <link href="{{ asset('css/volunteer/detail_info.css') }}" rel="stylesheet">
@endsection

@section('content')
	<div class="row">
		<div class="col-sm-5 col-sm-offset-4">
			<h2>
				Thêm bệnh vện mới
			</h2>
		</div>
	</div>

	<div class="row" style="margin-top: 40px">
		<div class="col-sm-6 col-sm-offset-2">
			@if (count($errors) > 0)
				<div class="alert alert-danger">
		          	<h4> error!!! </h4>
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
		    @endif
			<form action="/admin/post/create_hospital" method="POST" class="form-horizontal">
                {{ csrf_field() }}

			  	<div class="form-group">
			    	<label class="control-label col-sm-3" for="email">Tên Bệnh Viện:</label>
		    		<div class="col-sm-9">
			      		<input type="text" name="name" class="form-control" placeholder="Nhập tên bệnh viện">
			    	</div>
			  	</div>
				<div class="form-group">
			    	<label class="control-label col-sm-3" for="email">Số điện thoại</label>
		    		<div class="col-sm-9">
			      		<input type="text" name="phone" class="form-control" placeholder="Nhập số điện thoại">
			    	</div>
			  	</div>
			  	<div class="form-group">
			    	<label class="control-label col-sm-3" for="email">Địa chỉ</label>
		    		<div class="col-sm-9">
			      		<input type="text" name="address" class="form-control" placeholder="Nhập địa chỉ">
			    	</div>
			  	</div>
			  	<div class="form-group">
			    	<label class="control-label col-sm-3" for="email">Ghi chú</label>
		    		<div class="col-sm-9">
			      		<input type="text" name="note" class="form-control" placeholder="Nhập ghi chú">
			    	</div>
			  	</div>

			  	<div class="form-group"> 
				    <div class="col-sm-offset-3 col-sm-9">
				      	<button type="submit" class="btn btn-default">Thêm Bệnh Viện</button>
				    </div>
		  		</div>
			</form>
		</div>
	</div>
@endsection
@section('script')

@endsection
