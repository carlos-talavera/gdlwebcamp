$(document).ready(function () {
    
    $('.sidebar-menu').tree();

    /* DataTables */

    if($('#registros')) {

        $('#registros').DataTable({
            'paging': true,
            'pageLength' : 10,
            'lengthChange': false,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': false,
            'language': {
                paginate: {
                    next: 'Siguiente',
                    previous: 'Anterior',
                    last: 'Último',
                    first: 'Primero'
                },
                info: "Mostrando _START_ a _END_ de _TOTAL_ resultados",
                emptyTable: "No se encontraron resultados",
                infoEmpty: "0 resultados",
                search: "Buscar: "
            }
        });

    }

    /* iCheck */

    if($('.check-evt')) {

        $('.check-evt').iCheck({
            checkboxClass: 'icheckbox_flat-blue'
        })

    }

    if($('.check-evt-act')) {

        $('.check-evt-act').iCheck({
            checkboxClass: 'icheckbox_flat-green'
        })

    }

    /* Chart JS */

    if($('#registros_dia')) {

        let barChartCanvas = $('#registros_dia').get(0).getContext('2d');
        let barChart = new Chart(barChartCanvas);

        let barChartData = {
            
            labels: [],
            datasets: [{
                label: '',
                fillColor: 'rgba(0, 166, 90, 1)',
                strokeColor: 'rgba(0, 166, 90, 1)',
                pointColor: 'rgba(0, 166, 90, 1)',
                pointStrokeColor: '#c1c7d1',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data: []
                }
            ]
        };

        $.getJSON('servicio-registrados.php', function (data) {
            
            for (let i = 0; i < data.length; i++) {

            barChartData.labels.push(data[i].fecha);
            barChartData.datasets[0].data.push(parseInt(data[i].cantidad));

            }

        });

        setTimeout(function() {
        
        let barChartOptions = {
            //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
            scaleBeginAtZero: true,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines: true,
            //String - Colour of the grid lines
            scaleGridLineColor: 'rgba(0,0,0,.05)',
            //Number - Width of the grid lines
            scaleGridLineWidth: 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines: true,
            //Boolean - If there is a stroke on each bar
            barShowStroke: true,
            //Number - Pixel width of the bar stroke
            barStrokeWidth: 2,
            //Number - Spacing between each of the X value sets
            barValueSpacing: 5,
            //Number - Spacing between data sets within X values
            barDatasetSpacing: 1,
            //String - A legend template
            legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (let i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
            //Boolean - whether to make the chart responsive
            responsive: true,
            maintainAspectRatio: true
        }

        barChartOptions.datasetFill = false;
        barChart.Bar(barChartData, barChartOptions);

        }, 1000);

    }
      
})