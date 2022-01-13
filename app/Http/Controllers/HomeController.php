<?php

namespace App\Http\Controllers;

use App\Exports\FormulariosExport;
use App\Models\Todo;

/* Controlador de la página principal del aplicativo */
class HomeController extends Controller
{
    /* Función que retorna la vista home con todas las tareas que se encuentran en la base de datos almacenadas en la variable todos */ 
    public function index()
    {
        return view('home', ['todos' => Todo::all()]);
    }

      public function export()
    {
        return (new FormulariosExport)->download('tareas.xlsx');
        //return Excel::download(new FormulariosExport, 'respuestas.xlsx');
    }
}
