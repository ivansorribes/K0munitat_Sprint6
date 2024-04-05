import React, { useState, useEffect } from "react";
import { createRoot } from "react-dom/client";

const BlogCard = () => {
  const [blog, setBlog] = useState([]);
  const [likedPosts, setLikedPosts] = useState([]);
  const [searchTerm, setSearchTerm] = useState("");
  const [currentPage, setCurrentPage] = useState(1);
  const postsPerPage = 6;

  useEffect(() => {
    if (window.blogData) {
      setBlog(window.blogData);
      setLikedPosts(new Array(window.blogData.length).fill(false));
    }
  }, []);

  const filteredPosts = blog.filter((post) =>
    post.title.toLowerCase().includes(searchTerm.toLowerCase())
  );

  const indexOfLastPost = currentPage * postsPerPage;
  const indexOfFirstPost = indexOfLastPost - postsPerPage;
  const currentPosts = filteredPosts.slice(indexOfFirstPost, indexOfLastPost);

  const paginate = (pageNumber) => setCurrentPage(pageNumber);

  const handleSearch = (e) => {
    setSearchTerm(e.target.value);
    setCurrentPage(1); // Reset page number when search term changes
  };

  const handleLike = (index) => {
    const updatedLikedPosts = [...likedPosts];
    updatedLikedPosts[index] = !updatedLikedPosts[index];
    setLikedPosts(updatedLikedPosts);
  };

  return (
    <>
      <div className="relative flex min-h-screen flex-col overflow-hidden bg-gray-50 py-6 sm:py-12">
        <div className="m-10 flex flex-col mx-auto max-w-screen-lg">
          <div className="flex mt-4 mb-4">
            <input
              type="text"
              placeholder="Search..."
              value={searchTerm}
              onChange={handleSearch}
              className="px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-blue-500"
            />
          </div>
          <div className="grid w-full gap-10 grid-cols-3">
            {currentPosts.map((blogPost, index) => (
              <div
                key={index}
                className="bg-white w-full rounded-lg shadow-md flex flex-col transition-all overflow-hidden hover:shadow-2xl"
              >
                <a href={`/blog/show/${blogPost.id}`} className="block">
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
                        <time dateTime={blogPost.created_at}>
                          {new Date(blogPost.created_at).toLocaleDateString(
                            "es-ES",
                            {
                              year: "numeric",
                              month: "long",
                              day: "2-digit",
                              hour: "2-digit",
                              minute: "2-digit",
                            }
                          )}
                        </time>
                      </span>
                      <button
                        onClick={() => handleLike(index)}
                        className={`text-xl ${
                          likedPosts[index] ? "text-red-500" : "text-gray-500"
                        }`}
                      >
                        &#9825;
                      </button>
                    </div>
                    <h3 className="mb-4 font-semibold text-neutral text-2xl">
                      {blogPost.title}
                    </h3>
                    <p className="text-neutral text-sm mb-0">
                      {blogPost.description}
                    </p>
                  </div>
                  <div className="mt-auto">
                    {blogPost.post_image && (
                      <img
                        src={`/img/fotosblog/${blogPost.post_image}`}
                        alt={blogPost.post_image}
                        className="w-full h-48 object-cover"
                      />
                    )}
                  </div>
                </a>
              </div>
            ))}
          </div>
          <div className="flex justify-center  mt-16">
            {[
              ...Array(Math.ceil(filteredPosts.length / postsPerPage)).keys(),
            ].map((number) => (
              <button
                key={number}
                onClick={() => paginate(number + 1)}
                className={`mx-1 px-3 py-1 rounded ${
                  currentPage === number + 1
                    ? "bg-green-500 text-white"
                    : "bg-gray-300 text-gray-700 hover:bg-gray-400"
                }`}
              >
                {number + 1}
              </button>
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
