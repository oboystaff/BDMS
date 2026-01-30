$(document).ready(function () {

    if ($('select[name="payment_mode"]').length > 0) {
        $('select[name="payment_mode"]').change(function () {
            toggleChequeDetails();
        });
    }

    function toggleChequeDetails() {
        var paymentMode = $('select[name="payment_mode"]').val();

        if (paymentMode === 'cheque') {
            $('#cheque_no').show();
            $('#bank_name').show();
        } else if (paymentMode === 'bank transfer') {
            $('#cheque_no').hide();
            $('#bank_name').show();
        } else if (paymentMode === 'cash') {
            $('#cheque_no').hide();
            $('#bank_name').hide();
        } 
    }
    
});