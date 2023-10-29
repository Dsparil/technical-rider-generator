var crudObject = {
    attributeName:      null,
    objectName:         null,
    colClass:           'col-3',
    fieldList:          [],
    buildCardsCallback: null,
    deleteButtonBelow:  true,
    movable:            false,

    getItems: function() {
        return JSON.parse(this.attr(this.attributeName));
    },

    setItems: function(items) {
        this.attr(this.attributeName, JSON.stringify(items));
    },

    getFirstItemBy: function(field, value) {
        let items = this.getItems();

        for (idx in items) {
            if (items[idx][field] == value) {
                return items[idx];
            }
        }

        return null;
    },

    getFirstIdxBy: function(field, value) {
        let items = this.getItems();

        for (idx in items) {
            if (items[idx][field] == value) {
                return parseInt(idx);
            }
        }

        return null;
    },

    deleteItemById: function(id) {
        let items = this.getItems();
        let idx = this.getFirstIdxBy('id', id);
        
        console.log('idx =', idx, 'items =', items);

        if (idx !== null) {
            items.splice(idx, 1);
        }

        this.setItems(items);
        this.trigger('modified');
        this.buildCards();
    },

    newItem: function(item) {
        let items = this.getItems();

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

        for (let idx in items) {
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

    _getItemIdFromButton: function($button) {
        return $button.closest('div[data-item-id]').attr('data-item-id');
    },

    bindEvents: function() {
        this.on('click', 'a.deleteItem', function(event) {
            let $target = $(event.target);
            let id      = this._getItemIdFromButton($target);

            this.deleteItemById(id);
        }.bind(this)).on ('click', 'a.newItem', function(event) {
            let newItem      = {};
            let field        = null;
            let newItemInput = null;

            for (let idx in this.fieldList) {
                field = this.fieldList[idx];
                newItemInput = this.getNewItemInput(field);
                newItem[field] = (newItemInput.length > 0)? newItemInput.val() : '';
                this.getNewItemInput(field).val('');
            }

            this.newItem(newItem);
        }.bind(this)).on('click', 'a.moveUpItem', function(event) {
            let $target = $(event.target);
            let id      = this._getItemIdFromButton($target);
            let idx     = this.getFirstIdxBy('id', id);
            let items   = this.getItems();

            console.log('MOVE UP ', idx);
            console.log('ITEMS =', items);

            if (idx === null || idx == 0) {
                return;
            }

            let tmp        = items[idx - 1];
            items[idx - 1] = items[idx];
            items[idx]     = tmp;

            this.setItems(items);

            this.moveUp(id);

            this.buildCards(true);
        }.bind(this)).on('click', 'a.moveDownItem', function(event) {
            let $target = $(event.target);
            let id      = this._getItemIdFromButton($target);
            let idx     = this.getFirstIdxBy('id', id);
            let items   = this.getItems();

            console.log('MOVE DOWN ', idx);
            console.log('ITEMS =', items);

            if (idx === null || idx >= items.length - 1) {
                return;
            }

            console.log('idx =', idx, 'items =', items);

            let tmp        = items[idx + 1];
            items[idx + 1] = items[idx];
            items[idx]     = tmp;

            console.log('items =', items);

            this.setItems(items);

            this.moveDown(id);

            this.buildCards(true);
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
            let input  = event.target;
            let $input = $(input);
            let file   = input.files[0];
            let url    = URL.createObjectURL(file);

            $input.closest('.card').find($input.attr('data-target')).html(`<img src="${url}" style="width: 100%;" />`);
        }.bind(this));

        return this;
    },

    getInputForId: function(item) {
        return `<input type="hidden" class="input-item-id" name="${this.getInputName(item, 'id')}" value="${item.id}" />`;
    },

    getNewItemInput: function(field) {
        return $('[data-name="' + this.objectName + '_' + field + '"]');
    },

    getActionButtons: function(strClass) {
        let btnClass = '';

        if (strClass) {
            btnClass = strClass;
        }

        let btnStyle = '';

        if (this.movable) {
            btnStyle = `style="--bs-btn-padding-y: .1rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .60rem;"`;
        }

        let btnMoveUp   = '';
        let btnDelete   = `<a href="#" class="btn btn-sm btn-danger deleteItem ${btnClass}" ${btnStyle}>Suppr.</a>`;
        let btnMoveDown = '';

        if (this.movable) {
            btnMoveUp   = `<a href="#" class="btn btn-sm btn-warning moveUpItem ${btnClass}" ${btnStyle}>Monter</a>`;
            btnMoveDown = `<a href="#" class="btn btn-sm btn-warning moveDownItem ${btnClass}" ${btnStyle}>Descendre</a>`;
        }

        return `<span>
                    ${((btnMoveUp != '')? `${btnMoveUp}<br />`  : '')}
                    ${((btnMoveDown != '')? `${btnDelete}<br />`  : btnDelete)}
                    ${btnMoveDown}
                </span>`;
    },

    getInputName: function(item, name, forceObjectName) {
        return ((forceObjectName)? forceObjectName : this.objectName) + '[' + item.id + '][' + name + ']';
    },

    _getCardTemplate: function(item, header, body) {
        return $(
            `<div class="${this.colClass}" data-item-id="${item.id}">
                <div class="card mr-2 mb-2 bg-white">
                    ${header}
                    <div class="card-body">
                        ${body}
                    </div>
                </div>
            </div>`
        );
    },

    getCard: function(item) {
        let body, header = this.getCardHeader(item);

        if (header != '') {
            header = `<div class="card-header"><h5>${header}</h5></div>`;
        }

        if (this.deleteButtonBelow) {
            body = `<div class="form-group mb-3">
                        ${this.getInputForId(item)}
                        ${this.getCardContent(item)}
                    </div>
                    ${this.getActionButtons()}`;
        } else {
            body = `<div class="form-group mb-3">
                        ${this.getInputForId(item)}
                        <div class="row">
                            ${this.getCardContent(item)}
                            <div class="col-1">
                                ${this.getActionButtons()}
                            </div>
                        </div>
                    </div>`;
        }

        return this._getCardTemplate(item, header, body);
    },

    moveUp: function(id) {},

    moveDown: function(id) {},

    getCardContent: function(id) {},

    getCardHeader: function(id) {
        return '';
    },

    buildCards: function(reset) {
        // this.find('div.' + this.colClass + ':not(:last-child)').remove();
        let colSelector = 'div.' + this.colClass;

        if (reset) {
            this.find('div.' + this.colClass + ':not(:last-child)').remove();
        }
        
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

        let items = this.getItems();

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