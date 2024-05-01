import React, { useState, useEffect, useRef } from "react";
import axios from "axios";
import { createRoot } from "react-dom/client";
import CommunityCard from "./CommunityCard";
import "tailwindcss/tailwind.css";
import "../../css/community.css";
import useApiSwitcher from "../hooks/useApiSwitcher";
import ToggleButton from "../components/buttons/toggle";
import { animateScroll as scroll } from "react-scroll";
import { ButtonCreate } from "../components/buttons";

const CommunitiesList = () => {
  const [option, setOption] = useState("option1");
  const [currentPage, setCurrentPage] = useState(1);
  const [loading, setLoading] = useState(true);
  const scrollRef = useRef();
  const [communities, setCommunities] = useState([]);
  const [searchTerm, setSearchTerm] = useState("");
  const [showScrollButton, setShowScrollButton] = useState(false);
  const [user, setUser] = useState([]);
  const [filteredCommunities, setFilteredCommunities] = useState([]);
  const [totalPages, setTotalPages] = useState(0); // Nuevo estado para almacenar el número total de páginas

  const fetchData = async (page) => {
    setLoading(true);
    try {
      const response = await axios.get(`/communitiesList?page=${page}`);
      setCommunities((prevCommunities) => [
        ...prevCommunities,
        ...response.data.communities.data,
      ]);
      setTotalPages(response.data.communities.last_page); // Establecer el número total de páginas
      setCurrentPage(page);
    } catch (error) {
      console.error("Error fetching communities:", error);
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    fetchData(1); // Load initial data
  }, []);

  const handleScroll = () => {
    if (scrollRef.current) {
      const { scrollTop, scrollHeight, clientHeight } = scrollRef.current;
      setShowScrollButton(scrollTop > clientHeight / 2);
      if (
        scrollTop + clientHeight >= scrollHeight &&
        !loading &&
        currentPage < totalPages // Comprueba si currentPage es menor que totalPages
      ) {
        fetchData(currentPage + 1); // Load next page
      }
    }
  };

  const scrollToTop = () => {
    scroll.scrollToTop({
      containerId: "scroll-container",
      duration: 500,
      smooth: "easeInOutQuad",
    });
  };

  const handleSearchChange = (event) => {
    setSearchTerm(event.target.value);
  };

  useEffect(() => {
    const filtered = communities.filter((community) =>
      community.name.toLowerCase().includes(searchTerm.toLowerCase())
    );
    setFilteredCommunities(filtered);
  }, [communities, searchTerm]);

  return (
    <div className="container py-10 mx-auto mt-[6vw] md:mt-[8] lg:mt-[10] xl:mt-[12] relative">
      <div className="flex justify-between items-center mb-4">
        <input
          type="text"
          placeholder="Search Communities"
          value={searchTerm}
          onChange={handleSearchChange}
          className="px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
        />
        <a href="/communities/create" rel="noopener noreferrer">
          <ButtonCreate label="Create" />
        </a>
      </div>
      <div
        id="scroll-container"
        ref={scrollRef}
        style={{ overflowY: "scroll", height: "60vh" }}
        onScroll={handleScroll}
      >
        {showScrollButton && (
          <button
            onClick={scrollToTop}
            className="fixed bottom-4 right-4 bg-blue-500 text-white px-4 py-2 rounded-full shadow-md hover:bg-blue-600 focus:outline-none"
          >
            <svg
              className="w-6 h-6"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                strokeLinecap="round"
                strokeLinejoin="round"
                strokeWidth="2"
                d="M5 10l7-7m0 0l7 7m-7-7v18"
              ></path>
            </svg>
          </button>
        )}
        <div className="grid grid-cols-1 md:grid-cols-4 gap-4">
          {filteredCommunities.map((community) => (
            <CommunityCard
              key={community.id}
              community={community}
              option={
                communities.includes(community.id) || community.private === 0
                  ? "enter"
                  : "send"
              }
              user={user}
            />
          ))}
          {/* Mostrar mensaje si el usuario no está unido a ninguna comunidad */}
          {communities.length === 0 && (
            <div className="col-span-4 text-center text-gray-600">
              <p>You are not attached to a community.</p>
            </div>
          )}
        </div>
      </div>
    </div>
  );
};

if (document.getElementById("communityList")) {
  createRoot(document.getElementById("communityList")).render(
    <CommunitiesList />
  );
}
