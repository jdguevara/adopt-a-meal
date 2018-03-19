
window.simpleJQueryValidation = function simpleJQueryValidation(event, validation_id, regex) {
    if($(event).val()) {
        var checkRegex = regex == undefined || regex.test($(event).val());
        if (checkRegex) {
            $(validation_id).addClass('hidden');
            $(validation_id).addClass('valid');
            return;
        }
    }
    $(validation_id).removeClass('hidden');
    $(validation_id).removeClass('valid');
};

window.simpleJQueryValidity = function simpleJQueryValidity(validation_id) {
    if(!($(validation_id).hasClass('valid'))) {
        $(validation_id).removeClass('hidden');
        return false;
    } else {
        return true;
    }
}

window.resetJQueryValidation = function resetJQueryValidation(inputIds, checkfields){
    $.each(inputIds, function( index, value) {
        $(value + '-validation').addClass('hidden');
        $(value + '-validation').removeClass('valid');
        if(checkfields) simpleJQueryValidation($(value), value + '-validation');
    });
}