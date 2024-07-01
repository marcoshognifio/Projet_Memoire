@extends('user.user')

@section('title')
	Bienvenu sur notre site
@endsection

@section('content')

	<h1>@yield('title')</h1>

	<div>
		<a href="{{route('user.login')}}">Connectez-vous</a>
	</div>
	
	<div>
		<a href="{{route('user.create')}}">Créer un compte utilisateur</a>
	</div>	

@endsection