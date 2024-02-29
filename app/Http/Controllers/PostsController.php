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

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $communityId = null)
    {
        $query = posts::with(['images' => function ($query) {
            $query->select('id', 'id_post', 'name');
        }]);
        // $query->where('type', $type);

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
        });
        return view('communities.show', [
            'posts' => $posts,
            'community' => $community ?? null,
        ]);
    }

    public function getComunnities()
    {
        $posts = posts::with(['user', 'community'])->get();
        return view('adminPanel.paneladminPosts', compact('posts'));
    }

    public function update(Request $request, posts $post)
    {
        $post->update($request->only(['title', 'description', 'category']));
        return back();
    }

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
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
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
        }])->findOrFail($id_post);

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

        return response()->json([
            'post' => $post,
        ]);
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
