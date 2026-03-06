function toggleField(triggerSelector, valuesEnable, targetSelector, disabledValue='') {
    const trigger = $(triggerSelector);
    const target = $(targetSelector);
    if (trigger.length == 0 || target.length == 0) return;

    const isCheckbox = trigger.is(':radio');
    const currentValue = isCheckbox ? trigger.is(':checked') : trigger.val();
    
    const enable = Array.isArray(valuesEnable)
        ? valuesEnable.includes(currentValue)
        : currentValue == valuesEnable;

    if (enable) {
        target.val('')
        target.prop('disabled', false);
    
    } else {
        target.val(disabledValue);
        target.prop('disabled', true);
    }
}

$('#outro').on('change', function() {
    toggleField('#outro', true, '#outroComplemento', '');
});
