
@extends('user.user')



 
@section('title',"Enregistrer une transaction")



@section('content')

	<h1>@yield('title')</h1>

	<form action="{{ route('user.projet.transaction.store', $projet) }}" method="post">
		
		@csrf

		@include('inputform',['label' => 'Le projet destinataire','name' => 'projet_destinataire_id','type' =>'select','items' => $projets])

		@include('inputform',['label' => 'Montant','name' => 'montant'])

		@include('inputform',['label' => 'Objet de la transaction','name' => 'objet'])

		<button >Enregistrer</button>

	</form>

@endsection