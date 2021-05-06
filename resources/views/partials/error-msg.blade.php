@if($errors->any())
<div class="alert alert-warning"  role="alert">
	<ul class="list-unstyled">
		@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@elseif(session('custom_error'))
<div class="alert alert-warning">
	{{ session('custom_error') }}
</div>
@elseif(session('success_msg'))
<div class="alert alert-success">
	{{ session('success_msg') }}
</div>
@endif