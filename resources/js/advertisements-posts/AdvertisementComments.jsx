import React, { useState, useEffect } from "react";
import { createRoot } from "react-dom/client";
import { CommentLikeButton } from "../components/CommentLikeButton";
import { ReplyBox } from "../components/ReplyBox";

export default function AdvertisementComments() {
    const [comments, setComments] = useState([]);
    const [newComment, setNewComment] = useState('');
    const [editingCommentId, setEditingCommentId] = useState(null);
    const [editingCommentText, setEditingCommentText] = useState("");
    const [postId, setPostId] = useState(null);
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [commentToDelete, setCommentToDelete] = useState(null);
    const id_user = document.getElementById("id_user").value;
    const username = document.getElementById("username").value;
    const [activeReplyBox, setActiveReplyBox] = useState(null);

    const fetchComments = () => {
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
    };

    useEffect(() => {
        fetchComments(); // Llama a la función dentro de useEffect
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

            const userProfileImageUrl = '';

            const commentWithCompleteUserData = {
                ...newCommentData,
                user: {
                    id: id_user,
                    username: username,
                    profile_image: userProfileImageUrl
                }
            };

            setComments(prevComments => [...prevComments, commentWithCompleteUserData]);
            fetchComments();
            setNewComment('');
        } catch (error) {
            console.error('Error posting the comment:', error);
        }
    };



    const handleEditComment = (comment) => {
        setEditingCommentId(comment.id);
        setEditingCommentText(comment.comment);
    };

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

            handleCancelEdit();
        } catch (error) {
            console.error('Error updating the comment:', error);
        }
    };

    const handleDeleteClick = (commentId) => {
        setCommentToDelete(commentId);
        setIsModalOpen(true);
    };

    const handleDeleteComment = async () => {
        if (!commentToDelete) return;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        try {
            const response = await fetch(`/comments/${commentToDelete}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
            });

            if (!response.ok) {
                throw new Error(`Network response was not ok: ${response.status}`);
            }

            setComments(comments.filter(comment => comment.id !== commentToDelete));
            setIsModalOpen(false);
            setCommentToDelete(null);
        } catch (error) {
            console.error('Error deleting the comment:', error);
        }
    };

    const onToggleLike = (commentId) => {
        fetch(`/comments/${commentId}/likes`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ id_comment: commentId })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Actualiza el estado de los comentarios para reflejar el cambio de like
                    setComments(prevComments =>
                        prevComments.map(comment => {
                            if (comment.id === commentId) {
                                const updatedLiked = !comment.liked;
                                return {
                                    ...comment,
                                    liked: updatedLiked,
                                    likes_count: updatedLiked ? comment.likes_count + 1 : comment.likes_count - 1
                                };
                            }
                            return comment;
                        })
                    );
                }
            })
            .catch(error => console.error('Error al intentar dar like al comentario:', error));
    };



    return (
        <>
            <section className="bg-white py-8 lg:py-16 antialiased">
                <div className="max-w-2xl mx-auto px-4">
                    <h2 className="text-lg lg:text-2xl font-extrabold text-neutral mb-6">Comments</h2>
                    {comments.map((comment) => (
                        <article key={comment.id} className="p-6 mb-4 text-base bg-white rounded-lg border border-neutral">
                            {editingCommentId === comment.id ? (
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
                                <div>
                                    <footer className="mb-2">
                                        <div className="flex items-center justify-between"> {/* Contenedor Flex principal */}
                                            <div className="flex items-center space-x-3"> {/* Contenedor para la imagen y el nombre de usuario */}
                                                <img
                                                    src={comment.user.profile_image}
                                                    alt="Profile Image"
                                                    className="h-10 w-10 rounded-full"
                                                />
                                                <p className="text-sm text-neutral font-extrabold">
                                                    {comment.user.username}
                                                </p>
                                            </div>
                                            {comment.user.id == id_user && (
                                                <div>
                                                    <button onClick={() => handleEditComment(comment)} className="py-1 px-3 text-xs font-bold text-neutral bg-blue-500 rounded-lg hover:bg-blue-800">Edit</button>
                                                    <button onClick={() => handleDeleteClick(comment.id)} className="ml-2 py-1 px-3 text-xs font-bold text-neutral bg-red-500 rounded-lg hover:bg-red-600">Delete</button>
                                                </div>
                                            )}
                                        </div>
                                    </footer>
                                    <p className="text-neutral">
                                        {comment.comment}
                                    </p>

                                    <div className="flex justify-between items-center mt-2">
                                        <button
                                            className="py-1 px-3 text-xs font-bold text-neutral bg-blue-500 rounded-lg hover:bg-blue-800"
                                            onClick={() => setActiveReplyBox(activeReplyBox === comment.id ? null : comment.id)}
                                        >Reply
                                        </button>
                                        <CommentLikeButton
                                            commentId={comment.id}
                                            liked={comment.liked || false}
                                            likesCount={comment.likes_count}
                                            onToggleLike={onToggleLike}
                                        />
                                    </div>
                                    {activeReplyBox === comment.id && (
                                        <ReplyBox
                                            onSendReply={(replyText) => {
                                                console.log("Reply text for comment ID", comment.id, ":", replyText);
                                                // Aquí puedes agregar la lógica para enviar la respuesta al servidor
                                                setActiveReplyBox(null); // Opcional: Cierra el cuadro de respuesta después de enviar
                                            }}
                                        />
                                    )}
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
            {isModalOpen && (
                <div className="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                    <div className="bg-white p-4 rounded-lg">
                        <p>Are you sure you want to delete this comment?</p>
                        <button onClick={handleDeleteComment} className="mr-2 py-2 px-4 text-xs font-bold text-white bg-red-500 rounded-lg hover:bg-red-600">Delete</button>
                        <button onClick={() => setIsModalOpen(false)} className="py-2 px-4 text-xs font-bold text-black bg-gray-300 rounded-lg hover:bg-gray-400">Cancel</button>
                    </div>
                </div>
            )}
        </>
    );
}

if (document.getElementById("advertisementComments")) {
    createRoot(document.getElementById("advertisementComments")).render(<AdvertisementComments />);
}
