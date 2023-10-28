$(document).ready(function() {
    let $container = $('[data-band-members]');

    if ($container.length > 0) {
        document.$bandMembers = $.extend($container, crudObject, {
            attributeName: 'data-band-members',
            objectName:    'members',
            colClass:      'col-lg-3',
            fieldList:     [
                'band_id',
                'name',
                'picture',
                'role',
                'allergies'
            ],
            getCardHeader: function(item) {
                let header = '--';

                if (item.picture !== undefined && item.picture !== null && item.picture != '') {
                    header = `<img src="${item.picture}" style="width: 100%;" />`;
                }

                return header;
            },
            getCardContent: function(item) {
                return  `<p class="form-group mb-3">
                            <input type="hidden" name="${this.getInputName(item, 'band_id')}" value="${item.band_id}" />
                            <label>Nom : <input type="text" name="${this.getInputName(item, 'name')}" class="form-control" value="${item.name}" /></label>
                            <label>Rôle : <input type="text" name="${this.getInputName(item, 'role')}" class="form-control" value="${item.role}" /></label>
                            <label>Allergies alimentaires : <input type="text" name="${this.getInputName(item, 'allergies')}" class="form-control" value="${(item.allergies !== null)? item.allergies : ''}" /></label>
                            <label>Photo : <input type="file" name="${this.getInputName(item, 'picture')}" data-target=".card-header" class="form-control" />
                        </p>`;
            }
        }).bindEvents();
    }

    document.getMembersSelectBox = function(targetObject, field, item, selectedId, forceObjectName) {
        var selectBox = '';
        
        $.ajax({
            url:      T.MEMBER.AJAX_LIST_URL.replace('__BAND_ID__', $('#bandId').val()),
            dataType: 'json',
            async:    false
        }).done(function(data) {
            let options       = `<option value="">--</option>`;
            let selected      = '';
            let nameAttribute = '';
    
            for (var idx in data) {
                selected = (selectedId == data[idx].id)? ' selected="selected"' : '';
                options +=  `<option value="${data[idx].id}" ${selected}> ${data[idx].name}</option>`;
            }
    
            if (field.substr(0, 4) == 'new-') {
                nameAttribute = 'data-name="' + ((forceObjectName)? forceObjectName : targetObject.objectName) + '_' + field.substr(4) + '"';
            } else {
                nameAttribute = 'name="' + targetObject.getInputName(item, field, forceObjectName) + '"';
            }
    
            selectBox = `<select ${nameAttribute} class="form-control ${targetObject.objectName}">${options}</select>`;
        });

        return selectBox;
    }
});