<?php

namespace App\Http\Controllers;
use App\Models\Event;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $event = Event::All();
        return $event;
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
            $event->title = $request->input('title');
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
