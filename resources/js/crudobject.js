var crudObject = {
    attributeName:      null,
    objectName:         null,
    colClass:           'col-3',
    fieldList:          [],
    buildCardsCallback: null,
    deleteButtonBelow:  true,

    getItems: function() {
        return JSON.parse(this.attr(this.attributeName));
    },

    setItems: function(items) {
        this.attr(this.attributeName, JSON.stringify(items));
    },

    getFirstItemBy(field, value) {
        var items = this.getItems();

        for (idx in items) {
            if (items[idx][field] == value) {
                return items[idx];
            }
        }

        return null;
    },

    deleteItemById: function(id) {
        var items = this.getItems();

        for (idx in items) {
            if (items[idx].id == id) {
                items.splice(idx, 1);
            }
        }

        this.setItems(items);
        this.trigger('modified');
        this.buildCards();
    },

    newItem: function(item) {
        var items = this.getItems();

        item.id = 'new' + this.countNewItems();
        items.push(item);

        this.setItems(items);
        this.trigger('modified');
        this.buildCards();
    },

    countNewItems: function () {
        let items      = this.getItems();
        let newCounter = 0;

        for (idx in items) {
            if (typeof(items[idx].id) == 'string' && items[idx].id.substr(0, 3) == 'new') {
                ++newCounter;
            }
        }

        return newCounter;
    },

    getSelectBox: function(field, item, selectedId, forceObjectName) {
        let items         = this.getItems();
        let options       = `<option value="">--</option>`;
        let selected      = '';
        let nameAttribute = '';

        for (var idx in items) {
            selected = (selectedId == items[idx].id)? ' selected="selected"' : '';
            options +=  `<option value="${items[idx].id}" ${selected}> ${items[idx].name}</option>`;
        }

        if (field.substr(0, 4) == 'new-') {
            nameAttribute = 'data-name="' + ((forceObjectName)? forceObjectName : this.objectName) + '_' + field.substr(4) + '"';
        } else {
            nameAttribute = 'name="' + this.getInputName(item, field, forceObjectName) + '"';
        }

        return `<select ${nameAttribute} class="form-control ${this.objectName}">${options}</select>`;
    },

    bindEvents: function() {
        this.on('click', 'a.deleteItem', function(event) {
            var $target = $(event.target);
            var id      = $target.closest('div').find('input[name$="[id]"]').val();

            this.deleteItemById(id);
        }.bind(this)).on ('click', 'a.newItem', function(event) {
            let newItem      = {};
            let field        = null;
            let newItemInput = null;

            for (var idx in this.fieldList) {
                field = this.fieldList[idx];
                newItemInput = this.getNewItemInput(field);
                newItem[field] = (newItemInput.length > 0)? newItemInput.val() : '';
                this.getNewItemInput(field).val('');
            }

            this.newItem(newItem);
        }.bind(this));

        if (this.bindCustomEvents) {
            this.bindCustomEvents();
        }

        $('span.' + this.objectName + '_selectbox').each(function(idx, item) {
            let $item      = $(item);
            let field      = $item.attr('data-field');
            let objectName = $item.attr('data-object-name');

            $item.replaceWith(this.getSelectBox(field, undefined, undefined, objectName));
        }.bind(this));

        this.buildCards();

        this.on('change', 'input[type=file]', function(event) {
            console.log('CHANGE');
            let input  = event.target;
            let $input = $(input);
            let file   = input.files[0];
            let url    = URL.createObjectURL(file);

            $input.closest('.card').find($input.attr('data-target')).html(`<img src="${url}" style="width: 100%;" />`);
        }.bind(this));

        return this;
    },

    getInputForId: function(item) {
        return `<input type="hidden" name="${this.getInputName(item, 'id')}" value="${item.id}" />`;
    },

    getNewItemInput: function(field) {
        return $('[data-name="' + this.objectName + '_' + field + '"]');
    },

    getDeleteButton: function(strClass) {
        let btnClass = '';

        if (strClass) {
            btnClass = strClass;
        }

        return `<a href="#" class="btn btn-sm btn-danger deleteItem ${btnClass}">Supprimer</a>`;
    },

    getInputName: function(item, name, forceObjectName) {
        return ((forceObjectName)? forceObjectName : this.objectName) + '[' + item.id + '][' + name + ']';
    },

    getCard: function(item) {
        let header = this.getCardHeader(item);

        if (header != '') {
            header = `<div class="card-header"><h5>${header}</h5></div>`;
        }

        if (this.deleteButtonBelow) {
            return $(
                `<div class="${this.colClass}" data-item-id="${item.id}">
                    <div class="card mr-2 mb-2 bg-white">
                        ${header}
                        <div class="card-body">
                            <div class="form-group mb-3">
                                ${this.getInputForId(item)}
                                ${this.getCardContent(item)}
                            </div>
                            ${this.getDeleteButton()}
                        </div>
                    </div>
                </div>`
            );
        } else {
            return $(
                `<div class="${this.colClass}" data-item-id="${item.id}">
                    <div class="card mr-2 mb-2 bg-white">
                        ${header}
                        <div class="card-body">
                            <div class="form-group mb-3">
                                ${this.getInputForId(item)}
                                <div class="row">
                                    ${this.getCardContent(item)}
                                    <div class="col-1">
                                        ${this.getDeleteButton('mt-4')}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`
            );
        }
    },

    getCardContent: function(id) {},

    getCardHeader: function(id) {
        return '';
    },

    buildCards: function() {
        // this.find('div.' + this.colClass + ':not(:last-child)').remove();
        let colSelector = 'div.' + this.colClass;
        
        this.find(colSelector + ':not(:last-child)').each(function(idx, item) {
            let $item = $(item);
            let items = this.getItems();
            let found = false;

            for (idx in items) {
                if (items[idx].id == $item.attr('data-item-id')) {
                    found = true;
                    break;
                }
            }

            if (!found) {
                $item.remove();
            }
        }.bind(this));

        var items = this.getItems();

        for (idx in items) {
            if (this.find('[data-item-id=' + items[idx].id + ']').length == 0) {
                this.find(colSelector + ':last-child').before(this.getCard(items[idx]));
            }
        }

        if (this.buildCardsCallback) {
            this.buildCardsCallback();
        }
    }
};