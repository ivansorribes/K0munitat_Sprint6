<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostsRequest;
use App\Http\Requests\UpdatePostsRequest;
use App\Models\posts;
use App\Models\imagePost;
use App\Models\categories;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('advertisement-list', []);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = categories::all();
        return view('form-create-advertisement', ['categories' => $categories]);
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
            'category_id' => 'required|exists:categories,id',
            'private' => 'sometimes|boolean',
            'image' => 'nullable|image|max:2048',
            // Agrega aquí otras reglas de validación según sea necesario
        ]);

        // Creación de una nueva instancia del modelo Post y asignación de los datos
        $post = new posts([
            'id_user' => 1, //$request->user()->id, // Asumiendo que quieres usar el ID del usuario autenticado
            'id_category' => $request->category_id,
            'id_community' => 1,
            'title' => $request->title,
            'description' => $request->description,
            'isActive' => true, // o $request->isActive si lo estás tomando del formulario
            'private' => $request->has('private') ? true : false,
            'type' => 'advert', // Asegúrate de que este campo se maneje correctamente en tu formulario
        ]);
        // Guardar el post en la base de datos
        $post->save();


        // Redireccionar al usuario a una página específica después de guardar los datos
        // Asegúrate de reemplazar 'ruta-destino' con la ruta a la que deseas redirigir al usuario
        return redirect('/map')->with('success', 'Post creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(posts $posts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(posts $posts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostsRequest $request, posts $posts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(posts $posts)
    {
        //
    }
}
