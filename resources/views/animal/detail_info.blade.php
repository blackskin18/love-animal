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
    		<h2 class="text-center"> ca {{$animal->id}} </h3>
			<div class="row">
		        <div class="col-lg-4">
		        	<div class="row">
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

						<div class="text-center">
							<div width="50" height="50">
							  		<img src="{{ asset('icon/themAnh_128.png') }}" alt="" height="40" class="btn btn-primary" >
									<form action="/animal/add_image" enctype="multipart/form-data" id="form-add-image" method="POST">
										{{csrf_field()}}
										<div>
									  		<input type="hidden" name="animal_id" value="{{$animal->id}}" readonly style="display: inline-block;">
										</div>
										<div class="form-group">
											<input type="file" name="photos[]" multiple="" class="change-photo" title="Thêm ảnh" style="position: absolute; top:0; left:0; margin: 0px; padding: 0px; cursor: pointer; opacity: 0; height: 100%; width: 100%" onchange="document.getElementById('form-add-image').submit()">
										</div>	
								  	</form>
							</div>
							
						</div>
		        	</div>
		        	<div class="row">
		        		<div class="col-lg-12" style="padding: 0" id="list-image">
		        			<?php $sum_image = 0; ?>
				        	@foreach($images as $key => $image)
								<div class="image-box" >
									<img src="{{ asset('animal_image/'.$image->animal_id.'/'.$image->file_name) }}" alt="ảnh ca {{$image->animal_id}}" >
									<div class="delete" id="delete-image-{{$key+1}}">
										<input type="hidden" value="{{$image->id}}" disabled>
										<img src="{{ asset('icon/xoaAnh_128.png') }}" alt="" height="30" >
									</div>
									<div class="update" id="update-image-{{$key+1}}" style="">
										<img src="{{ asset('icon/thayAnh_128.png') }}" alt="" height="30" >
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
						<input type="image" src="{{ asset('icon/thongTinCase_128.png') }}" height="35" class="btn btn-primary" style="display: inline-block;" id="btn-show-info">
						<input type="image" src="{{ asset('icon/lichSu_96.png') }}" height="35" class="btn btn-primary" style="display: inline-block;" id="btn-show-history">
		        	</div>
		        	<div class="history-box">
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
													<input type="image" src="{{ asset('icon/Sua.png') }}" class="btn btn-primary " id="btn-edit-create-at" height="35">
													<input type="image" src="{{ asset('icon/Huy_128.png') }}" class="btn btn-primary " height="35" id="btn-edit-create-at-cancel" style="display: none">
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
													<input type="image" src="{{ asset('icon/Sua.png') }}" height="35" class="btn btn-primary " id="btn-edit-status" >
														
													</input>
													<input type="image" src="{{ asset('icon/Huy_128.png') }}" height="35" style="display: none" class="btn btn-primary " id="btn-edit-status-cancel" >
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
												@if($animal->place == 'commonHome')
													<p>
														Nhà Chung
													</p>
												@elseif($animal->place == 'volunteer')
													<p>
		                                                Nhà TNV: <a href="/volunteer/info/{{$place[0]->id}}"> {{$place[0]->name}} </a> <br> 
		                                                Ghi chú: {{$place[1]->note}}
		                                            </p>
												@elseif($animal->place == 'hospital')
													<p>
		                                                Bệnh Viện: <a href="/hospital/detail_info/{{$place[0]->id}}"> {{$place[0]->name}} </a> <br> 
		                                                Ghi chú: {{$place[1]->note}}
		                                            </p>
		                                        @else
		                                        	<p>
		                                        		{{$animal->place}}
		                                        	</p>
												@endif
											</div>
											<div class="col-lg-3 text-right">
												@if($user_level == 1 || $user_level == 2 || $user_level == 3 )
													<input type="image" src="{{ asset('icon/Sua.png') }}" height="35" class="btn btn-primary btn-edit" id="btn-edit-place">
													<input type="image" src="{{ asset('icon/Huy_128.png') }}" height="35" class="btn btn-primary " id="btn-edit-place-cancel" style="display: none">
												@endif
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>Địa chỉ</td>
									<td>
										<div class="row">
											<div class="col-lg-9">
												<p>
													{{$animal->address}}
												</p>
											</div>
											<div class="col-lg-3 text-right">
												@if($user_level == 1 || $user_level == 2 || $user_level == 3 )
													<input type="image" src="{{ asset('icon/Sua.png') }}" height="35" class="btn btn-primary btn-edit" id="btn-edit-address">
													<input type="image" src="{{ asset('icon/Huy_128.png') }}" height="35"  class="btn btn-primary " id="btn-edit-address-cancel" style="display: none">
												@endif
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
													{{$animal->name}}
												</p>
											</div>
											<div class="col-lg-3 text-right">
												@if($user_level == 1 || $user_level == 2 || $user_level == 3 )
													<input type="image" src="{{ asset('icon/Sua.png') }}" height="35" class="btn btn-primary btn-edit" id="btn-edit-name">
													<input type="image" src="{{ asset('icon/Huy_128.png') }}" height="35" class="btn btn-primary " id="btn-edit-name-cancel" style="display: none">
												@endif
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>Tuổi</td>
									<td>
										<div class="row">
											<div class="col-lg-9">
												<p>
													{{$animal->age}}
												</p>
											</div>
											<div class="col-lg-3 text-right">
												@if($user_level == 1 || $user_level == 2 || $user_level == 3 )	
													<input type="image" src="{{ asset('icon/Sua.png') }}" height="35" class="btn btn-primary btn-edit" id="btn-edit-age">
													<input type="image" src="{{ asset('icon/Huy_128.png') }}" height="35" class="btn btn-primary " id="btn-edit-age-cancel" style="display: none">
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
													<input type="image" src="{{ asset('icon/Sua.png') }}" height="35" class="btn btn-primary btn-edit" id="btn-edit-type">
													<input type="image" src="{{ asset('icon/Huy_128.png') }}" height="35" class="btn btn-primary btn-edit" id="btn-edit-type-cancel" style="display: none">
												@endif
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>Mô tả</td>
									<td>
										<div class="row">
											<div class="col-lg-9">
												<p>
													{{$animal->description}}
												</p>
											</div>
											<div class="col-lg-3 text-right">
												<input type="image" src="{{ asset('icon/Sua.png') }}" height="35" class="btn btn-primary btn-edit" id="btn-edit-description">
												<input type="image" src="{{ asset('icon/Huy_128.png') }}" height="35" class="btn btn-primary " id="btn-edit-description-cancel" style="display: none">
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>Ghi Chú</td>
									<td>
										<div class="row">
											<div class="col-lg-9">
												<p>
													{{$animal->note}}
												</p>
											</div>
											<div class="col-lg-3 text-right">
												<input type="image" src="{{ asset('icon/Sua.png') }}" height="35" class="btn btn-primary btn-edit" id="btn-edit-note">
												<input type="image" src="{{ asset('icon/Huy_128.png') }}" height="35" class="btn btn-primary " id="btn-edit-note-cancel" style="display: none">
											</div>
										</div>
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