@extends('template')
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item active">Kriteria</li>
</ol>
@endsection 
@section('content')
<div class="col-md-12 mb-12">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#data" role="tab" aria-controls="profile"><i class="icon-basket-loaded"></i> Data Kriteria</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="data" role="tabpanel">
            <div class="col-md-7" id="editKriteria" style="display: none;">
                <div class="card">
                    <div class="card-header">
                        <strong>Edit Data Kriteria</strong>
                    </div>
                    <div class="card-body">
                        {!! Form::open(array('id'=>'formEditKriteria','class'=>'form-horizontal')) !!}
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="editIdKriteria">ID Kriteria</label>
                            <div class="col-md-9">
                                <input type="text" id="editIdKriteria" name="id_kriteria" class="form-control" placeholder="ID Kriteria" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="editNamaKriteria">Nama</label>
                            <div class="col-md-9">
                                <input type="text" id="editNamaKriteria" name="nama_kriteria" class="form-control" placeholder="Nama Kriteria" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="editTypeKriteria">Type</label>
                            <div class="col-md-9">
                                <input type="text" id="editTypeKriteria" name="type_kriteria" class="form-control" placeholder="Type Kriteria" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="editNilaiKriteria">Nilai</label>
                            <div class="col-md-9">
                                {{--  <input type="text" id="editNilaiKriteria" name="nilai_kriteria" class="form-control" placeholder="Nilai Kriteria">  --}}
                                <select class="form-control" id="editNilaiKriteria" name="nilai_kriteria">
	                                <option value='1'>1</option>
	                                <option value='2'>2</option>
	                                <option value='3'>3</option>
	                                <option value='4'>4</option>
	                                <option value='5'>5</option>
	                            </select>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="card-footer">
                        <button id="updateKriteria" type="submit" class="btn btn-sm btn-primary"><i class="icon-plus"></i> Submit</button>
                        <button id="cancelKriteria" type="button" class="btn btn-sm btn-danger"><i class="icon-close"></i> Cancel</button>
                    </div>
                </div>
            </div>

            <table class="table table-bordered" id="tableKriteria">
                <thead>
                    <th>No</th>
                    <th>Nama Kriteria</th>
                    <th>Type Kriteria</th>
                    <th>Nilai Kriteria</th>
                    <th>Bobot Kriteria</th>
                    <th>Action</th>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@section('jsAjax')
    <script src="{{ asset('js/pages/kriteria.js') }}"></script>
@endsection