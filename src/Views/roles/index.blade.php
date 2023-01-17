@extends('template.dreams.dreams')

@section('content')
    <div class="col-md-12 col-12">
        <div class="page-header">
            <div class="page-title">
                <h4>Role</h4>
                <h6>Semua Data Role</h6>
            </div>
            <div class="page-btn">
                @role('roles-create')
                    <a class="btn btn-added" href="{{ route('roles.create') }}"><img src="assets/img/icons/plus.svg" class="me-2" alt="img"> Tambah Baru</a>
                @endrole
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-input">
                                <a class="btn btn-searchset">
                                    <img src="{{url('/assets/img/icons/search-white.svg')}}" alt="img">
                                </a>
                                <form action="" method="get">
                                    <label> <input type="search" class="form-control form-control-sm" name="keyword" placeholder="Search..." value="{!! !empty(Request::get('keyword')) ? Request::get('keyword') : '' !!}"></label>
                                </form>
                            </div>
                        </div>
                        <div class="wordset">
                            {{-- <ul>
                                <li>
                                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="pdf" aria-label="pdf"><img src="assets/img/icons/pdf.svg" alt="img"></a>
                                </li>
                                <li>
                                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="excel" aria-label="excel"><img src="assets/img/icons/excel.svg" alt="img"></a>
                                </li>
                                <li>
                                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="print" aria-label="print"><img src="assets/img/icons/printer.svg" alt="img"></a>
                                </li>
                            </ul> --}}
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center" width="20">No</th>
                                    <th>Nama</th>
                                    <th>Slug</th>
                                    <th width="280" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $key => $role)
                                    <tr>
                                        <td>
                                            <center>{{ $key + 1 + $valuepage }}</center>
                                        </td>
                                        <td>{{$role->name}}</td>
                                        <td>{{$role->slug}}</td>
                                        <td>
                                            <center>
                                                @role('roles-edit')
                                                    <a class="btn btn-primary btn-sm"
                                                        href="{{ route('roles.edit', $role->id) }}">Ubah</a>
                                                @endrole
                                                @role('roles-delete')
                                                <form action="{{route('roles.destroy',$role->id)}}" method="post" style="display:inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                                @endrole
                                            </center>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <p class="pt-1">{{ $labelcount }}</p>
                    </div>
                    {{ $roles->appends(['keyword' => Request::get('keyword')])->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

@endsection
