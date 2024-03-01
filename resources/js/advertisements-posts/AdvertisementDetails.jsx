import React, { useState, useEffect } from "react";
import { createRoot } from "react-dom/client";
import { HeartButton } from "../components/HeartButton";

export default function AdvertisementDetails() {
    const [post, setPost] = useState(null);
    const community = window.communityData;

    useEffect(() => {
        const pathParts = window.location.pathname.split('/');
        const communityId = pathParts[pathParts.length - 2];
        const postId = pathParts[pathParts.length - 1];

        fetch(`http://localhost/api/communities/${communityId}/${postId}`)
            .then(response => response.json())
            .then(data => {
                setPost(data.post);
            })
            .catch(error => console.error('Error fetching post data:', error));
    }, []);

    const toggleLike = (postId) => {
        fetch(`http://localhost/posts/${postId}/likes`, {
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
                            <span className="font-bold">{post.creator_username}</span>
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
                            <span className="px-2 py-1 bg-primary text-neutral rounded-full text-xs flex items-center">
                                {post.type}
                            </span>
                            <HeartButton liked={post.liked} likesCount={post.likes_count} onToggleLike={() => toggleLike(post.id)} />
                        </div>
                    </div>
                    <h3 className="mb-4 font-extrabold text-2xl text-neutral">
                        {post.title}
                    </h3>
                    {post.images.map((image) => (
                        <div key={image.id} className="mt-auto">
                            <img src={image.url} alt="" className="max-w-md max-h-96 w-auto h-auto object-cover mx-auto" />
                        </div>
                    ))}
                    <p className="text-neutral text-sm mb-0 mt-5">
                        {post.description}
                    </p>
                </div>
            </div>
        </div>
    );
}

if (document.getElementById("advertisementDetails")) {
    createRoot(document.getElementById("advertisementDetails")).render(<AdvertisementDetails />);
}
