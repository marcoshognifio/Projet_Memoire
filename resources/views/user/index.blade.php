@extends('user.user')

@section('title')
	Votre compte
@endsection

@section('content')


	

	<h1>@yield('title')</h1>
	
	@foreach($projets as $projet)

	<div>
		<img src="{{ $projet->imageUrl() }}" width="200" height="200">
		<p>{{ $projet->nom }}</p>
		<a href="{{route('user.projet.show',$projet)}}">Conslter le projet</a>
	</div>

	@endforeach


@endsection