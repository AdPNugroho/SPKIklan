
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    loadChart()
    loadVektor()
    $('#saveResult').click(function(){
        $.post("grafik/save", null,
        function (response) {
            $.toast({
                heading: 'Information',
                text: response.message,
                position: 'bottom-right',
                stack: false,
                showHideTransition: 'slide',
                icon: response.status
            });
        }, "json");
    });
    $('#refreshGrafik').click(function(){
        loadChart()
        $('#tableVektor').DataTable().ajax.reload();
    });
});
function loadChart(){
    $.ajax({
        url:"grafik/data",
        cache:false,
        dataType:'json',
        type:'post',
        success:function(response){
            console.log(response);
            if(response.status){
                var wp = response.wp;
                var saw = response.saw;
                var categories = response.categories;
                Highcharts.chart('containerChartWP', {
                    chart: {
                        type: 'column',
                        options3d: {
                            enabled: true,
                            alpha: 10,
                            beta: 25,
                            depth: 70
                        }
                    },
                    title: {
                        text: 'Grafik Perbandingan Nilai Preferensi'
                    },
                    subtitle: {
                        text: 'Metode Weighted Product'
                    },
                    plotOptions: {
                        column: {
                            depth: 25
                        }
                    },
                    xAxis: {
                        categories: categories,
                        labels: {
                            skew3d: true,
                            style: {
                                fontSize: '16px'
                            }
                        }
                    },
                    yAxis: {
                        title: {
                            text: null
                        }
                    },
                    series: [{
                        name: 'Weighted Product',
                        data: wp
                    }]
                });
                Highcharts.chart('containerChartSAW', {
                    chart: {
                        type: 'column',
                        options3d: {
                            enabled: true,
                            alpha: 10,
                            beta: 25,
                            depth: 70
                        }
                    },
                    title: {
                        text: 'Grafik Perbandingan Nilai Preferensi'
                    },
                    subtitle: {
                        text: 'Metode Simple Additive Weighting'
                    },
                    plotOptions: {
                        column: {
                            depth: 25
                        }
                    },
                    xAxis: {
                        categories: categories,
                        labels: {
                            skew3d: true,
                            style: {
                                fontSize: '16px'
                            }
                        }
                    },
                    yAxis: {
                        title: {
                            text: null
                        }
                    },
                    series: [{
                        name: 'Simple Additive Weighting',
                        data: saw
                    }]
                });
            }else{
                $('#panelWarning').fadeIn();
                $('#panelChart').fadeOut();
            }
        }
    });
}
function loadVektor(){
    var table = $("#tableVektor").DataTable({
        processing: true,
        serverSide: true,
        ordering:false,
        autoWidth: false,
        ajax: "grafik/table",
        language: {
            "emptyTable":"Tidak Ada Data Vektor Tersimpan"
        },
        columns: [
            {data: 'nama_alternatif',
                render: function (data, type, row) {
                    return  data;
                },'width':'20%'
            },
            {data: 'nilai_vektor_s'},
            {data: 'nilai_vektor_v_wp'},
            {data: 'ranking_wp',
                render: function (data, type, row) {
                    return  '<center>'+data+'</center>';
                },'width':'10%'
            },
            {data: 'nilai_vektor_v_saw'},
            {data: 'ranking_saw',
                render: function (data, type, row) {
                    return  '<center>'+data+'</center>';
                },'width':'10%'
            }
        ]
    });
}
