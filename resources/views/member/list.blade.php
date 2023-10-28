@extends('layout')

@section('content')
<div class="row">
    <div class="col s12 text-center mt-1 mb-5"><h1>{{ $band->name }}</h1></div>
</div>
<form name="members" method="POST" action="{{ url(route('members.save', ['bandId' => $band->id])) }}" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <div class="row">
        <div class="col">
            <div class="row" data-band-members="{{ $members->toJson() }}">
                <div class="col-lg-3">
                    <div class="card mr-2 mb-2 bg-white">
                        <div class="card-header bg-dark text-white">
                            <h5 class="card-title">Nouveau</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <input type="hidden" data-name="members_band_id" value="{{ $band->id }}" />
                                <label>Nom : <input type="text" data-name="members_name" class="form-control" /></label>
                                <label>Rôle : <input type="text" data-name="members_role" class="form-control" /></label>
                                <label>Allergies alimentaires : <input type="text" data-name="members_allergies" class="form-control" /></label>
                            </div>
                            <a href="#" class="btn btn-primary newItem">Ajouter</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="submit" class="btn btn-success" value="Sauvegarder" />
</form>
<script type="text/javascript" src="{{ asset('js/init_members.js') }}"></script>
@endsection