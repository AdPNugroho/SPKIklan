@extends('template')
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item active">Data Radius Kota</li>
</ol>
@endsection 
@section('content')
<div class="col-md-12 mb-12">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#input" role="tab" aria-controls="home"><i class="icon-calculator"></i> Data Radius Kota</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="input" role="tabpanel">
            <div class="row">
                <div class="col-md-12">
                    <button id="addRadius" type="submit" class="btn btn-sm btn-primary"><i class="icon-plus"></i> Tambah Radius Kota</button><br/>
                </div>
                <div class="col-md-12">
                <table class="table table-bordered" id="tableKota">
                    <thead>
                        <th>No</th>
                        <th>Nama Kota</th>
                        <th>Jumlah Penduduk</th>
                        <th>Action</th>
                    </thead>
                </table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="Add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-primary" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Form Add Data Radius Kota</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(array('id'=>'frmRadK')) !!}               
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="name">Nama Kota</label>
                                            <input type="text" class="form-control" id="nama_kota" name="nama_kota" placeholder="Nama Kota">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="ccnumber">Jumlah Penduduk</label>
                                            <input type="text" class="form-control" id="jumlah_penduduk" name="jumlah_penduduk">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {!! Form::close() !!}   
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="submitAdd">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="Edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-success" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Form Edit Data Radius Kota</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(array('id'=>'frmEdRadK')) !!}               
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="name">ID Kota</label>
                                            <input type="text" class="form-control" id="id_kota_radius" name="id_kota_radius" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="name">Nama Kota</label>
                                            <input type="text" class="form-control" id="edit_nama_kota" name="nama_kota" placeholder="Nama Kota">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="ccnumber">Jumlah Penduduk</label>
                                            <input type="text" class="form-control" id="edit_jumlah_penduduk" name="jumlah_penduduk">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {!! Form::close() !!}   
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="submitEdit">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('jsAjax')
<script src="{{ asset('js/pages/kota.js') }}"></script>
@endsection