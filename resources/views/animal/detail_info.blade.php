@extends('layouts.index_no_search')
@section('link-css')
    <link href="{{ asset('css/animal/detail_info.css') }}" rel="stylesheet">
@endsection
@section('link-js')
    <script src="{{ asset('js/animal/detail_info.js') }}"></script>
@endsection
@section('content')
<div class="container">
	<input type="hidden" id="animal-id" value="{{$animal->id}}" disabled>
	@foreach($all_status as $status)
	<!-- @if($status->id == $animal->status)
		<input type="hidden" id="animal-id" value="{{$animal->id}}" disabled>
	@endif -->
	@endforeach
    <div class="content"> 
    	<div>
    		<h3 class="text-center"> ca {{$animal->id}} </h3>
			<div class="row">
		        <div class="col-lg-4" style="background-color: blue;">
		        	ảnh
		        </div>
		        <div class="col-lg-8" style="">
		        	<div class="button-box text-center">
		        		<button class="btn btn-primary" id="btn-show-info">thông tin case</button>
		        		<button class="btn btn-primary" id="btn-show-history">nhật ký thay đổi</button>
		        	</div>
		        	<div class="history-box">
		        		
		        	</div>
		        	<div class="info-box">
						<table class="table">
							<tbody>
								<tr>
									<td>Ngày nhận</td>
									<td>
										<div class="row">
											<div class="col-lg-9">
												<p>
													{{$animal->created_at}}
												</p>
											</div>
											<div class="col-lg-3 text-right">
												<button class="btn btn-primary " id="btn-edit-create-at">
													edit
												</button>
												<button class="btn btn-primary " id="btn-edit-create-at-cancel" style="display: none">
													hủy
												</button>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>Trạng thái</td>
									<td>
										<div class="row">
											<div class="col-lg-9">
												<p>	
													@foreach($all_status as $status)
														@if($status->id == $animal->status)
															{{$status->name}}
														@endif
													@endforeach
												</p>
											</div>
											<div class="col-lg-3 text-right">
												<button class="btn btn-primary btn-edit" id="btn-edit-status">
													edit
												</button>
												<button class="btn btn-primary " id="btn-edit-status-cancel" style="display: none">
													hủy
												</button>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>Địa điểm</td>
									<td>
										<div class="row">
											<div class="col-lg-9">
												<p>
													{{$animal->address}}
												</p>
											</div>
											<div class="col-lg-3 text-right">
												<button class="btn btn-primary btn-edit" id="btn-edit-address">
													edit
												</button>
												<button class="btn btn-primary " id="btn-edit-address-cancel" style="display: none">
													hủy
												</button>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>Tên</td>
									<td>
										<div class="row">
											<div class="col-lg-9">
												<p>
													{{$animal->name}}
												</p>
											</div>
											<div class="col-lg-3 text-right">
												<button class="btn btn-primary btn-edit" id="btn-edit-name">
													edit
												</button>
												<button class="btn btn-primary " id="btn-edit-name-cancel" style="display: none">
													hủy
												</button>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>tuổi</td>
									<td>
										<div class="row">
											<div class="col-lg-9">
												<p>
													{{$animal->age}}
												</p>
											</div>
											<div class="col-lg-3 text-right">
												<button class="btn btn-primary btn-edit" id="btn-edit-age">
													edit
												</button>
												<button class="btn btn-primary " id="btn-edit-age-cancel" style="display: none">
													hủy
												</button>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>Loài</td>
									<td>
										<div class="row">
											<div class="col-lg-9">
												<p>
													{{$animal->type}}
												</p>
											</div>
											<div class="col-lg-3 text-right">
												<button class="btn btn-primary btn-edit" id="btn-edit-type">
													edit
												</button>
												<button class="btn btn-primary btn-edit" id="btn-edit-type-cancel" style="display: none">
													hủy
												</button>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>Trường hợp</td>
									<td>
										<div class="row">
											<div class="col-lg-9">
												<p>
													{{$animal->description}}
												</p>
											</div>
											<div class="col-lg-3 text-right">
												<button class="btn btn-primary btn-edit" id="btn-edit-description">
													edit
												</button>
												<button class="btn btn-primary " id="btn-edit-description-cancel" style="display: none">
													hủy
												</button>
											</div>
										</div>
									</td>
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
</div>
@endsection