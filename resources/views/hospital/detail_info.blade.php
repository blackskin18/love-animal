@extends('layouts.index_no_search')

@section('link-css')
@endsection
@section('link-js')
 <script src="{{ asset('js/hospital/detail_info.js') }}"></script>
@endsection

@section('content')
	<input type="hidden" id="hospital-id" disabled value="{{$hospital->id}}">
	<div class="tagget text-center">
		<h3>
			Bệnh Viện {{$hospital->name}}
		</h3>
	</div >
	<div class="col-sm-offset-1">
		<button class="btn" id="btn-show-info">
			thông tin
		</button>
	</div>
	<div class="row text-center info-box">
		<div class="col-sm-10 col-sm-offset-1 text-left">
			<table class="table">
				<tbody>
					@if($user_level == 1 || $user_level == 2 || $user_level == 3 )
					<tr>
						<td>
							<p>
								Tên Bệnh Viện	
							</p>
						</td>
						<td>
							<div class="row">
								<div class="col-lg-9">
									<p>
										{{$hospital->name}}
									</p>
								</div>
								<div class="col-lg-3 text-right">
										<button class="btn btn-primary btn-edit" id="btn-edit-name">
											sửa
										</button>
										<button class="btn btn-primary " id="btn-edit-name-cancel" style="display: none">
											hủy
										</button>
								</div>
							</div>
						</td>
					</tr>
					@endif	
					
					<tr>
						<td>
							<p>
								số điện thoại	
							</p>
						</td>
						<td>
							<div class="row">
								<div class="col-lg-9">
									<p>
										{{$hospital->phone}}
									</p>
								</div>
								<div class="col-lg-3 text-right">
									@if($user_level == 1 || $user_level == 2 || $user_level == 3 )
										<button class="btn btn-primary btn-edit" id="btn-edit-phone">
											sửa
										</button>
										<button class="btn btn-primary " id="btn-edit-phone-cancel" style="display: none">
											hủy
										</button>
									@endif	
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<p>
								Địa chỉ	
							</p>
						</td>
						<td>
							<div class="row">
								<div class="col-lg-9">
									<p>
										{{$hospital->address}}
									</p>
								</div>
								<div class="col-lg-3 text-right">
									@if($user_level == 1 || $user_level == 2 || $user_level == 3 )
										<button class="btn btn-primary btn-edit" id="btn-edit-address">
											sửa
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
						<td>
							<p>
								Ghi chú
							</p>
						</td>
						<td>
							<div class="row">
								<div class="col-lg-9">
									<p>
										{{$hospital->note}}
									</p>
								</div>
								<div class="col-lg-3 text-right">
									@if($user_level == 1 || $user_level == 2 || $user_level == 3 )
										<button class="btn btn-primary btn-edit" id="btn-edit-note">
											sửa
										</button>
										<button class="btn btn-primary " id="btn-edit-note-cancel" style="display: none">
											hủy
										</button>
									@endif	
								</div>
							</div>
						</td>
					</tr>
					
				</tbody>
			</table>
			
		</div>
	</div>
	<div class="col-sm-offset-1">
		<button class="btn" id="btn-show-history">
			Danh Sách Case Điều Trị
		</button>
	</div>
	<div class="row history-box" style="display: none">
		<div class="col-sm-10 col-sm-offset-1">
			@if(!$animal_hospitals->isEmpty())
				@foreach($animal_hospitals as $key => $animal_hospital)
				<div class="col-sm-2" style = "padding-bottom: 10px">
					<a href="/animal/detail_info/{{$animal_hospital->animal_id}}">
						<div>					
							@if($animal_hospital->file_name)
								<img src="{{ asset('animal_image/'.$animal_hospital->animal_id.'/'.$animal_hospital->file_name) }}" alt="	ảnh ca {{$animal_hospital->animal_id}}" width="100%" height="100px" >
							@else
								<img src="{{ asset('animal_image/default_image/default.jpg') }}" alt="	ảnh ca {{$animal_hospital->animal_id}}" width="100%" height="100px" >
							@endif
						</div>
						<div class="text-center">
							{{$animal_hospital->animal_id}}
						</div>
					</a>
				</div>
				@endforeach
			@else
				<div class="text-center">
					<h2>
						Không có case nào được chữa trị ở đây
					</h2>
				</div>
			@endif
			
		</div>
	</div>
@endsection
@section('script')

@endsection
