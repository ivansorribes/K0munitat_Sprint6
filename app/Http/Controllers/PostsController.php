<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostsRequest;
use App\Http\Requests\UpdatePostsRequest;
use App\Models\posts;
use App\Models\imagePost;
use App\Models\categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\communities;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use App\Models\commentsPosts;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $communityId = null)
    {
        $query = posts::with(['images' => function ($query) {
            $query->select('id', 'id_post', 'name');
        }])->withCount('likes');

        if ($communityId) {
            $community = communities::findOrFail($communityId);
            $query->where('id_community', $communityId);
        }

        $posts = $query->get();

        // Añadir URL completa a cada imagen
        $posts->each(function ($post) {
            $post->images->each(function ($image) {
                $image->url = URL::to('storage/posts/' . $image->name);
            });
            $post->liked = $post->likes()->where('id_user', Auth::id())->exists();
        });
        return view('communities.show', [
            'posts' => $posts,
            'community' => $community ?? null,
        ]);
    }

    public function getPosts()
    {
        $posts = posts::with(['user', 'community'])->get();
        return view('adminPanel.paneladminPosts', compact('posts'));
    }

    public function getAdvertisements()
    {
        $posts = posts::with(['user', 'community'])->get();
        return view('adminPanel.paneladminAdvertisements', compact('posts'));
    }




    public function updateAdvertisement(Request $request, posts $advertisement)
    {
        if ($advertisement->type === 'advertisement') {
            $advertisement->update($request->only(['title', 'description']));
            return redirect()->route('paneladminAdvertisements');
        } else {
            // Manejar el caso en que no sea un anuncio (podría ser útil para la validación o manejo de errores)
            // Por ejemplo, podrías redirigirlo a una página de error o hacer otro tipo de acción.
            return redirect()->back()->with('error', 'Esta publicación no es un anuncio.');
        }
    }

    public function updatePost(Request $request, posts $post)
    {
        $post->update($request->only(['title', 'description']));
        return redirect()->back();
    }

    public function toggleActivation(posts $post)
    {
        $post->isActive = !$post->isActive;
        $post->save();

        return redirect()->back()->with('success', 'Post state toggled successfully.');
    }


    // public function update(Request $request, posts $post)
    // {
    //     $post->update($request->only(['title', 'description', 'category']));

    //     return back();
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function createAdvertisement($communityId) // Asumiendo que recibes el communityId como parámetro
    {
        $categories = $this->getCategories();
        return view('form-create-advertisement', [
            'categories' => $categories,
            'communityId' => $communityId // Pasando el communityId a la vista
        ]);
    }

    public function createPost($communityId) // Asumiendo que recibes el communityId como parámetro
    {
        $categories = $this->getCategories();
        return view('advertisements-posts.form-create-advertisement-post', [
            'categories' => $categories,
            'communityId' => $communityId // Pasando el communityId a la vista
        ]);
    }

    private function getCategories()
    {
        return categories::all();
    }

    public function showPostById(posts $post)
    {
        // Aquí puedes cargar la vista de detalles del post y pasar los datos del post
        return view('adminPanel.postDetail', ['post' => $post]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $communityId)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|max:50',
                'description' => 'required|max:1000',
                'category_id' => 'required|exists:categories,id',
                'private' => 'sometimes|boolean',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                'type' => 'required|in:advertisement,post',
            ]);

            $post = posts::create([
                'id_user' => Auth::id(),
                'id_category' => $validatedData['category_id'],
                'id_community' => $communityId,
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

            return redirect("/communities/{$communityId}");
        } catch (\Exception $e) {
            Log::error('Error al crear el post: ' . $e->getMessage());
            return back()->withErrors('Ocurrió un error al crear el post. Por favor, intenta de nuevo.')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $community, $id_post)
    {
        $post = posts::with(['images' => function ($query) {
            $query->select('id', 'id_post', 'name');
        }, 'comments' => function ($query) {
            $query->with(['user' => function ($q) {
                $q->select('id', 'username');
            }])
                ->select('id', 'id_post', 'id_user', 'comment');
        }, 'user' => function ($query) { // Carga el usuario que creó el post
            $query->select('id', 'username');
        }, 'likes']) // Asegúrate de cargar la relación de likes aquí
            ->findOrFail($id_post);

        $post->liked = $post->likes->contains('user_id', Auth::id());

        $community = null;
        if ($post->community_id) {
            $community = communities::findOrFail($post->community_id);
        }

        $post->images->each(function ($image) {
            $image->url = URL::to('storage/posts/' . $image->name);
        });

        // Ajusta la estructura de los comentarios como antes
        $post->comments->each(function ($comment) {
            if ($comment->user) {
                $comment->username = $comment->user->username;
                unset($comment->id_user);
            }
        });

        // Añade el username del creador del post a la respuesta
        $post->creator_username = $post->user ? $post->user->username : null;

        // Calcula el conteo de likes
        $post->likes_count = $post->likes->count();

        // Opcional: Eliminar la colección de likes para no enviarla en la respuesta
        unset($post->likes);

        return response()->json([
            'post' => $post,
        ]);
    }

    public function update(Request $request, $id_post)
    {
        $post = posts::find($id_post);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        // Verificar si el usuario actual es el creador del post
        if ($post->id_user !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            // Asumiendo que no se requieren cambios en las imágenes en este punto
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $post = posts::with('images')->find($id_post); // Asegúrate de cargar las relaciones necesarias

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $post->title = $request->input('title');
        $post->description = $request->input('description');

        // Aquí podrías incluir lógica para manejar actualizaciones de imágenes, si es necesario
        // Por ejemplo, si permites que las imágenes sean añadidas o removidas durante la actualización del post

        $post->save();

        // Retorna el post actualizado incluyendo sus imágenes
        // Esto es crucial para asegurarte de que el frontend recibe la información más actual
        $updatedPost = posts::with('images')->find($id_post);

        return response()->json($updatedPost, 200);
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
