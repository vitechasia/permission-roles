@extends('template.dreams.dreams')

@section('content')
    <div class="col-md-12 col-12">
        <div class="page-header">
            <div class="page-title">
                <h4>Role</h4>
                <h6>Semua Data Role</h6>
            </div>
            <div class="page-btn">
                @role('role-create')
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
                    <div class="float-right mb-1">
                        <form action="" method="get">
                            <input type="search" name="keyword" class="form-control" placeholder="Pencarian..."
                                value="{!! !empty(Request::get('keyword')) ? Request::get('keyword') : '' !!}">
                        </form>
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
