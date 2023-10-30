@extends('layout')

@section('content')
<div class="row">
    <div class="col s12 text-center mt-1 mb-5"><h1>{{ $band->name }}</h1></div>
</div>
<form action="{{ route('band.edit', ['bandId' => $band->id]) }}" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <div class="row">
        <div class="col-lg-8 col-12">
            <div class="form-group">
                <label for="band-name">Nom</label>
                <input type="text" class="form-control bg-white" id="band-name" name="band-name" placeholder="" value="{{ $band->name }}" />
            </div>
            <div class="row">
                <div class="form-group col-lg-5 col-12">
                    <label for="band-style">Style</label>
                    <input type="text" class="form-control bg-white" id="band-style" name="band-style" placeholder="" value="{{ $band->style }}" />
                </div>
                <div class="form-group col-lg-3 col-12">
                    <label for="band-style">Année de naissance</label>
                    <input type="text" class="form-control bg-white" id="band-birth_year" name="band-birth_year" placeholder="" value="{{ $band->birth_year }}" />
                </div>
                <div class="form-group col-lg-4 col-12">
                    <label for="band-style">Label</label>
                    <input type="text" class="form-control bg-white" id="band-label" name="band-label" placeholder="" value="{{ $band->label }}" />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-6 col-12">
                    <label for="band-style">Siège</label>
                    <input type="text" class="form-control bg-white" id="band-location" name="band-location" placeholder="" value="{{ $band->location }}" />
                </div>
                <div class="form-group col-lg-6 col-12">
                    <label for="band-style">Langues parlées</label>
                    <input type="text" class="form-control bg-white" id="band-spoken_languages" name="band-spoken_languages" placeholder="" value="{{ $band->spoken_languages }}" />
                </div>
            </div>
            <div class="form-group">
                <label for="band-style">Description</label>
                <textarea id="band-description" name="band-description" class="form-control">{!! $band->description !!}</textarea>
            </div>
            <div class="form-group">
                <label for="band-style">Staff</label>
                <textarea id="band-staff" name="band-staff" class="form-control">{!! $band->staff !!}</textarea>
            </div>
            <div class="row">
                <div class="form-group col-lg-4 col-12">
                    <label for="band-style">Facebook</label>
                    <input type="text" class="form-control bg-white" id="band-link_fb" name="band-link_fb" placeholder="" value="{{ $band->link_fb }}" />
                </div>
                <div class="form-group col-lg-4 col-12">
                    <label for="band-style">Instagram</label>
                    <input type="text" class="form-control bg-white" id="band-link_ig" name="band-link_ig" placeholder="" value="{{ $band->link_ig }}" />
                </div>
                <div class="form-group col-lg-4 col-12">
                    <label for="band-style">Youtube</label>
                    <input type="text" class="form-control bg-white" id="band-link_yt" name="band-link_yt" placeholder="" value="{{ $band->link_yt }}" />
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12">
            <div class="form-group">
                <label for="band-logo">Logo</label>
                <input type="file" id="band-logo" name="band-logo" class="form-control bg-white" />
            </div>
            <div class="text-center mt-4">
                <img id="band-logo-img" name="band-logo-img" src="{{ url('storage/logos/'.$band->logo) }}" style="object-fit:contain; height: 10rem;" />
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-success mt-4">Sauvegarder</button>
</form>

<script type="text/javascript">
$(document).ready(function() {
    let editors = [$('#band-description')[0], $('#band-staff')[0]];

    for (idx in editors) {
        tinymce.init({
            target:      editors[idx],
            menubar:     false,
            toolbar:     'styleselect bold italic forecolor backcolor bullist numlist outdent indent',
            plugins:     'textcolor, lists,advlist',
            width:       '100%',
            // skin:        'oxide-dark',
            // content_css: 'dark',
            statusbar:   false,
            setup:       function (editor) {
                editor.on('change', function () {
                    editor.save();
                });
            }
        });
    }

    $('#band-logo').on('change', function(event) {
        let input  = event.target;
        let $input = $(input);
        let file   = input.files[0];
        let url    = URL.createObjectURL(file);

        $('#band-logo-img').attr('src', url);
    }.bind(this));

});
</script>
@endsection