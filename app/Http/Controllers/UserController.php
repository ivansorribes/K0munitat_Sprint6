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
            $posts = posts::where('id_user', $user->id)->get();

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
            ->select('comments.id', 'comments.comment', 'comments.id_user', 'users.username')
            ->where('commentsPosts.id_post', '=', $id_post)
            ->get();

        return response()->json(['comments' => $comments]);
    }
}
