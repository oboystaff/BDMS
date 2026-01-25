$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.generate_report').on('click', function(event) {
        event.preventDefault();

        var from_date = $('input[name="from_date"]').val();
        var to_date = $('input[name="to_date"]').val();
        var status = $('select[name="status"]').val();
        var report_type = $('select[name="report_type"]').val();

        if ($('select[name="report_type"]').val() == 1) {
            $('#summary').hide();
            $('#details').show();
            $('#graph').hide();
            $('#example4').DataTable().destroy();
            load_data(from_date, to_date, status, report_type);
        } else {
            $('#summary').show();
            $('#details').hide();
            $('#graph').show();
            $('#example5').DataTable().destroy();
            load_summary(from_date, to_date, status, report_type);
            loadPieChartKg(from_date, to_date, status);
            loadPieChartM3(from_date, to_date, status);
        }
    });

    function load_data(from_date = '', to_date = '', status = '', report_type = '') {
        var url = $("input[name='pickup-report_url']").attr("url");

        try {
            $('#example4').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: url,

                    data: {
                        from_date: from_date,
                        to_date: to_date,
                        status: status,
                        report_type: report_type
                    }
                },

               columns: [

                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},

                    {data: 'pickup_id', name: 'pickup_id'},

                    {data: 'customer_id', name: 'customer_id'},

                    {data: 'name', name: 'name'},

                    {data: 'site', name: 'site'},

                    {data: 'waste_received_kg', name: 'waste_received_kg'},

                    {data: 'waste_received_m3', name: 'waste_received_m3'},

                    {data: 'waste_received_pcs', name: 'waste_received_pcs'},

                    {data: 'transporter', name: 'transporter'},

                    {data: 'driver', name: 'driver'},

                    {data: 'vehicle', name: 'vehicle'},

                    {data: 'received_by', name: 'received_by'},

                    {data: 'receiving_location', name: 'receiving_location'},

                    {data: 'treatment_location', name: 'treatment_location'},

                    {data: 'disposal_location', name: 'disposal_location'},

                    {data: 'created_by', name: 'created_by'},

                    {data: 'created_at', name: 'created_at'}
                ],
                language: {
                    paginate: {
                        next: '<i class="fa-solid fa-angle-right">',
                        previous: '<i class="fa-solid fa-angle-left">'
                    }
                },
                dom: 'lBfrtip',
			    buttons: [
				    'copyHtml5', 'excelHtml5', 'pdfHtml5', 'csvHtml5'
			    ],
                "footerCallback": function () {
                    var api = this.api();
                    
                    // Remove the formatting to get integer data for summation
                    var intVal = function (i) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
                }
            });
        } catch (err) {
            //alert(err);
        }
    }

    function load_summary(from_date = '', to_date = '', status = '', report_type = '') {
        var url = $("input[name='pickup-report_url']").attr("url");

        try {
            $('#example5').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: url,

                    data: {
                        from_date: from_date,
                        to_date: to_date,
                        status: status,
                        report_type: report_type
                    }
                },

               columns: [

                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},

                    {data: 'waste_type', name: 'waste_type'},

                    {data: 'waste_picked_kg', name: 'waste_picked_kg'},

                    {data: 'waste_picked_m3', name: 'waste_picked_m3'},

                    {data: 'waste_picked_pcs', name: 'waste_picked_pcs'}
                ],
                language: {
                    paginate: {
                        next: '<i class="fa-solid fa-angle-right">',
                        previous: '<i class="fa-solid fa-angle-left">'
                    }
                },
                dom: 'lBfrtip',
			    buttons: [
				    'copyHtml5', 'excelHtml5', 'pdfHtml5', 'csvHtml5'
			    ],
                "footerCallback": function () {
                    var api = this.api();
                    
                    // Remove the formatting to get integer data for summation
                    var intVal = function (i) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                                i : 0;
                    };

                     // Total over all pages
                     var waste_picked_kg = api
                        .column(2)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    var waste_picked_m3 = api
                        .column(3)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    var waste_picked_pcs = api
                        .column(4)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);


                    // Update status DIV
                    $('#title').html('Total');
                    $('#waste_picked_kg').html(format_money(waste_picked_kg));
                    $('#waste_picked_m3').html(format_money(waste_picked_m3));
                    $('#waste_picked_pcs').html(format_money(waste_picked_pcs));
                }
            });
        } catch (err) {
            //alert(err);
        }
    }

    function loadPieChartKg(from_date = '', to_date = '', status = '') {
        var url = $("input[name='pickup-graph_url']").attr("url");
        var formData = new FormData();
        formData.append('from_date', from_date);
        formData.append('to_date', to_date);
        formData.append('status', status);

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // Process the response data
                var labels = response.labels;
                var data = response.data;
                var color = [];

                var dynamicColors = function() {
                    var r = Math.floor(Math.random() * 255);
                    var g = Math.floor(Math.random() * 255);
                    var b = Math.floor(Math.random() * 255);
                    return "rgb(" + r + "," + g + "," + b + ")";
                };

                for (var i = 1; i <= data.length; i++) {
                    color.push(dynamicColors());
                }

                // Create the pie chart
                $("canvas#pie-chart").remove();
                $("div.pie-chart").append('<canvas id="pie-chart" width="400" height="400"></canvas>');
                var ctx = document.getElementById('pie-chart').getContext('2d');
                var myPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: color,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: false,
                        title: {
                            display: true,
                            text: 'Waste Pickup Summary (kg)'
                        }
                    }
                });
            },
            error: function(xhr, status, error) {
                //alert(error);
            }
        });
    }

    function loadPieChartM3(from_date = '', to_date = '', status = '') {
        var url = $("input[name='pickup-graph_url']").attr("url");
        var formData = new FormData();
        formData.append('from_date', from_date);
        formData.append('to_date', to_date);
        formData.append('status', status);

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // Process the response data
                var labels = response.labels2;
                var data = response.data2;
                var color = [];

                var dynamicColors = function() {
                    var r = Math.floor(Math.random() * 255);
                    var g = Math.floor(Math.random() * 255);
                    var b = Math.floor(Math.random() * 255);
                    return "rgb(" + r + "," + g + "," + b + ")";
                };

                for (var i = 1; i <= data.length; i++) {
                    color.push(dynamicColors());
                }

                // Create the pie chart
                $("canvas#bar-chart").remove();
                $("div.bar-chart").append('<canvas id="bar-chart" width="400" height="400"></canvas>');
                var ctx = document.getElementById('bar-chart').getContext('2d');
                var myPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: color,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: false,
                        title: {
                            display: true,
                            text: 'Waste Pickup Summary (M3)'
                        }
                    }
                });
            },
            error: function(xhr, status, error) {
                //alert(error);
            }
        });
    }

    function format_money(num) {
        var p = num.toFixed(2).split(".");
        return p[0].split("").reverse().reduce(function(acc, num, i, orig) {
            return num + (num != "-" && i && !(i % 3) ? "," : "") + acc;
        }, "") + "." + p[1];
    }

});