function initBootstrapControls() {
    $('.ad-description').tooltip({'placement': 'bottom'});
}

function updateMediaplansTableRow(value, settings) {
    var cell = $(this);
    cell.text('');
    var row = cell.parent().parent();
    eval('var data = ' + value);
    for (fieldName in data) {
        row.find('span[data-field-name=' + fieldName + ']').text(''+data[fieldName]);
    }
    $('.table-fixed-header').resizeHeader();
}

// Switch off pines notify history.
$.pnotify.defaults.history = false;
function onErrorEditMediaplan(settings, original, xhr) {
    console.log(xhr);
    if (xhr.status == 400) {
        $.pnotify({
            title: 'Некорректное значение',
            text: xhr.responseText
        });
    } else if (xhr.status == 403) {
        $.pnotify({
            title: 'Отказано в доступе',
            text: 'У вас нет привилегий на данную операцию',
            type: 'error'
        });
    } else if (xhr.status == 401) {
        $.pnotify({
            title: 'Неавторизованный запрос',
            text: 'Необходимо перезайти в систему',
            type: 'error'
        });
    } else if (xhr.status >= 500) {
        $.pnotify({
            title: 'Внутренняя ошибка сервера',
            text: 'Мы работаем над этим',
            type: 'error'
        });
    }
    original.reset(this);
}