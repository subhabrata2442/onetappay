@if (Session::has('success'))
<div class="alert alert-success" id="successMessage">{{ Session::get('success') }}
</div>
@elseif (Session::has('error'))
<div class="alert alert-danger" id="errorMessage">{!! Session::get('error')!!}
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger" id="displayErrorMessage">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{!! $error !!}</li>
		@endforeach
	</ul>
</div>
@endif