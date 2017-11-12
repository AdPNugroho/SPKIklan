@extends('template')
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item active">Alternatif</li>
</ol>
@endsection 
@section('content')
<div class="col-md-12 mb-12">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#input" role="tab" aria-controls="home"><i class="icon-calculator"></i> Input Alternatif</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#data" role="tab" aria-controls="profile"><i class="icon-basket-loaded"></i> Data Alternatif</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="input" role="tabpanel">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <strong>Input Data Alternatif Form</strong>
                    </div>
                    <div class="card-body">
                        {!! Form::open(array('id'=>'formAlternatif','class'=>'form-horizontal')) !!}
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="nama_alternatif">Nama</label>
                            <div class="col-md-9">
                                <input type="text" id="nama_alternatif" name="nama_alternatif" class="form-control" placeholder="Nama Alternatif">
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="card-footer">
                        <button id="saveAlternatif" type="submit" class="btn btn-sm btn-primary"><i class="icon-plus"></i> Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="data" role="tabpanel">
            <div class="col-md-7" id="EditAlt" style="display: none;">
                <div class="card">
                    <div class="card-header">
                        <strong>Edit Data Alternatif Form</strong>
                    </div>
                    <div class="card-body">
                        {!! Form::open(array('id'=>'formEditAlternatif','class'=>'form-horizontal')) !!}
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="editIdAlternatif">ID Alternatif</label>
                            <div class="col-md-9">
                                <input type="text" id="editIdAlternatif" name="id_alternatif" class="form-control" placeholder="ID Alternatif" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="editNamaAlternatif">Nama</label>
                            <div class="col-md-9">
                                <input type="text" id="editNamaAlternatif" name="nama_alternatif" class="form-control" placeholder="Nama Alternatif">
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="card-footer">
                        <button id="updateAlternatif" type="submit" class="btn btn-sm btn-primary"><i class="icon-plus"></i> Submit</button>
                        <button id="cancelAlternatif" type="button" class="btn btn-sm btn-danger"><i class="icon-close"></i> Cancel</button>
                    </div>
                </div>
            </div>

            <table class="table table-bordered" id="tableAlternatif">
                <thead>
                    <th>No</th>
                    <th>Nama Alternatif</th>
                    <th>Action</th>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@section('jsAjax')
<script src="{{ asset('js/pages/alternatif.js') }}"></script>
@endsection