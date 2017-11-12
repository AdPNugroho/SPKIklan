@extends('template') 
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item active">Dashboard</li>
    
    <li class="breadcrumb-menu d-md-down-none">
        <div class="btn-group" role="group" aria-label="Button group">
            <a class="btn" href="{{ url('/grafik') }}"><i class="icon-graph"></i> &nbsp;Grafik</a>
        </div>
    </li>
</ol>
@endsection 

@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">

        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body p-3 clearfix">
                        <i class="fa fa-users bg-success p-3 font-2xl mr-3 float-left"></i>
                        <div class="h5 text-primary mb-0 mt-2">{{ $alternatif }}</div>
                        <div class="text-muted text-uppercase font-weight-bold font-xs">Total Alternatif</div>
                    </div>
                    <div class="card-footer px-3 py-2">
                        <a class="font-weight-bold font-xs btn-block text-muted" href="{{ url('/alternatif') }}">Detail <i class="fa fa-angle-right float-right font-lg"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body p-3 clearfix">
                        <i class="fa fa-line-chart bg-danger p-3 font-2xl mr-3 float-left"></i>
                        <div class="text-primary mb-0 mt-2">{{ $wp }}</div>
                        <div class="text-muted text-uppercase font-weight-bold font-xs">Rank Tertinggi WP</div>
                    </div>
                    <div class="card-footer px-3 py-2">
                        <a class="font-weight-bold font-xs btn-block text-muted" href="{{ url('/grafik') }}">Detail <i class="fa fa-angle-right float-right font-lg"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body p-3 clearfix">
                        <i class="fa fa-area-chart bg-danger p-3 font-2xl mr-3 float-left"></i>
                        <div class="text-primary mb-0 mt-2">{{ $saw }}</div>
                        <div class="text-muted text-uppercase font-weight-bold font-xs">Rank Tertinggi SAW</div>
                    </div>
                    <div class="card-footer px-3 py-2">
                        <a class="font-weight-bold font-xs btn-block text-muted" href="{{ url('/grafik') }}">Detail <i class="fa fa-angle-right float-right font-lg"></i></a>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">

            <div class="col-sm-12 col-md-12">
                <div class="card border-primary">
                    <div class="card-header">
                        Komparasi Metode DSS Weighted Product & Simple Additive Weighting
                    </div>
                    <div class="card-body">
                        <h4>SimpleAdditiveWeighting</h4>
                        <p>
                        Metode SAW sering dikenal dengan istilah metode penjumlahan terbobot. 
                        Konsep dasar metode SAW (Simple Additive Weighting) adalah mencari penjumlahan terbobot dari rating kinerja pada setiap alternatif pada semua atribut. 
                        Metode SAW dapat membantu dalam pengambilan keputusan suatu kasus, akan tetapi perhitungan dengan menggunakan metode SAW ini hanya yang menghasilkan nilai terbesar yang akan terpilih sebagai alternatif yang terbaik. 
                        Perhitungan akan sesuai dengan metode ini apabila alternatif yang terpilih memenuhi kriteria yang telah ditentukan. 
                        Metode SAW ini lebih efisien karena waktu yang dibutuhkan dalam perhitungan lebih singkat. 
                        Metode SAW membutuhkan proses normalisasi matriks keputusan (X) ke suatu skala yang dapat diperbandingkan dengan semua rating alternatif yang ada.
                        </p>


                        <h4>WeightedProduct</h4>
                        <p>
                            Metode Weighted Product (WP) adalah salah satu metode penyelesaian pada sistem pendukung keputusan. 
                            Metode ini mengevaluasi beberapa alternatif terhadap sekumpulan atribuat atau kriteria, 
                            dimana setiap atribut saling tidak bergantung satu dengan yang lainnya.
                            Menurut Yoon (dalam buku Kusumadewi, 2006), metode weighted product menggunakan teknik perkalian untuk menghubungkan rating atribut, 
                            dimana rating tiap atribut harus dipangkatkan terlebih dahulu dengan bobot atribut yang bersangkutan.<br/>
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection