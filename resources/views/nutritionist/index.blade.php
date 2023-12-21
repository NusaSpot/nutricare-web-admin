@extends('layouts.main')
@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Ahli Gizi</h4>
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
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">
                    Data Ahli Gizi
                </h4>
                <form method="get" class="form-inline">
                    <div class="form-group mx-2">
                        <label for="filter" class="mr-2">Filter:</label>
                        <select name="filter" id="filter" class="form-control" onchange="this.form.submit()">
                            <option value="">Semua</option>
                            <option value="pending" {{ request()->filter === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ request()->filter === 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ request()->filter === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                            <option value="not_completed" {{ request()->filter === 'not_completed' ? 'selected' : '' }}>Belum Lengkap</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="card-body">
                @if( Session::get('success') !="")
                    <div class='alert alert-success'><center><b>{{Session::get('success')}}</b></center></div>        
                @endif
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($nutritionists as $key => $row)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->eligibleValue}}</td>
                                <td>
                                    @if($row->is_eligible != 'not_completed')
                                        <a href="{{ route('nutritionist.detail', $row->id) }}" class="btn btn-primary btn-rounded btn-sm"><i class="fa fa-eye"></i></a>
                                    @endif
                                    {{-- <a href="{{ route('nutritionist.delete', $row->id) }}" class="btn btn-danger btn-rounded btn-sm" onclick="return confirm('Apakah anda yakin ?')"><i class="fa fa-trash"></i></a> --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
