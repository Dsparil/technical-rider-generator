<table border="1" cellspacing="0">
    <tr>
        <th>Entrée</th>
        <th>Musicien</th>
        <th>Instrument</th>
        <th>Micro</th>
        <th>Pied de micro</th>
    </tr>
    @foreach($rider->patchlists as $patch)
    <tr>
        <td>{{ $patch->number }}</td>
        <td>{{ $patch->member->name }}</td>
        <td>{{ $patch->instrument }}</td>
        <td>{{ $patch->microphone }}</td>
        <td>{{ $patch->microphone_stand }}</td>
    </tr>
    @endforeach
</table>