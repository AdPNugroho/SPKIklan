@extends('template')
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item active">Data History</li>
</ol>
@endsection 
@section('content')
<div class="col-md-12 mb-12">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#input" role="tab" aria-controls="home"><i class="icon-calculator"></i> Data History Preferensi</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="input" role="tabpanel">
            <div class="row">
                <div class="col-md-12">
                <table class="table table-bordered" id="tableHistory">
                    <thead>
                        <th>No</th>
                        <th>Tanggal Simpan</th>
                        <th>Kandidat WP</th>
                        <th>Kandidat SAW</th>
                        <th>Action</th>
                    </thead>
                </table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-primary" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Form Detail Data History Preferensi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body" id="chartDetailHistory"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('jsAjax')
<script src="{{ asset('js/highcharts.js') }}"></script>
<script src="{{ asset('js/highcharts-3d.js') }}"></script>
<script src="{{ asset('js/pages/history.js') }}"></script>
@endsection