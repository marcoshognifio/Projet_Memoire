@extends('user.user')

@section('title')
	Votre compte
@endsection

@section('content')


	

	<h1>@yield('title')</h1>
	
	<section>
		@foreach($projets as $projet)

			<div>
				<img src="{{ $projet->imageUrl() }}" width="200" height="200">
				<p>{{ $projet->nom }}</p>
				<a href="{{route('user.projet.show',$projet)}}">Conslter le projet</a>
			</div>

		@endforeach
	</section>

	<div><a href="{{route('user.projet.depense.index',$projet_actuel)}}">Enregistrer une depense</a></div>
	<div><a href="{{route('user.projet.transaction.create',$projet_actuel)}}">Enregistrer une transaction entre projet</a></div>
	
	@if ($projet_actuel->projet_parent_id == NULL)
	<div><a href="{{route('user.projet.ajoutfond.create',$projet_actuel)}}">Ajouter un fond au projet</a></div>
	@endif


@endsection