$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#submitAdd').click(function(){
        var data = $('#frmRadK').serializeArray();
        $.ajax({
            url: "kota/save",
            data: data,
            type: 'post',
            dataType: 'json',
            cache: false,
            success: function (response) {
                $.toast({
                    heading: 'Information',
                    text: response.message,
                    position: 'bottom-right',
                    stack: false,
                    showHideTransition: 'slide',
                    icon: response.status
                });
                $('#frmRadK').trigger('reset');
                $('#tableKota').DataTable().ajax.reload();
                $('#Add').modal('hide');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                var error = xhr.responseJSON;
                var no = 0;
                var errorArray = [];
                $.each(error, function (key, value) {
                    errorArray[no] = value[0];
                    no++;
                });
                $.toast({
                    heading: 'Kesalahan!',
                    text: errorArray,
                    icon: 'error',
                    position: 'bottom-right'
                });
            }
        });
    });
    loadHistory()
});
$(document).on('click','.detailHistory',function(){
    var id = $(this).attr('data-id');
    $.ajax({
        url:"history/detail",
        data:'id_history='+id,
        cache:false,
        dataType:'json',
        type:'post',
        success:function(response){
            console.log(response);
            if(response.status){
                var wp = response.nilai_wp;
                var saw = response.nilai_saw;
                var categories = response.nama_alternatif;
                Highcharts.chart('chartDetailHistory', {
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
                        text: 'Metode Weighted Product dan SAW'
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
                    },{
                        name: 'Weighted Product',
                        data: wp
                    }]
                });
            }
        },
        complete:function(response){
            $('#detail').modal('show');
        }
    });
});
$(document).on('click','.deleteHistory',function(){
    var id = $(this).attr('data-id');
    $.post("history/delete", {
        "id_history": id
    },
    function (response) {
        $.toast({
            heading: 'Information',
            text: response.message,
            position: 'bottom-right',
            stack: false,
            showHideTransition: 'slide',
            icon: response.status
        });
    }, "json").done(function(){
        $('#tableHistory').DataTable().ajax.reload();
    });
});
function loadHistory(){
    var table = $("#tableHistory").DataTable({
        processing: true,
        serverSide: true,
        ordering:false,
        autoWidth: false,
        ajax: "history/data",
        language: {
            "emptyTable":"Tidak Ada Data History Tersimpan"
        },
        columns: [
            {data: 'id_history'},
            {data: 'tanggal_simpan'},
            {data: 'nama_alternatif_wp'},
            {data: 'nama_alternatif_saw'},
            {data: 'id_history',
                render: function (data, type, row) {
                    return  '<button class="detailHistory btn btn-sm btn-primary" data-id='+data +'><i class="fa fa-wrench"></i></button>' +
                            '<button class="deleteHistory btn btn-sm btn-danger" data-title="Hapus Admin ?" data-btn-ok-label="Ya" data-btn-cancel-label="Tidak" data-toggle="confirmation" data-placement="left" data-id='+data + '><i class="fa fa-trash-o"></i></button>';
                },'width':'7%'
            }
        ]
    });
}
