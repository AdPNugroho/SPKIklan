$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    loadEvaluasi()
    loadMatriks()
    $('#submitEdit').click(function(){
        var data = $('#frmEdEval').serializeArray();
        console.log(data);
        $.ajax({
            url: "evaluasi/update",
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
                loadEvaluasi()
                loadMatriks()
            }
        });
    });
});
$(document).on('click','.editEvaluasi',function(){
    var id = $(this).attr('data-id');
    $.post("evaluasi/getEvaluasi", {
        "id_alternatif": id
    },
    function (response) {
        console.log(response);
        var kota = response.kota;
        var alternatif = response.alternatif;
        $('#nama_alternatif').val(alternatif.nama_alternatif)
        $('#id_alternatif').val(alternatif.id_alternatif)
        $('#harga_iklan').val(response.harga);
        $('#oplah_harian').val(response.oplah);
        $('#jumlah_halaman').val(response.jumlah);
        $('#jangkauan').empty();
        $.each(kota,function(i,item){
            var kota = "<div class='checkbox'><label for='kota_radius"+item.id_kota_radius+"'><input type='checkbox' id='kota_radius"+item.id_kota_radius+"' name='kota_radius[]' value='"+item.id_kota_radius+"'>"+item.nama_kota +"</label></div>";
            $('#jangkauan').append(kota);
        });
    }, "json").done(function(){
        $('#Edit').modal('show');
    });
});
function loadEvaluasi(){
    $.ajax({
        url:"evaluasi/data",
        cache:false,
        dataType:'json',
        type:'post',
        success:function(response){
            var heading = "";
            var rows = "";
            $('#tableHeading').empty();
            $('#tableBody').empty();
            heading += '<tr><th><center>Nama Alternatif</center></th>';
            var alternatif = response.alternatif;
            var kriteria = response.kriteria;
            var evaluasi = response.evaluasi;
            $.each(kriteria,function(i,item){
                heading += '<th><center>'+ item.nama_kriteria +'</center></th>';
            });
            $.each(alternatif,function(i,item){ 
                rows = "";
                rows += '<tr><td>'+item.nama_alternatif+'</td>';
                for(e=0;e<evaluasi[i].length;e++){
                    rows += '<td><center>'+evaluasi[i][e]+'</center></td>';
                }
                rows += '<td><button class="btn btn-sm btn-primary editEvaluasi" data-id="'+ item.id_alternatif +'"><i class="fa fa-cogs"></i> Edit</button></td>';
                rows += '</tr>';
                $('#tableBody').append(rows);
            });
            heading += '<th width="7%"><center>Action</center></th></tr>';
            $('#tableHeading').append(heading);
            console.log(response);
        }
    });
}

function loadMatriks(){
    $.ajax({
        url:"evaluasi/matriks",
        cache:false,
        dataType:'json',
        type:'post',
        success:function(response){
            var heading = "";
            var rows = "";
            $('#tableHeadingMatriks').empty();
            $('#tableBodyMatriks').empty();
            heading += '<tr><th><center>Nama Alternatif</center></th>';
            var alternatif = response.alternatif;
            var kriteria = response.kriteria;
            var evaluasi = response.evaluasi;
            $.each(kriteria,function(i,item){
                heading += '<th><center>'+ item.nama_kriteria +'</center></th>';
            });
            $.each(alternatif,function(i,item){ 
                rows = "";
                rows += '<tr><td>'+item.nama_alternatif+'</td>';
                for(e=0;e<evaluasi[i].length;e++){
                    rows += '<td><center>'+evaluasi[i][e]+'</center></td>';
                }
                rows += '</tr>';
                $('#tableBodyMatriks').append(rows);
            });
            heading += '</tr>';
            $('#tableHeadingMatriks').append(heading);
            console.log(response);
        }
    });
}