<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostsRequest;
use App\Http\Requests\UpdatePostsRequest;
use App\Models\posts;
use App\Models\imagePost;
use App\Models\categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $type = 'advertisement')
    {
        $posts = posts::where('type', $type)->get();
        return view('advertisement-list', ['posts' => $posts]);
    }

    public function getComunnities()
    {
        $posts = posts::with(['user', 'community'])->get();
        return view('paneladminPosts', compact('posts'));
    }

    public function update(Request $request, posts $post)
    {
        $post->update($request->only(['title', 'description', 'category']));

        // Puedes devolver una respuesta JSON si lo prefieres
        return response()->json(['message' => 'Post actualizado correctamente']);
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
        try {
            $validatedData = $request->validate([
                'title' => 'required|max:50',
                'description' => 'required|max:1000',
                'category_id' => 'required|exists:categories,id',
                'private' => 'sometimes|boolean',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'type' => 'required|in:advertisement,post',
            ]);

            $post = posts::create([
                'id_user' => 1, // Asume un valor estático o ajusta según tu lógica de autenticación
                'id_category' => $validatedData['category_id'],
                'id_community' => 1, // Ajusta según necesites
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'isActive' => true,
                'private' => $request->has('private') ? true : false,
                'type' => $validatedData['type'],
            ]);

            // Manejo de la carga de la imagen
            if ($request->hasFile('image')) {
                try {
                    $file = $request->file('image');
                    Log::info("Intentando guardar el archivo: " . $file->getClientOriginalName());
                    $path = $file->store('posts', 'public');
                    Log::info("Archivo guardado en: " . $path);
                } catch (\Exception $e) {
                    Log::error("Error al guardar el archivo: " . $e->getMessage());
                    // Asegúrate de retornar o manejar el error aquí si es necesario
                }
                $imageName = basename($path);

                // Guardar referencia de la imagen en la base de datos
                ImagePost::create([
                    'id_post' => $post->id,
                    'name' => $imageName,
                    'front_page' => true,
                ]);
            }

            return redirect('/map');
        } catch (\Exception $e) {
            Log::error('Error al crear el post: ' . $e->getMessage());
            return back()->withErrors('Ocurrió un error al crear el post. Por favor, intenta de nuevo.')->withInput();
        }
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
     * Remove the specified resource from storage.
     */
    public function destroy(posts $posts)
    {
        //
    }
}
