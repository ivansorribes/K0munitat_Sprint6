<?php

namespace App\Http\Controllers;

use App\Models\ReplyComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function update(Request $request, $replyId)
    {
        $request->validate([
            'reply' => 'required|string|max:500',
        ]);

        $reply = ReplyComment::findOrFail($replyId);

        // Verificar que el usuario tiene permiso para editar esta respuesta
        if (auth()->id() !== $reply->id_user) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $reply->reply = $request->reply;
        $reply->save();

        return response()->json($reply, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($replyId)
    {
        // Busca la respuesta usando el modelo de respuestas (ajusta el nombre del modelo si es necesario)
        $reply = ReplyComment::find($replyId);

        // Verifica si la respuesta existe
        if (!$reply) {
            return response()->json(['message' => 'Reply not found'], 404);
        }

        // Elimina la respuesta
        $reply->delete();

        // Devuelve una respuesta indicando que la operación fue exitosa
        return response()->json(['message' => 'Reply deleted'], 200);
    }
}
