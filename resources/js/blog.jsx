import React, { useState, useEffect, useRef } from "react";
import { createRoot } from "react-dom/client";
import { HalfCircleSpinner } from "react-epic-spinners";

const BlogCard = () => {
  const [blog, setBlog] = useState([]);
  const [likedPosts, setLikedPosts] = useState([]);
  const [searchTerm, setSearchTerm] = useState("");
  const [loading, setLoading] = useState(false);
  const [currentPage, setCurrentPage] = useState(1);
  const postsPerPage = 6;
  const containerRef = useRef();

  useEffect(() => {
    if (window.blogData) {
      setBlog(window.blogData);
      setLikedPosts(new Array(window.blogData.length).fill(false));
    }
  }, []);

  useEffect(() => {
    const handleScroll = () => {
      const { scrollTop, clientHeight, scrollHeight } = containerRef.current;

      if (scrollTop + clientHeight >= scrollHeight - 20 && !loading) {
        loadMorePosts();
      }
    };

    window.addEventListener("scroll", handleScroll);

    return () => {
      window.removeEventListener("scroll", handleScroll);
    };
  }, [loading]);

  const loadMorePosts = async () => {
    setLoading(true);

    try {
      // Simular una solicitud para cargar más publicaciones
      await new Promise((resolve) => setTimeout(resolve, 1000));

      // Calcular el índice del último post a mostrar
      const lastIndex = currentPage * postsPerPage;

      // Obtener los posts adicionales para mostrar
      const additionalPosts = window.blogData.slice(
        lastIndex,
        lastIndex + postsPerPage
      );

      console.log("Datos adicionales cargados:", additionalPosts);

      // Verificar si hay datos adicionales para cargar
      if (additionalPosts.length === 0) {
        console.log("No hay más datos para cargar.");
        return;
      }

      // Agregar los posts adicionales a la lista de blog
      setBlog((prevBlog) => [...prevBlog, ...additionalPosts]);

      // Actualizar el estado de carga y la página actual
      setCurrentPage((prevPage) => prevPage + 1);
    } catch (error) {
      console.error("Error al cargar más publicaciones:", error);
    } finally {
      // Independientemente del resultado, detener la carga
      setLoading(false);
    }
  };

  useEffect(() => {
    // Cargar los primeros 6 posts al inicio
    const initialPosts = window.blogData.slice(0, postsPerPage);
    setBlog(initialPosts);
    setLikedPosts(new Array(initialPosts.length).fill(false));
  }, []);

  const handleSearch = (e) => {
    setSearchTerm(e.target.value);
    setCurrentPage(1); // Resetear el número de página cuando cambia el término de búsqueda
  };

  const handleLike = (index) => {
    const updatedLikedPosts = [...likedPosts];
    updatedLikedPosts[index] = !updatedLikedPosts[index];
    setLikedPosts(updatedLikedPosts);
  };

  const filteredPosts = blog.filter((post) =>
    post.title.toLowerCase().includes(searchTerm.toLowerCase())
  );

  return (
    <div
      ref={containerRef}
      className="relative flex min-h-screen flex-col overflow-y-auto bg-gray-50 py-6 sm:py-12"
    >
      <div className="flex flex-col items-center mx-auto max-w-screen-lg">
        <div className="flex mb-4">
          <input
            type="text"
            placeholder="Search..."
            value={searchTerm}
            onChange={handleSearch}
            className="px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
          />
        </div>
        <div className="grid w-full gap-10 grid-cols-3">
          {filteredPosts.map((blogPost, index) => (
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
                        {new Date().toLocaleDateString("es-ES", {
                          year: "numeric",
                          month: "long",
                          day: "2-digit",
                          hour: "2-digit",
                          minute: "2-digit",
                        })}
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
        {
          <div className="text-center mt-8">
            <HalfCircleSpinner color="green"></HalfCircleSpinner>
          </div>
        }
      </div>
    </div>
  );
};

if (document.getElementById("blog")) {
  const root = createRoot(document.getElementById("blog"));
  root.render(<BlogCard />);
}
