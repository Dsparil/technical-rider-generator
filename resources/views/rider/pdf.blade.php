<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
        <meta http-equiv="encoding" content="utf-8" />
        <title>Fiche technique {{ $rider->band->name }}</title>
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
            table tr td {
                vertical-align: top;
            }
            .even {
                background: #eee;
            }
        </style>
    </head>
    <body>
        <footer>
            {{ $rider->band->name }} - Fiche technique - Copyright &copy; {{ date("Y") }} Simon PERRIN
        </footer>

        <main>
            <center>
                <img src="{{ $rider->band->base64Logo() }}" style="max-width: 90%; max-height: 50%;" />
                <br />
                <br />
                <h1>Fiche technique</h1>
                <p>Générée par GTRG le : {{ date('Y-m-d H:i:s') }}</p>
            </center>

            <div class="pageBreak"></div>

            <h1>Présentation générale</h1>
            @include('rider.pdf.presentation')

            @if (count($rider->sections) > 0)
                <div class="pageBreak"></div>

                <h1>Rider</h1>
                @include('rider.pdf.sections')
            @endif

            @if (count($rider->stuff) > 0)
                <div class="pageBreak"></div>

                <h1>Matériel</h1>
                @include('rider.pdf.stuff')
            @endif

            @if (count($rider->patchlists) > 0)
                <div class="pageBreak"></div>

                <h1>Patchlist</h1>
                @include('rider.pdf.patchlist')
            @endif

            @if(!empty($rider->hasSceneMap()))
                <div class="pageBreak"></div>

                <h1>Plan de scène</h1>
                <img src="{!! $rider->scene_map_snapshot !!}" style="width: 100%" />
            @endif
        </main>
    </body>
</html>
