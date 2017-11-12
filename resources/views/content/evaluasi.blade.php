@extends('template')
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item active">Evaluasi</li>
</ol>
@endsection
@section('content')
<div class="col-md-12 mb-12">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#data" role="tab" aria-controls="profile"><i class="icon-basket-loaded"></i> Data Alternatif</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#matriks" role="tab" aria-controls="profile"><i class="icon-basket-loaded"></i> Table Matriks</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="data" role="tabpanel">
            <table class="table table-bordered">
                <thead id="tableHeading"></thead>
                <tbody id="tableBody"></tbody>
            </table>
        </div>
        <div class="tab-pane" id="matriks" role="tabpanel">
            <table class="table table-bordered">
                <thead id="tableHeadingMatriks"></thead>
                <tbody id="tableBodyMatriks"></tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="Edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-success" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Edit Data Evaluasi Kota</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(array('id'=>'frmEdEval','class'=>'form-horizontal')) !!}               
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="hf-email">ID Alternatif</label>
                        <div class="col-md-9">
                            <input type="text" id="id_alternatif" name="id_alternatif" class="form-control" readonly>
                        </div>
                    </div>    
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="hf-email">Nama Alternatif</label>
                        <div class="col-md-9">
                            <input type="text" id="nama_alternatif" class="form-control" readonly>
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Kriteria</th>
                                <th>Nilai Evaluasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Harga Iklan</td>
                                <td><input type='number' class='form-control' name='harga_iklan' id="harga_iklan"></td>
                            </tr>
                            <tr>
                                <td>Oplah Harian</td>
                                <td><input type='number' class='form-control' name='oplah_harian' id="oplah_harian"></td>
                            </tr>
                            <tr>
                                <td>Jumlah Halaman</td>
                                <td><input type='number' class='form-control' name='jumlah_halaman' id="jumlah_halaman"></td>
                            </tr>
                            <tr>
                                <td>Jangkauan Radius</td>
                                <td id="jangkauan"></td>
                            </tr>
                        </tbody>
                    </table>
                {!! Form::close() !!}   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="submitEdit">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('jsAjax')
<script src="{{ asset('js/pages/evaluasi.js') }}"></script>
@endsection