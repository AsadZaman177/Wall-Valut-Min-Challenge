<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RolesController extends Controller
{
    public function index(Request $request){

        abort_if(!auth()->user()->can('view roles'), 403, __('Permission Denied'));

        if($request->ajax()){

            $roles = Role::all();

            return DataTables::of($roles)
                ->addColumn('action', function ($role) {
                    $html = '<div class="text-center d-flex justify-content-center gap-2">';

                    if ($role->name !== 'Admin') {
                        if (auth()->user()->can('edit roles')) {
                            $html .= '<a class="mr-2 editPage text-primary" href="'. route('roles.edit', $role->id) .'" style="margin-right: 10px;"><i class="fa fa-edit"></i> Edit</a>';
                        }
    
                        if (auth()->user()->can('delete roles')) {
                            $html .= '<a class="deleteRole text-danger" href="#" data-id="'. $role->id .'" style="margin-right: 10px;"><i class="fa fa-trash"></i> Delete</a>';
                        }
                    }
    
                    $html .= '</div>';
    
                    return $html;
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('roles.index');
    }

    public function create(){
        abort_if(!auth()->user()->can('add roles'), 403, __('Permission Denied'));
        $permissions = Permission::all()->groupBy(function($permission) {
            return last(explode(' ', $permission->name));
        });
        return view('roles.create',compact('permissions'));
    }

    // store
    public function store(Request $request){
        abort_if(!auth()->user()->can('add roles'), 403, __('Permission Denied'));
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array', // Ensure permissions is an array
        ],[
            'name.required' => 'Role Name is required',
            'name.unique' => 'Role already exists',
            'permissions.required' => 'At least one permission must be selected',
        ]);

        $role = Role::create(['name' => $request->name]);

        if ($request->has('permissions')) {
            $permissions = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
            $role->syncPermissions($permissions);
        }

        return redirect()->route('roles.index')->with('success', 'Role created successfully!');
    }

    public function edit($id)
    {
        abort_if(!auth()->user()->can('edit roles'), 403, __('Permission Denied'));
        $role = Role::findOrFail($id);
       
        $permissions = Permission::all()->groupBy(function($permission) {
            return last(explode(' ', $permission->name));
        });
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        return view('roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        abort_if(!auth()->user()->can('edit roles'), 403, __('Permission Denied'));
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
            'permissions' => 'required|array',
        ],[
            'name.required' => 'Role Name is required',
            'name.unique' => 'Role already exists',
            'permissions.required' => 'At least one permission must be selected',
        ]);

        $role = Role::findOrFail($id);

        $role->name = $request->input('name');
        $role->save();

        $role->permissions()->sync($request->input('permissions'));

        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }

    public function delete($id)
    {
        abort_if(!auth()->user()->can('delete roles'), 403, __('Permission Denied'));

        $role = Role::findOrFail($id);

        if ($role->name === 'super admin') {
            return redirect()->route('roles.index')->with('error', 'Super Admin role cannot be deleted.');
        }

        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
