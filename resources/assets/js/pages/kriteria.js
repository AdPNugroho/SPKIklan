
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    loadKriteria()
});
$(document).on('click','.editKriteria',function(){
    var id = $(this).attr('data-id');
    $.post("kriteria/getKriteria", {
        "id_kriteria": id
    },
    function (response) {
        $('#editIdKriteria').val(response.id_kriteria);
        $('#editNamaKriteria').val(response.nama_kriteria);
        $('#editTypeKriteria').val(response.type_kriteria);
        $('#editNilaiKriteria').val(response.nilai_kriteria);
    }, "json").done(function(){
        $('#editKriteria').fadeIn();
    });
});
$(document).on('click','#updateKriteria',function(){
    var data = $('#formEditKriteria').serialize();
    $.ajax({
        url: "kriteria/update",
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
            $('#formEditKriteria').trigger('reset');
            $('#editKriteria').fadeOut();
            $('#tableKriteria').DataTable().ajax.reload();
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
$(document).on('click','#cancelKriteria',function(){
    $('#editKriteria').fadeOut();
});
function loadKriteria(){
    var table = $("#tableKriteria").DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        autoWidth: false,
        ordering:false,
        ajax: "kriteria/data",
        language: {
            "emptyTable":"Tidak Ada Data Kriteria"
        },
        columns: [
            {data: 'id_kriteria',
                render:function(data,type,row){
                    return  '<center>'+data+'</center>';
                },'width':'7%'
            },
            {data: 'nama_kriteria',
                render: function (data, type, row) {
                    return data;
                },'width':'10%'
            },
            {data: 'type_kriteria',
                render: function (data, type, row) {
                    return  '<center>'+data+'</center>';
                },'width':'10%'
            },
            {data: 'nilai_kriteria',
                render: function (data, type, row) {
                    return  '<center>'+data+'</center>';
                }
            },
            {data: 'nilai_bobot',
                render: function (data, type, row) {
                    return  '<center>'+data+'</center>';
                }
            },
            {data: 'id_kriteria',
                render: function (data, type, row) {
                    return  '<button class="editKriteria btn btn-primary" data-id='+data +'><i class="fa fa-cogs"></i>&nbsp;&nbsp;Edit</button>';
                },'width':'7%'
            }
        ]
    })
;}