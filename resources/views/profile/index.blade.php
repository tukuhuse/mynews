@extends('layouts.front')

@section('content')
	<div class="container">
		<hr color="#c0c0c0">
		<div class="row">
			<div class="posts col-md-8 mx-auto mt-3">
				@foreach($profiles as $profile)
					<div class="post">
						<div class="row">
							<div class="text col-md-6">
								<div class="name">
									{{ $profile->name }}
								</div>
								<div class="body gender">
									{{ $profile->gender }}
								</div>
								<div class="body hobby">
									{{ $profile->hobby }}
								</div>
								<div class="body introduction">
									{{ $profile->introduction }}
								</div>
							</div>
						</div>
					</div>
					<hr color="#c0c0c0">
				@endforeach
			</div>
		</div>
	</div>
	</div>
@endsection