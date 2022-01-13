<?php

namespace App\Http\Controllers;

use App\Models\ObservacionTodo;
use App\Models\Todo;
use Illuminate\Http\Request;

class ObservacionTodoController extends Controller
{

    /* Función que retorna la vista del formulario de creacion de observaciones recibiendo como parametro la tarea */
    public function create(Todo $todo)
    {
        /* se crea una nueva instancia del modelo ObservacionTodo */
        $observacionTodo = new ObservacionTodo();
        /* Se devuelve la vista del formulario para la creación del la observación pasando las variables todo y observacion todo */
        return view('observaciones.create', compact('todo', 'observacionTodo'));
    }

    /* Esta función es la encargada de la validación y la creación de la observación a la tarea */
    public function store(Request $request, Todo $todo)
    {
        /* Valida que la observación sea obligatoria y no sea mayor a 255 caracteres */
        $data = $request->validate([
            'observacion' => 'required|max:255',
        ]);
        /* Se asigna el id correspondiente a la tarea */
        $data['todo_id'] = $todo->id;
        /* Se asigna el usuario creador del registro siendo este el usuario autenticado */
        $data['user_id'] = auth()->user()->id;
        /* Mediante eloquent se crea el registro en la base de datos */
        ObservacionTodo::create($data);
        /* Se redirecciona a la ruta todos.show la cual devuelve la vista de la tarea, junto con el mensaje de confirmación */
        return redirect()->route('todos.show', $todo)->withFlash('La observación para la tarea #' . $todo->id . ' ha sido creada de forma exitosa');
    }

    /* Función que retorna la vista del formulario de edición de observaciones recibiendo como parametro la observación a modificar  */
    public function edit(ObservacionTodo $observacionTodo)
    {
        /* Se agrega la política de actualización creada para el modelo */
        $this->authorize('update', $observacionTodo);
        return view('observaciones.edit', compact('observacionTodo'));
    }

    /* Esta función es la encargada de la validación y la actualización de la observación */
    public function update(Request $request, ObservacionTodo $observacionTodo)
    {
        /* Se agrega la política de actualización creada para el modelo */
        $this->authorize('update', $observacionTodo);
        /* Valida que la observación sea obligatoria y no sea mayor a 255 caracteres */
        $data = $request->validate([
            'observacion' => 'required|max:255',
        ]);
        /* Mediante eloquent se actualiza el registro */
        $observacionTodo->update($data);
        /* Se redirecciona a la ruta todos.show la cual devuelve la vista de la tarea, junto con el mensaje de confirmación */
        return redirect()->route('todos.show', $observacionTodo->todo_id)->withFlash('La observación ha sido actualizada de forma exitosa');
    }


    public function destroy(ObservacionTodo $observacionTodo)
    {
        /* Mediante eloquent se elimina el registro */
        $observacionTodo->delete();
        /* Se redirecciona a la ruta todos.show la cual devuelve la vista de la tarea, junto con el mensaje de confirmación */
        return redirect()->route('todos.show', $observacionTodo->todo_id)->withFlash('La observación ha sido eliminada de forma exitosa');
    }
}
