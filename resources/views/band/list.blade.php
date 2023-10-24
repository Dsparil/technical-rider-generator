@extends('layout')

@section('content')
@foreach ($bands as $band)
    <div class="row">
    
        <div class="card">
            @if (!empty($band->logo))
            <img class="card-img-top" src="{{ $band->logo }}" />
            @endif

            <div class="card-body">
                <h5 class="card-title">{{ $band->name }}</h5>
                <a class="card-link" href="{{ url(route('rider.list', ['bandId' => $band->id])) }}">Voir les fiches techniques</a>
            </div>
        </div>
    </div>
@endforeach
@endsection