
@extends('user.user')

@php

	$nom = null;
	$telephone = null;
	$email = null;
	$password = null;

	if($utilisateur->exists) {
		$nom = $utilisateur->nom;
		$telephone = $utilisateur->telephone;
		$email = $utilisateur->email;
		$password = $utilisateur->password;
	}

@endphp


 
@section('title',$utilisateur->exists ? "Editer votre compte":"Creer un Compte")



@section('content')

	<h1>@yield('title')</h1>

	<form action="{{ route($utilisateur->exists ? 'user.update':'user.store', $utilisateur) }}" method="post" enctype="multipart/form-data">
		
		@csrf

		@method($utilisateur->exists?'put':'post')

		@include('inputform',['label' => 'Nom','name' => 'name','value' => $nom])

		@include('inputform',['label' => 'No telephone','name' => 'telephone','value' => $telephone])

		@include('inputform',['label' => 'Email','name' => 'email','type' => 'email','value' => $email])

		@include('inputform',['type' => 'password','label' => 'Mot de passe','name' => 'password','value' => $password])

		@include('inputform',['label' => 'Image','name' => 'image','type' => 'file'])

		

		<button >Enregistrer</button>
	</form>

@endsection