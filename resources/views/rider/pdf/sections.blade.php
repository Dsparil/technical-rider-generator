<table border="0" cellspacing="10">
    <tr>
        <td style="vertical-align: top; text-align: justify;">
            @foreach($rider->sections as $riderSection)
            <h4 style="margin-bottom: 0">{{ $riderSection->title }}</h4>
            <div style="margin-top: 0">{!! $riderSection->content !!}</div>
                @if($loop->iteration % 4 == 0)
        </td>
        <td style="vertical-align: top; text-align: justify;">
                @endif
            @endforeach
        </td>
    </tr>
</table>