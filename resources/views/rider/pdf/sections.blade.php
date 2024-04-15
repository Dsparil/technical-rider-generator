@php
    $chunks = $rider->sections->chunk(4);
@endphp
<table border="0" cellspacing="10">
    <tr>
        @foreach ($chunks as $chunk)
        <td style="vertical-align: top; text-align: justify; width: {{ 100/count($chunks) }}%;">
            @foreach($chunk as $riderSection)
            <h4 style="margin-bottom: 0">{{ $riderSection->title }}</h4>
            <div style="margin-top: 0">{!! $riderSection->content !!}</div>
            @endforeach
        </td>
        @endforeach
    </tr>
</table>