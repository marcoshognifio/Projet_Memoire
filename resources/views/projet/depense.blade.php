@extends('user.user')

@section('title')
	Enregistrement d'une dépense
@endsection

@section('content')


	<h1>@yield('title')</h1>
	
	<section>

        @php
            $a=0;
        @endphp
		@foreach($articles as $article)

            <div>
                
                <h2>Article {{$a=$a+1}}</h2>
                <p>Nom {{ $article['nom'] }}</p>
                <p>Quantite: {{ $article['quantite'] }}</p>
                <p>Montant: {{ $article['montant'] }}</p>
                
            </div>

		@endforeach

        <div><a href="{{route('user.projet.depense.article',$projet)}}">Ajouter un article</a></div>
	
    </section>

	<div>
        <form action="{{ route('user.projet.depense.store', $projet) }}" method="post">
            @csrf
            @include('inputform',['label' => 'Objet de la depense','name' => 'objet'])
            <button>Enregistrer la dépense</button>
        </form>
    </div>
        
	

@endsection