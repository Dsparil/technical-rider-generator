<table border="1">
    <tr>
        @foreach(App\Models\Stuff::enumValues() as $stuffSection)
        <th style="width: {{ abs(100 / count(App\Models\Stuff::enumValues())) }}%">{{ $stuffSection }}</th>
        @endforeach
    </tr>
    <tr>
        @foreach(App\Models\Stuff::enumValues() as $sectionCode => $stuffSection)
        <td style="vertical-align: top;">
            @foreach($rider->stuff->filter->isSection($sectionCode) as $stuffItem)
                @if (!empty($stuffItem->content))
                    <h4>{{ $stuffItem->label ?? $stuffItem->member->name.' : '.$stuffItem->member->role }}</h4>
                    {!! $stuffItem->content !!}
                @endif
            @endforeach
        </td>
        @endforeach
    </tr>
</table>