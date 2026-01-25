$(document).ready(function () {
    $('.generate_report').on('click', function(event) {
        event.preventDefault();

        var from_date = $('input[name="from_date"]').val();
        var to_date = $('input[name="to_date"]').val();
        var company_id = $('select[name="company_id"]').val();
        var site_id = $('select[name="site_id"]').val();
        var report_type = $('select[name="report_type"]').val();
        var status = $('select[name="status"]').val();

        if ($('select[name="report_type"]').val() == 1) {
            $('#summary').hide();
            $('#details').show();
            $('#graph').hide();
            $('#example4').DataTable().destroy();
            load_data(from_date, to_date, company_id, site_id, report_type, status);
        } else {
            $('#summary').show();
            $('#details').hide();
            $('#graph').show();
            $('#example5').DataTable().destroy();
            load_summary(from_date, to_date, company_id, site_id, report_type, status);
            loadPieChart(from_date, to_date, company_id, site_id, status);
            loadBarChart(from_date, to_date, company_id, site_id, status);
        }
    });

    function load_data(from_date = '', to_date = '', company_id = '', site_id = '', report_type = '', status = '') {
        var url = $("input[name='waste-segregation-report_url']").attr("url");

        try {
            $('#example4').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: url,

                    data: {
                        from_date: from_date,
                        to_date: to_date,
                        company_id: company_id,
                        site_id: site_id,
                        report_type: report_type,
                        status: status
                    }
                },

               columns: [

                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},

                    {data: 'company_name', name: 'company_name'},

                    {data: 'site_name', name: 'site_name'},

                    {data: 'batch_id', name: 'batch_id'},

                    {data: 'total', name: 'total'},

                    {data: 'organic', name: 'organic'},

                    {data: 'compost', name: 'compost'},

                    {data: 'rejects', name: 'rejects'},

                    {data: 'chemical', name: 'chemical'},

                    {data: 'others', name: 'others'},

                    {data: 'status', name: 'status'},

                    {data: 'approved_by', name: 'approved_by'},

                    {data: 'recorded_by', name: 'recorded_by'},

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

                     // Total over all pages
                    var total = api
                        .column(4)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    var organic_total = api
                        .column(5)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    var compost_total = api
                        .column(6)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    var rejects_total = api
                        .column(7)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    var chemical_total = api
                        .column(8)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    var others_total = api
                        .column(9)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Update status DIV
                    $('#title').html('Total');
                    $('#total').html(format_money(total));
                    $('#organic_total').html(format_money(organic_total));
                    $('#compost_total').html(format_money(compost_total));
                    $('#rejects_total').html(format_money(rejects_total));
                    $('#chemical_total').html(format_money(chemical_total));
                    $('#others_total').html(format_money(others_total));
                }
            });
        } catch (err) {
            //alert(err);
        }
    }

    function load_summary(from_date = '', to_date = '', company_id = '', site_id = '', report_type = '', status = '') {
        var url = $("input[name='waste-segregation-report_url']").attr("url");

        try {
            $('#example5').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: url,

                    data: {
                        from_date: from_date,
                        to_date: to_date,
                        company_id: company_id,
                        site_id: site_id,
                        report_type: report_type,
                        status: status
                    }
                },

               columns: [

                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},

                    {data: 'company_name', name: 'company_name'},

                    {data: 'site_name', name: 'site_name'},

                    {data: 'total', name: 'total'},

                    {data: 'organic', name: 'organic'},

                    {data: 'organic_perc', name: 'organic_perc'},

                    {data: 'compost', name: 'compost'},

                    {data: 'compost_perc', name: 'compost_perc'},

                    {data: 'rejects', name: 'rejects'},

                    {data: 'rejects_perc', name: 'rejects_perc'},

                    {data: 'chemical', name: 'chemical'},

                    {data: 'chemical_perc', name: 'chemical_perc'},

                    {data: 'others', name: 'others'},

                    {data: 'others_perc', name: 'others_perc'},

                    {data: 'status', name: 'status'},

                    {data: 'approved_by', name: 'approved_by'},

                    {data: 'recorded_by', name: 'recorded_by'},

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

                     // Total over all pages
                    var total = api
                        .column(3)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    var organic_total = api
                        .column(4)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    var organic_perc_total = api
                        .column(5)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    var compost_total = api
                        .column(6)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    var compost_perc_total = api
                        .column(7)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    var rejects_total = api
                        .column(8)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    var rejects_perc_total = api
                        .column(9)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    var chemical_total = api
                        .column(10)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    var chemical_perc_total = api
                        .column(11)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    var others_total = api
                        .column(12)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    var others_perc_total = api
                        .column(13)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Update status DIV
                    $('#title1').html('Total');
                    $('#total1').html(format_money(total));
                    $('#organic_total1').html(format_money(organic_total));
                    $('#organic_perc_total1').html(format_money(organic_perc_total));
                    $('#compost_total1').html(format_money(compost_total));
                    $('#compost_perc_total1').html(format_money(compost_perc_total));
                    $('#rejects_total1').html(format_money(rejects_total));
                    $('#rejects_perc_total1').html(format_money(rejects_perc_total));
                    $('#chemical_total1').html(format_money(chemical_total));
                    $('#chemical_perc_total1').html(format_money(chemical_perc_total));
                    $('#others_total1').html(format_money(others_total));
                    $('#others_perc_total1').html(format_money(others_perc_total));
                }
            });
        } catch (err) {
            //alert(err);
        }
    }

    function loadPieChart(from_date = '', to_date = '', company_id = '', site_id = '', status = '') {
        var url = $("input[name='waste-segregation-graph_url']").attr("url");
        var formData = new FormData();
        formData.append('from_date', from_date);
        formData.append('to_date', to_date);
        formData.append('company_id', company_id);
        formData.append('site_id', site_id);
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
                            text: 'Waste Segregation Summary'
                        }
                    }
                });
            },
            error: function(xhr, status, error) {
                //alert(error);
            }
        });
    }

    function loadBarChart(from_date = '', to_date = '', company_id = '', site_id = '', status = '') {
        var url = $("input[name='waste-segregation-graph_url']").attr("url");
        var formData = new FormData();
        formData.append('from_date', from_date);
        formData.append('to_date', to_date);
        formData.append('company_id', company_id);
        formData.append('site_id', site_id);
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

                // Create the bar chart
                $("canvas#bar-chart").remove();
                $("div.bar-chart").append('<canvas id="bar-chart" width="400" height="400"></canvas>');
                var ctx = document.getElementById('bar-chart').getContext('2d');
                var myBarChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: color,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Waste Segregation Summary'
                        },
                        scales: {
                            xAxes: [{
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Waste Category'
                                }
                            }],
                            yAxes: [{
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Waste Category Quantity'
                                }
                            }]
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