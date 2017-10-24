@extends('layouts.index_no_search')

@section('link-css')
@endsection

@section('content')
	<div class="row text-center">
		<h3>
			Bệnh Viện {{$hospital->name}}
		</h3>
		<div>
			<h4> thông tin</h4>
			<b> Số điện thoại </b> {{$hospital->phone}} <br>
			<b> Địa chỉ </b> {{$hospital->address}} <br>
			<b> Ghi chú </b> {{$hospital->note}} <br>
		</div>
	</div>
	<div class="row">
		<div class="text-center">
			<h4>
				Danh Sách Case Điều Trị
			</h4>
		</div>
		<div class="col-sm-10 col-sm-offset-1">
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
		</div>
	</div>
@endsection
@section('script')

@endsection
