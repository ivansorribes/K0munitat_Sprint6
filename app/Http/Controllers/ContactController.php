<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
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
            'name' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'email' => 'required|string|email|max:50',
            'message' => 'required|string',
        ]);
    
        // Obtener el ID del usuario autenticado
        $userId = Auth::id();
    
        // Crear y guardar el mensaje de contacto
        $contactMessage = new contactMessages();
        $contactMessage->sender_name = $request->input('name');
        $contactMessage->phone = $request->input('phone');
        $contactMessage->sender_email = $request->input('email');
        $contactMessage->message = $request->input('message');
        $contactMessage->id_user = $userId;
        $contactMessage->save();
    
        // Devolver una respuesta exitosa
        return response()->json(['message' => 'Message sent successfully'], 200);
    }
    
    public function getUser()
    {
        $user = Auth::user(); // Obtiene el usuario autenticado
    
        // Comprueba si hay un usuario autenticado
        if ($user) {
            // Retorna los datos del usuario en formato JSON
            return response()->json([
                'firstname' => $user->firstname,
                'telephone' => $user->telephone,
                'email' => $user->email
            ]);
        } else {
            // Retorna un mensaje de error si no hay usuario autenticado
            return response()->json([
                'error' => 'No se ha encontrado ningún usuario autenticado'
            ], 401); // Código de estado 401 para no autorizado
        }
    }
    
}
