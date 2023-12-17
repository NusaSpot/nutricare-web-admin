@extends('layouts.main')

@section('content')
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
                        <h5 class="text-white op-7 mb-2">Halo {{ Auth::user()->name }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5 mb-0">
            <div class="row row-card-no-pd mt--2">
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="flaticon-users text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Total Tamu</p>
                                        {{ $total_guest }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="flaticon-user text-success"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Total User</p>
                                        {{ $total_user }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="flaticon-box text-danger"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Total Resep</p>
                                        {{ $total_recipe }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="flaticon-twitter text-primary"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Total Ahli Gizi</p>
                                        {{ $total_nutritionist }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                Grafik Perbandingan Tamu vs Pengguna
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12 text-center">
                                <div class="chart" style="height: 602px" id="echarts"><h3>Loading.....</h3></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>
    <script>
        $.ajax({
            type: "GET",
            url: "{{ route('chart-pie') }}",
            success: function (data) {
                var myChart = echarts.init(document.getElementById('echarts'), 'light');
            
                var option = {
                    title: {
                        text: 'Pengguna vs Tamu',
                        subtext: 'Persentasi Pengguna dan Tamu',
                        left: 'center'
                    },
                    tooltip : {
                        trigger: 'item',
                        formatter: "{a} <br/>{b} : {c} ({d}%)"
                    },
                    series: [{
                        name: 'Total',
                        type: 'pie',
                        radius: '62%',
                        center: ['50%', '55%'],
                        label: {
                            show: true,
                            formatter: '{b} : {c}',
                            color: '#222'
                        },
                        data: JSON.parse(data.json_data),
                        color: [
                            '#1872E8',
                            '#56D96F',
                            '#E3E6EF',
                            '#9FE6B8',
                            '#FFDB5C',
                            '#ff9f7f',
                            '#fb7293',
                            '#E062AE',
                            '#E690D1',
                            '#e7bcf3',
                            '#9d96f5',
                            '#8378EA',
                            '#96BFFF'
                        ]
                    }]
                };
            
                myChart.setOption(option);
            }
        });
    </script>
@endpush
