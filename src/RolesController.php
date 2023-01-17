<?php

namespace Vdes\PermisionRoles;

use App\Http\Controllers\Controller;
use Vdes\PermisionRoles\Models\Role;
use Illuminate\Http\Request;
use Vdes\PermisionRoles\Models\Permission;


class RolesController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:roles-list', ['only' => ['index','show']]);
        $this->middleware('permission:roles-create', ['only' => ['create','store']]);
        $this->middleware('permission:roles-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:roles-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Role";
        $pagination  = 10;
        $roles = Role::when($request->keyword, function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->keyword}%");
            })->orderBy('id', 'DESC')->paginate($pagination);
        $valuepage = (($roles->currentPage() - 1) * $roles->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $roles->count()) . " Data dari ". $roles->total(). " Data";
        return view('template.dreams.modul.roles.index', compact('roles', 'valuepage', 'labelcount','title'));
    }
    public function create()
    {
        $title = "Tambah Record Role";
        $permissions = Permission::all();
        return view('template.dreams.modul.roles.create',compact('title','permissions'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
        ]);
		$add_role = new Role();
		$add_role->slug = PermisionsRoles::slug($request->name);
		$add_role->name = $request->name;
		$add_role->save();
		$add_role->permissions()->attach($request->permission);
        return redirect()->route('roles.index')->with('success','Data berhasi diproses');
    }

    public function show(Role $roles)
    {
        //
    }

    public function edit($id)
    {
        $title = "Ubah Record Role";
        $roles = Role::find($id);
        $notIdPermissions = $roles->permissions->map(function($ip){
            return $ip->id;
        })->toArray();
        $permissions = Permission::whereNotIn('id',$notIdPermissions)->get();
        return view('template.dreams.modul.roles.edit',compact('title','roles','permissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name,'.$id,
        ]);
        $roles = Role::find($id);
		$roles->slug = PermisionsRoles::slug($request->name);
		$roles->name = $request->name;
		$roles->save();
        if(!empty($request->detach) || $request->detach != null){
            $roles->permissions()->detach($request->detach);
        }
		if(!empty($request->permission) || $request->permission != null){
            $roles->permissions()->attach($request->permission);
        }
        return redirect()->route('roles.index')->with('success','Data berhasi diproses');
    }

    public function destroy(Role $roles)
    {
        $roles->delete();
        return redirect()->route('roles.index')->with('success','Data berhasi diproses');
    }
}
