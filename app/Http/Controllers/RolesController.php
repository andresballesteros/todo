<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
/* use Spatie\Permission\Models\Role; */
use Spatie\Permission\Models\Permission;
use App\Models\Roles;
use Carbon\Carbon;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', new Roles);
        return view('roles.index', ['roles' => Roles::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', $role = new Roles);
        return view('roles.create', ['permissions' => Permission::all(), 'role' => $role]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Roles);
        $data = $request->validate(
            [
                'name' => 'required|unique:roles',
                'description' => 'required',
                'permissions' => 'required'
            ],
            ['permissions.required' => 'Debe seleccionar al menos un permiso']
        );
        $data['display_name'] = Str::ucfirst($request->name);
        $data['creator_user_id'] = auth()->user()->id;
        $data['updater_user_id'] = auth()->user()->id;
        $role = Roles::create($data);
        $role->givePermissionTo($request->permissions);

        return redirect()->route('roles.index', ['roles' => Roles::all()])->withFlash('Rol creado de forma correcta');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Roles $role)
    {
        $this->authorize('view', $role);
        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Roles $role)
    {
        $this->authorize('update', $role);
        return view('roles.edit', ['role' => $role, 'permissions' => Permission::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Roles $role)
    {
        $this->authorize('update', $role);
        return $request;
        $data = $request->validate(
            [
                'display_name' => 'required',
                'description' => 'required',
                'permissions' => 'required'
            ],
            ['permissions.required' => 'Debe seleccionar al menos un permiso']
        );

        $data['updater_user_id'] = auth()->user()->id;

        $role->update($data);
        $role->permissions()->detach();
        $role->givePermissionTo($request->permissions);

        return redirect()->route('roles.index', ['roles' => Roles::all()])->withFlash('Rol actualizado de forma correcta');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Roles $role)
    {
        $this->authorize('delete', $role);

        $role->delete();

        return redirect()->route('roles.index', ['roles' => Roles::all()])->withFlash('Rol eliminado de forma correcta');
    }
}
