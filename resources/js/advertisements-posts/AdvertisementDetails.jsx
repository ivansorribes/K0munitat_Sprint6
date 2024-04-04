import React, { useState, useEffect } from "react";
import { createRoot } from "react-dom/client";
import { HeartButton } from "../components/HeartButton";

export default function AdvertisementDetails() {
    const [post, setPost] = useState(null);
    const community = window.communityData;
    const [isEditing, setIsEditing] = useState(false);
    const [editTitle, setEditTitle] = useState("");
    const [editDescription, setEditDescription] = useState("");
    const id_user = document.getElementById("id_user").value;

    useEffect(() => {
        const pathParts = window.location.pathname.split('/');
        const communityId = pathParts[pathParts.length - 2];
        const postId = pathParts[pathParts.length - 1];

        fetch(`/api/communities/${communityId}/${postId}`)
            .then(response => response.json())
            .then(data => {
                setPost(data.post);
            })
            .catch(error => console.error('Error fetching post data:', error));
    }, []);

    const toggleLike = (postId) => {
        fetch(`/posts/${postId}/likes`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ id_post: postId })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    setPost(prevPost => ({
                        ...prevPost,
                        liked: !prevPost.liked,
                        likes_count: prevPost.liked ? prevPost.likes_count - 1 : prevPost.likes_count + 1,
                    }));
                }
            });
    };

    const startEditing = () => {
        setEditTitle(post.title);
        setEditDescription(post.description);
        setIsEditing(true);
    };

    const saveChanges = async () => {
        const data = JSON.stringify({
            title: editTitle,
            description: editDescription,
        });

        const response = await fetch(`/posts/${post.id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: data,
        });

        if (response.ok) {
            // En vez de solo actualizar el estado con la respuesta del PUT
            // Realiza una nueva solicitud GET para obtener el post actualizado, incluyendo las imágenes
            fetchUpdatedPost();
            setIsEditing(false);
        } else {
            console.error('Failed to update the post');
        }
    };

    // Definir fetchUpdatedPost para obtener los datos actualizados del post
    const fetchUpdatedPost = async () => {
        const pathParts = window.location.pathname.split('/');
        const communityId = pathParts[pathParts.length - 2];
        const postId = pathParts[pathParts.length - 1];

        try {
            const response = await fetch(`/api/communities/${communityId}/${postId}`);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const data = await response.json();
            setPost(data.post);
        } catch (error) {
            console.error('Error fetching updated post data:', error);
        }
    };





    if (!post) {
        return <div>Loading...</div>;
    }

    const pathParts = window.location.pathname.split('/');
    const communityId = pathParts[pathParts.length - 2];

    return (
        <div className="flex flex-col items-center mx-auto max-w-screen-lg m-10">
            <div className="self-start mb-4">
                <a href={`/communities/${communityId}`} className="inline-block bg-primary hover:bg-secondary text-white font-bold py-2 px-4 rounded">
                    Back
                </a>
            </div>

            <div className="bg-white w-full rounded-lg shadow-md flex flex-col transition-all overflow-hidden hover:shadow-2xl">
                <div className="p-6">
                    <div className="pb-3 mb-4 border-b border-stone-200 text-sm flex justify-between items-center text-neutral">
                        <div className="flex items-center gap-4">
                            <div className="flex items-center space-x-3"> {/* Contenedor Flex */}
                                <img
                                    id="userIcon"
                                    src={post.user.profile_image} // Asegúrate de que esto devuelve la URL correcta
                                    alt="Profile Image"
                                    className="h-10 w-10 rounded-full"
                                />
                                <p className="text-sm text-neutral font-extrabold">
                                    {post.user.username} {/* Asegúrate de acceder correctamente al username */}
                                </p>
                            </div>
                            <span className="text-xs">
                                Created: <time dateTime={post.created_at}>{new Date(post.created_at).toLocaleDateString('es-ES', {
                                    year: 'numeric',
                                    month: 'long',
                                    day: '2-digit',
                                    hour: '2-digit',
                                    minute: '2-digit',
                                })}</time>
                            </span>
                        </div>
                        <div className="flex items-center gap-2">
                            {post.id_user == id_user && (
                                <button onClick={() => startEditing()} className="py-1 px-3 text-xs font-bold text-white bg-blue-500 rounded-lg hover:bg-blue-600">Edit</button>
                            )}
                            <span className="px-2 py-1 bg-primary text-white rounded-full text-xs flex items-center">
                                {post.type}
                            </span>
                            <HeartButton liked={post.liked} likesCount={post.likes_count} onToggleLike={() => toggleLike(post.id)} />
                        </div>
                    </div>

                    {
                        isEditing ? (
                            <>
                                <input
                                    className="mb-4 font-extrabold text-2xl text-neutral w-full"
                                    value={editTitle}
                                    onChange={(e) => setEditTitle(e.target.value)}
                                />
                                <textarea
                                    className="text-neutral text-sm mb-0 mt-5 w-full"
                                    value={editDescription}
                                    onChange={(e) => setEditDescription(e.target.value)}
                                />
                                <button onClick={() => saveChanges()} className="py-1 px-3 text-xs font-bold text-neutral bg-green-500 rounded-lg hover:bg-green-600">Save Changes</button>
                                <button onClick={() => setIsEditing(false)} className="py-1 px-3 text-xs font-bold text-neutral bg-gray-300 rounded-lg hover:bg-gray-400">Cancel</button>
                            </>
                        ) : (
                            <>
                                <h3 className="mb-4 font-extrabold text-2xl text-neutral">{post.title}</h3>
                                <p className="text-neutral text-sm mb-0 mt-5">{post.description}</p>
                            </>
                        )
                    }
                    {/* Mover la visualización de las imágenes fuera del bloque condicional */}
                    {post.images && post.images.map((image) => (
                        <div key={image.id} className="mt-auto">
                            <img src={image.url} alt="" className="max-w-md max-h-96 w-auto h-auto object-cover mx-auto" />
                        </div>
                    ))}
                </div>
            </div>
        </div>

    );
}

if (document.getElementById("advertisementDetails")) {
    createRoot(document.getElementById("advertisementDetails")).render(<AdvertisementDetails />);
}
