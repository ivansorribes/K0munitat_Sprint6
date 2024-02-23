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
                    <div className="pb-3 mb-4 border-b border-stone-200 text-xs font-medium flex justify-between text-blue-900">
                        <span className="flex items-center gap-1">
                            {post.created_at}
                        </span>
                        <span>
                            {post.type}
                        </span>
                    </div>
                    <h3 className="mb-4 font-semibold text-2xl">
                        {post.title}
                    </h3>
                    <p className="text-sky-800 text-sm mb-0">
                        {post.description}
                    </p>
                </div>
                {post.images.map((image) => (
                    <div key={image.id} className="mt-auto">
                        <img src={image.url} alt="" className="w-full h-48 object-cover" />
                    </div>
                ))}
            </div>
        </div>
    );
}

if (document.getElementById("advertisementDetails")) {
    createRoot(document.getElementById("advertisementDetails")).render(<AdvertisementDetails />);
}
