@extends('template')

@section('app_title', 'Daftar Penduduk')

@section('app_contents')
    <section class="section">
        <h3>
            @yield('app_title')
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('app_title')</li>
            </ol>
        </nav>
    </section>

    @if (session('message'))
        {!! session('message') !!}
    @endif
    @if ($errors->any())
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    @endif

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-book"></i> @yield('app_title')
                    </h2>
                    <div class="pull-right">
                        <a href="{{ url('admin/kependudukan/download') }}" class="btn btn-dark btn-sm">Download
                            Data</a>
                        <a href="" class="btn btn-success btn-sm" data-target="#upload-excel"
                            data-toggle="modal">Upload
                            Data</a>
                        <a href="{{ url('admin/kependudukan/create') }}" class="btn btn-primary btn-sm">Tambah
                            Penduduk</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-box table-responsive">
                                <table class="table table-bordered table-striped" id="datatable">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($penduduk as $penduduk)
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <td>{{ $penduduk->nik }}</td>
                                                <td>{{ $penduduk->nama }}</td>
                                                <td>{{ $penduduk->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                                <td>
                                                    <a href="{{ url('admin/kependudukan/' . $penduduk->id . '/edit') }}"
                                                        class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                                    <form action="{{ url('admin/kependudukan/' . $penduduk->id) }}"
                                                        class="d-inline" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-sm btn-danger"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
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
        </div>
    </div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="upload-excel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa fa-plus"></i>
                        <span>Tambah Data</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/kependudukan/upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="excel">Upload Excel</label>
                            <input type="file" name="excel" id="excel" class="form-control" required
                                accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ url('dokumen/template.xlsx') }}" class="btn btn-sm btn-dark"><i
                                class="fa fa-download"></i> Download Template</a>
                        <button type="reset" class="btn btn-danger btn-sm" data-dismiss="modal">
                            <i class="fa fa-times"></i> Kembali
                        </button>
                        <button class="btn btn-sm btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
