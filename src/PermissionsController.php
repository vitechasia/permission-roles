<?php

namespace Vdes\PermisionRoles;

use App\Http\Controllers\Controller;
use Vdes\PermisionRoles\Models\Permission;
use Illuminate\Http\Request;


class PermissionsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:permissions-list', ['only' => ['index','show']]);
        $this->middleware('permission:permissions-create', ['only' => ['create','store']]);
        $this->middleware('permission:permissions-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:permissions-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Permission";
        $pagination  = 2;
        $permissions = Permission::when($request->keyword, function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->keyword}%");
            })->orderBy('id', 'DESC')->paginate($pagination);
        $valuepage = (($permissions->currentPage() - 1) * $permissions->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $permissions->count()) . " Data dari ". $permissions->total(). " Data";
        return view('template.dreams.modul.permissions.index', compact('permissions', 'valuepage', 'labelcount','title'));
    }
    public function create()
    {
        $title = "Tambah Record Permission";
        return view('template.dreams.modul.permissions.create',compact('title'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
        ]);
        $input = $request->all();
        $input['slug'] = PermisionsRoles::slug($request->name);
        Permission::create($input);
        return redirect()->route('permissions.index')->with('success','Data berhasi diproses');
    }

    public function show(Permission $permissions)
    {
        //
    }

    public function edit($id)
    {
        $title = "Ubah Record Permission";
        $permissions = Permission::find($id);
        return view('template.dreams.modul.permissions.edit',compact('title','permissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name,'.$id,
        ]);
        $permissions = Permission::find($id);
        $input = $request->all();
        $input['slug'] = PermisionsRoles::slug($request->name);
        $permissions->update($input);
        return redirect()->route('permissions.index')->with('success','Data berhasi diproses');
    }

    public function destroy(Permission $permissions)
    {
        $permissions->delete();
        return redirect()->route('permissions.index')->with('success','Data berhasi diproses');
    }
}
