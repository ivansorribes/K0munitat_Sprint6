<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\post_admin_blog;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blog = post_admin_blog::all();

        if ($blog->isEmpty()) {
            return view('blog')->with('error', 'No hay registros en la base de datos.');
        }

        return view('blog', [
            'blog' => $blog,
            ]
        );
        //return response()->json($posts);
    }

    public function adminPanel()
    {
    $blogs = post_admin_blog::all();

    return view('adminPanel.paneladminBlog', ['blogs' => $blogs]);
    }

    public function createBlog()
    {
        return view('blog.createForm');
    }

    public function store(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'title' => 'required|string|max:50',
        'description' => 'required|string|max:1000',
        'post_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validar la imagen
    ]);

    // Procesar la imagen y almacenarla en el almacenamiento (storage)
    if ($request->hasFile('post_image')) {
        // Obtener el nombre de la imagen
        $imageName = time() . '.' . $request->post_image->getClientOriginalExtension();
        
        // Guardar la imagen en el directorio "public/images"
        $request->post_image->storeAs('public/images', $imageName);
    } else {
        // Si no se proporciona ninguna imagen, establecer el nombre de la imagen como nulo
        $imageName = null;
    }

    // Crear una nueva instancia del modelo de blog y asignar los datos del formulario
    $blog = new post_admin_blog();
    $blog->title = $request->title;
    $blog->description = $request->description;
    $blog->post_image = $imageName; // Asignar el nombre de la imagen
    $blog->save();

    // Redireccionar después de guardar
    return redirect()->route('paneladminBlog')->with('success', 'Blog creado exitosamente.');
    }

    public function destroy($id)
    {
    // Encuentra la entrada de blog por su ID
    $blog = post_admin_blog::findOrFail($id);

    // Elimina la entrada de blog
    $blog->delete();

    // Redirige de vuelta a donde sea apropiado después de eliminar
    return redirect()->route('paneladminBlog')->with('success', 'Entrada de blog eliminada exitosamente.');
    }

    public function updateBlog($id)
    {
    // Encuentra la entrada de blog por su ID
    $blog = post_admin_blog::findOrFail($id);

    return view('blog.editForm', compact('blog'));
    }


    public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:50',
        'description' => 'required|string|max:1000',
        'post_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // validar que es una imagen
    ]);

    $blog = post_admin_blog::findOrFail($id);
    $blog->title = $request->title;
    $blog->description = $request->description;

    // Guardar la imagen si se ha cargado
    if ($request->hasFile('post_image')) {
        $imageName = time().'.'.$request->post_image->extension();
        $request->post_image->storeAs('public/images', $imageName); // Utiliza storeAs para almacenar la imagen
        $blog->post_image = $imageName;
    }

    $blog->save();

    return redirect()->route('paneladminBlog')->with('success', 'Blog actualizado correctamente.');
}

}