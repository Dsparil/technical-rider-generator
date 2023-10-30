<table border="0">
    <tr>
        <td style="width: 130px;"><b>Style :</b></td>
        <td>{{ $rider->band->style }}</td>
    </tr>
    <tr>
        <td><b>Année de formation :</b></td>
        <td>{{ $rider->band->birth_year }}</td>
    </tr>
    <tr>
        <td><b>Localisation :</b></td>
        <td>{{ $rider->band->location }}</td>
    </tr>
    <tr>
        <td><b>Label :</b></td>
        <td>{{ $rider->band->label }}</td>
    </tr>
    <tr>
        <td><b>Description :</b></td>
        <td>{!! $rider->band->description !!}</td>
    </tr>
</table>

<h3>Membres</h3>
@include('rider.pdf.members')

@if(!empty($rider->band->staff))
    <h3>Staff et accompagnateurs</h3>
    {!! $rider->band->staff !!}
@endif

@if(!empty($rider->band->spoken_languages))
    <h3>Langues d'échange</h3>
    {{ $rider->band->spoken_languages }}
@endif

<br />
<br />

@if(!empty($rider->band->link_ig))
    <b>Instagram : </b>{{ $rider->band->link_ig }}<br />
@endif
@if(!empty($rider->band->link_fb))
    <b>Facebook : </b>{{ $rider->band->link_fb }}<br />
@endif
@if(!empty($rider->band->link_yt))
    <b>Youtube : </b>{{ $rider->band->link_yt }}<br />
@endif