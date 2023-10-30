<div class="row">
    <div class="col">
        <h3>Matériel</h3>
        <div class="row" data-stuff="{{ $rider->stuff->toJson() }}">
            <div class="col-lg-6">
                <div class="card mr-2 mb-2 bg-white">
                    <div class="card-header bg-dark text-white">
                        <h5 class="card-title">Nouveau</h5>
                    </div>
                    <div class="card-body">
                        <a name="sections_newItem"></a>
                        <div class="form-group mb-3">
                            <label>Type : <span class="sections_selectbox" data-field="new-section" data-object-name="stuff"></span></label>
                            <label>Membre : <span class="members_selectbox_stuff" data-field="new-member_id" data-object-name="stuff"></span></label>
                            <label>Spécificité : <input type="text" data-name="stuff_label" class="form-control" /></label>
                            <label>Description : <textarea data-name="stuff_content" class="form-control w-100"></textarea></label>
                        </div>
                        <a href="#sections_newItem" class="btn btn-primary newItem">Ajouter</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        document.getStuffTypeSelectBox = function(targetObject, field, item, selectedId, forceObjectName) {
            var selectBox = '';

            $.ajax({
                url:      T.STUFF.AJAX_LIST_ENUM,
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

        document.$stuff = $.extend(true, $('[data-stuff]'), crudObject, {
            attributeName: 'data-stuff',
            objectName:    'stuff',
            colClass:      'col-lg-6',
            fieldList:     [
                'section',
                'member_id',
                'label',
                'content'
            ],

            getCardContent: function(item) {
                return  `<div class="form-group mb-3">
                            <label>Type : ${document.getStuffTypeSelectBox(this, 'section', item, item.section, this.objectName)}</label>
                            <label>Membre : ${document.getMembersSelectBox(this, 'member_id', item, item.member_id, this.objectName)}</label>
                            <label>Spécificité : <input type="text" name="${this.getInputName(item, 'label')}" class="form-control" value="${(item.label ?? '')}"" /></label>
                            <label>Description : <textarea name="${this.getInputName(item, 'content')}" class="form-control w-100">${item.content}</textarea></label>
                        </div>`;
            },

            buildCardsCallback: function() {
                this.find('textarea').each(function(idx, item) {
                    tinymce.init({
                        target:      item,
                        menubar:     false,
                        toolbar:     'styleselect bold italic forecolor backcolor bullist numlist outdent indent',
                        plugins:     'textcolor, lists,advlist',
                        width:       '100%',
                        // skin:        'oxide-dark',
                        // content_css: 'dark',
                        statusbar:   false,
                        setup:       function (editor) {
                            editor.on('change', function () {
                                editor.save();
                            });
                        }
                    });
                });
            }
        }).bindEvents();

        $('span.members_selectbox_stuff').html(document.getMembersSelectBox(document.$stuff, 'new-member_id'));
        $('span.sections_selectbox').html(document.getStuffTypeSelectBox(document.$stuff, 'new-section'));
    });
</script>