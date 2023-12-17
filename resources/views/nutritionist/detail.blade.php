@extends('layouts.main')
@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Ahli Gizi Detail</h4>
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
                    <a href="#">Ahli Gizi</a>
                </li>
            </ul>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Ahli Gizi Detail
                </h4>
            </div>
            <div class="card-body">
                @if( Session::get('success') !="")
                    <div class='alert alert-success'><center><b>{{Session::get('success')}}</b></center></div>        
                @endif
                @if($nutritionist->deleted_at)
                    <div class='alert alert-danger'><center><b>Akun ini sudah ter suspend</b></center></div>        
                @endif
                <p>Nama : {{ $nutritionist->name }}</p>
                <p>Foto Profile : </p>
                <img src="{{ $nutritionist->nutritionistProfile->profilePictureLink }}" style="max-width:250px" alt="foto profile">
                <p>Jenis Kelamin : {{ $nutritionist->nutritionistProfile->gender == 'male' ? 'Laki - laki' : 'Perempuan' }}</p>
                <p>Tanggal Lahir : {{ $nutritionist->nutritionistProfile->date_of_birth }}</p>
                <p>No Whatsapp : {{ $nutritionist->nutritionistProfile->phone }}</p>
                <p>NIK : {{ $nutritionist->nutritionistProfile->nik }}</p>
                <p>Pengalaman Kerja : {{ $nutritionist->nutritionistProfile->work_experience }}</p>
                <p>Pendidikan Terakhir : {{ $nutritionist->nutritionistProfile->educationValue }}</p>
                <p>Tempat Bekerja Saat Ini : {{ $nutritionist->nutritionistProfile->work_place }}</p>
                <p>CV : <a href="{{ $nutritionist->nutritionistProfile->cvLink }}" target="_blank">Download</a></p>
                @if(!$nutritionist->deleted_at)
                    <hr>
                    <form action="{{ route('nutritionist.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $nutritionist->id }}">
                        <div class="form-group">
                            <label for="is_eligible">Ubah Status</label>
                            <select name="is_eligible" id="is_eligible" class="form-control" required>
                                <option value="" disabled selected>Pilih Status</option>
                                <option value="approved" {{ $nutritionist->is_eligible == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $nutritionist->is_eligible == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="remark">Catatan</label>
                            <textarea name="remark" id="remark" cols="30" rows="5" class="form-control">{{ $nutritionist->remark }}</textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
