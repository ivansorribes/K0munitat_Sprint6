<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\contactMessagesClient;

use App\Models\ContactMessage;
use App\Models\contactMessages;
use Illuminate\Support\Facades\Session;

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
        $replyMessage = new ContactMessagesClient();
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
        $userId = auth()->user()->id;
        $deletedEmails = DB::table('contactMessagesClient')->where('id_user', $userId)->where('isActive', 0)->get();
        $activeEmails = DB::table('contactMessagesClient')->where('id_user', $userId)->where('isActive', 1)->get();

        // Obtener la URL base de la aplicación
        $baseUrl = url('/');

        // Añadir la URL de la imagen de perfil para cada mensaje
        foreach ($deletedEmails as $email) {
            // Obtener la imagen de perfil del usuario que envió el mensaje
            $user = DB::table('users')->where('id', $email->id_user)->first();
            // Verificar si el usuario tiene una imagen de perfil
            if ($user && isset($user->profile_image)) {
                // Si tiene una imagen de perfil, añadir la URL completa al mensaje
                $email->profile_image = "{$baseUrl}/profile/images/{$user->profile_image}";
            } else {
                // Si no tiene una imagen de perfil, establecer la URL de una imagen predeterminada o dejarla vacía
                $email->profile_image = ""; // Aquí puedes establecer la URL de una imagen predeterminada si lo deseas
            }
        }

        foreach ($activeEmails as $email) {
            // Obtener la imagen de perfil del usuario que envió el mensaje
            $user = DB::table('users')->where('id', $email->id_user)->first();
            // Verificar si el usuario tiene una imagen de perfil
            if ($user && isset($user->profile_image)) {
                // Si tiene una imagen de perfil, añadir la URL completa al mensaje
                $email->profile_image = "{$baseUrl}/profile/images/{$user->profile_image}";
            } else {
                // Si no tiene una imagen de perfil, establecer la URL de una imagen predeterminada o dejarla vacía
                $email->profile_image = ""; // Aquí puedes establecer la URL de una imagen predeterminada si lo deseas
            }
        }

        return view('emailsUser.emailsUser', compact('deletedEmails', 'activeEmails'));
    }




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

    public function replyMessageClient(Request $request){
         // Validar los datos del formulario
         $request->validate([
            'reply_message' => 'required|string',
        ]);

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener el mensaje original
        $originalMessage = contactMessagesClient::find($request->input('original_message_id'));

        // Crear un nuevo mensaje de respuesta
        $replyMessage = new ContactMessages();
        $replyMessage->sender_name = $user->username; // Asignar el nombre de usuario del remitente
        $replyMessage->phone = $user->telephone;
        $replyMessage->sender_email = $user->email; // Asignar el correo electrónico del remitente
        $replyMessage->message = $request->input('reply_message'); // Asignar el mensaje de respuesta
        $replyMessage->read = false; // Establecer el mensaje como no leído
        $replyMessage->id_user = optional($originalMessage)->id_user ?: $user->id; // Asignar la ID del usuario que envió el mensaje original, o la ID del usuario actual si no se encuentra el mensaje original
        $replyMessage->isActive = true; // Establecer el mensaje como activo
        $replyMessage->save();

        // Redireccionar a una página de éxito o a donde desees
        return redirect()->back()->with('success', 'Reply sent successfully!');
    }
}
