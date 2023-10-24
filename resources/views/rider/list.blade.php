@extends('layout')

@section('content')
<div class="row">
    <div class="col s12 text-center mt-1 mb-5"><h1>{{ $band->name }}</h1></div>
</div>
<div class="row">
@foreach ($riders as $rider)
    <div class="card border-dark mx-5" style="width: 15rem; height: 16rem;">
        <div class="card-body text-dark">
            <h5 class="card-title">{{ $rider->title }}</h5>
            <a class="card-link" href="{{ url(route('rider.download', ['riderId' => $rider->id])) }}">Télécharger</a>
            <a class="card-link" href="{{ url(route('rider.edit', ['riderId' => $rider->id])) }}">Modifier</a>
            <a class="card-link mt-3" href="{{ url(route('rider.duplicate', ['riderId' => $rider->id])) }}">Dupliquer</a>
            <a class="card-link mt-3" href="{{ url(route('rider.delete', ['riderId' => $rider->id])) }}">Supprimer</a>
        </div>
    </div>
@endforeach

    <div class="card border-dark mx-5" style="width: 15rem; height: 16rem;">
        <img class="card-img-top" src="{{ url(asset('images/plus.jpg')) }}" style="object-fit:contain; height: 10rem;" />
        <div class="card-body">
            <h5 class="card-title">Nouvelle fiche technique</h5>
            <a class="card-link" href="{{ url(route('band.new')) }}">Créer</a>
        </div>
    </div>
</div>
@endsection