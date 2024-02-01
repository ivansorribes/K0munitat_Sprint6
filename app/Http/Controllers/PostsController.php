<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostsRequest;
use App\Http\Requests\UpdatePostsRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
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
        return view('form-create-advertisement', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los datos enviados desde el formulario
        $request->validate([
            'title' => 'required|max:50',
            'description' => 'required|max:1000',
            // Agrega aquí otras reglas de validación según sea necesario
        ]);

        // Creación de una nueva instancia del modelo Post y asignación de los datos
        $post = new Post([
            'id_community' => 3, // Este valor debería ser dinámico según tu lógica de aplicación
            'id_user' => 1, // Este valor también debería ser dinámico, por ejemplo, usando Auth::id() si estás autenticando usuarios
            'title' => $request->title,
            'description' => $request->description,
            'category' => 'default', // Deberías modificar esto según la lógica de tu aplicación
            'isActive' => true,
            'type' => 'default', // Modifica según sea necesario
        ]);

        // Guardar el post en la base de datos
        $post->save();

        // Redireccionar al usuario a una página específica después de guardar los datos
        // Asegúrate de reemplazar 'ruta-destino' con la ruta a la que deseas redirigir al usuario
        return redirect('/')->with('success', 'Post creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $posts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $posts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostsRequest $request, Post $posts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $posts)
    {
        //
    }
}
