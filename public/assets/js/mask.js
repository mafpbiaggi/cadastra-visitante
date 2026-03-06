function mask(input, type) {
    let value = input.value.toUpperCase();

    switch (type) {
        case 'CEL':
            value = value.replace(/^(\d{2})(\d)/, '($1) $2');
            value = value.replace(/(\d{5})(\d)/, '$1-$2');
            value = value.substring(0, 15);
            break;
        default:
            break;
    }

    input.value = value;
}
