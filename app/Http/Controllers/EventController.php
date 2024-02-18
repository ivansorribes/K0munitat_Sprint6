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
        // Validación de datos (puedes personalizar según tus necesidades)
        $request->validate([
            'id_community' => 'required|integer',
            'id_user' => 'required|integer',
            'title' => 'required|string',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
        ]);

        // Crear un nuevo evento
        $event = new Event();
        $event->id_community = $request->input('id_community');
        $event->id_user = $request->input('id_user');
        $event->title = $request->input('title');
        $event->start = $request->input('start');
        $event->end = $request->input('end');

        // Guardar el evento en la base de datos
        $event->save();

        // Puedes devolver una respuesta JSON con el evento recién creado si es necesario
        return response()->json(['message' => 'Evento creado exitosamente', 'data' => $event], 201);
    }
}
