@extends('layouts.index_no_search')

@section('link-css')
<link type="text/css" rel="stylesheet" href="{{ asset('css/popModal.css') }}">
@endsection

@section('link-js')
<script src="{{ asset('js/popModal.js') }}"></script>
<script src="{{ asset('js/animal/list_image_all_animal.js') }}"></script>
@endsection

@section('content')
	<input type="hidden" id="sum_image"  disabled value="{{ $sum_image }}">
	<div class="row">
		<div class="text-center">
			<h4>
				Danh Sách Case Theo Ảnh
			</h4>
		</div>
		<div class="col-sm-10 col-sm-offset-1" id="list-image-box">
			@foreach($images as $key => $image)
			<div class="col-sm-2" style = "padding-bottom: 10px">
				<!-- <a href="/animal/detail_info/{{$image->animal_id}}"> -->
					<div id="image_{{$image->id}}">
						<input type="hidden" disabled value="{{$image->animal_id}}">			
						@if($image->file_name)
							<img src="{{ asset('animal_image/'.$image->animal_id.'/'.$image->file_name) }}" alt="ảnh ca {{$image->animal_id}}" width="100%" height ="130px" class="animal_image" >
						@else
							<img src="{{ asset('animal_image/default_image/default.jpg') }}" alt="	ảnh ca {{$image->animal_id}}" width="100%" height="130px" class="animal_image" >
						@endif
					</div>
					<div class="text-center">
						{{$image->animal_id}}
					</div>
					<?php 
						$tmp = $image->animal_id;
					?>
				<!-- </a> -->
			</div>
			@endforeach
			<input type="hidden" id = "last_animal_id" value = "{{$tmp}}">
		</div>
	</div>
@endsection
@section('script')

@endsection
