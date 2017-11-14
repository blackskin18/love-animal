@extends('layouts.index_no_search')

@section('link-css')
    <link href="{{ asset('css/volunteer/detail_info.css') }}" rel="stylesheet">
@endsection

@section('content')
	<div class="text-center">
		<h3> Tạo mới</h3>
	</div>
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
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
			<form action="/admin/post/create_case" method="post" enctype="multipart/form-data" class="form-horizontal">
				{{csrf_field()}}
				<div class="form-group">
			    	<label class="control-label col-sm-2" for="email">Ảnh</label>
		    		<div class="col-sm-10">
			      		<input type="file" name="photos[]" class="form-control" placeholder="Thêm ảnh" multiple>
			    	</div>
			  	</div>
			  	<div class="form-group">
			    	<label class="control-label col-sm-2" for="email">Trường hợp</label>
		    		<div class="col-sm-10">
			      		<input type="text" name="name" class="form-control" placeholder="Nhập trường hợp case">
			    	</div>
			  	</div>
			  	<div class="form-group">
			    	<label class="control-label col-sm-2" for="email">Mô tả</label>
		    		<div class="col-sm-10">
			      		<input type="text" name="description" class="form-control" placeholder="Nhập mô tả">
			    	</div>
			  	</div>
			  	<div class="form-group">
			    	<label class="control-label col-sm-2" for="email">Ghi chú</label>
		    		<div class="col-sm-10">
			      		<textarea rows="4" cols="50" type="text" name="note" class="form-control" placeholder="Nhập ghi chú">
			      		</textarea>
			    	</div>
			  	</div>
			  	<div class="form-group">
			    	<label class="control-label col-sm-2" for="email">Địa điểm</label>
		    		<div class="col-sm-10">
		      		 	<select class="form-control" name ="place" id="sel1">
							<option value="">-------------------Chọn Địa Điểm Hiện Tại-----------------</option>
		                    <option value="Khác"> Khác </option>
		                    <option value="Nhà Chung">Nhà Chung</option>
		                    <option value="Nhà TNV">nhà TNV</option>
		                    <option value="Bệnh Viện">Bệnh Viện</option>
		                </select>
			    	</div>
			  	</div>
			  	<div class="form-group">
			    	<label class="control-label col-sm-2" for="email">Địa chỉ</label>
		    		<div class="col-sm-10">
			      		<input type="text" name="address" class="form-control" placeholder="Nhập địa điểm đón">
			    	</div>
			  	</div>
			  	<div class="form-group">
			    	<label class="control-label col-sm-2" for="email">Tuổi</label>
		    		<div class="col-sm-10">
			      		<input type="number" name="age" class="form-control" placeholder="Nhập Tuổi">
			    	</div>
			  	</div>
			  	<div class="form-group">
			    	<label class="control-label col-sm-2" for="email">Loài</label>
		    		<div class="col-sm-10">
			      		<input type="text" name="type" class="form-control" placeholder="Nhập Loài">
			    	</div>
			  	</div>
			  	<div class="form-group">
			    	<label class="control-label col-sm-2" for="email">Trạng thái</label>
			    	<div class="col-sm-10">
			    		<select name="status" class="form-control">
							<option value="">---------------------------Chọn một---------------------------</option>
							@foreach($statuses as $status)
								<option value="{{$status->id}}">{{$status->name}}</option>
							@endforeach
						</select>
					</div>
			  	</div>

			  	<div class="form-group"> 
				    <div class="col-sm-offset-2 col-sm-10">
				      	<button type="submit" class="btn btn-default">Tạo Case</button>
				    </div>
		  		</div>
			</form>
		</div>
	</div>
@endsection
@section('script')

@endsection
