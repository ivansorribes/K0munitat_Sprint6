<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function contactView()
    {
        return view('contact.contact');
    }

    public function store(Request $request)
    {
        try {
            // Validación de datos
            $request->validate([
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required|email',
                'message' => 'required',
            ]);

            // Obtención de los datos del formulario
            $formData = $request->only(['name', 'phone', 'email', 'message']);

            // Construcción del cuerpo del mensaje
            $body = "Hemos recibido una solicitud de contacto con los siguientes datos:\n\n";
            foreach ($formData as $key => $value) {
                $body .= ucfirst($key) . ": " . $value . "\n";
            }

            // Dirección de correo donde se enviará el mensaje
            $email = "tatiana@k0munitat.com";

            // Envío del correo electrónico
            Mail::raw($body, function ($message) use ($email) {
                $message->from('noreply@k0munitat.com', 'K0munitat');
                $message->to($email, 'User Name')->subject('Formulario de contacto');
            });

            // Redirección con un mensaje de éxito
            return back()->with('success', '¡Gracias por tu mensaje! Nos pondremos en contacto contigo pronto.');
        } catch (\Exception $e) {
            // Registro del error en los logs
            Log::error($e);

            // Retorno de un error al cliente
            return response()->json(['error' => 'Ha ocurrido un error al procesar el formulario'], 500);
        }
    }
}
