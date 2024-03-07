<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\posts;
use App\Models\likesPosts;
use App\Models\commentsPosts;
use App\Models\imagePost;
use App\Models\comments;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

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

    public function EditProfileView()
    {
        return view('profile.editPersonalProfile');
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

    public function userInfo()
    {
        $users = User::select('id', 'firstname', 'email', 'username', 'telephone', 'city', 'role', 'isActive')->get();
        return view('adminPanel.paneladminUsers', compact('users'));
    }

    public function toggleIsActive($id)
    {
        $user = User::findOrFail($id);
        $user->isActive = !$user->isActive;
        $user->save();
        return back();
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return back();
    }

    public function postUser()
    {
        $user = Auth::user();

        if ($user) {
            // Obtener todas las publicaciones del usuario
            $posts = posts::where('id_user', $user->id)
                ->where('isActive', 1)
                ->get();

            // Adjuntar la información del usuario a cada publicación
            foreach ($posts as $post) {
                // Obtener la información del usuario
                $userData = [
                    'id' => $user->id,
                    'username' => $user->username,
                    'firstname' => $user->firstname,
                    'lastname' => $user->lastname,
                    'profile_image' => $user->profile_image,
                    'profile_description' => $user->profile_description,
                    'email' => $user->email,
                    'telephone' => $user->telephone,
                    'city' => $user->city,
                    'postcode' => $user->postcode,
                ];

                // Obtener todos los comentarios asociados con el post actual
                $postComments = commentsPosts::where('id_post', $post->id)
                    ->with(['comment.user'])
                    ->get();

                // Adjuntar los comentarios al post
                $post->comments = $postComments;

                // Obtener los likes del post
                $post->likes = likesPosts::where('id_post', $post->id)->with('user')->get();

                // Obtener la imagen del post
                $post->image = imagePost::where('id_post', $post->id)->first();

                // Adjuntar la información del usuario a la publicación
                $post->user = $userData;
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
                // Guardar la nueva imagen en el directorio /storage/app/public/posts/
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('/storage/posts/'), $imageName);

                // Actualizar la ruta de la imagen en la base de datos
                DB::table('imagePost')->where('id_post', $id_post)->update(['name' => $imageName]);

                // Obtener la URL completa de la imagen actualizada
                $imageUrl = asset('/storage/posts/' . $imageName);
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

    public function updateUserInfo(Request $request)
    {
        try {
            // Obtén el usuario autenticado
            $user = Auth::user();

            // Construye la consulta para actualizar la información del usuario
            DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'firstname' => $request->input('firstname'),
                    'lastname' => $request->input('lastname'),
                    'username' => $request->input('username'),
                    'email' => $request->input('email'),
                    'telephone' => $request->input('telephone'),
                    'city' => $request->input('city'),
                    'postcode' => $request->input('postcode'),
                ]);

            // Si se proporcionó una nueva imagen, actualiza la ruta de la imagen en la base de datos
            if ($request->hasFile('profile_image')) {
                $image = $request->file('profile_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('/profile/images/'), $imageName);

                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['profile_image' => $imageName]);
            }

            return response()->json(['message' => 'Información de usuario actualizada correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ha ocurrido un error al actualizar la información del usuario'], 500);
        }
    }

    public function changePassword(Request $request)
    {
        try {
            // Obtén el usuario autenticado
            $user = Auth::user();

            // Verifica si la nueva contraseña y la repetición coinciden
            if ($request->input('new_password') !== $request->input('confirm_password')) {
                return response()->json(['error' => 'Las contraseñas no coinciden'], 400);
            }

            // Verifica si la contraseña actual del usuario es válida
            if (!Hash::check($request->input('actual_password'), $user->password)) {
                return response()->json(['error' => 'La contraseña actual es incorrecta'], 400);
            }

            // Actualiza la contraseña del usuario directamente en la base de datos
            DB::table('users')
                ->where('id', $user->id)
                ->update(['password' => Hash::make($request->input('new_password'))]);

            // Envía una respuesta de éxito
            return response()->json(['message' => 'Contraseña actualizada correctamente'], 200);
        } catch (\Exception $e) {
            // Maneja cualquier otro error que pueda ocurrir durante el proceso
            return response()->json(['error' => 'Ha ocurrido un error al actualizar la contraseña'], 500);
        }
    }


    public function deleteUserImage(Request $request)
    {
        try {
            // Obtén el usuario autenticado
            $user = Auth::user();

            // Verifica si el usuario tiene una imagen de perfil
            if ($user->profile_image) {
                // Elimina la imagen del directorio de almacenamiento
                Storage::delete('public/profile/images/' . $user->profile_image);

                // Actualiza la columna 'profile_image' del usuario a null utilizando DB
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['profile_image' => null]);

                return response()->json(['message' => 'Imagen de perfil eliminada correctamente'], 200);
            } else {
                return response()->json(['error' => 'El usuario no tiene una imagen de perfil'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ha ocurrido un error al eliminar la imagen de perfil'], 500);
        }
    }
}
