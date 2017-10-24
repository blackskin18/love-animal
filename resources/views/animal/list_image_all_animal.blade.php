@extends('layouts.index_no_search')

@section('link-css')
@endsection

@section('content')
	<div class="row">
		<div class="text-center">
			<h4>
				Danh Sách Case Theo Ảnh
			</h4>
		</div>
		<div class="col-sm-10 col-sm-offset-1">
			@foreach($images as $key => $image)
			<div class="col-sm-2" style = "padding-bottom: 10px">
				<a href="/animal/detail_info/{{$image->animal_id}}">
					<div>					
						@if($image->file_name)
							<img src="{{ asset('animal_image/'.$image->animal_id.'/'.$image->file_name) }}" alt="	ảnh ca {{$image->animal_id}}" width="100%" height="100px" >
						@else
							<img src="{{ asset('animal_image/default_image/default.jpg') }}" alt="	ảnh ca {{$image->animal_id}}" width="100%" height="100px" >
						@endif
					</div>
					<div class="text-center">
						{{$image->animal_id}}
					</div>
				</a>
			</div>
			@endforeach
		</div>
	</div>
@endsection
@section('script')

@endsection
