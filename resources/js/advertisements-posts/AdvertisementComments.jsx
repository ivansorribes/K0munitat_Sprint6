import React, { useState, useEffect } from "react";
import { createRoot } from "react-dom/client";

export default function AdvertisementComments() {
    const [comments, setComments] = useState([]);
    const [newComment, setNewComment] = useState('');
    const [postId, setPostId] = useState(null);
    const id_user = document.getElementById("id_user").value;

    useEffect(() => {
        const pathParts = window.location.pathname.split('/');
        const communityId = pathParts[pathParts.length - 2];
        const postId = pathParts[pathParts.length - 1];
        setPostId(postId);

        fetch(`http://localhost/api/communities/${communityId}/${postId}`)
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
            const response = await fetch('http://localhost/api/comments', {
                method: 'POST',
                body: formData,
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const data = await response.json();
            setComments([...comments, data]);
            setNewComment('');
        } catch (error) {
            console.error('Error posting the comment:', error);
        }
    };

    return (
        <section className="bg-white dark:bg-gray-900 py-8 lg:py-16 antialiased">
            <div className="max-w-2xl mx-auto px-4">
                <h2 className="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white mb-6">
                    Comments
                </h2>
                {comments.map((comment) => (
                    <article key={comment.id} className="p-6 mb-4 text-base bg-white rounded-lg dark:bg-gray-900 border border-gray-200 dark:border-gray-700">
                        <footer className="mb-2">
                            <div className="flex items-center justify-between">
                                <p className="text-sm text-gray-900 dark:text-white font-semibold">
                                    {/* Aquí puedes agregar el nombre del usuario o cualquier identificador */}
                                    {comment.username}
                                </p>
                                <p className="text-sm text-gray-600 dark:text-gray-400">
                                    {/* Opcional: fecha del comentario */}
                                </p>
                            </div>
                        </footer>
                        <p className="text-gray-500 dark:text-gray-400">
                            {comment.comment}
                        </p>
                    </article>
                ))}
                <div className="mb-6">
                    <textarea
                        id="comment"
                        rows="4"
                        className="w-full p-2 text-sm text-black border-2 border-gray-200 dark:border-gray-700 rounded-lg"
                        placeholder="Write a comment..."
                        value={newComment}
                        onChange={(e) => setNewComment(e.target.value)}
                        required
                    />
                    <button
                        type="button" // Cambiado a type="button" para evitar la recarga de la página
                        className="mt-2 py-2 px-4 text-xs font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700"
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
