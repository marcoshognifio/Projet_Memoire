@extends('user.user')

@php

	$nom = null;
	$description = null;
	$budget = null;
	$date_fin = null;

	if($projet->exists) {
		$nom = $projet->nom;
		$description = $projet->description;
		$budget = $projet->budget;
		$date_fin = $projet->date_fin;
	}

@endphp


 
@section('title',$projet->exists ? "Edition de Projet":"Creation de Projet")



@section('content')

	<h1>@yield('title')</h1>

	<form action="{{ route($projet->exists ? 'user.projet.update':'user.projet.store', $projet) }}" method="post" enctype="multipart/form-data">
		
		@csrf

		@method($projet->exists?'put':'post')

		@include('inputform',['label' => 'Nom','name' => 'nom','value' => $nom])

		@include('inputform',['type' => 'textarea','label' => 'Description du projet','name' => 'description','value' => $description])

		@include('inputform',['label' => 'Budget provisoire du projet','name' => 'budget','value' => $budget])

		@include('inputform',['type' => 'date','label' => 'Date de fin du projet','name' => 'date_fin','value' => $date_fin])

		@include('inputform',['label' => 'Image','name' => 'image','type' => 'file'])

		

		<button >Enregistrer</button>
	</form>

@endsection