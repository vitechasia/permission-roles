@extends('template.dreams.dreams')

@section('content')
    <div class="col-md-12 col-12">
        <div class="page-header">
            <div class="page-title">
                <h4>Permission</h4>
                <h6>Semua Data permission</h6>
            </div>
            <div class="page-btn">
                @role('permissions-create')
                    <a class="btn btn-added" href="{{ route('permissions.create') }}"><img src="assets/img/icons/plus.svg" class="me-2" alt="img"> Tambah Baru</a>
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
                                @foreach ($permissions as $key => $permission)
                                    <tr>
                                        <td>
                                            <center>{{ $key + 1 + $valuepage }}</center>
                                        </td>
                                        <td>{{$permission->name}}</td>
                                        <td>{{$permission->slug}}</td>
                                        <td>
                                            <center>
                                                @role('permissions-edit')
                                                    <a class="btn btn-primary btn-sm"
                                                        href="{{ route('permissions.edit', $permission->id) }}">Ubah</a>
                                                @endrole
                                                @role('permissions-delete')
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id], 'style' => 'display:inline']) !!}
                                                    {!! Form::submit('Hapus', ['class' => 'btn btn-danger btn-sm']) !!}
                                                    {!! Form::close() !!}
                                                @endrole
                                            </center>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <p class="pt-1">{{ $labelcount }}</p>
                    </div>
                    {{ $permissions->appends(['keyword' => Request::get('keyword')])->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

@endsection
