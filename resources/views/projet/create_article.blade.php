@php

	
	$nom ??=null;
	$quantite ??=null;
    $montant ??=null;

@endphp

@extends('user.user')

@section('title','Création d\'article ')

@section('content')

	<h1>@yield('title')</h1>

	<form action="{{ route('user.projet.depense.store_article',$projet) }}" method="post">

		@csrf

		@include('inputform',['type' => 'text','label' => 'Nom de l\'article','name' => 'nom','value' => $nom])
        @include('inputform',['type' => 'text','label' => 'Quantite','name' => 'quantite','value' => $quantite])
		@include('inputform',['type' => 'text','label' => 'Montant total','name' => 'montant','value' => $montant])

		<button >Se connecter</button>

	</form>
	
@endsection