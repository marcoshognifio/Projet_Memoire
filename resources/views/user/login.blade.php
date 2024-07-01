@php

	
	$email ??=null;
	$error_login ??=null;

@endphp

@extends('user.user')

@section('title','Connectez Vous ')

@section('content')

	<h1>@yield('title')</h1>

	@if($error_login != null)

		<div>
			{{ $error_login }} 
		</div>

	@endif

	<form action="{{ route('user.do_login') }}" method="post">

		@csrf

		@include('inputform',['type' => 'email','label' => 'Votre Email','name' => 'email','value' => $email])

		@include('inputform',['type' => 'password','label' => 'Mot de passe','name' => 'password'])

		<button >Se connecter</button>

	</form>
	
@endsection