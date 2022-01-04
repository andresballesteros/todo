<?php

namespace App\Http\Controllers;

use App\Exports\FormulariosExport;
use App\Models\Formulario;
use App\Models\Todo;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', ['todos' => Todo::all()]);
    }

      public function export()
    {
        return (new FormulariosExport)->download('respuestas.xlsx');
        //return Excel::download(new FormulariosExport, 'respuestas.xlsx');
    }
}
