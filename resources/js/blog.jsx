import React, { useState, useEffect, useRef } from "react";
import { createRoot } from "react-dom/client";

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
        {loading && (
          <div className="text-center mt-4">
            <svg
              className="animate-spin h-5 w-5 mr-3 ..."
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
            >
              <circle
                className="opacity-25"
                cx="12"
                cy="12"
                r="10"
                stroke="currentColor"
                strokeWidth="4"
              ></circle>
              <path
                className="opacity-75"
                fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A8.001 8.001 0 0112 4.472v3.087c-3.308.53-5.941 2.64-7.51 5.519L6 12.73zM12 20.944c-2.312 0-4.43-.784-6.127-2.093l1.745-2.418A9.98 9.98 0 0012 19.544v1.4zm7.723-7.785a7.974 7.974 0 01-1.654 2.121l-2.416-1.744c1.88-1.568 2.99-4.201 3.52-7.51h3.09zM5.544 6.278a7.974 7.974 0 011.655-2.12l2.416 1.743c-1.88 1.568-2.99 4.2-3.52 7.509H4.472zm7.398-3.806A7.973 7.973 0 0115.522 6h-3.087a9.981 9.981 0 00-2.048 3.157l2.418 1.745zM12 7.056c1.627 0 3.124.555 4.319 1.482l-1.745 2.417A9.98 9.98 0 0012 8.456V7.056zm6.456 2.466l-2.418-1.745a8.001 8.001 0 012.093 6.126h1.4a9.98 9.98 0 00-1.575-4.381zM6 11.271l-1.745 2.418A7.974 7.974 0 014.472 12h-3.09c.531 3.309 1.64 5.942 3.52 7.511l2.417-1.745zM12 16.944c2.312 0 4.43.784 6.127 2.093l-1.745 2.418A9.98 9.98 0 0012 20.444v-1.4zm-2.73 3.476l2.418 1.745c1.567-1.88 4.2-2.99 7.509-3.52v-3.087a8.001 8.001 0 01-6.126 2.093zM12 19.544c-1.626 0-3.124-.555-4.318-1.482l1.745-2.417A9.98 9.98 0 0012 16.944v1.4zm3.184-2.758l-2.417 1.745A7.974 7.974 0 0112 19.544v3.087c3.309-.531 5.942-1.64 7.51-3.52l-2.418-1.745zM15.522 18.278a7.973 7.973 0 01-1.655 2.12l-2.416-1.743c1.88-1.567 2.99-4.2 3.52-7.509h3.087zm-9.858-1.656l2.418-1.745A7.974 7.974 0 016 12.456v-3.087c-3.309.531-5.942 1.64-7.51 3.52l2.417 1.745zm-1.745-5.836A8.001 8.001 0 014.472 12h3.087c-.531-3.309-1.64-5.942-3.52-7.511l-2.417 1.745zM12 7.944c-2.312 0-4.43-.784-6.127-2.093l1.745-2.418A9.98 9.98 0 0012 2.444v1.4zm2.73-3.476l-2.418-1.745A8.001 8.001 0 019.28 6.73h-1.4a9.98 9.98 0 001.575-4.381l2.418 1.745zM17.556 6.73l-2.417-1.744A8.001 8.001 0 0118.72 6.28v1.4a9.98 9.98 0 00-1.575-4.381l2.418 1.745zM12 2.444c-1.626 0-3.124.555-4.318 1.482l-1.745-2.417A9.98 9.98 0 009.28 0v1.4zm-3.184 2.758l2.417-1.745C12.874 1.579 15.507.47 18.816 0v3.087a8.001 8.001 0 01-6.126 2.093zM4.472 5.722l-2.417-1.745C1.578 5.126.47 7.759 0 11.068h3.087a8.001 8.001 0 012.385-5.346z"
              ></path>
            </svg>
            Cargando...
          </div>
        )}
      </div>
    </div>
  );
};

if (document.getElementById("blog")) {
  const root = createRoot(document.getElementById("blog"));
  root.render(<BlogCard />);
}
