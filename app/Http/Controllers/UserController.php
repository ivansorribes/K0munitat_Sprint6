<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\posts;
use App\Models\likesPosts;
use App\Models\commentsPosts;
use App\Models\imagePost;
use App\Models\comments;
use Illuminate\Support\Facades\Storage;



class UserController extends Controller
{
    public function LoginView()
    {
        return view('login.login');
    }

    public function ProfileView()
    {
        return view('profile.personalProfile');
    }

    public function updateProfileDescription(Request $request)
    {
        try {
            // Obtén el usuario autenticado
            $user = Auth::user();

            // Actualiza la descripción del usuario con la nueva descripción proporcionada en la solicitud
            $affectedRows = DB::table('users')
                ->where('id', $user->id)
                ->update(['profile_description' => $request->input('description')]);

            if ($affectedRows > 0) {
                return response()->json(['message' => 'Descripción actualizada con éxito'], 200);
            } else {
                return response()->json(['error' => 'Error al actualizar la descripción'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar la descripción'], 500);
        }
    }

    public function postUser()
    {
        $user = Auth::user();

        if ($user) {
            // Obtener todas las publicaciones del usuario
            $posts = posts::where('id_user', $user->id)
                ->where('isActive', 1)
                ->get();

            // Obtener la información del usuario
            $userData = [
                'id' => $user->id,
                'username' => $user->username,
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
                'profile_image' => $user->profile_image,
                'profile_description' => $user->profile_description,
            ];

            // Adjuntar la información del usuario a cada publicación
            foreach ($posts as $post) {
                $post->comments = commentsPosts::where('id_post', $post->id)->with('comment')->get();
                $post->likes = likesPosts::where('id_post', $post->id)->with('user')->get();
                $post->image = imagePost::where('id_post', $post->id)->first();
                $post->user = $userData; // Adjuntar la información del usuario a la publicación
            }

            return response()->json(['user' => $userData, 'posts' => $posts], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function CommentsUser($id_post)
    {
        // Busca el post por su ID
        $post = posts::find($id_post);

        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        // Obtén los comentarios asociados con el post
        $comments = DB::table('commentsPosts')
            ->join('comments', 'commentsPosts.id_comment', '=', 'comments.id')
            ->join('users', 'comments.id_user', '=', 'users.id')
            ->select('comments.id', 'comments.comment', 'comments.id_user', 'users.username', 'users.profile_image')
            ->where('commentsPosts.id_post', '=', $id_post)
            ->get();

        return response()->json(['comments' => $comments]);
    }

    public function EditPost(Request $request, $id_post)
    {
        try {
            // Verificar si el post existe
            $post = DB::table('posts')->find($id_post);

            if (!$post) {
                return response()->json(['error' => 'El post no existe'], 404);
            }

            // Actualizar título y descripción del post si están presentes en la solicitud
            if ($request->has('title')) {
                DB::table('posts')->where('id', $id_post)->update(['title' => $request->input('title')]);
            }
            if ($request->has('description')) {
                DB::table('posts')->where('id', $id_post)->update(['description' => $request->input('description')]);
            }

            // Actualizar imagen del post si está presente en la solicitud
            if ($request->hasFile('image')) {
                // Guardar la nueva imagen en el directorio public/profile/images
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('profile/images'), $imageName);

                // Actualizar la ruta de la imagen en la base de datos
                DB::table('imagePost')->where('id_post', $id_post)->update(['name' => $imageName]);

                // Obtener la URL completa de la imagen actualizada
                $imageUrl = asset('profile/images/' . $imageName);
            }

            // Obtener el post actualizado
            $updatedPost = DB::table('posts')->find($id_post);

            // Retornar el post actualizado junto con la URL de la imagen si está presente
            return response()->json(['message' => 'El post ha sido actualizado correctamente', 'post' => $updatedPost, 'imageUrl' => $imageUrl ?? null]);
        } catch (\Exception $e) {
            // Manejar cualquier excepción que ocurra durante el proceso
            return response()->json(['error' => 'Ha ocurrido un error al actualizar el post'], 500);
        }
    }

    public function DeletePost(Request $request, $id_post)
    {
        try {
            $affected = DB::table('posts')
                ->where('id', $id_post)
                ->update(['isActive' => 0]);

            if ($affected) {
                return response()->json(['message' => 'El post ha sido marcado como inactivo correctamente'], 200);
            } else {
                return response()->json(['error' => 'No se encontró el post'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ha ocurrido un error al marcar el post como inactivo'], 500);
        }
    }
}
