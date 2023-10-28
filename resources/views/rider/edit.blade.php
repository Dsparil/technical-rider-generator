@extends('layout')

@section('content')
<a class="btn" href="{{ url(route('rider.list', ['bandId' => $rider->band->id])) }}">&lt; Liste des fiches techniques</a>
<div class="row">
    <div class="col s12 text-center mt-1 mb-5"><h1>{{ $rider->band->name }} -&gt; {{ $rider->title }}</h1></div>
</div>

<input type="hidden" id="bandId" value="{{ $rider->band->id }}" />
<script type="text/javascript" src="{{ asset('js/init_members.js') }}"></script>

<form id="riderForm" method="POST" action="{{ route('rider.edit', ['riderId' => $rider->id]) }}" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <!-- Tabs -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link{{ ($activeTab == 'patchlist')? ' active' : '' }}" id="patchlist-tab" data-bs-toggle="tab" data-bs-target="#patchlist" type="button" role="tab" aria-controls="patchlist" aria-selected="false">Patchlist</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link{{ ($activeTab == 'stuff')? ' active' : '' }}" id="stuff-tab" data-bs-toggle="tab" data-bs-target="#stuff" type="button" role="tab" aria-controls="stuff" aria-selected="false">Matériel</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link{{ ($activeTab == 'rider')? ' active' : '' }}" id="rider-tab" data-bs-toggle="tab" data-bs-target="#rider" type="button" role="tab" aria-controls="rider" aria-selected="false">Contenu personnalisé</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link{{ ($activeTab == 'spi')? ' active' : '' }}" id="spi-tab" data-bs-toggle="tab" data-bs-target="#spi" type="button" role="tab" aria-controls="spi" aria-selected="false">Éléments plan de scène</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link{{ ($activeTab == 'scenemap')? ' active' : '' }}" id="scene-tab" data-bs-toggle="tab" data-bs-target="#scene" type="button" role="tab" aria-controls="scene" aria-selected="false">Plan de scène</button>
        </li>
    </ul>
    <!-- Tabs contents -->
    <div class="tab-content" id="myTabContent">
        <!-- Patchlist -->
        <div class="tab-pane fade{{ ($activeTab == 'patchlist')? ' show active' : '' }}" id="patchlist" role="tabpanel" aria-labelledby="patchlist-tab">
            @include('rider.edit.patchlist')
        </div>
        <!-- Matériel -->
        <div class="tab-pane fade{{ ($activeTab == 'stuff')? ' show active' : '' }}" id="stuff" role="tabpanel" aria-labelledby="stuff-tab">
            @include('rider.edit.stuff')
        </div>
        <!-- Rider -->
        <div class="tab-pane fade{{ ($activeTab == 'rider')? ' show active' : '' }}" id="rider" role="tabpanel" aria-labelledby="rider-tab">
            @include('rider.edit.section')
        </div>
        <!-- Éléments plan de scène -->
        <div class="tab-pane fade{{ ($activeTab == 'spi')? ' show active' : '' }}" id="spi" role="tabpanel" aria-labelledby="spi-tab">
            @include('rider.edit.items')
        </div>
        <!-- Plan de scène -->
        <div class="tab-pane fade{{ ($activeTab == 'scenemap')? ' show active' : '' }}" id="scene" role="tabpanel" aria-labelledby="scene-tab">
            @include('rider.edit.scenemap')
        </div>
    </div>
    
    <div class="row">
        <div class="col s12 text-right">
            <input type="submit" value="Sauvegarder" class="btn btn-success" />
        </div>
    </div>
</form>
@endsection