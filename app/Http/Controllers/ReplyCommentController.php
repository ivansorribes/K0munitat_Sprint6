<?php

namespace App\Http\Controllers;

use App\Models\ReplyComment;
use Illuminate\Http\Request;

class ReplyCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $commentId)
    {
        // Validar la entrada
        $request->validate([
            'reply' => 'required|string|max:500', // Asegúrate de que las reglas coincidan con tus necesidades
        ]);

        // Asumiendo que ya tienes una autenticación y puedes obtener el ID del usuario autenticado
        $userId = auth()->id(); // Asegúrate de que este método esté disponible y sea correcto según tu sistema de autenticación

        // Crear una nueva respuesta usando el modelo y los campos correctos
        $reply = new ReplyComment([
            'reply' => $request->reply, // Asegúrate de que este campo se llama 'reply' en tu solicitud
            'id_user' => $userId, // ID del usuario autenticado
            'id_comment' => $commentId, // ID del comentario al cual se está respondiendo
        ]);

        $reply->save(); // Guardar la nueva respuesta en la base de datos

        // Retorna una respuesta adecuada
        return response()->json([
            'message' => 'Respuesta creada con éxito',
            'reply' => $reply
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(ReplyComment $replyComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReplyComment $replyComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReplyComment $replyComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReplyComment $replyComment)
    {
        //
    }
}
