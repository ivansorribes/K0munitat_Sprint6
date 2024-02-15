import React, { useState, useEffect } from 'react';
import { createRoot } from 'react-dom/client';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faEdit, faSave, faTimes, faHeart, faComment, faEllipsisV } from '@fortawesome/free-solid-svg-icons';

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
    const [menuOpen, setMenuOpen] = useState(false);

    useEffect(() => {
        const fetchUserData = async () => {
            try {
                const response = await fetch('/postUser');
                if (response.ok) {
                    const data = await response.json();
                    setUser(data.user || {});
                    setPosts(data.posts || []);
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
        setEditModalOpen(true);
        setMenuOpen(false);
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
                const updatedPosts = posts.map((post) =>
                    post.id === selectedEditPost.id ? selectedEditPost : post
                );
                setPosts(updatedPosts);
                closeEditModal();
            } else {
                console.error('Error al editar el post');
            }
        } catch (error) {
            console.error('Error inesperado', error);
        }
    };

    return (
        <div className="container mx-auto mt-8">
            <div className="bg-white shadow-md rounded p-8 mb-4">
                <div className="flex items-center justify-between mb-4">
                    <h1 className="text-3xl font-bold">{`${user.username}`}</h1>
                    <button className="mt-6 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Edit profile
                    </button>
                </div>

                <div className="flex items-center">
                    <div className="w-1/4 text-center">
                        <div className="flex flex-col items-center">
                            <img
                                className="w-32 h-32 rounded-full mb-4 cursor-pointer"
                                src={`/profile/images/${user.profile_image}`}
                                alt="Imagen de Usuario"
                                id="userImage"
                            />
                            <p className="font-bold">{`${user.firstname} ${user.lastname}`}</p>
                        </div>
                    </div>
                    <div className="flex items-center relative w-3/4">
                        <p className="font-bold mb-2 text-left w-full">Description:</p>
                        <div className="relative w-full">
                            {editingDescription ? (
                                <div className="w-full h-48 border rounded p-2 mb-4" style={{ width: '800px', height: '120px', marginBottom: '10px' }}>
                                    <textarea
                                        className="w-full h-full outline-none"
                                        value={newDescription}
                                        onChange={(e) => setNewDescription(e.target.value)}
                                    />
                                    <div className="flex items-end justify-end absolute bottom-0 right-0 mb-2 mr-2">
                                        <button className="bg-green-500 text-white px-2 py-1 rounded mr-2" onClick={saveDescription} style={{ marginBottom: '15px' }}>
                                            <FontAwesomeIcon icon={faSave} size="xs" />
                                        </button>
                                        <button className="bg-red-500 text-white px-2 py-1 rounded" onClick={cancelEditingDescription} style={{ marginBottom: '15px' }}>
                                            <FontAwesomeIcon icon={faTimes} size="xs" />
                                        </button>
                                    </div>
                                </div>
                            ) : (
                                <div className="border rounded p-2 relative" style={{ width: '800px', height: '120px', marginBottom: '10px' }}>
                                    {user.profile_description ? (
                                        <p>{user.profile_description}</p>
                                    ) : (
                                        <p>No description available</p>
                                    )}
                                    <button className="bg-blue-500 text-white px-2 py-1 rounded absolute bottom-0 right-0 mb-2 mr-2" onClick={() => { startEditingDescription(); setNewDescription(user.profile_description); }}>
                                        <FontAwesomeIcon icon={faEdit} size="xs" />
                                    </button>
                                </div>
                            )}
                        </div>
                    </div>
                </div>

                <div className="mt-6">
                    <h2 className="text-2xl text-center font-bold mb-4">Publications</h2>
                    <div className="grid grid-cols-2 gap-4">
                        {posts.map((post) => (
                            <div
                                key={post.id}
                                className="post-card border border-gray-300 p-4 bg-gray-100 cursor-pointer relative"
                            >
                                <img
                                    className="w-full h-32 object-cover rounded"
                                    src={`/profile/images/${post.image.name}`}
                                    alt={`Publicación ${post.id}`}
                                    style={{ width: '800px', height: '350px' }}
                                    onClick={() => openModal(post.image.name, `${post.likes.length} likes`, `${post.comments.length} comentarios`, post.description)}
                                />
                                {/* Botón desplegable */}
                                <div className="absolute top-2 right-2">
                                    <div className="dropdown relative">
                                        <button className="dropdown-toggle" onClick={() => setMenuOpen(!menuOpen)}>
                                            <FontAwesomeIcon icon={faEllipsisV} className="text-gray-500" />
                                        </button>
                                        <div className={`dropdown-menu ${menuOpen ? 'block' : 'hidden'} absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10`}>
                                            <button className="dropdown-item block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onClick={() => openEditModal(post)}>Edit</button>
                                            {<button className="dropdown-item block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onClick={() => handleDeletePost(post)}>Delete</button>}
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

            {/* Modal */}
            {modalImage && (
                <div className="modal fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex items-center justify-center" onClick={closeModal}>
                    <div className="modal-content max-w-3/4 bg-white p-4 rounded overflow-hidden">
                        <span className="close absolute top-0 right-0 m-4 text-3xl cursor-pointer" onClick={closeModal}>&times;</span>
                        <img
                            className="w-full h-auto"
                            src={`/profile/images/${modalImage.imageSrc}`}
                            alt="Imagen Ampliada"
                            style={{ width: '600px', height: '600px' }}
                        />
                        <div className="mt-2">
                            <p className="text-center font-bold">Detalles</p>
                            <div className="flex justify-between mt-2">
                                <div className="flex items-center">
                                    <FontAwesomeIcon icon={faHeart} className="text-red-500 mr-1" />
                                    {modalImage.likes}
                                </div>
                                <div className="flex items-center">
                                    <FontAwesomeIcon icon={faComment} className="text-blue-500 mr-1" />
                                    {modalImage.comments}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            )}

            {/* Comments Modal */}
            {commentsModalOpen && selectedPostComments && (
                <div className="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50" onClick={closeCommentsModal}>
                    <div className="modal-content bg-white p-4 rounded-xl overflow-hidden" style={{ width: '1200px', height: '600px' }}>
                        <span className="close absolute top-0 right-0 m-4 text-3xl cursor-pointer" onClick={(e) => { e.stopPropagation(); closeCommentsModal(); }}>&times;</span>
                        <h2 className="text-xl font-bold mb-4">Comments</h2>
                        {/* Renderizar comentarios */}
                        {selectedPostComments.comments.map((comment, index) => (
                            <div key={index} className="border-b py-2">
                                {/* Mostrar imagen de usuario */}
                                <img
                                    src={comment.userAvatar}
                                    alt={`Avatar de ${comment.username}`}
                                    className="w-8 h-8 rounded-full mr-2 inline-block"
                                />
                                {/* Mostrar nombre de usuario */}
                                <span className="font-bold text-blue-500">{comment.username}</span>:
                                {/* Mostrar comentario */}
                                <p className="ml-2 inline-block">{comment.comment}</p>
                            </div>
                        ))}
                    </div>
                </div>
            )}

            {/* Edit Modal */}
            {editModalOpen && selectedEditPost && (
                <div className="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50">
                    <div className="modal-content bg-white p-4 rounded-xl overflow-hidden" style={{ width: '800px', height: '600px' }}>
                        <div className="flex flex-col">
                            <span className="close absolute top-0 right-0 m-4 text-3xl cursor-pointer" onClick={closeEditModal}>&times;</span>
                            <h1>Edit Post</h1>
                            <div className="flex items-center mb-4">
                                <img
                                    className="w-16 h-16 object-cover rounded mr-4"
                                    src={`/profile/images/${selectedEditPost.image.name}`}
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
                            <div>
                                <button className="bg-green-500 text-white px-4 py-2 rounded mr-2" onClick={handleSavePost}>Save</button>
                                <button className="bg-red-500 text-white px-4 py-2 rounded" onClick={closeEditModal}>Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            )}


        </div>
    );
}

if (document.getElementById('personalProfile')) {
    createRoot(document.getElementById('personalProfile')).render(<PersonalProfile />);
}
