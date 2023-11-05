@php
    $allStuff    = $rider->getAllStuff();
    $allSections = App\Models\Stuff::enumValues()
@endphp
<table border="1">
    <tr>
        @foreach(array_keys($allStuff) as $section)
        <th style="width: {{ abs(100 / count($allStuff)) }}%">{{ $allSections[$section] }}</th>
        @endforeach
    </tr>
    <tr>
        @foreach($allStuff as $stuffSection)
        <td style="vertical-align: top;">
            @foreach($stuffSection as $stuffItem)
                @if (!empty($stuffItem->content))
                    <h4>{{ $stuffItem->label ?? $stuffItem->member->name.' : '.$stuffItem->member->role }}</h4>
                    {!! $stuffItem->content !!}
                @endif
            @endforeach
        </td>
        @endforeach
    </tr>
</table>