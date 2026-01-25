$(document).ready(function () {

    checkInput();

    $("select[name='machine_type_id']").change(function () {
        var selectedValue = ($("option:selected", this).text().trim()).toLowerCase();

        if (selectedValue == "vehicles" || selectedValue == "vehicle") {
            $('.location').hide();
        } else {
            $('.location').show();
        }
    });

    function checkInput(){
        var selectedValue = ($('select[name="machine_type_id"] option:selected').text().trim().toLowerCase());

        if (selectedValue == "vehicles" || selectedValue == "vehicle") {
            $('.location').hide();
        } else {
            $('.location').show();
        }
    }
});