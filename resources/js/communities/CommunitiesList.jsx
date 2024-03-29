import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { createRoot } from 'react-dom/client';
import ReactPaginate from 'react-paginate';
import CommunityCard from './CommunityCard';
import 'tailwindcss/tailwind.css';
import '../../css/community.css';
import useApiSwitcher from '../hooks/useApiSwitcher'; // Importa el hook useApiSwitcher
import ToggleButton from '../components/bottons/toggle';

const CommunitiesList = () => {
  const [currentPage, setCurrentPage] = useState(0);
  const [option, setOption] = useState('option1');
  const perPage = 9;

  const { data: communities, loading } = useApiSwitcher(option);

  const handlePageChange = ({ selected }) => {
    setCurrentPage(selected);
  };

  const displayedCommunities = communities.slice(
    currentPage * perPage,
    (currentPage + 1) * perPage
  );

  const toggleOption = () => {
    setOption(option === 'option1' ? 'option2' : 'option1');
  };

  return (
    <div className="container mx-auto mt-[5vw] md:mt-[6] lg:mt-[16] xl:mt-[20]">
      <div className="flex justify-between items-center">
        <ToggleButton onToggle={toggleOption} checked={option === 'option2'} text={option === 'option1' ? 'All Communities' : 'My Communities'} />
        <div className="ml-auto"> 
          <a
            href="/communities/create"
            rel="noopener noreferrer"
          >
            <button className="button-create">
              Create
            </button>
          </a>
        </div>
      </div>
      <div className="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4"> {/* Agrega margen entre el botón y el listado */}
        {displayedCommunities.map((community) => (
          <CommunityCard
            key={community.id}
            community={community}
            communityPath={`/community/${community.id}`}
          />
        ))}
      </div>
      <div className="flex justify-center mt-5">
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
  );
};

if (document.getElementById('communityList')) {
  createRoot(document.getElementById('communityList')).render(<CommunitiesList />);
}

export default CommunitiesList;
