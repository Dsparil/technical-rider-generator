<table style="text-align: center;">
    <tr>
        @foreach($rider->band->members as $member)
            @php
                $picture = Illuminate\Support\Facades\Storage::get('public/members/'.basename($member->picture));
                $type = pathinfo($rider->band->logo, PATHINFO_EXTENSION);
                $base64Picture = 'data:image/' . $type . ';base64,' . base64_encode($picture);
            @endphp
        <td><img src="{{ $base64Picture }}" style="width: 100px" /></td>
        @endforeach
    </tr>
    <tr>
        @foreach($rider->band->members as $member)
            <td><strong>{{ $member->name }}</strong> : {{ $member->role }}</td>
        @endforeach
    </tr>
</table>