<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /* Función que retorna la vista con el listado de todos los usuarios del sistema */
    public function index()
    {
        /* Se agrega la política de visualización implementada para el modelo */
        $this->authorize('view', new User);
        return view('usuarios.index', ['usuarios' => User::all()]);
    }

    /* Función que devuelve la vista con el formulario para la creación de usuarios */
    public function create()
    {
        /* Se agrega la política de creación implementada para el modelo */
        $this->authorize('create', new User);
        return view('usuarios.create', ['roles' => Role::all(), 'usuario' => new User]);
    }

    /* Funcion encargada de la validacion y el almacenamiento de los usuarios */
    public function store(Request $request)
    {
        /* Se agrega la política de creación implementada para el modelo */
        $this->authorize('create', new User);
        /* Validaciones de los campos enviados por el formulario */
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);
        /* asignacion del usuario quien realiza la operación */
        $data['creator_user_id'] = auth()->user()->id;
        $data['updater_user_id'] = auth()->user()->id;
        /* Mediante eloquent se crea el registro del nuevo usuario en base */
        $user = User::create($data);
        /* Se asigna los roles al usuario */
        $user->assignRole($request->roles);
        /* se redirecciona a la ruta usuarios.index con el mensaje de confirmación */
        return redirect()->route('usuarios.index')->withFlash('El usuario ha sido creado de forma exitosa');
    }


    /* Devuelve la vista con la información del ususario */
    public function show(User $usuario)
    {
        /* Se agrega la política de visualización implementada para el modelo */
        $this->authorize('view', $usuario);
        return view('usuarios.show', compact('usuario'));
    }

    /* Retorna la vista con el formulario para la edición de usuarios */
    public function edit(User $usuario)
    {
        /* Se agrega la política de actualización implementada para el modelo */
        $this->authorize('update', $usuario);
        /* Mediante eloquent se obtiene todos los roles */
        $roles = Role::where('id', '!=', 1)->get();
        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    /* Funcion encargada de validar y actualizar usuarios */
    public function update(Request $request, User $usuario)
    {
        /* Se agrega la política de actualización implementada para el modelo */
        $this->authorize('update', $usuario);

        $rules = [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($usuario->id)],
        ];
        /* Si la contraseña no es ingresada no se valida ni se actualiza */
        if ($request->filled('password')) {
            $rules['password'] = ['min:6', 'confirmed'];
            $rules['password_confirmation'] = ['required'];
        }
        /* Se realiza la validación de los campos enviados por el formulario */
        $data = $request->validate($rules);
        if ($request->has('active')) {
            $data['active'] = true;
        } else {
            $data['active'] = false;
        }
        $data['updater_user_id'] = auth()->user()->id;
        /* Mediante eloquent se actualiza el usuario */
        $usuario->update($data);
        /* Se sincronizan los roles del usuario */
        $usuario->syncRoles($request->roles);
        /* se redirecciona a la ruta usuarios.index con el mensaje de confirmación */
        return redirect()->route('usuarios.index')->withFlash('El usuario ha sido actualizado de forma exitosa');
    }


    /* función que devuelve la vista que presenta el perfil del usuario */
    public function profile()
    {
        return view('usuarios.profile', ['usuario' => auth()->user()]);
    }

    /* Funcion para actualizar la contraseña del usuario */
    public function updatePassword(Request $request, User $usuario)
    {
        $data = $request->validate([
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $usuario->update($data);

        return redirect()->route('user.profile', ['usuario' => auth()->user()])->withFlash('Tu contraseña ha sido actualizada');
    }
}
