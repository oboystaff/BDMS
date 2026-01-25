$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('select[name="company"]').change(function () {
        site($(this).val());
    });

    function site(company_id) {
        var url = $("input[name='site_url']").attr("url");
        var formData = new FormData();
        formData.append("company_id", company_id);

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                // $('#register').preloader();
                // $("#send").prop("disabled", true);
            },
            success: function (response) {
                $("select[name='site']").html("");
                $("select[name='site']").append("<option disabled selected>Select Site Name</option>");
                for (var i = 0; i < response.message.length; i++) {
                    $("select[name='site']").append("<option value=" + response.message[i].id + ">" +
                        response.message[i].name + "</option>");
                }
            },
            error: function (error) {
                //alert(error.statusText + error.responseText);
            },
        });
    }
});