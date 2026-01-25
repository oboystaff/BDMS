let dataSet = [];




(function($) {
     "use strict"


    //example 1
    var table = $('#example').DataTable({
        createdRow: function ( row, data, index ) {
           $(row).addClass('selected')
        } ,
		language: {
			paginate: {
			   next: '<i class="fa-solid fa-angle-right"></i>',
			  previous: '<i class="fa-solid fa-angle-left"></i>'
			}
		  }
    });
	var table = $('#projects-tbl').DataTable({
		//dom: 'Bfrtip',
		'dom': 'ZBfrltip',
		buttons: [

			{ extend: 'excel', text: '<i class="fa-solid fa-file-excel"></i> Export Report',
              className: 'btn btn-sm border-0'
			}
        ],
		searching: false,
		pageLength:5,
		select: false,
        lengthChange:false ,
		language: {
			paginate: {
				next: '<i class="fa-solid fa-angle-right"></i>',
				previous: '<i class="fa-solid fa-angle-left"></i>'
			}

		},

    });

	var table = $('#projects-tbl1').DataTable({
		//dom: 'Bfrtip',
		'dom': 'ZBfrltip',
		buttons: [

			{ extend: 'excel', text: '<i class="fa-solid fa-file-excel"></i> Export Report',
              className: 'btn btn-sm border-0'
			}
        ],
		searching: false,
		pageLength:5,
		select: false,
        lengthChange:false ,
		language: {
			paginate: {
				next: '<i class="fa-solid fa-angle-right"></i>',
				previous: '<i class="fa-solid fa-angle-left"></i>'
			}

		},

    });
	var table = $('#projects-tb22').DataTable({
		//dom: 'Bfrtip',
		'dom': 'ZBfrltip',
		buttons: [

			{ extend: 'excel', text: '<i class="fa-solid fa-file-excel"></i> Export Report',
              className: 'btn btn-sm border-0'
			}
        ],
		searching: false,
		pageLength:5,
		select: false,
        lengthChange:false ,
		language: {
			paginate: {
				next: '<i class="fa-solid fa-angle-right"></i>',
				previous: '<i class="fa-solid fa-angle-left"></i>'
			}

		},

    });
	var table = $('#user-tbl').DataTable({
		//dom: 'Bfrtip',
		'dom': 'ZBfrltip',
		buttons: [

			{ extend: 'excel', text: '<i class="fa-solid fa-file-excel"></i> Export Report',
              className: 'btn btn-sm border-0'
			}
        ],

		searching: true,
		pageLength:12,
		select: false,
        lengthChange:false ,
		language: {
			paginate: {
				next: '<i class="fa-solid fa-angle-right"></i>',
				previous: '<i class="fa-solid fa-angle-left"></i>'
			},
			'search' : ' <i class="fa-solid fa-magnifying-glass"></i>',
			searchPlaceholder: "Search..."

		},

    });


	var table = $('#attendance-tbl').DataTable({
		//dom: 'Bfrtip',
		'dom': 'ZBfrltip',
		buttons: [

			{ extend: 'excel', text: '<i class="fa-solid fa-file-excel"></i> Export Report',
              className: 'btn btn-sm border-0'
			}
        ],
		searching: false,
		select: false,
        lengthChange:false ,
		language: {
			paginate: {
				next: '<i class="fa-solid fa-angle-right"></i>',
				previous: '<i class="fa-solid fa-angle-left"></i>'
			}

		},

    });
	var table = $('#empoloyees-tbl').DataTable({
		//dom: 'Bfrtip',
		'dom': 'ZBfrltip',
		buttons: [

			{ extend: 'excel', text: '<i class="fa-solid fa-file-excel"></i> Export Report',
              className: 'btn btn-sm border-0'
			}
        ],
		searching: false,
		select: false,
        pageLength:5,
        lengthChange:false ,
		language: {
			paginate: {
				next: '<i class="fa-solid fa-angle-right"></i>',
				previous: '<i class="fa-solid fa-angle-left"></i>'
			}

		},

    });
	var table = $('#empoloyees-tblwrapper').DataTable({
		//dom: 'Bfrtip',
		'dom': 'ZBfrltip',
		buttons: [

			{ extend: 'excel', text: '<i class="fa-solid fa-file-excel"></i> Export Report',
              className: 'btn btn-sm border-0'
			}
        ],
		searching: false,
		select: false,
        //pageLength:5,
        lengthChange:false ,
		language: {
			paginate: {
				next: '<i class="fa-solid fa-angle-right"></i>',
				previous: '<i class="fa-solid fa-angle-left"></i>'
			}

		},

    });
	var table = $('#empoloyees-tbl2').DataTable({
		//dom: 'Bfrtip',
		'dom': 'ZBfrltip',
		buttons: [

			{ extend: 'excel', text: '<i class="fa-solid fa-file-excel"></i> Export Report',
              className: 'btn btn-sm border-0'
			}
        ],
		searching: false,
		select: false,
        pageLength:5,
        lengthChange:false ,
		language: {
			paginate: {
				next: '<i class="fa-solid fa-angle-right"></i>',
				previous: '<i class="fa-solid fa-angle-left"></i>'
			}

		},

    });
	var table = $('#empoloyees-tbl3').DataTable({
		//dom: 'Bfrtip',
		'dom': 'ZBfrltip',
		buttons: [

			{ extend: 'excel', text: '<i class="fa-solid fa-file-excel"></i> Export Report',
              className: 'btn btn-sm border-0'
			}
        ],
		searching: false,
		select: false,
        pageLength:7,
        lengthChange:false ,
		language: {
			paginate: {
				next: '<i class="fa-solid fa-angle-right"></i>',
				previous: '<i class="fa-solid fa-angle-left"></i>'
			}

		},

    });
	var table = $('#reports-tbl').DataTable({
		//dom: 'Bfrtip',
		'dom': 'ZBfrltip',
		buttons: [

			{ extend: 'excel', text: '<i class="fa-solid fa-file-excel"></i> Export Report',
              className: 'btn btn-sm border-0'
			}
        ],
		searching: false,
		select: false,
        //pageLength:5,
        lengthChange:false ,
		language: {
			paginate: {
				next: '<i class="fa-solid fa-angle-right"></i>',
				previous: '<i class="fa-solid fa-angle-left"></i>'
			}

		},

    });
	var table = $('#empoloyeestbl2').DataTable({
		//dom: 'Bfrtip',
		'dom': 'ZBfrltip',
		buttons: [

			{ extend: 'excel', text: '<i class="fa-solid fa-file-excel"></i> Export Report',
              className: 'btn btn-sm border-0'
			}
        ],
		searching: false,
		select: false,
        /* pageLength:5, */
        lengthChange:false ,
		language: {
			paginate: {
				next: '<i class="fa-solid fa-angle-right"></i>',
				previous: '<i class="fa-solid fa-angle-left"></i>'
			}

		},

    });
	var table = $('#empoloyees-tbl1').DataTable({
		//dom: 'Bfrtip',
		'dom': 'ZBfrltip',
		buttons: [

			{ extend: 'excel', text: '<i class="fa-solid fa-file-excel"></i> Export Report',
              className: 'btn btn-sm border-0'
			}
        ],
		searching: false,
		select: false,
        pageLength:8,
        lengthChange:false ,
		language: {
			paginate: {
				next: '<i class="fa-solid fa-angle-right"></i>',
				previous: '<i class="fa-solid fa-angle-left"></i>'
			}

		},

    });
	var table = $('#product-tbl').DataTable({
		//dom: 'Bfrtip',
		searching: false,
		select: false,
		pageLength:7,
        lengthChange:false ,
		language: {
			paginate: {
				next: '<i class="fa-solid fa-angle-right"></i>',
				previous: '<i class="fa-solid fa-angle-left"></i>'
			}

		},

    });

    table.on('click', 'tbody tr', function() {
    var $row = table.row(this).nodes().to$();
    var hasClass = $row.hasClass('selected');
    if (hasClass) {
        $row.removeClass('selected')
    } else {
        $row.addClass('selected')
    }
    })

    table.rows().every(function() {
    this.nodes().to$().removeClass('selected')
    });


    //example 2
    var table2 = $('#example2').DataTable( {
        createdRow: function ( row, data, index ) {
            $(row).addClass('selected')
        },

        "scrollY":        "42vh",
        "scrollCollapse": true,
        "paging":         false
    });

    table2.on('click', 'tbody tr', function() {
        var $row = table2.row(this).nodes().to$();
        var hasClass = $row.hasClass('selected');
        if (hasClass) {
            $row.removeClass('selected')
        } else {
            $row.addClass('selected')
        }
    })

    table2.rows().every(function() {
        this.nodes().to$().removeClass('selected')
    });

	// dataTable1
	var table = $('#dataTable1').DataTable({
		searching: false,
		paging:true,
		select: false,
		lengthChange:false ,

	});
	// dataTable2
	var table = $('#dataTable2').DataTable({
		searching: false,
		paging:true,
		select: false,
		lengthChange:false ,

	});
	// dataTable3
	var table = $('#dataTable3').DataTable({
		searching: false,
		paging:true,
		select: false,
		lengthChange:false ,

	});
	// dataTable4
	var table = $('#dataTable4').DataTable({
		searching: false,
		paging:true,
		select: false,
		lengthChange:false,

	});

	// dataTable5
	var table = $('#dataTable5').DataTable({
		searching: false,
		paging:false,
		select: false,
		lengthChange:false,

	});

	// dataTable6
		var table = $('#example6').DataTable({
			searching: false,
			paging:true,
			select: false,
			info: false,
			lengthChange:false ,
			language: {
			paginate: {
			  next: '<i class="fa-solid fa-angle-right"></i>',
			  previous: '<i class="fa-solid fa-angle-left"></i>'
			}
		  }

		});


	// dataTable7
	var table = $('#example7').DataTable({
		searching: false,
		paging:true,
		select: false,
		info: true,
		lengthChange:false ,
		language: {
			paginate: {
			   next: '<i class="fa-solid fa-angle-right"></i>',
			  previous: '<i class="fa-solid fa-angle-left"></i>'
			}
		  }

	});
	// dataTable9

	// table row
	var table = $('#example4').DataTable({

        'dom': "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
        "t" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

		buttons: [

			{ extend: 'excelHtml5', text: '<i class="fa-solid fa-file-excel"></i> Excel',
              className: 'btn btn-sm border-0'
			},
			{ extend: 'csvHtml5', text: '<i class="fa-solid fa-file-text"></i> CSV',
              className: 'btn btn-sm border-0'
			},
			{ extend: 'pdfHtml5', text: '<i class="fa fa-file-pdf"></i> PDF',
              className: 'btn btn-sm border-0',
              exportOptions: {
                columns: function (idx, data, node) {
                    return true;  // Export all columns
                }
            }
			},
			{ extend: 'copyHtml5', text: '<i class="fa-solid fa-print"></i> Copy',
              className: 'btn btn-sm border-0'
			}
        ],
		searching: true,
		select: true,
        lengthChange:true,
		lengthMenu: [
			[10, 25, 50, 100, -1],
			[10, 25, 50, 100, "All"]
		],
		pageLength:10,
		language: {
			paginate: {
				next: '<i class="fa-solid fa-angle-right"></i>',
				previous: '<i class="fa-solid fa-angle-left"></i>'
			}
		},

	});

	var table = $('#example5').DataTable({

        'dom': "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
        "t" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",


		buttons: [

			{ extend: 'excelHtml5', text: '<i class="fa-solid fa-file-excel"></i> Excel',
              className: 'btn btn-sm border-0'
			},
			{ extend: 'csvHtml5', text: '<i class="fa-solid fa-file-text"></i> CSV',
              className: 'btn btn-sm border-0'
			},
			{ extend: 'pdfHtml5', text: '<i class="fa fa-file-pdf"></i> PDF',
              className: 'btn btn-sm border-0',
              exportOptions: {
                columns: function (idx, data, node) {
                    return true;  // Export all columns
                }
            }
			},
			{ extend: 'copyHtml5', text: '<i class="fa-solid fa-print"></i> Copy',
              className: 'btn btn-sm border-0'
			}
        ],
		searching: true,
		pageLength:10,
		select: true,
        lengthChange:true ,
		language: {
			paginate: {
				next: '<i class="fa-solid fa-angle-right"></i>',
				previous: '<i class="fa-solid fa-angle-left"></i>'
			}

		},
	});


	$('#example tbody').on('click', 'tr', function () {
		var data = table.row( this ).data();
	});

	// application table
	var table = $('#application-tbl1,#application-tbl2,#application-tbl3,#application-tbl4 ').DataTable({
		searching: false,
		lengthChange:false ,
		language: {
			paginate: {
			  next: '<i class="fa-solid fa-angle-right"></i>',
			  previous: '<i class="fa-solid fa-angle-left"></i>'
			}
		  }
	});

})(jQuery);
