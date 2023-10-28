<div class="row">
    <div class="col">
        <h3>Contenu personnalisé</h3>
        <div class="row" data-section="{{ $sections->toJson() }}">
            <div class="col-lg-6">
                <div class="card mr-2 mb-2 bg-white">
                    <div class="card-header bg-dark text-white">
                        <h5 class="card-title">Nouveau</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label>Titre : <input type="text" data-name="section_title" class="form-control" /></label>
                            <label>Description : <textarea data-name="section_content" class="form-control"></textarea></label>
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
        document.$bandMembers = $.extend($('[data-section]'), crudObject, {
            attributeName: 'data-section',
            objectName:    'section',
            colClass:      'col-lg-6',
            fieldList:     [
                'title',
                'content'
            ],

            getCardContent: function(item) {
                return  '<h5 class="card-title">' +
                            '<input type="text" name="' + this.getInputName(item, 'title') + '" class="form-control" value="' + item.title + '" />' +
                        '</h5>' +
                        '<p class="card-text">' +
                            '<textarea name="' + this.getInputName(item, 'content') + '" class="form-control">' + item.content + '</textarea>' +
                        '</p>';
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
    });
</script>