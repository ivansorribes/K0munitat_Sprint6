import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { createRoot } from 'react-dom/client';
import ReactPaginate from 'react-paginate';
import CommunityCard from './CommunityCard';
import 'tailwindcss/tailwind.css';
import '../../css/community.css'

const CommunitiesList = () => {
  const [communities, setCommunities] = useState([]);
  const [currentPage, setCurrentPage] = useState(0);
  const perPage = 9; // Número de comunidades por página

  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await axios.get('http://localhost/api/communities');
        setCommunities(response.data);
      } catch (error) {
        console.error('Error loading communities:', error.message);
      }
    };

    fetchData();
  }, []);

  const handlePageChange = ({ selected }) => {
    setCurrentPage(selected);
  };

  const displayedCommunities = communities.slice(
    currentPage * perPage,
    (currentPage + 1) * perPage
  );

  return (
    <div className="grid grid-cols-1 md:grid-cols-3 gap-4 mx-4 md:mx-auto">
      <div className="md:col-span-3 text-center">
        <h1 className="text-4xl font-bold my-4">Community List</h1>
        <div className="md:col-span-1 flex flex-col justify-center items-center mt-4 md:mt-0">
          <a
            href="http://localhost/communities/create"
            target="_blank"
            rel="noopener noreferrer"
          >
            <button className="button-create">
              Create
            </button>
          </a>
        </div>
        <div className="container mx-auto">
          <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
            {displayedCommunities.map((community) => (
              <CommunityCard
                key={community.id}
                community={community}
                communityPath={`/community/${community.id}`}
              />
            ))}
          </div>
        </div>
        <div className="flex justify-center mt-5 py-2">
        <ReactPaginate
            previousLabel={'previous'}
            nextLabel={'next'}
            breakLabel={'...'}
            pageCount={Math.ceil(communities.length / perPage)}
            marginPagesDisplayed={2}
            pageRangeDisplayed={5}
            onPageChange={handlePageChange}
            containerClassName={'pagination flex space-x-2 items-center'}
            activeClassName={'active'}
            pageClassName={'bg-white text-black px-4 py-2 rounded-lg text-lg cursor-pointer'}
            breakClassName={'bg-white text-black px-4 py-2 rounded-lg text-lg'}
        />
        </div>
      </div>
    </div>
  );
};

if (document.getElementById('communityList')) {
  createRoot(document.getElementById('communityList')).render(<CommunitiesList />);
}
