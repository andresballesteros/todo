<?php

namespace App\Http\Controllers;

use App\Models\ObservacionTodo;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /* Retorna la vista home con todas las tareas almacenadas en base */
    public function index()
    {

        return view('home', ['todos' => Todo::all()]);
    }

    /* Retorna la vista con el formulario para la creación de tareas */
    public function create()
    {
        return view('todos.create', ['todo' => new Todo]);
    }

    /* Función encargada para la validación y creación de la tarea */
    public function store(Request $request)
    {
        /* Validacion del campo tarea */
        $data = $request->validate([
            'tarea' => 'required|max:255',
        ]);
        /* Se valida si la tarea fue realizada o no */
        if ($request->has('active')) {
            $data['active'] = true;
        } else {
            $data['active'] = false;
        }
        /* Se asigna el usuario creador de la tarea */
        $data['user_id'] = auth()->user()->id;
        /* Mediante eloquent se crea la nueva tarea */
        Todo::create($data);
        /* Se redirecciona a la ruta home con el mensaje de confirmación */
        return redirect()->route('home')->withFlash('La tarea ha sido creada de forma exitosa');
    }

    /* Retorna la vista que presenta la información de la tarea y sus observaciones */
    public function show(Todo $todo)
    {
        /* Mediante eloquent se obtienen todas las observciones de la tarea */
        $observacionesTodo = ObservacionTodo::where('todo_id', '=', $todo->id)->get();
        /* se retorna la vista todos.show pasando las variables todo y observacionesTodo */
        return view('todos.show', compact('todo', 'observacionesTodo'));
    }

    /* Retorna la vista con el formulario para la actualización de tareas */
    public function edit(Todo $todo)
    {
        /* Se agrega la política de actualización implementada para el modelo */
        $this->authorize('update', $todo);
        return view('todos.edit', compact('todo'));
    }

    /* Función encargada para la validación y actualización de la tarea */
    public function update(Request $request, Todo $todo)
    {
        /* Se agrega la política de actualización implementada para el modelo */
        $this->authorize('update', $todo);
        /* Validacion del campo tarea */
        $data = $request->validate([
            'tarea' => 'required|max:255',
        ]);
        /* Se valida si la tarea fue realizada o no */
        if ($request->has('active')) {
            $data['active'] = true;
        } else {
            $data['active'] = false;
        }
        /* Mediante eloquent se actualiza la tarea */
        $todo->update($data);
        /* Se redirecciona a la ruta home con el mensaje de confirmación */
        return redirect()->route('home')->withFlash('La tarea ha sido actualizada de forma exitosa');
    }

    /* Función para eliminar la tarea, al eliminar la tarea se eliminarán las observaciones asociadas a esta tarea*/
    public function destroy(Todo $todo)
    {
        /* mediante eloquent se elimina el registro de la tarea */
        $todo->delete();
        /* Se redirecciona a la ruta home con el mensaje de confirmación */
        return redirect()->route('home')->withFlash('La tarea #' . $todo->id . ' ha sido eliminada de forma exitosa');
    }


    /* Función para marcar como realizada una tarea */
    public function complete(Todo $todo)
    {
        $data['active'] = true;
        $todo->update($data);
        /* Se redirecciona a la ruta home con el mensaje de confirmación */
        return redirect()->route('home')->withFlash('La tarea #' . $todo->id . ' ha sido completada de forma exitosa');
    }

    /* Función para desmarcar como realizada una tarea */
    public function incomplete(Todo $todo)
    {
        $data['active'] = false;
        $todo->update($data);
        /* Se redirecciona a la ruta home con el mensaje de confirmación */
        return redirect()->route('home')->withFlash('La tarea #' . $todo->id . ' ha sido marcada como incompleta de forma exitosa');
    }
}
