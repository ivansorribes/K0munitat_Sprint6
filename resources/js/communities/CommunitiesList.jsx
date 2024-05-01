import React, { useState, useEffect, useRef } from "react";
import axios from "axios";
import { createRoot } from "react-dom/client";
import CommunityCard from "./CommunityCard";
import "tailwindcss/tailwind.css";
import "../../css/community.css";
import { animateScroll as scroll } from "react-scroll";
import { ButtonCreate } from "../components/buttons";
import CommunitySelector from "../components/select/communityRegion";

const CommunitiesList = () => {
  const [option, setOption] = useState("option1");
  const [loading, setLoading] = useState(true);
  const scrollRef = useRef();
  const [communities, setCommunities] = useState([]);
  const [searchTerm, setSearchTerm] = useState("");
  const [showScrollButton, setShowScrollButton] = useState(false);
  const [user, setUser] = useState([]);
  const [filteredCommunities, setFilteredCommunities] = useState([]);
  const [totalPages, setTotalPages] = useState(0);
  const [currentPage, setCurrentPage] = useState(1);

  const fetchData = async (page, search = "") => {
    setLoading(true);
    try {
      const response = await axios.get(
        `/communitiesList?page=${page}&search=${search}`
      );
      setCommunities((prevCommunities) => [
        ...prevCommunities,
        ...response.data.communities.data,
      ]);
      setTotalPages(response.data.communities.last_page);
      setUser(response.data.user);
    } catch (error) {
      console.error("Error fetching communities:", error);
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    fetchData(currentPage, searchTerm);
  }, [currentPage, searchTerm]);

  const handleScroll = () => {
    if (scrollRef.current) {
      const { scrollTop, scrollHeight, clientHeight } = scrollRef.current;
      setShowScrollButton(scrollTop > clientHeight / 2);
      if (
        scrollTop + clientHeight >= scrollHeight &&
        !loading &&
        currentPage < totalPages
      ) {
        setCurrentPage((prevPage) => prevPage + 1);
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
    setCommunities([]);
    setCurrentPage(1);
  }, [searchTerm]);

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
        <CommunitySelector />
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
                community.isMember || community.private === 0 ? "enter" : "send"
              }
              user={user}
            />
          ))}
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
