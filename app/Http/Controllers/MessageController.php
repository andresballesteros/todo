<?php

namespace App\Http\Controllers;

use App\Mail\MessageReceived;
use Illuminate\Support\Facades\Mail;

//use Illuminate\Http\Request; no es necesario al utilisar la funcion request

class MessageController extends Controller
{
    public function store()
    {
        $message = request()->validate([
            'nombre' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'content' => 'required|min:3',
        ], [
            'nombre.required' => 'Por favor ingrese el Nombre'
        ]);

        //Mail::to('andres.ballesteros1988@gmail.com')->send(new MessageReceived($message));
        Mail::to('andres.ballesteros1988@gmail.com')->queue(new MessageReceived($message));

        return back()->with('status', 'Recibimos tu mensaje');
    }
}
