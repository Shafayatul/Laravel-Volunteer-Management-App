<div class="row">
	<div class="col-sm-12">
		

		@if(Session::has('success'))
			<br>
		    <div class="alert alert-success">
		        <strong>Success!</strong> {{ Session::get('success') }}
		    </div>
		@endif

		@if(Session::has('error'))
			<br>
			<div class="alert alert-danger">
			    <strong>Error!</strong> {{ Session::get('error') }}
			</div>
		@endif   

		@if ($errors->any())
			<br>
		    <ul class="alert alert-danger">
		        @foreach ($errors->all() as $error)
		            <li>{{ $error }}</li>
		        @endforeach
		    </ul>
		@endif	
	</div>
</div>
