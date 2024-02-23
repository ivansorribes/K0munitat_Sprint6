import React, { useState, useEffect } from "react";
import { createRoot } from "react-dom/client";

export default function AdvertisementComments() {
    const [post, setPost] = useState(null);

    useEffect(() => {
        // Simulación de carga de datos
        // Asegúrate de que window.postData esté definido antes de intentar usar este componente
        setPost(window.postData ? window.postData : { comments: [] });
    }, []);

    if (!post) {
        return <div>Loading...</div>;
    }

    return (
        <section className="bg-white dark:bg-gray-900 py-8 lg:py-16 antialiased">
            <div className="max-w-2xl mx-auto px-4">
                <h2 className="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white mb-6">

                </h2>
                <div className="mb-6">
                    <textarea
                        id="comment"
                        rows="4"
                        className="w-full p-2 text-sm text-black border-2 border-gray-200 dark:border-gray-700 rounded-lg"
                        placeholder="Write a comment..."
                        required
                    />
                    <button
                        type="submit"
                        className="mt-2 py-2 px-4 text-xs font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700"
                    >
                        Post comment
                    </button>
                </div>

                <article className="p-6 mb-4 text-base bg-white rounded-lg dark:bg-gray-900 border border-gray-200 dark:border-gray-700">
                    <footer className="mb-2">
                        <div className="flex items-center justify-between">
                            <p className="text-sm text-gray-900 dark:text-white font-semibold">
                                hola
                            </p>
                            <p className="text-sm text-gray-600 dark:text-gray-400">

                            </p>
                        </div>
                    </footer>
                    <p className="text-gray-500 dark:text-gray-400">

                    </p>
                </article>

            </div>
        </section>
    );
}

if (document.getElementById("advertisementComments")) {
    createRoot(document.getElementById("advertisementComments")).render(<AdvertisementComments />);
}
