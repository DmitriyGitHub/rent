function addConditionalVisibility(fieldSelector, conditionFieldSelector, options){
    if(typeof(options) == 'undefined'){
        options = {};
    }
    if(typeof(options.fieldWrapper) == 'undefined'){
        options.fieldWrapper = '.form-group';
    }
    if(typeof(options.conditionCheckValue) == 'undefined'){
        options.conditionCheckValue = [];
        options.conditionCheckValue.push('');
        options.conditionCheckValue.push('0');
        options.conditionCheckValue.push('0.00');
        options.conditionCheckValue.push(0);
    }
    if(typeof(options.truncateFieldOnHide) == 'undefined'){
        options.truncateFieldOnHide = true;
    }
    $(document).on('change', conditionFieldSelector, function(){
        console.log($(this).val());
        console.log(options.conditionCheckValue);
        console.log($.inArray($(this).val(), options.conditionCheckValue));
        console.log(fieldSelector);
        if($.inArray($(this).val(), options.conditionCheckValue) != -1){
            
            $(fieldSelector).parents(options.fieldWrapper).hide();
            if(options.truncateFieldOnHide){
                $(fieldSelector).val('');
            }
        }
        else{
            $(fieldSelector).parents(options.fieldWrapper).show();
        }
    });
    $(conditionFieldSelector).trigger('change');
}