@extends('layout')

@section('content')
<div class="row">
    <div class="col s12 text-center mt-1 mb-5"><h1>{{ $band->name }}</h1></div>
</div>
<div class="row">
@foreach ($riders as $rider)
    <div class="col-sm-6 col-lg-3 mb-2">
        <div class="card bg-white" style="height: 18rem;">
            <div class="card-header bg-dark text-white">
                <h5 class="card-title">{{ $rider->title }}</h5>
            </div>
            <div class="card-body text-dark">
                Créée le : {{ $rider->created_at->format('d/m/Y à H:i') }}
                <hr />
                <a class="btn btn-sm btn-success" href="{{ url(route('rider.download', ['riderId' => $rider->id])) }}">Télécharger</a><br />
                <a class="btn btn-sm btn-primary mt-1" href="{{ url(route('rider.edit', ['riderId' => $rider->id])) }}">Modifier</a><br />
                <a class="btn btn-sm btn-primary mt-1" href="{{ url(route('rider.duplicate', ['riderId' => $rider->id])) }}">Dupliquer</a><br />
                <a class="btn btn-sm btn-danger mt-3" href="{{ url(route('rider.delete', ['riderId' => $rider->id])) }}">Supprimer</a>
            </div>
        </div>
    </div>
@endforeach

    <div class="col-sm-6 col-lg-3">
        <div class="card bg-white" style="height: 18rem;">
            <div class="card-header bg-dark text-white">
                <h5 class="card-title">Nouvelle fiche technique</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('rider.new', ['bandId' => $band->id]) }}"">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="form-group mb-3">
                        <label>Nom : <input type="text" name="title" class="form-control" /></label>
                    </div>
                    <input type="submit" class="btn btn-sm btn-primary" value="Créer" />
                </form>
            </div>
        </div>
    </div>
@endsection
</div>