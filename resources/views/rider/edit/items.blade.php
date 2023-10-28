<div class="row">
    <div class="col">
        <h3>Éléments du plan de scène</h3>
        <div class="row" data-items="{{ $items->toJson() }}">
            <div class="col-lg-2">
                <div class="card mr-2 mb-2 bg-white">
                    <div class="card-header bg-dark text-white">
                        <h5 class="card-title">Nouveau</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label>Nom : <input type="text" data-name="items_name" class="form-control" /></label>
                            <label>Type : <span class="item_type_selectbox" data-field="new-item_type" data-object-name="items"></span></label>
                        </div>
                        <a href="#" class="btn btn-primary newItem">Ajouter</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        document.getItemTypeSelectBox = function(targetObject, field, item, selectedId, forceObjectName) {
            var selectBox = '';

            $.ajax({
                url:      T.ITEM.AJAX_LIST_ENUM,
                dataType: 'json',
                async:    false
            }).done(function(data) {
                let options       = `<option value="">--</option>`;
                let selected      = '';
                let nameAttribute = '';

                for (var idx in data) {
                    selected = (selectedId == idx)? ' selected="selected"' : '';
                    options += `<option value="${idx}" ${selected}> ${data[idx]}</option>`;
                }

                if (field.substr(0, 4) == 'new-') {
                    nameAttribute = 'data-name="' + ((forceObjectName)? forceObjectName : targetObject.objectName) + '_' + field.substr(4) + '"';
                } else {
                    nameAttribute = 'name="' + targetObject.getInputName(item, field, forceObjectName) + '"';
                }

                selectBox = `<select ${nameAttribute} class="form-control ${targetObject.objectName}">${options}</select>`;
            });

            return selectBox;
        };

        document.$items = $.extend($('[data-items]'), crudObject, {
            attributeName: 'data-items',
            objectName:    'items',
            colClass:      'col-lg-2',
            fieldList:     [
                'name',
                'item_type',
                'picture'
            ],
            getCardHeader: function(item) {
                let header = '--';

                if (item.picture !== undefined && item.picture !== null && item.picture != '') {
                    header = `<img src="${item.picture}" style="width: 100%;" />`;
                }

                return header;
            },
            getCardContent: function(item) {
                return  `<p class="card-text">
                            <label>Nom : <input type="text" name="${this.getInputName(item, 'name')}" class="form-control" value="${item.name}" /></label>
                            <label>Type : ${document.getItemTypeSelectBox(this, 'item_type', item, item.item_type, this.objectName)}</label>
                            <label>Image : <input type="file" name="${this.getInputName(item, 'picture')}" data-target=".card-header" class="form-control" /></label>
                        </p>`;
            }
        }).bindEvents();

        $('span.item_type_selectbox').html(document.getItemTypeSelectBox(document.$items, 'new-item_type'));
    });
</script>