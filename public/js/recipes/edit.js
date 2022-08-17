let ingredients = {
    addFields: function (copyElement, pastIn) {
        let element = $('#'+copyElement).clone()
        let elements_count = +$('#'+pastIn).data('elements_count')
        $(element)
            .removeClass('d-none')
            .removeAttr('id')
        $(element)
            .find('#ingredient')
            .attr('name', 'ingredient[new'+elements_count+']')
            .attr('id', 'ingredient_'+elements_count)
        $(element)
            .find('#ingredientCount')
            .attr('name', 'ingredientCount[new'+elements_count+']')
            .attr('id', 'ingredientCount_'+elements_count)
        $('#'+pastIn)
            .append(element)
            .data('elements_count', elements_count+1)
    },

    remove: function (element) {
        element.closest('div.form-group').remove()
    }
};
