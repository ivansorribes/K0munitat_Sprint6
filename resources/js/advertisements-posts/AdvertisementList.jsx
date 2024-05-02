import React, { useState, useEffect } from "react";
import { createRoot } from "react-dom/client";
import { HeartButton } from "../components/HeartButton";

export default function AdvertisementList() {
    const [posts, setPosts] = useState([]);
    const [filter, setFilter] = useState('all');
    const community = window.communityData;
    useEffect(() => {
        if (window.postsData) {
            setPosts(window.postsData);
        }
    }, []);

    const toggleLike = (postId) => {
        fetch(`/posts/${postId}/likes`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({ id_post: postId })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    setPosts(posts => posts.map(post => {
                        if (post.id === postId) {
                            return {
                                ...post,
                                liked: !post.liked,
                                likes_count: post.liked ? post.likes_count - 1 : post.likes_count + 1,
                            };
                        }
                        return post;
                    }));
                }
            });
    };


    const handleFilterChange = (e) => {
        setFilter(e.target.value);
    };

    const filteredPosts = posts.filter(post => {
        if (filter === 'all') return true;
        return post.type === filter;
    });
    return (
        <>
            <div className="flex flex-col items-center mx-auto max-w-screen-lg m-10">
                <div className="text-center my-8">
                    <h1 className="text-3xl font-bold">{community.name}</h1>
                    <p className="text-gray-700">{community.description}</p>
                </div>
                <div className="flex justify-between w-full mb-5">
                    <select onChange={handleFilterChange} value={filter} className="bg-secondary hover:bg-accent text-neutral py-2 px-4 rounded-lg text-base no-underline min-w-[200px] text-center transition-colors duration-300 ease-in-out font-bold mr-5 cursor-pointer">
                        <option value="all">All</option>
                        <option value="advertisement">Advertisements</option>
                        <option value="post">Posts</option>
                    </select>
                    <a
                        href={`/communities/${community.id}/form-create-advertisement-post`}
                        className="bg-secondary hover:bg-accent text-neutral py-2 px-4 rounded-lg text-base no-underline min-w-[200px] text-center transition-colors duration-300 ease-in-out font-bold mr-5"
                    >
                        Create Advertisement / Post
                    </a>

                </div>
                <div className="grid w-full gap-10 grid-cols-3">
                    {filteredPosts.map((post, index) => (
                        <div key={index} className="bg-white w-full rounded-lg shadow-md flex flex-col transition-all overflow-hidden hover:shadow-2xl">
                            <div className="p-6">
                                <div className="pb-3 mb-4 border-b border-stone-200 text-xs font-medium flex justify-between text-neutral">
                                    <span className="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" className="w-6 h-6">
                                            <path strokeLinecap="round" strokeLinejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        <time dateTime={post.created_at}>{new Date(post.created_at).toLocaleDateString('es-ES', {
                                            year: 'numeric',
                                            month: 'long',
                                            day: '2-digit',
                                            hour: '2-digit',
                                            minute: '2-digit',
                                        })}</time>
                                    </span>
                                    <span>
                                        <HeartButton liked={post.liked} likesCount={post.likes_count} onToggleLike={() => toggleLike(post.id)} />
                                    </span>
                                </div>
                                <h3 className="mb-4 font-extrabold text-2xl">
                                    <a href={`/communities/${community.id}/${post.id}`} className="transition-all text-neutral hover:text-secondary">
                                        {post.title}
                                    </a>
                                </h3>
                                <p className="text-neutral text-sm mb-0">
                                    {post.description}
                                </p>
                            </div>
                            {post.images.map((image) => (
                                <div key={image.id} className="mt-auto">
                                    <img src={image.url} alt="" className="rounded-md w-full h-48 object-cover" />
                                </div>
                            ))}
                        </div>
                    ))}
                </div>
            </div>
        </>
    );
}

if (document.getElementById("advertisementList")) {
    createRoot(document.getElementById("advertisementList")).render(<AdvertisementList />);
}
