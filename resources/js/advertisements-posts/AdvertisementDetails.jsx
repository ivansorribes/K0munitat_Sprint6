import React, { useState, useEffect } from "react";
import { createRoot } from "react-dom/client";

export default function AdvertisementDetails() {
    const [post, setPost] = useState(null);
    const community = window.communityData;
    console.log(post)

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

    if (!post) {
        return <div>Loading...</div>;
    }

    return (
        <div className="flex flex-col items-center mx-auto max-w-screen-lg m-10">

            <div className="bg-white w-full rounded-lg shadow-md flex flex-col transition-all overflow-hidden hover:shadow-2xl">
                <div className="p-6">
                    <div className="pb-3 mb-4 border-b border-stone-200 text-xs font-medium flex justify-between text-neutral">
                        <span className="flex items-center gap-1">
                            Created: {new Date(post.created_at).toLocaleDateString('es-ES', {
                                year: 'numeric',
                                month: '2-digit',
                                day: '2-digit',
                                hour: '2-digit',
                                minute: '2-digit',
                                second: '2-digit',
                                hour12: false
                            })}
                        </span>
                        <span>
                            {post.type}
                        </span>
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
