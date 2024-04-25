<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\contactMessages;
use Illuminate\Support\Facades\Auth;


class ContactController extends Controller
{
    public function contactView()
    {
        return view('contact.contact');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'user_name' => 'required|string|max:50',
            'user_phone' => 'required|string|max:20',
            'user_email' => 'required|string|email|max:50',
            'message' => 'required|string',
        ]);

        // Obtener el ID del usuario autenticado
        $userId = Auth::id();

        // Crear y guardar el mensaje de contacto
        $contactMessage = new contactMessages();
        $contactMessage->sender_name = $request->input('user_name');
        $contactMessage->phone = $request->input('user_phone');
        $contactMessage->sender_email = $request->input('user_email');
        $contactMessage->message = $request->input('message');
        $contactMessage->id_user = $userId;
        $contactMessage->save();

        // Devolver una respuesta exitosa
        return response()->json(['message' => 'Message sent successfully'], 200);
    }
}
