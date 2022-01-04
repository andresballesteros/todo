<?php

namespace App\Http\Controllers;

use App\Models\ObservacionTodo;
use App\Models\Todo;
use Illuminate\Http\Request;

class ObservacionTodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Todo $todo)
    {
        $observacionTodo = new ObservacionTodo();
        return view('observaciones.create', compact('todo', 'observacionTodo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Todo $todo)
    {
        $data = $request->validate([
            'observacion' => 'required|max:255',
        ]);
        $data['todo_id'] = $todo->id;
        $data['user_id'] = auth()->user()->id;
        ObservacionTodo::create($data);
        return redirect()->route('todos.show', $todo)->withFlash('La observación para la tarea #' . $todo->id . ' ha sido creada de forma exitosa');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ObservacionTodo  $observacionTodo
     * @return \Illuminate\Http\Response
     */
    public function show(ObservacionTodo $observacionTodo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ObservacionTodo  $observacionTodo
     * @return \Illuminate\Http\Response
     */
    public function edit(ObservacionTodo $observacionTodo)
    {
        $this->authorize('update', $observacionTodo);
        return view('observaciones.edit', compact('observacionTodo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ObservacionTodo  $observacionTodo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ObservacionTodo $observacionTodo)
    {
        $this->authorize('update', $observacionTodo);
        $data = $request->validate([
            'observacion' => 'required|max:255',
        ]);
        $data['user_id'] = auth()->user()->id;
        $observacionTodo->update($data);
        return redirect()->route('todos.show', $observacionTodo->todo_id)->withFlash('La observación ha sido actualizada de forma exitosa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ObservacionTodo  $observacionTodo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ObservacionTodo $observacionTodo)
    {
        $observacionTodo->delete();
        return redirect()->route('todos.show', $observacionTodo->todo_id)->withFlash('La observación ha sido eliminada de forma exitosa');
    }
}
