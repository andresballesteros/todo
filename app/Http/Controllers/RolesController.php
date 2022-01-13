<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Models\Roles;

class RolesController extends Controller
{
    /* Función que retorna la vista roles.index con todas roles que se encuentran en la base de datos almacenadas en la variable roles */
    public function index()
    {
        /* Se agrega la política de visualización creada para el modelo */
        $this->authorize('view', new Roles);
        return view('roles.index', ['roles' => Roles::all()]);
    }


    /* Esta función retona la vista con el formulario para la creación de nuevos roles */
    public function create()
    {
        /* Se agrega la política de creación implementada para el modelo */
        $this->authorize('create', $role = new Roles);
        /* Mediante eloquent se obtienen todos los permisos y se pasa a la vista en la variable permissions */
        return view('roles.create', ['permissions' => Permission::all(), 'role' => $role]);
    }


    public function store(Request $request)
    {
        /* Se agrega la política de creación implementada para el modelo */
        $this->authorize('create', new Roles);
        /* Se realizan las validaciones de los campos */
        $data = $request->validate(
            [
                /* El campo nombre debe ser único en la tabla roles */
                'name' => 'required|unique:roles',
                /* La descripción y los permisos son obligatorios */
                'description' => 'required',
                'permissions' => 'required'
            ],
            /* Mensaje para el campo permissions */
            ['permissions.required' => 'Debe seleccionar al menos un permiso']
        );
        /* Convierte la primera letra del nombre en mayuscula */
        $data['display_name'] = Str::ucfirst($request->name);
        /* Se asigna el usuario creador y actualizador */
        $data['creator_user_id'] = auth()->user()->id;
        $data['updater_user_id'] = auth()->user()->id;
        /* Mediante eloquent se asigna se crea el rol */
        $role = Roles::create($data);
        /* Se asignan los permisos al rol creado */
        $role->givePermissionTo($request->permissions);
        /* Se redirecciona a la ruta rolex.index con el mensaje de confirmación  y todos los roles almacenados en base*/
        return redirect()->route('roles.index', ['roles' => Roles::all()])->withFlash('Rol creado de forma correcta');
    }


    public function show(Roles $role)
    {
        /* Se agrega la política de visualización creada para el modelo */
        $this->authorize('view', $role);
        /* Retorna la vista que presenta la información del rol */
        return view('roles.show', compact('role'));
    }

    /* Esta función retona la vista con el formulario para la actualización de roles */
    public function edit(Roles $role)
    {
        /* Se agrega la política de actualización creada para el modelo */
        $this->authorize('update', $role);
        return view('roles.edit', ['role' => $role, 'permissions' => Permission::all()]);
    }


    public function update(Request $request, Roles $role)
    {
        /* Se agrega la política de actualización implementada para el modelo */
        $this->authorize('update', $role);
        /* Se realizan las validaciones de los campos */
        $data = $request->validate(
            [

                'display_name' => 'required',
                'description' => 'required',
                'permissions' => 'required'
            ],
            ['permissions.required' => 'Debe seleccionar al menos un permiso']
        );

        /* Se asigna el usuario actualizador */
        $data['updater_user_id'] = auth()->user()->id;
        /* Mediante eloquent se actualiza el rol */
        $role->update($data);
        /* Se quitan todos los permisos del rol */
        $role->permissions()->detach();
        /* Se asignan los permisos enviados por el formulario */
        $role->givePermissionTo($request->permissions);
        /* Se redirecciona a la ruta rolex.index con el mensaje de confirmación  y todos los roles almacenados en base*/
        return redirect()->route('roles.index', ['roles' => Roles::all()])->withFlash('Rol actualizado de forma correcta');
    }


    public function destroy(Roles $role)
    {
        /* Se agrega la política de eliminación implementada para el modelo */
        $this->authorize('delete', $role);
        /* mediante eloquent se elimina el registro del rol */
        $role->delete();
        /* Se redirecciona a la ruta rolex.index con el mensaje de confirmación  y todos los roles almacenados en base*/
        return redirect()->route('roles.index', ['roles' => Roles::all()])->withFlash('Rol eliminado de forma correcta');
    }
}
