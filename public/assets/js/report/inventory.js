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
            loadPieChart(from_date, to_date, status);
            loadBarChart(from_date, to_date, status);
        }
    });

    function load_data(from_date = '', to_date = '', status = '', report_type = '') {
        var url = $("input[name='inventory-report_url']").attr("url");

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

                    {data: 'book_id', name: 'book_id'},

                    {data: 'subject_name', name: 'subject_name'},

                    {data: 'level_name', name: 'level_name'},

                    {data: 'unit_price', name: 'unit_price'},

                    {data: 'quantity', name: 'quantity'},

                    {data: 'minimum_stock_level', name: 'minimum_stock_level'},

                    {data: 'author', name: 'author'},

                    {data: 'title', name: 'title'},

                    {data: 'status', name: 'status'},

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
        var url = $("input[name='customer-report_url']").attr("url");

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

                    {data: 'customer_status', name: 'customer_status'},

                    {data: 'customer_number', name: 'customer_number'},

                    {data: 'percentage', name: 'percentage'}
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

    function loadPieChart(from_date = '', to_date = '', status = '') {
        var url = $("input[name='customer-graph_url']").attr("url");
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
                            text: 'Customer Summary Report'
                        }
                    }
                });
            },
            error: function(xhr, status, error) {
                //alert(error);
            }
        });
    }

    function loadBarChart(from_date = '', to_date = '', status = '') {
        var url = $("input[name='customer-graph_url']").attr("url");
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
                            text: 'Customer Summary Report'
                        },
                        scales: {
                            xAxes: [{
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Status'
                                }
                            }],
                            yAxes: [{
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Number of customers'
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