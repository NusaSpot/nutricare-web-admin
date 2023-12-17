@extends('layouts.main')
@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Aktivitas Ahli Gizi</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('dashboard') }}">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Aktivitas Ahli Gizi</a>
                </li>
            </ul>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Aktivitas Detail
                </h4>
            </div>
            <div class="card-body">
                <div class="card-box d-block mx-auto pd-20 mb-20">
                    <p>Judul : {{ $activity->title }}</p>
                    <p>Tanggal : {{ $activity->date }}</p>
                    <p>Bukti Screenshoot :</p>
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ $activity->proof1Link }}"  style="max-width:400px" alt="Proof 1">
                        </div>
                        @if($activity->proof_2)
                            <div class="col-md-4">
                                <img src="{{ $activity->proof2Link }}" style="max-width:400px" alt="Proof 2">
                            </div>
                        @endif
                        @if($activity->proof_3)
                            <div class="col-md-4">
                                <img src="{{ $activity->proof3Link }}" style="max-width:400px" alt="Proof 3">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
