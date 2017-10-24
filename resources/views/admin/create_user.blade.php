@extends('layouts.index_no_search')

@section('link-css')
    <link href="{{ asset('css/volunteer/detail_info.css') }}" rel="stylesheet">
@endsection

@section('content')
	<div class="row">
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
			<form action="/admin/post/create_user" class="form-horizontal">
			  	<div class="form-group">
			    	<label class="control-label col-sm-2" for="email">Email:</label>
		    		<div class="col-sm-10">
			      		<input type="email" name="email" class="form-control" placeholder="nhập email">
			    	</div>
			  	</div>
			  	<div class="form-group">
			    	<label class="control-label col-sm-2" for="email">Chức vụ</label>
		    		<div class="col-sm-10">
						<select name="level" class="form-control">
							<option value="">-------chọn kiểu người dùng-----</option>
							@foreach($role_infos as $role_info)
								<option value="{{$role_info->role_info_id}}">{{$role_info->role_description}}</option>
							@endforeach
						</select>

			      		<!-- <input type="email" name="email" class="form-control" placeholder="nhập email"> -->
			    	</div>
			  	</div>
			  	<div class="form-group"> 
				    <div class="col-sm-offset-2 col-sm-10">
				      	<button type="submit" class="btn btn-default">thêm người dùng</button>
				    </div>
		  		</div>
			</form>
		</div>
	</div>
@endsection
@section('script')

@endsection
