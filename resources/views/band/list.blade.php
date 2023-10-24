@extends('layout')

@section('content')
<div class="row">
@foreach ($bands as $band)
    <div class="card border-dark mx-5" style="width: 15rem; height: 16rem;">
        <img class="card-img-top" src="{{ url('storage/logos/min/'.$band->logo) }}" style="object-fit:contain; height: 10rem;" />

        <div class="card-body text-dark">
            <h5 class="card-title">{{ $band->name }}</h5>
            <a class="card-link" href="{{ url(route('rider.list', ['bandId' => $band->id])) }}">Voir les fiches techniques</a>
        </div>
    </div>
@endforeach

    <div class="card border-dark mx-5" style="width: 15rem; height: 16rem;">
        <img class="card-img-top" src="{{ url(asset('images/plus.jpg')) }}" style="object-fit:contain; height: 10rem;" />
        <div class="card-body">
            <h5 class="card-title">Nouveau groupe</h5>
            <a class="card-link" href="{{ url(route('band.new')) }}">Créer</a>
        </div>
    </div>
</div>
@endsection