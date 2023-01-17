@extends('template.dreams.dreams')

@section('content')

    <div class="col-md-12 col-12">
        <div class="page-header">
            <div class="page-title">
                <h4>Users</h4>
                <h6>Ubah Users</h6>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{route('users.update',$users->id)}}" method="post" class="form form-vertical">
                        @csrf
                        @method('PUT')
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input name="name" class="form-control" type="text" value="{{$users->name}}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input name="email" class="form-control" type="email" value="{{$users->email}}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input name="password" class="form-control" type="password" >
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Role</label>
                                        <input type="hidden" name="role_now" value="{!! !empty($users->roles()->first()['id']) ? $users->roles()->first()['id'] : '0' !!}">
                                        <select name="role_id" class="form-control">
                                            @foreach($roles as $key => $role)
                                                @if(!empty($users->roles()->first()['id']))
                                                    <option value="{{$role->id}}" {!! $users->roles()->first()['id'] == $role->id ? 'selected' : '' !!}>{{$role->name}}</option>
                                                @else
                                                    <option value="{{$role->id}}" >{{$role->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 pt-2 border-top">
                                    <button type="submit" class="btn btn-submit me-2">Proses</button>
                                    <a class="btn btn-cancel"
                                        href="{{ route('users.index') }}"> Batal</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
