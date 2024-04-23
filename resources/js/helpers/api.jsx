// helpers/api.js
export const fetchComments = async (communityId, postId) => {
    try {
        const response = await fetch(`/api/communities/${communityId}/${postId}`);
        const data = await response.json();
        return data.post.comments || [];
    } catch (error) {
        console.error('Error fetching post data:', error);
    }
};

// helpers/api.js

export const postComment = async (postId, userId, commentText, setComments, setNewComment) => {
    const formData = new FormData();
    formData.append('id_post', postId);
    formData.append('id_user', userId);
    formData.append('comment', commentText);

    try {
        const response = await fetch('/api/comments', {
            method: 'POST',
            body: formData,
        });

        if (!response.ok) {
            throw new Error(`Network response was not ok. Status: ${response.status}`);
        }

        const newCommentData = await response.json();
        const commentWithCompleteUserData = {
            ...newCommentData,
            user: {
                id: userId,
                username: newCommentData.username || "Anonymous",  // Asegúrate de que el username se maneje adecuadamente
                profile_image: newCommentData.profile_image || "default.png"
            }
        };

        // Actualiza el estado local de los comentarios añadiendo el nuevo comentario al principio o al final de la lista
        setComments(prevComments => [commentWithCompleteUserData, ...prevComments]);
        setNewComment('');
    } catch (error) {
        console.error('Error posting the comment:', error);
    }
};

export const saveEditedComment = async (editingCommentId, editingCommentText, setComments, handleCancelEdit) => {
    const data = JSON.stringify({
        comment: editingCommentText,
    });

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    try {
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

export const deleteComment = async (commentToDelete, setComments, setIsModalOpen, setCommentToDelete) => {
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

        // El comentario ha sido eliminado del servidor, ahora actualiza el estado local
        setComments(prevComments => prevComments.filter(comment => comment.id !== commentToDelete));
        setIsModalOpen(false);
        setCommentToDelete(null);
    } catch (error) {
        console.error('Error deleting the comment:', error);
    }
};

export const toggleLike = async (commentId, setComments) => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    try {
        const response = await fetch(`/comments/${commentId}/likes`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ id_comment: commentId })
        });

        const data = await response.json();
        if (data.success) {
            // La llamada fue exitosa, actualiza el estado de los comentarios
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
        } else {
            throw new Error("Failed to toggle like on the comment");
        }
    } catch (error) {
        console.error('Error al intentar dar like al comentario:', error);
    }
};

export const toggleLikeReply = async (replyId, commentId, setComments) => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    try {
        const response = await fetch(`/replies/${replyId}/likes`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ id_reply: replyId })
        });

        const data = await response.json();
        if (data.success) {
            // Update the comments state to reflect the like change
            setComments(prevComments =>
                prevComments.map(comment => {
                    if (comment.id === commentId) {
                        return {
                            ...comment,
                            replies: comment.replies.map(reply => {
                                if (reply.id === replyId) {
                                    const updatedLiked = !reply.liked;
                                    return {
                                        ...reply,
                                        liked: updatedLiked,
                                        likes_count: updatedLiked ? reply.likes_count + 1 : reply.likes_count - 1
                                    };
                                }
                                return reply;
                            })
                        };
                    }
                    return comment;
                })
            );
        }
    } catch (error) {
        console.error('Error when toggling like on reply:', error);
    }
};

export const deleteReply = async (replyToDelete, setComments, setReplyToDelete, setIsModalReplyOpen) => {
    if (!replyToDelete) return;

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    try {
        const response = await fetch(`/replies/${replyToDelete}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
        });

        if (!response.ok) {
            throw new Error(`Network response was not ok: ${response.status}`);
        }

        // Actualizar el estado para filtrar la respuesta eliminada
        setComments(prevComments => prevComments.map(comment => {
            return {
                ...comment,
                replies: comment.replies.filter(reply => reply.id !== replyToDelete)
            };
        }));

        // Restablecer y cerrar el modal después de la eliminación exitosa
        setReplyToDelete(null);
        setIsModalReplyOpen(false);
    } catch (error) {
        console.error('Error deleting the reply:', error);
    }
};

export const sendReply = async (commentId, replyText, setActiveReplyBox, fetchComments) => {
    const data = JSON.stringify({
        reply: replyText
    });

    try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const response = await fetch(`/comments/${commentId}/reply`, {
            method: 'POST',
            body: data,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
        });

        if (response.ok) {
            console.log("Respuesta enviada con éxito");
            setActiveReplyBox(null); // Cierra el cuadro de respuesta después de enviar
        } else {
            console.error("Error al enviar la respuesta");
        }
    } catch (error) {
        console.error("Error al enviar la respuesta:", error);
    }
};