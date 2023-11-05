<div class="row">
    <div class="col">
        <h3>Patchlist</h3>
        <div class="row" data-patchlist="{{ $rider->patchlists->toJson() }}" data-colorlist="{{ json_encode(App\Models\Patchlist::COLORS) }}">
            <div class="col-12">
                <div class="card mr-2 mb-2 bg-white">
                    <a name="newItem"></a>
                    <div class="card-header bg-dark text-white">
                        <h5 class="card-title">Nouvelle entrée</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <div class="row">
                                <div class="col-lg-1 col-sm-6">
                                    <label class="w-100">Numéro : <input type="number" data-name="patchlist_number" class="form-control" /></label>
                                </div>
                                <div class="col-lg-2 col-sm-6">
                                    <label class="w-100">Membre : <span class="members_selectbox" data-field="new-member_id" data-object-name="patchlist"></span></label>
                                </div>
                                <div class="col-lg-2 col-sm-12">
                                    <label class="w-100">Instrument : <input type="text" data-name="patchlist_instrument" class="form-control" /></label>
                                </div>
                                <div class="col-lg-2 col-sm-12">
                                    <label class="w-100">Type de micro : <input type="text" data-name="patchlist_microphone" class="form-control" /></label>
                                </div>
                                <div class="col-lg-1 col-sm-6">
                                    <label class="w-100">Fond : <input type="color" data-name="patchlist_microphone" class="form-control" value="#FFFFFF" /></label>
                                </div>
                                <div class="col-lg-2 col-sm-6">
                                    <label class="w-100">Taille du stand de micro : <span class="micstand_selectbox" data-field="new-microphone_stand" data-object-name="patchlist"></span></label>
                                </div>
                                <div class="col-lg-1 col-sm-6">
                                    <label class="w-100">Insert : <input type="text" data-name="patchlist_effect_insert" class="form-control" /></label>
                                </div>
                                <div class="col-1">
                                    <a href="#newItem" class="btn btn-sm btn-primary newItem mt-4">Ajouter</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        document.getPatchlistStandSelectBox = function(targetObject, field, item, selectedId, forceObjectName) {
            var selectBox = '';

            $.ajax({
                url:      T.PATCHLIST.AJAX_LIST_ENUM,
                dataType: 'json',
                async:    false
            }).done(function(data) {
                let options       = `<option value="">--</option>`;
                let selected      = '';
                let nameAttribute = '';
        
                for (var idx in data) {
                    selected = (selectedId == idx)? ' selected="selected"' : '';
                    options +=  `<option value="${idx}" ${selected}> ${data[idx]}</option>`;
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

        document.$patchlist = $.extend($('[data-patchlist]'), crudObject, {
            deleteButtonBelow: false,
            movable:           true,
            attributeName:     'data-patchlist',
            objectName:        'patchlist',
            colClass:          'col-12',
            fieldList:         [
                'number',
                'member_id',
                'instrument',
                'microphone',
                'microphone_stand',
                'effect_insert',
                'color'
            ],

            renumber: function() {
                let items = this.getItems();

                for (let idx in items) {
                    items[idx].number = parseInt(idx) + 1;
                }

                this.setItems(items);
            },

            moveUp: function(id) {
                this.renumber();
            },

            moveDown: function(id) {
                this.renumber();
            },

            getCardContent: function(item) {
                if (item.color === null) {
                    item.color = '#FFFFFF';
                }

                return `
                <div class="col-lg-1 col-sm-6">
                    <label class="w-100">Numéro : <input type="number" name="${this.getInputName(item, 'number')}" class="form-control" value="${item.number}" /></label>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <label class="w-100">Membre : ${document.getMembersSelectBox(this, 'member_id', item, item.member_id, this.objectName)}</label>
                </div>
                <div class="col-lg-2 col-sm-12">
                    <label class="w-100">Instrument : <input type="text" name="${this.getInputName(item, 'instrument')}" class="form-control" value="${item.instrument}" /></label>
                </div>
                <div class="col-lg-2 col-sm-12">
                    <label class="w-100">Type de micro : <input type="text" name="${this.getInputName(item, 'microphone')}" class="form-control" value="${item.microphone}" /></label>
                </div>
                <div class="col-lg-1 col-sm-6">
                    <label class="w-100">Fond : <input type="color" name="${this.getInputName(item, 'color')}" class="form-control" value="${item.color}" /></label>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <label class="w-100">Taille du stand de micro : ${document.getPatchlistStandSelectBox(this, 'microphone_stand', item, item.microphone_stand, this.objectName)}</label>
                </div>
                <div class="col-lg-1 col-sm-6">
                    <label class="w-100">Insert : <input type="text" name="${this.getInputName(item, 'effect_insert')}" class="form-control" value="${(item.effect_insert !== null)? item.effect_insert : ''}" /></label>
                </div>
                `;
            }
        }).bindEvents();

        $('span.members_selectbox').html(document.getMembersSelectBox(document.$patchlist, 'new-member_id'));
        $('span.micstand_selectbox').html(document.getPatchlistStandSelectBox(document.$patchlist, 'new-microphone_stand'));
    });
</script>