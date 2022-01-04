<?php

namespace App\Http\Controllers;


use App\Models\Node;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('view', new User);
        return view('usuarios.index', ['usuarios' => User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', new User);
        return view('usuarios.create', ['roles' => Role::all(), 'usuario' => new User]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', new User);
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);
        $data['creator_user_id'] = auth()->user()->id;
        $data['updater_user_id'] = auth()->user()->id;
        $user = User::create($data);
        $user->assignRole($request->roles);
        return redirect()->route('usuarios.index')->withFlash('El usuario ha sido creado de forma exitosa');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $usuario)
    {
        $this->authorize('view', $usuario);
        return view('usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $usuario)
    {
        $this->authorize('update', $usuario);
        $roles = Role::where('id', '!=', 1)->get();
        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $usuario)
    {

        $this->authorize('update', $usuario);
        $rules = [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($usuario->id)],            
        ];

        if ($request->filled('password')) {
            $rules['password'] = ['min:6', 'confirmed'];
            $rules['password_confirmation'] = ['required'];
        }
        $data = $request->validate($rules);
        if ($request->has('active')) {
            $data['active'] = true;
        } else {
            $data['active'] = false;
        }
        $data['updater_user_id'] = auth()->user()->id;
        $usuario->update($data);
        $usuario->syncRoles($request->roles);
        return redirect()->route('usuarios.index')->withFlash('El usuario ha sido actualizado de forma exitosa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function profile()
    {
        return view('usuarios.profile', ['usuario' => auth()->user()]);
    }

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
