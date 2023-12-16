@extends('layouts.main')
@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Resep</h4>
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
                    <a href="#">Resep</a>
                </li>
            </ul>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Data Resep
                    &nbsp;
                    <button title="Tambah" class="btn btn-icon btn-round btn-primary btn-sm" data-toggle="modal" data-target="#tambahResep">
                        <i class="fa fa-plus"></i>
                    </button>
                </h4>
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
                                <th>Title</th>
                                <th>Image</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recipes as $key => $row)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $row->title }}</td>
                                <td><img src="{{ $row->image }}" alt="Gambar Resep" width="30%"></td>
                                <td>
                                    <button title="Ubah" class="btn btn-icon btn-round btn-warning btn-sm" data-toggle="modal" data-target="#editResep" data-id="{{ $row->id }}" data-title="{{ $row->title }}" data-category="{{ $row->category }}" data-ingredients="{{ $row->ingredients }}" data-tutorials="{{ $row->tutorials }}">
                                        <i class="fa fa-pen-square"></i>
                                    </button>
                                    <a href="{{ route('recipe.delete', $row->id) }}" onclick="return confirm('Apakah anda yakin ?')" class="btn btn-icon btn-round btn-danger btn-sm">
                                        <i class="fa fa-trash pt-2"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="tambahResep" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('recipe.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <input type="text" class="form-control" id="category" name="category" required>
                        </div>
                        <div class="form-group">
                            <label for="ingredients">Bahan - bahan</label>
                            <textarea name="ingredients" id="ingredients" cols="30" rows="5" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="tutorials">Tutorial</label>
                            <textarea name="tutorials" id="tutorials" cols="30" rows="5" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editResep" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('recipe.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <p>Upload untuk update gambar</p>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <input type="text" class="form-control" id="category" name="category" required>
                        </div>
                        <div class="form-group">
                            <label for="ingredients">Bahan - bahan</label>
                            <textarea name="ingredients" id="ingredients" cols="30" rows="5" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="tutorials">Tutorial</label>
                            <textarea name="tutorials" id="tutorials" cols="30" rows="5" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $('#editResep').on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        var title = $(e.relatedTarget).data('title');
        var category = $(e.relatedTarget).data('category');
        var ingredients = $(e.relatedTarget).data('ingredients');
        var tutorials = $(e.relatedTarget).data('tutorials');

        $('#editResep').find('input[name="id"]').val(id);
        $('#editResep').find('input[name="title"]').val(title);
        $('#editResep').find('input[name="category"]').val(category);
        $('#editResep').find('textarea[name="ingredients"]').val(ingredients);
        $('#editResep').find('textarea[name="tutorials"]').val(tutorials);
    });
</script>
@endpush
