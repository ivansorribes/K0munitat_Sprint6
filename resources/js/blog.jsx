import React, { useState, useEffect } from "react";
import { createRoot } from "react-dom/client";

const BlogCard = () => {
  const [blog, setblog] = useState([]);
  useEffect(() => {
    if (window.blogData) {
      setblog(window.blogData);
    }
  }, []);
  return (
    <>
      <div className="relative flex min-h-screen flex-col justify-center overflow-hidden bg-gray-50 py-6 sm:py-12">
        <div className="m-10 flex flex-col items-center mx-auto max-w-screen-lg">
          {/* <div className="header flex w-full justify-center">
            <h2 className="font-black pb-10 mb-20 text-5xl text-blue-900 before:block before:absolute before:bg-sky-300  relative before:w-1/3 before:h-1 before:bottom-0 before:left-1/3">
              Advertisements
            </h2>
          </div> */}
          <div className="grid w-full gap-10 grid-cols-3">
            {blog.map((blog, index) => (
              <div
                key={index}
                className="bg-white w-full rounded-lg shadow-md flex flex-col transition-all overflow-hidden hover:shadow-2xl"
              >
                <div className="p-6">
                  <div className="pb-3 mb-4 border-b border-stone-200 text-xs font-medium flex justify-between text-neutral">
                    <span className="flex items-center gap-1">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        strokeWidth="1.5"
                        stroke="currentColor"
                        className="w-6 h-6"
                      >
                        <path
                          strokeLinecap="round"
                          strokeLinejoin="round"
                          d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                        />
                      </svg>
                      <time dateTime={blog.created_at}>{new Date(blog.created_at).toLocaleDateString('es-ES', {
                        year: 'numeric',
                        month: 'long',
                        day: '2-digit',
                        hour: '2-digit',
                        minute: '2-digit',
                      })}</time>
                    </span>

                  </div>
                  <h3 className="mb-4 font-semibold text-2xl">
                    <a
                      href=""
                      className="transition-all text-neutral hover:text-secondary"
                    >
                      {blog.title}
                    </a>
                  </h3>
                  <p className="text-neutral text-sm mb-0">
                    {blog.description}
                  </p>
                </div>
                <div className="mt-auto">
                  {blog.post_image && (
                    <img
                      src={`/img/fotosblog/${blog.post_image}`}
                      alt={blog.post_image}
                      className="w-full h-48 object-cover"
                    />
                  )}
                </div>
              </div>
            ))}
          </div>
        </div>
      </div>
    </>
  );
};

if (document.getElementById("blog")) {
  const root = createRoot(document.getElementById("blog"));
  root.render(<BlogCard />);
}
