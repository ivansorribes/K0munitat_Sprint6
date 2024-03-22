import React, { useState, useEffect } from "react";
import { createRoot } from "react-dom/client";

export default function AdvertisementComments() {
    const [comments, setComments] = useState([]);
    const [newComment, setNewComment] = useState('');
    const [editingCommentId, setEditingCommentId] = useState(null);
    const [editingCommentText, setEditingCommentText] = useState("");
    const [postId, setPostId] = useState(null);
    const id_user = document.getElementById("id_user").value;
    const username = document.getElementById("username").value;

    useEffect(() => {
        const pathParts = window.location.pathname.split('/');
        const communityId = pathParts[pathParts.length - 2];
        const postId = pathParts[pathParts.length - 1];
        setPostId(postId);

        fetch(`/api/communities/${communityId}/${postId}`)
            .then(response => response.json())
            .then(data => {
                setComments(data.post.comments || []);
            })
            .catch(error => console.error('Error fetching post data:', error));
    }, []);

    const handlePostComment = async () => {
        const formData = new FormData();
        formData.append('id_post', postId);
        formData.append('id_user', id_user);
        formData.append('comment', newComment);

        try {
            const response = await fetch('/api/comments', {
                method: 'POST',
                body: formData,
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const newCommentData = await response.json();
            // Asegúrate de que newCommentData incluya el 'id' y cualquier otro campo necesario.
            const commentWithUsername = { ...newCommentData, username: username, user: { id: id_user } };

            setComments(prevComments => [...prevComments, commentWithUsername]);
            setNewComment('');
        } catch (error) {
            console.error('Error posting the comment:', error);
        }
    };


    // Iniciar la edición de un comentario
    const handleEditComment = (comment) => {
        setEditingCommentId(comment.id);
        setEditingCommentText(comment.comment);
    };

    // Cancelar la edición
    const handleCancelEdit = () => {
        setEditingCommentId(null);
        setEditingCommentText("");
    };



    const handleSaveEdit = async () => {
        try {
            const data = JSON.stringify({
                comment: editingCommentText,
            });

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const response = await fetch(`/comments/${editingCommentId}`, {
                method: 'PUT',
                body: data,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
            });

            if (!response.ok) {
                throw new Error(`Network response was not ok: ${response.status}`);
            }

            const updatedCommentData = await response.json();

            setComments(prevComments =>
                prevComments.map(comment =>
                    comment.id === editingCommentId ? { ...comment, comment: updatedCommentData.comment } : comment
                )
            );

            // Resetear estado de edición
            handleCancelEdit();
        } catch (error) {
            console.error('Error updating the comment:', error);
        }
    };

    const handleDeleteComment = async (commentId) => {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        try {
            const response = await fetch(`/comments/${commentId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
            });

            if (!response.ok) {
                throw new Error(`Network response was not ok: ${response.status}`);
            }

            // Filtra el comentario eliminado del estado local
            setComments(comments.filter(comment => comment.id !== commentId));
        } catch (error) {
            console.error('Error deleting the comment:', error);
        }
    };

    return (
        <section className="bg-white py-8 lg:py-16 antialiased">
            <div className="max-w-2xl mx-auto px-4">
                <h2 className="text-lg lg:text-2xl font-extrabold text-neutral mb-6">
                    Comments
                </h2>
                {comments.map((comment) => (
                    <article key={comment.id} className="p-6 mb-4 text-base bg-white rounded-lg border border-neutral">
                        {editingCommentId === comment.id ? (
                            // Área de edición para el comentario actual
                            <div>
                                <textarea
                                    className="w-full p-2 text-sm text-neutral border-2 border-neutral rounded-lg focus:border-neutral focus:ring-0"
                                    value={editingCommentText}
                                    onChange={(e) => setEditingCommentText(e.target.value)}
                                />
                                <button onClick={handleSaveEdit} className="mr-2 py-2 px-4 text-xs font-bold text-neutral bg-secondary rounded-lg hover:bg-accent">Save</button>
                                <button onClick={handleCancelEdit} className="py-2 px-4 text-xs font-bold text-neutral bg-gray-300 rounded-lg hover:bg-gray-400">Cancel</button>
                            </div>
                        ) : (
                            // Visualización normal del comentario
                            <div>
                                <footer className="mb-2">
                                    <div className="flex items-center justify-between">
                                        <p className="text-sm text-neutral font-extrabold">
                                            {comment.username}
                                        </p>

                                        {/* Asegura que solo el usuario que creó el comentario pueda ver el botón de edición */}
                                        {comment.user.id == id_user && (
                                            <div className="flex items-center justify-between">
                                                <>
                                                    <button onClick={() => handleEditComment(comment)} className="py-1 px-3 text-xs font-bold text-neutral bg-gray-200 rounded-lg hover:bg-gray-300">Edit</button>
                                                    <button onClick={() => handleDeleteComment(comment.id)} className="ml-2 py-1 px-3 text-xs font-bold text-neutral bg-red-500 rounded-lg hover:bg-red-600">Delete</button>
                                                </>
                                            </div>
                                        )}
                                    </div>
                                </footer>
                                <p className="text-neutral">
                                    {comment.comment}
                                </p>
                            </div>
                        )}
                    </article>
                ))}

                <div className="mb-6">
                    <textarea
                        id="comment"
                        rows="4"
                        className="w-full p-2 text-sm text-neutral border-2 border-neutral rounded-lg focus:border-neutral focus:ring-0"
                        placeholder="Write a comment..."
                        value={newComment}
                        onChange={(e) => setNewComment(e.target.value)}
                        required
                    />
                    <button
                        type="button"
                        className="mt-2 py-2 px-4 text-xs font-bold text-neutral bg-secondary rounded-lg hover:bg-accent"
                        onClick={handlePostComment}
                    >
                        Post comment
                    </button>
                </div>
            </div>
        </section>

    );
}

if (document.getElementById("advertisementComments")) {
    createRoot(document.getElementById("advertisementComments")).render(<AdvertisementComments />);
}
