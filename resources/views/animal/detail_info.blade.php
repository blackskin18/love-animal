@extends('layouts.index_no_search')
@section('link-css')
    <link href="{{ asset('css/animal/detail_info.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="container">
    <div class="content"> 
    	<div>
    		<h3 class="text-center"> ca {{$animal->id}} </h3>
			<div class="row">
		        <div class="col-lg-4" style="background-color: blue;">
		        	ảnh
		        </div>
		        <div class="col-lg-8" style="">
		        	<h3 class="text-center">thông tin</h3>
					<table class="table">
						<tbody>
							<tr>
								<td>Ngày nhận</td>
								<td>{{$animal->created_at}}</td>
							</tr>
							<tr>
								<td>Trạng thái</td>
								<td>{{$status->name}}</td>
							</tr>
							<tr>
								<td>Địa điểm</td>
								<td>{{$animal->address}}</td>
							</tr>
							<tr>
								<td>Tên</td>
								<td>{{$animal->name}}</td>
							</tr>
							<tr>
								<td>tuổi</td>
								<td>{{$animal->age}}</td>
							</tr>
							<tr>
								<td>Loài</td>
								<td>{{$animal->type}}</td>
							</tr>
							<tr>
								<td>Trường hợp</td>
								<td>{{$animal->description}}</td>
							</tr>
							<tr>
								<td>Mô tả</td>
								<td>
									@foreach($animal_fosters as $animal_foster)
										{{$animal_foster->note}} <br>
									@endforeach
								</td>
							</tr>
							<tr>
								<td>Nhật ký điều trị</td>
								<td>chưa xử lý</td>
							</tr>
						</tbody>
					</table>
		        </div>
	        </div>
        </div>
    </div>
</div>
@endsection