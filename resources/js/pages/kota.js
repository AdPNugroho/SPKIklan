$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#addRadius').click(function(){
        $('#Add').modal('show');
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
    $('#submitEdit').click(function(){
        var data = $('#frmEdRadK').serializeArray();
        $.ajax({
            url: "kota/update",
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
                $('#Edit').modal('hide');
                $('#frmEdRadK').trigger('reset');
                $('#tableKota').DataTable().ajax.reload();
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
    loadKota()
});
$(document).on('click','.editRadius',function(){
    var id = $(this).attr('data-id');
    $.post("kota/getKota", {
        "id_kota_radius": id
    },
    function (response) {
        $('#id_kota_radius').val(response.id_kota_radius);
        $('#edit_nama_kota').val(response.nama_kota);
        $('#edit_jumlah_penduduk').val(response.jumlah_penduduk);
    }, "json").done(function(){
        $('#Edit').modal('show');
    });
});
$(document).on('click','.deleteRadius',function(){
    var id = $(this).attr('data-id');
    $.post("kota/delete", {
        "id_kota_radius": id
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
        $('#tableKota').DataTable().ajax.reload();
    });
});
function loadKota(){
    var table = $("#tableKota").DataTable({
        processing: true,
        serverSide: true,
        ordering:false,
        autoWidth: false,
        ajax: "kota/data",
        language: {
            "emptyTable":"Tidak Ada Data Kota Tersimpan"
        },
        columns: [
            {data: 'id_kota_radius',
                render:function(data,type,row){
                    return data;
                },'width':'7%'
            },
            {data: 'nama_kota'},
            {data: 'jumlah_penduduk'},
            {data: 'id_kota_radius',
                render: function (data, type, row) {
                    return  '<button class="editRadius btn btn-sm btn-primary" data-id='+data +'><i class="fa fa-wrench"></i></button>' +
                            '<button class="deleteRadius btn btn-sm btn-danger" data-title="Hapus Admin ?" data-btn-ok-label="Ya" data-btn-cancel-label="Tidak" data-toggle="confirmation" data-placement="left" data-id='+data + '><i class="fa fa-trash-o"></i></button>';
                },'width':'7%'
            }
        ]
    });
}
