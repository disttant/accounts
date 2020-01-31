@extends('layouts.mail')

@section('content')

	<p class="my-5 card-text">
		<p>
			Hello there,
		</p>

		<p>
			You sent us a request for being developer some time ago and this is a hand made process.
			We inspect each request as a hand made process in order to keep our high quality standards.
			As a possible developer, you accepted our Terms of Service and our Privacy Policy and sent us 
			some data that are impossible to change because some of them are verified.
		</p>

		<p>
			Your developing application has been: 
			<strong>
				@if( $applicationAccepted == true)
					accepted
				@else
					declined
				@endif
			</strong>
		</p>

		<p>
			As we said before, there is a person behing each developing application so we check all requests by hand.
			Because we appreciate your effort, we asked our employees to send a message giving information about the 
			status of the application and they had a better idea: information if declined and a welcome message if accepted.
			That was crazy because, remember, one by one. But we accepted, so the following words are just for you:

			<p>
				<strong>
					{{ $applicationMessage }}
				</strong>
			</p>
		</p>
	</p>

	<p style="margin: 3rem 0 3rem 0;">

		<p>
			As a result, if you were accepted, a new menú will appear in your account manager where you can 
			create (or delete) your apps and the data to access the information 
		</p>

		<a href="{{ url('developers/clients/show') }}" class="btn btn-primary">
			Create your first app
		</a>

	</p>

@endsection