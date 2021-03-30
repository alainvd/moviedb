<script>
function amount(amount) {
    amount = amount.toString().replaceAll('.', ''); // Remove seperator dots
    amount = parseInt(amount); // Remove anything thats not a number
    if (typeof amount === 'number' && isFinite(amount)) {
        amount = amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."); // Add new seperators
    } else {
        amount = '';
    }
    return amount;
}
function unformat_amount(amount) {
    amount = amount.toString().replaceAll('.', ''); // Remove seperator dots
    amount = parseInt(amount); // Remove anything thats not a number
    return amount;
}
</script>