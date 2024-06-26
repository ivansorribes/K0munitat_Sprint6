import React, { useState, useEffect } from 'react';
import { createRoot } from 'react-dom/client';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faEdit, faSave, faTimes, faHeart, faComment, faEllipsisV } from '@fortawesome/free-solid-svg-icons';
import { ButtonEdit, ButtonCancel, ButtonDelete, ButtonChangePage, ButtonIconSave, ButtonSave, ButtonChangeImage } from './components/buttons';

export default function PersonalProfile() {
    const [user, setUser] = useState({});
    const [editingDescription, setEditingDescription] = useState(false);
    const [newDescription, setNewDescription] = useState('');
    const [modalImage, setModalImage] = useState(null);
    const [posts, setPosts] = useState([]);
    const [commentsModalOpen, setCommentsModalOpen] = useState(false);
    const [selectedPostComments, setSelectedPostComments] = useState(null);
    const [editModalOpen, setEditModalOpen] = useState(false);
    const [selectedEditPost, setSelectedEditPost] = useState(null);
    const [menuOpen, setMenuOpen] = useState([]);
    const [selectedImageURL, setSelectedImageURL] = useState(''); // Nuevo estado para la URL de la imagen seleccionada
    const [deleteConfirmationOpen, setDeleteConfirmationOpen] = useState(false);
    const [postToDelete, setPostToDelete] = useState(null);
    useEffect(() => {
        const fetchUserData = async () => {
            try {
                const response = await fetch('/postUser');
                if (response.ok) {
                    const data = await response.json();
                    setUser(data.user || {});
                    setPosts(data.posts || []);
                    console.log(data.posts)
                    // Inicializar menuOpen con un array de falsos del mismo tamaño que posts
                    setMenuOpen(Array(data.posts.length).fill(false));
                } else {
                    console.error('Error al obtener datos del usuario');
                }
            } catch (error) {
                console.error('Error inesperado', error);
            }
        };

        fetchUserData();
    }, []);
    const startEditingDescription = () => {
        setNewDescription(user.description || '');
        setEditingDescription(true);
    };

    const saveDescription = async () => {
        try {
            const response = await fetch('/updateProfileDescription', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window.csrf_token,
                },
                body: JSON.stringify({ description: newDescription }),
            });

            if (response.ok) {
                setUser({ ...user, profile_description: newDescription });
                setEditingDescription(false);
            } else {
                console.error('Error al guardar la descripción');
            }
        } catch (error) {
            console.error('Error inesperado', error);
        }
    };

    const cancelEditingDescription = () => {
        setEditingDescription(false);
    };

    const openModal = (imageSrc, likes, comments, description) => {
        setModalImage({ imageSrc, likes, comments, description });
    };

    const openCommentsModal = async (post) => {
        setCommentsModalOpen(true);
        setSelectedPostComments(post);

        try {
            const response = await fetch(`/CommentsUser/${post.id}`);
            if (response.ok) {
                const data = await response.json();
                setSelectedPostComments({ ...post, comments: data.comments || [] });
            } else {
                console.error('Error al obtener los comentarios del post');
            }
        } catch (error) {
            console.error('Error inesperado', error);
        }
    };
    const openEditModal = (post) => {
        setSelectedEditPost(post);
        closeDeleteConfirmation(); // Cerrar el modal de confirmación de eliminación si está abierto
        setEditModalOpen(true);
        setSelectedImageURL(`/img/post/${post.image.name}`); // Establecer la URL de la imagen seleccionada
    
        // Cerrar cualquier menú desplegable abierto al abrir el modal de edición
        setMenuOpen(Array(posts.length).fill(false));
    };
    
    
    
    
    const closeCommentsModal = () => {
        setCommentsModalOpen(false);
        setSelectedPostComments(null);
    };

    const closeEditModal = () => {
        setEditModalOpen(false);
        setSelectedEditPost(null);
    };

    const closeModal = () => {
        setModalImage(null);
    };

    const handleImageChange = (e) => {
        const newImage = e.target.files[0];
        setSelectedEditPost({ ...selectedEditPost, image: newImage });
        setSelectedImageURL(URL.createObjectURL(newImage)); // Establecer la URL de la imagen seleccionada
    };

    const handleSavePost = async () => {
        try {
            const formData = new FormData();
            formData.append('title', selectedEditPost.title);
            formData.append('description', selectedEditPost.description);
            formData.append('image', selectedEditPost.image);

            const response = await fetch(`/updatePost/${selectedEditPost.id}`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': window.csrf_token,
                },
            });

            if (response.ok) {
                // Obtener la URL de la imagen actualizada del servidor
                const data = await response.json();
                const updatedPost = { ...selectedEditPost, image: data.imageUrl };

                // Actualizar el estado local con el post actualizado
                const updatedPosts = posts.map((post) =>
                    post.id === selectedEditPost.id ? updatedPost : post
                );
                setPosts(updatedPosts);

                // Cerrar el modal de edición
                closeEditModal();

                // Recargar la página
                window.location.reload();
            } else {
                console.error('Error al editar el post');
            }
        } catch (error) {
            console.error('Error inesperado', error);
        }
    };


    const toggleMenuOpen = (index) => {
        const newMenuOpen = [...menuOpen];
        newMenuOpen[index] = !newMenuOpen[index];
        setMenuOpen(newMenuOpen);
    };

    // Función para abrir el modal de confirmación y establecer el post a eliminar
    const openDeleteConfirmation = (post) => {
        setPostToDelete(post);
        setDeleteConfirmationOpen(true);
        setMenuOpen(Array(posts.length).fill(false));

    };

    // Función para cerrar el modal de confirmación
    const closeDeleteConfirmation = () => {
        setPostToDelete(null);
        setDeleteConfirmationOpen(false);
    };

    // Función para manejar la eliminación del post si el usuario confirma
    const handleDeletePost = async (postId) => {
        try {
            const response = await fetch(`/deletePost/${postId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': window.csrf_token,
                },
            });

            if (response.ok) {
                // Remove the deleted post from the posts array
                setPosts(posts.filter(post => post.id !== postId));
                // Close the delete confirmation modal
                setDeleteConfirmationOpen(false);
            } else {
                console.error('Error deleting post');
            }
        } catch (error) {
            console.error('Unexpected error', error);
        }
    };

    // Función para manejar la cancelación de la eliminación del post
    const handleDeleteCanceled = () => {
        // Cerrar el modal de confirmación
        closeDeleteConfirmation();
    };

    return (

        <div className="container mx-auto mt-20">
            <div className="bg-white shadow-md rounded p-8 mb-4">
                <div className="flex items-center justify-between mb-4">
                    <h1 className="text-3xl font-bold">{`${user.username}`}</h1>
                    <a href='/editPersonalProfile'>
                        <ButtonChangePage label="Edit Profile" />

                    </a>

                </div><div className="flex items-center">
                    <div className="w-1/4 text-center">
                        <div className="flex flex-col items-center">
                            <img
                                className="w-32 h-32 rounded-full mb-4 cursor-pointer"
                                src={user.profile_image ? `/profile/images/${user.profile_image}` : '/profile/images/DefaultImage.png'}
                                id="userImage"
                            />
                            <p className="font-bold">{`${user.firstname} ${user.lastname}`}</p>
                        </div>
                    </div>
                    <div className="w-3/4">
                        <p className="font-bold mb-2 text-left">Description:</p>
                        {editingDescription ? (
                            <div className="border rounded p-2 mb-4">
                                <textarea
                                    className="w-full h-50 outline-none"
                                    value={newDescription}
                                    onChange={(e) => setNewDescription(e.target.value)}
                                />
                                <div className="flex items-end justify-end">
                                    <button className="bg-customColor text-white px-2 py-1 rounded mr-2" onClick={saveDescription}>
                                        <FontAwesomeIcon icon={faSave} size="xs" />
                                    </button>
                                    <button className="bg-customColor2 text-white px-2 py-1 rounded" onClick={cancelEditingDescription}>
                                        <FontAwesomeIcon icon={faTimes} size="xs" />
                                    </button>


                                </div>
                            </div>
                        ) : (
                            <div className="border rounded p-2 mb-4">
                                {user.profile_description ? (
                                    <p>{user.profile_description}</p>
                                ) : (
                                    <p>No description available</p>
                                )}
                                <div className="flex items-end justify-end">

                                    <button className="bg-customColor1 text-white px-2 py-1 rounded" onClick={() => { startEditingDescription(); setNewDescription(user.profile_description); }}>
                                        <FontAwesomeIcon icon={faEdit} size="xs" />
                                    </button>
                                </div>
                            </div>
                        )}
                    </div>
                </div>


                <div className="mt-6">
                    <h2 className="text-2xl text-center font-bold mb-4">Publications</h2>
                    <hr className="border-gray-800 my-0 mb-10" />
                    <div className={`grid grid-cols-1 sm:grid-cols-2 md:grid-cols-${posts.length >= 3 ? '3' : '2'} gap-4`}>
                        {posts.map((post, index) => (
                            <div
                                key={post.id}
                                className="post-card border border-gray-300 p-4 bg-gray-100 cursor-pointer relative"
                            >
                                <img
                                    className="w-full h-44 object-cover rounded"
                                    src={`/img/post/${post.image.name}`}
                                    alt={`Publicación ${post.id}`}
                                    onClick={() => openModal(post.image.name, `${post.likes.length} likes`, `${post.comments.length} comentarios`, post.description)}
                                />
                                {/* Botón desplegable */}
                                <div className="absolute top-2 right-2">
                                    <div className="dropdown relative">
                                        <button className="dropdown-toggle" onClick={() => toggleMenuOpen(index)}>
                                            <FontAwesomeIcon icon={faEllipsisV} className="text-gray-500" />
                                        </button>
                                        <div className={`dropdown-menu ${menuOpen[index] ? 'block' : 'hidden'} absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10`}>
                                            <button className="dropdown-item block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onClick={() => openEditModal(post)}>Edit</button>
                                            <button className="dropdown-item block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onClick={() => openDeleteConfirmation(post)}>Delete</button>
                                            {/* Eliminar el botón de eliminar post */}
                                        </div>

                                    </div>
                                </div>
                                {/* Resto del contenido de la publicación */}
                                <div className="flex items-center mb-2">
                                    <div className="flex items-center mr-2">
                                        <FontAwesomeIcon icon={faHeart} className="text-red-500 mr-1" />
                                        {post.likes.length}
                                    </div>
                                    <div className="flex items-center" onClick={() => openCommentsModal(post)}>
                                        <FontAwesomeIcon icon={faComment} className="text-blue-500 mr-1 cursor-pointer" />
                                        {post.comments.length}
                                    </div>
                                </div>
                                <div className="mt-2">
                                    <p>{post.description}</p>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </div>
            {/* Comments Modal */}
            {commentsModalOpen && selectedPostComments && (
                <div className="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50">
                    <div className="modal-content bg-white rounded-xl overflow-hidden max-w-lg relative" style={{ width: '600px', height: '500px' }}>
                        {/* Mover la cruz (botón de cierre) */}
                        <span className="close absolute top-0 right-0 m-4 text-3xl cursor-pointer" onClick={(e) => { e.stopPropagation(); closeCommentsModal(); }}>&times;</span>
                        <div className="p-6">
                            <div className="mb-4">
                                <h2 className="text-2xl font-bold mb-2 text-center">Comments</h2>
                                {/* Línea negra debajo del título Comment */}
                                <hr className="border-gray-800 my-0" />
                            </div>
                            {/* Renderizar comentarios con scroll */}
                            <div className="overflow-y-auto" style={{ maxHeight: '400px' }}>
                                {selectedPostComments.comments.map((comment, index) => (
                                    <div key={index} className="flex items-center mb-4">
                                        {/* Mostrar imagen de usuario */}
                                        <img
                                            src={comment.profile_image ? `/profile/images/${comment.profile_image}` : '/profile/images/DefaultImage.png'}
                                            alt={`Avatar de ${comment.username}`}
                                            className="w-12 h-12 rounded-full mr-4"
                                        />
                                        <div>
                                            {/* Mostrar nombre de usuario */}
                                            <p className="font-bold text-green-900 mb-1">{comment.username}</p>
                                            {/* Mostrar comentario */}
                                            <p className="text-gray-700 mb-4">{comment.comment}</p>
                                            {/* Línea negra debajo del comentario */}
                                            {index !== selectedPostComments.comments.length - 1 && (
                                                <hr className="border-gray-800 my-0" />
                                            )}
                                        </div>
                                    </div>
                                ))}
                            </div>
                        </div>
                    </div>
                </div>
            )}


            {/* Edit Modal */}
            {editModalOpen && selectedEditPost && (
                <div className="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50">
                    <div className="modal-content bg-white p-4 rounded-xl overflow-hidden" style={{ width: '600px', height: '500px' }}>
                        <div className="flex flex-col">
                        <div className="mb-4">
                                <h2 className="text-2xl font-bold mb-2 text-center">Edit Post</h2>
                                {/* Línea negra debajo del título Comment */}
                                <hr className="border-gray-800 my-0" />
                            </div>
                            <div className="flex items-center mb-4">
                                <img
                                    className="w-16 h-16 object-cover rounded mr-4"
                                    src={selectedImageURL}
                                    alt="Current Image"
                                />
                                <input type="file" onChange={(e) => handleImageChange(e)} className="mb-4" />
                            </div>
                            <h1>Title</h1>
                            <input
                                type="text"
                                defaultValue={selectedEditPost.title}
                                placeholder="Title"
                                className="border rounded p-2 mb-4"
                                onChange={(e) => setSelectedEditPost({ ...selectedEditPost, title: e.target.value })}
                            />
                            <h1>Description</h1>
                            <textarea
                                defaultValue={selectedEditPost.description}
                                placeholder="Description"
                                className="border rounded p-2 mb-4 h-32"
                                onChange={(e) => setSelectedEditPost({ ...selectedEditPost, description: e.target.value })}
                            />
                            <div className="flex justify-end space-x-2 mb-4 mt-2">
                            <ButtonSave onClick={handleSavePost}label="Save"/>
                            <ButtonCancel onClick={closeEditModal}label="Cancel"/>

</div>
                        </div>
                    </div>
                </div>
            )}
            {deleteConfirmationOpen && postToDelete && (
                <div className="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50">
                    <div className="modal-content bg-white p-4 rounded-xl overflow-hidden">
                        <p className="text-center text-lg font-semibold mb-4">Are you sure you want to delete this post?</p>
                       
                        <div className="flex justify-center space-x-2 mb-4 mt-2">
                            <ButtonDelete onClick={() => handleDeletePost(postToDelete.id)} label="Yes" />
                            <ButtonCancel onClick={closeDeleteConfirmation} label="No" />


                        </div>
                    </div>
                </div>
            )}
            <style>
                {`
                    .bg-customColor {
                        background-color: #64a858;
                    }
                    .bg-customColor1 {
                        background-color: #62adde;
                    } 
                    .bg-customColor2 {
                        background-color: #3d3c3b;
                    } 
                    `}
            </style>

        </div>
    );
}


if (document.getElementById('personalProfile')) {
    createRoot(document.getElementById('personalProfile')).render(<PersonalProfile />);
}