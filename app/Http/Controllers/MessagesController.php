<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\contactMessagesClient;
<<<<<<< HEAD
use App\Models\User;
=======

use App\Models\ContactMessage;
>>>>>>> main
use App\Models\contactMessages;

class MessagesController extends Controller
{


    public function getEmailView()
    {
        // Marcar todos los mensajes como leídos
        DB::table('contactMessages')->where('read', false)->update(['read' => true]);

        // Obtener todos los mensajes activos
        $activeMessages = DB::table('contactMessages')->where('isActive', 1)->get();

        // Obtener todos los mensajes eliminados
        $deletedMessages = DB::table('contactMessages')->where('isActive', 0)->get();

        return view('adminPanel.emails', compact('activeMessages', 'deletedMessages'));
    }



    public function destroy($id)
    {
        try {
            // Actualizar el campo isActive a 0 en lugar de eliminar el mensaje
            DB::table('contactMessages')->where('id', $id)->update(['isActive' => 0]);
            return redirect()->back()->with('success', 'Message moved to deleted messages');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to move message to deleted messages');
        }
    }

<<<<<<< HEAD
=======
    public function restoreAdmin($id)
    {
        try {
            // Actualizar el campo isActive a 1 para restaurar el mensaje eliminado
            DB::table('contactMessages')->where('id', $id)->update(['isActive' => 1]);
            return redirect()->back()->with('success', 'Message restored successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to restore message');
        }
    }

>>>>>>> main
    public function replyMessage(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'reply_message' => 'required|string',
        ]);

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener el mensaje original
        $originalMessage = ContactMessages::find($request->input('original_message_id'));

        // Crear un nuevo mensaje de respuesta
<<<<<<< HEAD
        $replyMessage = new contactMessagesClient();
=======
        $replyMessage = new ContactMessagesClient();
>>>>>>> main
        $replyMessage->sender_name = $user->username; // Asignar el nombre de usuario del remitente
        $replyMessage->sender_email = $user->email; // Asignar el correo electrónico del remitente
        $replyMessage->message = $request->input('reply_message'); // Asignar el mensaje de respuesta
        $replyMessage->read = false; // Establecer el mensaje como no leído
        $replyMessage->id_user = optional($originalMessage)->id_user ?: $user->id; // Asignar la ID del usuario que envió el mensaje original, o la ID del usuario actual si no se encuentra el mensaje original
        $replyMessage->isActive = true; // Establecer el mensaje como activo
        $replyMessage->save();

        // Redireccionar a una página de éxito o a donde desees
        return redirect()->back()->with('success', 'Reply sent successfully!');
    }







    public function emailUserView()
    {
<<<<<<< HEAD
        // Obtener el ID del usuario autenticado
        $userId = auth()->user()->id;

        // Obtener los correos electrónicos activos y eliminados del usuario autenticado
        $deletedEmails = DB::table('contactMessagesClient')->where('id_user', $userId)->where('isActive', 0)->get();
        $activeEmails = DB::table('contactMessagesClient')->where('id_user', $userId)->where('isActive', 1)->get();

        // Iterar sobre los correos electrónicos activos para obtener la imagen de perfil del remitente
        foreach ($activeEmails as $email) {
            // Obtener el sender_name del correo electrónico
            $senderName = $email->sender_name;
            // Obtener la imagen de perfil del remitente
            $userProfileImage = User::where('username', $senderName)->value('profile_image');
            // Agregar la imagen de perfil al objeto del correo electrónico
            $email->userProfileImage = $userProfileImage;
        }

        foreach ($deletedEmails as $email) {
            // Obtener el   correo electrónico
            $senderName = $email->sender_name;
            // Obtener la imagen de perfil del remitente
            $userProfileImage = User::where('username', $senderName)->value('profile_image');
            // Agregar la imagen de perfil al objeto del correo electrónico
            $email->userProfileImage = $userProfileImage;
        }

        return view('emailsUser.emailsUser', compact('deletedEmails', 'activeEmails'));
    }



=======
        $userId = auth()->user()->id;
        $deletedEmails = DB::table('contactMessagesClient')->where('id_user', $userId)->where('isActive', 0)->get();
        $activeEmails = DB::table('contactMessagesClient')->where('id_user', $userId)->where('isActive', 1)->get();
        return view('emailsUser.emailsUser', compact('deletedEmails', 'activeEmails'));
    }

>>>>>>> main
    public function Delete($id)
    {
        // Buscar el mensaje por su ID
        $message = DB::table('contactMessagesClient')->where('id', $id)->first();

        // Verificar si el mensaje existe
        if (!$message) {
            return redirect()->back()->with('error', 'Message not found');
        }

        // Cambiar el campo isActive a 0 para "eliminar" el mensaje
        DB::table('contactMessagesClient')->where('id', $id)->update(['isActive' => 0]);

        return redirect()->back()->with('success', 'Message deleted successfully');
    }

    public function restore($id)
    {
        // Buscar el mensaje eliminado por su ID
        $message = DB::table('contactMessagesClient')->find($id);

        // Verificar si el mensaje existe
        if (!$message) {
            return redirect()->back()->with('error', 'Message not found');
        }

        // Actualizar el campo isActive a 1 para restaurar el mensaje
        DB::table('contactMessagesClient')
            ->where('id', $id)
            ->update(['isActive' => 1]);

        return redirect()->back()->with('success', 'Message restored successfully');
    }
}
