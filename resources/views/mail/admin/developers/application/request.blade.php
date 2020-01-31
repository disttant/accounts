@extends('layouts.mail')

@section('content')

	<p class="my-5 card-text">
		A user has applied to be a developer into the platform. Please, click the link below to enter
		and see the information about it because, for security reasons, it is not possible to show it
		into this email. Be careful and make a decition.
	</p>

	<a href="{{ route('admin.developers.application', ['developer_id' => $developer_id]) }}" class="btn btn-primary">Make a decition</a>

@endsection