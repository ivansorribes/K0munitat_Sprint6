<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ContactMessage;
use App\Models\contactMessages;
use Illuminate\Support\Facades\Session;

class MessagesController extends Controller
{


    public function getEmailView(Request $request)
    {
        // Verificar si es la primera visita del usuario
        if (!$request->session()->has('email_view_first_visit')) {
            // Marcar todos los mensajes como no leídos
            contactMessages::where('read', false)->update(['read' => true]);
            
            // Establecer la sesión indicando que es la primera visita
            $request->session()->put('email_view_first_visit', true);
        }
    
        // Obtener todos los mensajes
        $messages = contactMessages::all();
    
        return view('adminPanel.emails', compact('messages'));
    }
    

    public function destroy($id)
    {
        try {
            DB::table('contactMessages')->where('id', $id)->delete();
            return redirect()->back()->with('success', 'Message deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete message');
        }
    }
}
