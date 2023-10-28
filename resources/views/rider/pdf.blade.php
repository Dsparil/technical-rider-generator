<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html;charset=utf-8" http-equiv="Content-Type" /> 
        <meta content="utf-8" http-equiv="encoding" />
        <title>Fiche technique Muertissima</title>
        <style type="text/css">
            body {
                font-family: sans-serif;
            }
            .pageBreak {
                page-break-before: always;
            }
            @page {
                margin: 100px 25px;
            }
            footer {
                position: fixed; 
                bottom: -60px; 
                left: 0px; 
                right: 0px;
                height: 50px; 

                /** Extra personal styles **/
                border-top: 1px solid #000;
                text-align: center;
                line-height: 35px;
                font-size: 11px;
            }
            table {
                width: 100%;
                font-size: 12px;
            }
            .even {
                background: #eee;
            }
        </style>
    </head>
    @php
        $bandLogo = Illuminate\Support\Facades\Storage::get('public/logos/'.$rider->band->logo);
        $type = pathinfo($rider->band->logo, PATHINFO_EXTENSION);
        $base64Logo = 'data:image/' . $type . ';base64,' . base64_encode($bandLogo);
    @endphp
    <body>
        <footer>
            <img src="{{ $base64Logo }}" height="30px" style="margin-top: 12px" /> - Fiche technique - Copyright &copy; {{ date("Y") }} Simon PERRIN
        </footer>

        <main>
            <center>
                <img src="{{ $base64Logo }}" height="50%" />
                <br />
                <br />
                <h1>Fiche technique</h1>
                <p>Générée le : {{ date('Y-m-d H:i:s') }}</p>
            </center>

            <div class="pageBreak"></div>

            <h1>Présentation générale</h1>
            // TODO //
            <h3>Membres</h3>
            
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

            <h3>Staff et accompagnateurs</h3>
            // TODO //
            <h3>Langue d'échange</h3>
            // TODO //
            <br />
            <br />
            // TODO //

            <div class="pageBreak"></div>

            <h1>Rider</h1>
            @include('rider.pdf.sections')

            <div class="pageBreak"></div>

            <h1>Matériel</h1>
            @include('rider.pdf.stuff')

            <div class="pageBreak"></div>

            <h1>Patchlist</h1>
            @include('rider.pdf.patchlist')

            <div class="pageBreak"></div>

            <h1>Plan de scène</h1>
            <img src="{!! $rider->scene_map_snapshot !!}" style="width: 100%" />
        </main>
    </body>
</html>
