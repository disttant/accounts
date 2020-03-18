<!DOCTYPE html>
<html lang="en">
	<head>

		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>{{ config('app.vendor') }}</title>
	</head>
	<body>

		<div class="card mx-auto m-4 w-75" >
			<!--<img src="..." class="card-img-top" alt="...">-->
			<div class="card-body">
				<img src="{{ asset('img/512px.png') }}" class="align-middle" alt="{{ config('app.vendor') }}" style="width: 5rem; height: 5rem;">
				<h1 class="card-title d-inline align-middle font-weight-light">{{ config('app.vendor') }}</h1>

				@yield('content')

				<div class="d-flex justify-content-center small mt-5 text-muted">
					&copy; {{ config('app.vendor') }}
				</div>

			</div>
		</div>


	</body>
</html>