
let field = {
    clone: function (copyElement, pastIn) {
        pastIn = $('#'+pastIn)
        let element = $('#'+copyElement).clone()
        $(element)
            .removeClass('d-none')
            .removeAttr('id')
        $(element).find('input.file-code')
            .addClass('d-none')
        pastIn.append(element)
    },

    showCode: function(element) {
        let block = element.closest('div.form-group')
        if (element.files.length > 0) {
            let elements_count = +$('[name="last_code"]').val()
            $(block).find('input.file')
                .attr('name', 'file[new'+elements_count+']')
                .attr('id', 'file_'+elements_count)
            $(block).find('input.file-code')
                .attr('name', 'fileCode[new'+elements_count+']')
                .attr('id', 'fileCode_'+elements_count)
                .removeClass('d-none')
                .val('$CODE'+elements_count+'$')
            $('[name="last_code"]').val(elements_count + 1)
        } else {
            $(block).find('input.file')
                .attr('name', '')
                .attr('id', '')
            $(block).find('input.file-code')
                .attr('name', '')
                .attr('id', '')
                .addClass('d-none')
                .val('')
        }
    },

    remove: function(element) {
        let block = element.closest('div.form-group')
        let code = $(block).find('input.file-code').val()
        summernoteInit($('textarea').text().replaceAll(code, ''))
        block.remove()
    }
}

function sendFormFunction(current_form, successFun = null, errorFun = null, processData = false, contentType = false) {
    let form =  $(current_form)
    if (successFun == null) {
        successFun = (data) => {
            if (data.status) {
                location.href = data.url
            } else {
                toastr.error(data.message)
            }
        }
    }
    if (errorFun == null) {
        errorFun = (data) => {
            setErrorsFields(data.responseJSON)
            return true;
        }
    }
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        processData: processData,
        contentType: contentType,
        data:  new FormData(form[0]),
        success: successFun,
    	error: errorFun
 	})
}

function sendGet(url, successFun = null, errorFun = null, processData = false, contentType = false) {
    if (successFun == null) {
        successFun = (data) => {
            if (data.status) {
                location.href = data.url
            } else {
                toastr.error(data.message)
            }
        }
    }
    if (errorFun == null) {
        errorFun = (data) => {
            setErrorsFields(data.responseJSON)
            return true;
        }
    }
    $.ajax({
        url: url,
        type: 'GET',
        processData: processData,
        contentType: contentType,
        data: {},
        success: successFun,
    	error: errorFun
 	})
}



// if (typeof submitFormBtn !== 'undefined') {
//     $(submitFormBtn).on('click', document, sendForm)
// }


function setErrorsFields(data) {
    let errors = data.errors;
    for (let key in errors) {
        if (Object.hasOwnProperty.call(errors, key)) {
            let element = errors[key];
            $('[name="'+key+'"]').addClass('is-invalid')
            toastr.error(element)
        }
    }
    toastr.error(data.message)
}

function sendForm(current_form) {
    let form =  $(current_form)
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        processData: false,
        contentType: false,
        data:  new FormData(form[0]),
        success: function(data) {
            if (data.status) {
                location.href = data.url
            } else {
                toastr.error(data.message)
            }
        },
    	error: function(data) {
            setErrorsFields(data.responseJSON)
    	}
 	})
}

$(document).ready(function() {
    summernoteInit()
    select2Init()
    dateTimeInit()
    dateInit()
})

function summernoteInit(text = null) {
    $('.summernote').summernote({
        placeholder: 'Ожидаю ввод...',
        tabsize: 2,
        height: 200,
        lang: 'ru-RU',
    })
    if (text !== null) {
        $('.summernote').summernote('code', text)
    }
}

function select2Init() {
    $('.select2').select2({
        language: "ru",
        width: "100%"
    })
}


function dateInit() {
    $('.selectDate').daterangepicker({
        // "uiLibrary": 'bootstrap4',
        "singleDatePicker": true,
        "showDropdowns": true,
        "autoApply": true,
        "locale": confDrpSingle(),
        "drops": "auto",
    })
}

function dateTimeInit() {
    $('.selectDateTime').daterangepicker({
        // "uiLibrary": 'bootstrap4',
        "singleDatePicker": true,
        "showDropdowns": true,
        "timePicker": true,
        "timePicker24Hour": true,
        "locale": confDrpSingle(true),
        "drops": "auto",
    })
}

// function dateTimeInit() {
//     $('.selectDateTime').datetimepicker({
//         format: 'dd.mm.yyyy HH:MM',
//         showDropdowns: true,
//         locale: 'ru-ru',
//     })
// }

// function dateInit() {
//     $('.selectDate').datepicker({
//         format: 'dd.mm.yyyy',
//         showDropdowns: true,
//         locale: 'ru-ru',
//     })
// }

function copyVal(el) {
    var $tmp = $("<textarea>")
    $("body").append($tmp)
    $tmp.val($(el).val()).select()
    document.execCommand("copy")
    $tmp.remove()
    toastr.info('Код скопирован')
}

function confDrpSingle(dateTime = false) {
    return {
        "format": (dateTime ? "DD.MM.YYYY HH:mm" : "DD.MM.YYYY"),
        // "uiLibrary": 'bootstrap4',
        "applyLabel": "Применить",
        "cancelLabel": "Отмена",
        "weekLabel": "W",
        "daysOfWeek": [
            "Вс",
            "Пн",
            "Вт",
            "Ср",
            "Чт",
            "Пт",
            "Сб"
        ],
        "monthNames": [
            "Январь",
            "Февраль",
            "Март",
            "Апрель",
            "Май",
            "Июнь",
            "Июль",
            "Август",
            "Сентябрь",
            "Октябрь",
            "Ноябрь",
            "Декабрь"
        ],
        "firstDay": 1,
    };
}
