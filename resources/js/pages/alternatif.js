$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    loadAlternatif()
});
$(document).on('click','#saveAlternatif',function(){
    var data = $('#formAlternatif').serializeArray();
    $.ajax({
        url: "alternatif/save",
        data: data,
        type: 'post',
        dataType: 'json',
        cache: false,
        success: function (response) {
            console.log(response);
            $.toast({
                heading: 'Information',
                text: response.message,
                position: 'bottom-right',
                stack: false,
                showHideTransition: 'slide',
                icon: response.status
            });
            $('#formAlternatif').trigger('reset');
            $('#tableAlternatif').DataTable().ajax.reload();
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
$(document).on('click','#updateAlternatif',function(){
    var data = $('#formEditAlternatif').serializeArray();
    $.ajax({
        url: "alternatif/update",
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
            $('#formEditAlternatif').trigger('reset');
            $('#EditAlt').fadeOut();
            $('#tableAlternatif').DataTable().ajax.reload();
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
$(document).on('click','.editAlternatif',function(){
    var id = $(this).attr('data-id');
    $.post("alternatif/getAlternatif", {
        "id_alternatif": id
    },
    function (response) {
        $('#editIdAlternatif').val(response.id_alternatif);
        $('#editNamaAlternatif').val(response.nama_alternatif);
    }, "json").done(function(){
        $('#EditAlt').fadeIn();
    });
});
$(document).on('click','#cancelEdit',function(){
    $('#EditAlt').fadeOut();
});
$(document).on('click','.deleteAlternatif',function(){
    var id = $(this).attr('data-id');
    $.post("alternatif/delete", {
        "id_alternatif": id
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
        $('#tableAlternatif').DataTable().ajax.reload();
    });
});
function loadAlternatif(){
    var table = $("#tableAlternatif").DataTable({
        processing: true,
        serverSide: true,
        ordering:false,
        autoWidth: false,
        ajax: "alternatif/data",
        language: {
            "emptyTable":"Tidak Ada Data Alternatif Tersimpan"
        },
        columns: [
            {data: 'id_alternatif',
                render:function(data,type,row){
                    return data;
                },'width':'7%'
            },
            {data: 'nama_alternatif'},
            {data: 'id_alternatif',
                render: function (data, type, row) {
                    return  '<button class="editAlternatif btn btn-sm btn-primary" data-id='+data +'><i class="fa fa-wrench"></i></button>' +
                            '<button class="deleteAlternatif btn btn-sm btn-danger" data-title="Hapus Admin ?" data-btn-ok-label="Ya" data-btn-cancel-label="Tidak" data-toggle="confirmation" data-placement="left" data-id='+data + '><i class="fa fa-trash-o"></i></button>';
                },'width':'7%'
            }
        ]
    });
}
