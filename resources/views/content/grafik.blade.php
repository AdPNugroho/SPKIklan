@extends('template') 
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item active">Grafik</li>
    <li class="breadcrumb-menu d-md-down-none">
        <div class="btn-group" role="group" aria-label="Button group">
            <button id="saveResult" style="color:white;" onMouseOver="this.style.color='#000000'" onMouseOut="this.style.color='#FFFFFF'" class="btn btn-sm btn-primary" id="refreshGrafik"><i class="icon-cursor"></i> &nbsp;Save Result</button>
            <button class="btn btn-sm btn-default" id="refreshGrafik"><i class="icon-refresh"></i> &nbsp;Refresh</button>
        </div>
    </li>
</ol>
@endsection 

@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
        <div id="panelChart">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Grafik Nilai Preferensi Metode
                        </div>
                        <div class="card-body" id="containerChartWP">
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Grafik Nilai Preferensi Metode
                        </div>
                        <div class="card-body" id="containerChartSAW">
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Tabel Vektor</div>
                        <div class="card-body" id="tabelPreferensi">  
                            <table class="table table-bordered" id="tableVektor">
                                <thead>
                                    <th>Nama </th>
                                    <th>Nilai Vektor S WP</th>
                                    <th>Nilai Vektor V WP</th>
                                    <th>WP</th>
                                    <th>Nilai Vektor V SAW</th>
                                    <th>SAW</th>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="panelWarning" style="display:none;">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Info</div>
                        <div class="card-body"><h1>Tidak Ada Data Vektor WP dan SAW</h1></div>
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
<script src="{{ asset('js/pages/grafik.js') }}"></script>
@endsection