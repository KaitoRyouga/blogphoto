@extends('layouts.master')
@section('content')

<h2>DỊCH VỤ</h2>
<div class="title_under_img"></div>
<div class="panel-layout">
@if(isset($services) && $services)
@foreach($services as $key => $ser)
	<div class="layout-detail">
		<a href="{{ url($ser->urlservices) }}">
			<img src="uploads/services/{{ $ser->image_name }}" alt="">
		</a>
		<a href="{{ url($ser->urlservices) }}">
			<h3>{{ $ser->title }}</h3>
		</a>
		<p>
			{{ $ser->content }}
		</p>
	</div>
@endforeach
@endif
</div>

<h2>CONCEPT MỞ RỘNG</h2>
<div class="title_under_img" style="margin:100px 0 100px 0"></div>
<div class="concept-layout">
@if(isset($concept) && $concept)
	@foreach($concept as $key => $con)
		<div class="concept-layout-detail">
			<img src="uploads/concept/{{ $con->image_name }}" alt="">
			<div class="icobox">
				<h3>
					<a href="{{ url($con->urlconcept) }}">{{ $con->title }}</a>
				</h3>
				<p>
					{{ $con->content }}
				</p>
			</div>
		</div>
	@endforeach
@endif

@endsection