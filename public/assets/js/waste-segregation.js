$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".waste_segregation").repeater({
        initEmpty: false,
        isFirstItemUndeletable: true,
        show: function() {
            $(this).slideDown();
            $(this).find('select option:first').prop('selected', true);
        },
        hide: function(deleteElement) {
            if (confirm("Are you sure you want to delete this element?")) {
                $(this).slideUp(deleteElement);
            }
        },
    });
});