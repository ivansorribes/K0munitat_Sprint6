import React, { useState, useEffect, useRef } from "react";
import axios from "axios";
import { createRoot } from "react-dom/client";
import CommunityCard from "./CommunityCard";
import "tailwindcss/tailwind.css";
import "../../css/community.css";
import { animateScroll as scroll } from "react-scroll";
import { ButtonCreate, ButtonDelete } from "../components/buttons";
import CommunitySelector from "../components/select/communityRegion";
import ToggleButton from "../components/buttons/toggle";

const CommunitiesList = () => {
  const [loading, setLoading] = useState(true);
  const scrollRef = useRef();
  const [communities, setCommunities] = useState([]);
  const [searchTerm, setSearchTerm] = useState("");
  const [showScrollButton, setShowScrollButton] = useState(false);
  const [user, setUser] = useState([]);
  const [filteredCommunities, setFilteredCommunities] = useState([]);
  const [totalPages, setTotalPages] = useState(0);
  const [currentPage, setCurrentPage] = useState(1);
  const [selectedCommunity, setSelectedCommunity] = useState(null);
  const [selectedRegion, setSelectedRegion] = useState(null);
  const [showUserCommunities, setShowUserCommunities] = useState(false);

  useEffect(() => {
    // Obtener el valor de regionId del elemento oculto
    const regionIdElement = document.getElementById("regionId");
    if (regionIdElement) {
      const regionId = regionIdElement.value;
      setSelectedRegion({ value: regionId, label: `Region ${regionId}` });
    }

    // Obtener el valor de regionId desde la URL
    const urlParams = new URLSearchParams(window.location.search);
    const regionIdFromURL = urlParams.get("regionId");
    if (regionIdFromURL) {
      setSelectedRegion({
        value: regionIdFromURL,
        label: `Region ${regionIdFromURL}`,
      });
    }
  }, []);

  const clearRegionFilter = () => {
    // Eliminar el parámetro regionId de la URL
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.delete("regionId");
    const newUrl = window.location.pathname + "?" + urlParams.toString();
    window.history.replaceState({}, "", newUrl);

    // Limpiar el valor del input oculto regionId
    const regionIdElement = document.getElementById("regionId");
    if (regionIdElement) {
      regionIdElement.value = "";
    }

    // Limpiar el filtro de regiones en el estado
    setSelectedRegion(null);
  };

  const clearFilters = () => {
    setSelectedCommunity(null);
    setSelectedRegion(null); // Limpiar el filtro de región
    setSearchTerm("");
    setShowUserCommunities(false);
    // Llamar a la función clearRegionFilter para eliminar el filtro de región
    clearRegionFilter();
  };
  const fetchData = async (
    page,
    search = "",
    communityAutId = null,
    regionId = null,
    showUserCommunities = false
  ) => {
    setLoading(true);
    try {
      let url = `/communitiesList?page=${page}&search=${search}`;
      if (communityAutId) {
        url += `&communityAutId=${communityAutId}`;
      }
      if (regionId) {
        url += `&regionId=${regionId}`;
      }
      if (showUserCommunities) {
        url += `&showUserCommunities=true`;
      }
      const response = await axios.get(url);
      if (page === 1) {
        setCommunities(response.data.communities.data); // Limpiar y establecer la lista en la primera página
      } else {
        setCommunities((prevCommunities) => [
          ...prevCommunities,
          ...response.data.communities.data,
        ]); // Concatenar los nuevos resultados a la lista existente en páginas posteriores
      }
      setTotalPages(response.data.communities.last_page);
      setUser(response.data.user);
    } catch (error) {
      console.error("Error fetching communities:", error);
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    const fetchDataWithFilters = async () => {
      setLoading(true);
      try {
        await fetchData(
          currentPage,
          searchTerm,
          selectedCommunity?.value,
          selectedRegion?.value,
          showUserCommunities
        );
      } catch (error) {
        console.error("Error fetching communities:", error);
      } finally {
        setLoading(false);
      }
    };

    fetchDataWithFilters();
  }, [
    currentPage,
    searchTerm,
    selectedCommunity,
    selectedRegion,
    showUserCommunities,
  ]);

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
  }, [selectedCommunity, searchTerm, selectedRegion, showUserCommunities]);

  useEffect(() => {
    const filtered = communities.filter((community) =>
      community.name.toLowerCase().includes(searchTerm.toLowerCase())
    );
    setFilteredCommunities(filtered);
  }, [communities, searchTerm]);

  const handleCommunityChange = (selectedOption) => {
    setSelectedCommunity(selectedOption);
    setCurrentPage(1); // Reiniciar la página actual
    setSelectedRegion(null);
    setCommunities([]); // Limpiar la lista de comunidades
    fetchData(
      1,
      searchTerm,
      selectedOption ? selectedOption.value : null,
      null
    );
  };

  const handleRegionChange = (selectedOption) => {
    setSelectedRegion(selectedOption);
    setCurrentPage(1); // Reiniciar la página actual
    setCommunities([]); // Limpiar la lista de comunidades
    fetchData(
      1,
      searchTerm,
      selectedCommunity ? selectedCommunity.value : null,
      selectedOption ? selectedOption.value : null
    );
  };

  const handleToggleUserCommunities = (checked) => {
    setShowUserCommunities(checked);
  };

  const handleRegionFilter = () => {
    const regionIdElement = document.getElementById("regionIdElement");
    if (regionIdElement) {
      const regionId = regionIdElement.value;
      fetchDataWithRegionId(
        currentPage,
        searchTerm,
        selectedCommunity?.value,
        regionId,
        showUserCommunities
      );
    }
  };

  const fetchDataWithRegionId = async (
    page,
    search = "",
    communityAutId = null,
    showUserCommunities = false
  ) => {
    setLoading(true);
    try {
      const regionIdElement = document.getElementById("regionIdElement"); // Obtener el elemento del DOM que contiene regionId
      const regionId = regionIdElement.value; // Obtener el valor de regionId del elemento del DOM

      let url = `/communitiesList?page=${page}&search=${search}`;
      if (communityAutId) {
        url += `&communityAutId=${communityAutId}`;
      }
      if (regionId) {
        url += `&regionId=${regionId}`;
      }
      if (showUserCommunities) {
        url += `&showUserCommunities=true`;
      }

      const response = await axios.get(url);
      setCommunities(response.data.communities.data);
      setTotalPages(response.data.communities.last_page);
      setUser(response.data.user);
    } catch (error) {
      console.error("Error fetching communities:", error);
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="container py-10 mx-auto mt-[6vw] md:mt-[8] lg:mt-[8] xl:mt-[12] relative">
      <div className="flex flex-wrap justify-center items-center mb-4">
        <div className="grid grid-cols-1 md:grid-cols-4 md:gap-4 md:items-center">
          <div className="col-span-1 md:mr-4">
            <a href="/communities/create" rel="noopener noreferrer">
              <ButtonCreate label="Create" className="mr-2 p-3 md:p-2" />
            </a>
          </div>
          <div className="col-span-1 md:mr-4">
            <ToggleButton
              onToggle={handleToggleUserCommunities}
              checked={showUserCommunities}
              text="Show User Communities"
            />
          </div>
          <div className="md:flex-grow md:mr-2 col-span-3 md:col-span-1 mb-4 md:mb-0">
            {/* Agregamos margen inferior solo en dispositivos móviles */}
            <CommunitySelector
              onCommunityChange={handleCommunityChange}
              onRegionChange={handleRegionChange}
              className="w-full"
            />
          </div>
          <div className="md:w-auto md:flex md:items-center col-span-3 md:col-span-1 flex flex-col md:flex-row justify-center md:justify-end">
            <input
              type="text"
              placeholder="Search Communities"
              value={searchTerm}
              onChange={handleSearchChange}
              className="px-4 py-3 md:px-2 md:py-1 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 w-full md:w-auto md:mr-2 mb-2 md:mb-0 mb-input-search"
            />
            <div className="flex justify-center md:justify-start">
              <ButtonDelete onClick={clearFilters} label="Clear Filters" />
            </div>
          </div>
        </div>
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
              className="p-4"
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
