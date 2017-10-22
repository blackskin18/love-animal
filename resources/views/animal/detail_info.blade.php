@extends('layouts.index_no_search')
@section('link-css')
    <link href="{{ asset('css/animal/detail_info.css') }}" rel="stylesheet">
@endsection
@section('link-js')
    <script src="{{ asset('js/animal/detail_info.js') }}"></script>
@endsection
@section('content')
<div class="">
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
		        <div class="col-lg-4">
		        	<div class="row">
		        		@if (count($errors) > 0)
					        <ul>
					            @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
					    @endif
		        		<form action="/animal/add_image" method="post"  enctype="multipart/form-data">
							{{csrf_field()}}
						  	<input type="hidden" name="animal_id" value="{{$animal->id}}" readonly>
						  	<input type="file" name="photos[]" multiple>
						  	<input type="submit" class="btn btn-primary"value="thêm ảnh">
						</form>
		        	</div>
		        	<div class="row">
		        		<div class="col-lg-12" style="padding: 0" id="list-image">
		        			<?php $sum_image = 0; ?>
				        	@foreach($images as $key => $image)
								<div class="image-box" >
									<img src="{{ asset('animal_image/'.$image->animal_id.'/'.$image->file_name) }}" alt="ảnh ca {{$image->animal_id}}" >
									<div class="delete" id="delete-image-{{$key+1}}">
										<input type="hidden" value="{{$image->id}}" disabled>
										Xóa ảnh
									</div>
									<div class="update" id="update-image-{{$key+1}}" style="">
										Thay ảnh
										<input type="hidden" value="{{$image->id}}" disabled>
										<form action="/ok" enctype="multipart/form-data" class="change-photo" method="POST">
											<div class="form-group">
												<input type="file" class="change-photo" name="photo" title="thay ảnh" style="position: absolute; top:0; left:0; margin: 0px; padding: 0px; cursor: pointer; opacity: 0; height: 100%; width: 100%">

											</div>	
									  	</form>
									</div>
								</div>
								<?php $sum_image = $key+1; ?>
				        	@endforeach
				        	<input type="hidden" value="{{$sum_image}}" id="sum-image" disabled>
		        		</div>
		        	</div>
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
												@if($user_level == 1 || $user_level == 2 || $user_level == 3 )
													<button class="btn btn-primary " id="btn-edit-create-at">
														edit
													</button>
													<button class="btn btn-primary " id="btn-edit-create-at-cancel" style="display: none">
														hủy
													</button>
												@endif
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
												@if($user_level == 1 || $user_level == 2 || $user_level == 3 )

													<button class="btn btn-primary btn-edit" id="btn-edit-status">
														edit
													</button>
													<button class="btn btn-primary " id="btn-edit-status-cancel" style="display: none">
														hủy
													</button>
												@endif
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
												@if($user_level == 1 || $user_level == 2 || $user_level == 3 )
													<button class="btn btn-primary btn-edit" id="btn-edit-address">
														edit
													</button>
													<button class="btn btn-primary " id="btn-edit-address-cancel" style="display: none">
														hủy
													</button>
												@endif
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>trường hợp</td>
									<td>
										<div class="row">
											<div class="col-lg-9">
												<p>
													{{$animal->name}}
												</p>
											</div>
											<div class="col-lg-3 text-right">
												@if($user_level == 1 || $user_level == 2 || $user_level == 3 )
													<button class="btn btn-primary btn-edit" id="btn-edit-name">
														edit
													</button>
													<button class="btn btn-primary " id="btn-edit-name-cancel" style="display: none">
														hủy
													</button>
												@endif
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
												@if($user_level == 1 || $user_level == 2 || $user_level == 3 )	
													<button class="btn btn-primary btn-edit" id="btn-edit-age">
														edit
													</button>
													<button class="btn btn-primary " id="btn-edit-age-cancel" style="display: none">
														hủy
													</button>
												@endif
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
												@if($user_level == 1 || $user_level == 2 || $user_level == 3 )
													<button class="btn btn-primary btn-edit" id="btn-edit-type">
														edit
													</button>
													<button class="btn btn-primary btn-edit" id="btn-edit-type-cancel" style="display: none">
														hủy
													</button>
												@endif
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>mô tả</td>
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
									<td>nhật ký điều trị</td>
									<td>
										@foreach($animal_fosters as $animal_foster)
											{{$animal_foster->note}} <br>
										@endforeach
									</td>
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