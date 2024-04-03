<?php

namespace App\Http\Controllers;
use App\Models\Event;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        try {
            // Obtener el usuario autenticado
            $user = Auth::user();

            // Obtener todos los eventos
            $events = Event::all();

            // Si hay un usuario autenticado, devolver los datos del usuario, de lo contrario, devolver un array vacío
            $userData = $user ? $user : [];

            // Devolver una respuesta JSON con los eventos y los datos del usuario (si está autenticado)
            return response()->json(['message' => 'Datos recuperados exitosamente', 'user' => $userData, 'events' => $events], 200);
        } catch (\Exception $e) {
            // Manejar cualquier excepción y devolver una respuesta de error
            return response()->json(['message' => 'Error al recuperar datos', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            // Validación de datos (puedes personalizar según tus necesidades)
            $request->validate([
                'id_user' => 'required|integer',
                'title' => 'required|string',
                'start' => 'required|date',
                'end' => 'required|date|after_or_equal:start',
            ]);
        
            // Crear un nuevo evento
            $event = new Event();
            $event->id_user = $request->input('id_user');
            $event->title = htmlspecialchars($request->input('title')); // Sanitizar el título
            $event->start = $request->input('start');
            $event->end = $request->input('end');
        
            // Guardar el evento en la base de datos
            $event->save();
        
            // Devolver una respuesta JSON con el evento recién creado
            return response()->json(['message' => 'Evento creado exitosamente', 'data' => $event], 201);
        } catch (\Exception $e) {
            // Manejar cualquier excepción y devolver una respuesta de error
            return response()->json(['message' => 'Error al crear el evento', 'error' => $e->getMessage()], 500);
        }
    }
}
