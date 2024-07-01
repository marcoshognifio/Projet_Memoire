@php

	$fond ??=null;

@endphp

@extends('user.user')

@section('title','Ajout de fond' )

@section('content')

	<h1>@yield('title')</h1>

	<form action="{{ route('user.projet.ajoutfond.store',$projet) }}" method="post">

		@csrf

		@include('inputform',['type' => 'text','label' => 'Montant a afouter','name' => 'fond','value' => $fond])
        
		<button >Valider</button>

	</form>
	
@endsection