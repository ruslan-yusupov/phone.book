'use strict'

export default class Form {

    constructor() {
        this._attribute = 'data-form-submit';
    }

    submitHandler() {
        $('[' + this._attribute + ']').on('submit', (event) => {

            event.preventDefault();

            let formBlock = event.currentTarget;
            let tableBlock = $('[data-contacts-table]');
            let alertsBlock = $('[data-alerts]');
            let emptyBlock = $('[data-empty-block]');

            $.ajax({
                url: $(formBlock).attr('action'),
                type: $(formBlock).attr('method'),
                dataType: 'JSON',
                data: new FormData(formBlock),
                processData: false,
                contentType: false,
                success: (data) => {
                    switch (data.status) {
                        case 'error':
                            $(formBlock).html(data.html);
                            break;
                        case 'success':
                            $(tableBlock).append(data.html);
                            $(formBlock).find('input:text, input:file, textarea').val('');
                            $(alertsBlock).remove();
                            $(emptyBlock).remove();
                            break;
                    }
                },
            });
        });
    }

    initHandlers() {
        this.submitHandler();
    }

}