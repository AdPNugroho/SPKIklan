let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.js('resources/assets/js/pages/alternatif.js','public/compiled/js/page').
    js('resources/assets/js/pages/kota.js','public/compiled/js/page').
    js('resources/assets/js/pages/grafik.js','public/compiled/js/page').
    js('resources/assets/js/pages/history.js','public/compiled/js/page').
    js('resources/assets/js/pages/evaluasi.js','public/compiled/js/page').
    js('resources/assets/js/pages/kriteria.js','public/compiled/js/page');

mix.styles([
    'resources/css/jquery.dataTables.min.css',
    'resources/css/font-awesome.min.css',
    'resources/css/simple-line-icons.css',
    'resources/css/style.css',
    'resource/css/jquery.toast.css',
    'resources/css/dataTables.bootstrap.min.css'
],'public/compiled/css/all.css');

mix.scripts([
    'resources/bower_components/jquery/dist/jquery.min.js',
    'resources/bower_components/popper.js/index.js',
    'resources/bower_components/bootstrap/dist/js/bootstrap.min.js',
    'resources/js/jquery.dataTables.min.js',
    'resources/js/DataTablesBS4.js',
    'resources/bower_components/pace/pace.min.js',
    'resources/bower_components/chart.js/dist/Chart.min.js',
    'resources/js/app.js',
    'resources/js/jquery.toast.js'
],'public/compiled/js/all.js');
{/* <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('bower_components/popper.js/index.js') }}"></script>
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/DataTablesBS4.js') }}"></script>

<script src="{{ asset('bower_components/pace/pace.min.js') }}"></script>
<script src="{{ asset('bower_components/chart.js/dist/Chart.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/jquery.toast.js') }}"></script> */}