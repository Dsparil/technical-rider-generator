<style type="text/css">
#scenemap_items img {
    width: 50px;
}
</style>

<h6 class="mt-3">Cliquez sur un objet pour l'insérer dans le plan de scène. Vous pouvez le déplacer, le redimensionner ou le pivoter à votre guise.</h6>

<div class="row pb-3 pt-3">
    <input type="hidden" name="scenemap-json" id="scenemap_json" value="{{ $rider->scene_map_json }}" />
    <input type="hidden" name="scenemap-snapshot" id="scenemap_snapshot" />
    <div class="col">
        <canvas id="scene_map" class="border" width="1024" height="600"></canvas>
    </div>
    <div class="col" id="scenemap_items">
        <div class="mb-3 border-bottom">
            <button type="button" id="btn_remove" class="btn">Supprimer</button>
            <button type="button" id="btn_duplicate" class="btn">Dupliquer</button>
        </div>
        <h5 class="border-bottom">Membres</h5>
        <div class="mb-3">
            @foreach ($members as $member)
                <img src="{{ $member->picture }}" data-member-id="{{ $member->id }}" title="{{ $member->name }}" />
            @endforeach
        </div>
        @foreach (App\Models\Item::enumValues() as $itemType => $itemTypeLabel)
            <h5 class="border-bottom">{{ $itemTypeLabel }}</h5>
            <div class="mb-3">
                @foreach ($items->filter->isType($itemType) as $item)
                    <img src="{{ $item->picture }}" data-item-id="{{ $item->id }}" title="{{ $item->name }}" />
                @endforeach
            </div>
        @endforeach
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        let canvas = new fabric.Canvas('scene_map');

        canvas.on('object:rotating', function(options) {
            let step = 45;
            options.target.angle = Math.round(options.target.angle / step) * step;
        });

        $('#scenemap_items').on('click', 'img', function(targetCanvas, event) {
            let image = event.target;

            targetCanvas.add(new fabric.Image(image, {
                left: 100,
                top: 100,
                scaleX: .25,
                scaleY: .25,
                originX: 'center',
                originY: 'center'
            }));
        }.bind(null, canvas));

        $('#btn_duplicate').click(function(targetCanvas) {
            let object = targetCanvas.getActiveObject();

            if (!object){
                return;
            }

            object.clone(function(subtargetCanvas, targetObject, clone) {
                subtargetCanvas.add(clone.set({
                    left: object.left + 10, 
                    top:  object.top + 10
                }));

                subtargetCanvas.setActiveObject(clone);
            }.bind(null, targetCanvas, object));
        }.bind(null, canvas));

        $('#btn_remove').click(function(targetCanvas) {
            let object = targetCanvas.getActiveObject();

            if (!object){
                return;
            }

            targetCanvas.remove(object);
        }.bind(null, canvas));

        let json = $('#scenemap_json').val();

        if (json !== null && json != '') {
            canvas.loadFromJSON(json);
        }

        $('#riderForm').on('submit', function(targetCanvas) {
            $('#scenemap_json').val(JSON.stringify(targetCanvas));
            $('#scenemap_snapshot').val(targetCanvas.toDataURL('png'));
        }.bind(null, canvas));
    });
</script>