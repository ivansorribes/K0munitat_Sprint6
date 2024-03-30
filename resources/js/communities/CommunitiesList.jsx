import React, { useState, useEffect, useRef } from 'react';
import axios from 'axios';
import { createRoot } from 'react-dom/client';
import CommunityCard from './CommunityCard';
import 'tailwindcss/tailwind.css';
import '../../css/community.css';
import useApiSwitcher from '../hooks/useApiSwitcher'; // Importa el hook useApiSwitcher
import ToggleButton from '../components/buttons/toggle';
import { animateScroll as scroll } from 'react-scroll';
import {ButtonCreate} from '../components/buttons';

const CommunitiesList = () => {
  const [option, setOption] = useState('option1');
  const [currentPage, setCurrentPage] = useState(1);
  const perPage = 9;
  const [communities, setCommunities] = useState([]);
  const [loading, setLoading] = useState(true);
  const scrollRef = useRef();
  const [userCommunities, setUserCommunities] = useState([]);
  const [searchTerm, setSearchTerm] = useState(''); // Estado para almacenar el término de búsqueda

  useEffect(() => {
    const fetchUserCommunities = async () => {
      try {
        const response = await axios.get('/communitiesUserId');
        setUserCommunities(response.data);
      } catch (error) {
        console.error('Error fetching user communities:', error);
      }
    };

    fetchUserCommunities();
  }, []);

  const { data: apiData, loading: apiLoading } = useApiSwitcher(option, currentPage);

  useEffect(() => {
    setCommunities(prevCommunities => [...prevCommunities, ...apiData]);
    setLoading(apiLoading);
  }, [apiData, apiLoading]);

  useEffect(() => {
    const handleScroll = () => {
      if (scrollRef.current && scrollRef.current.scrollHeight - scrollRef.current.scrollTop === scrollRef.current.clientHeight) {
        fetchData();
      }
    };

    scrollRef.current.addEventListener('scroll', handleScroll);

    return () => {
      if (scrollRef.current) {
        scrollRef.current.removeEventListener('scroll', handleScroll);
      }
    };
  }, []);

  const fetchData = () => {
    setCurrentPage(prevPage => prevPage + 1);
  };

  const toggleOption = () => {
    setOption(option === 'option1' ? 'option2' : 'option1');
    setCurrentPage(1);
    setCommunities([]);
    fetchData();
    scrollToTop();
  };

  const scrollToTop = () => {
    scroll.scrollToTop({
      containerId: 'scroll-container',
      duration: 500,
      smooth: 'easeInOutQuad'
    });
  };

  // Función para manejar el cambio en el cuadro de búsqueda
  const handleSearchChange = (event) => {
    setSearchTerm(event.target.value);
  };

  // Filtrar comunidades basadas en el término de búsqueda
  const filteredCommunities = communities.filter(community =>
    community.name.toLowerCase().includes(searchTerm.toLowerCase())
  );

  return (
    <div className="container mx-auto mt-[5vw] md:mt-[8] lg:mt-[10] xl:mt-[12]">
      <div className="flex justify-between items-center mb-4">
        <ToggleButton onToggle={toggleOption} checked={option === 'option2'} text={option === 'option1' ? 'All Communities' : 'My Communities'} />
        {/* Cuadro de búsqueda */}
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
      <div id="scroll-container" ref={scrollRef} style={{ overflowY: 'scroll', height: '60vh' }}>
        <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
          {filteredCommunities.map((community) => (
            <CommunityCard
              key={community.id}
              community={community}
              option={userCommunities.includes(community.id) || community.private === 0 ? 'enter' : 'send'}
            />
          ))}
        </div>
        {loading && <p>Loading...</p>}
      </div>
    </div>
  );
};

if (document.getElementById('communityList')) {
  createRoot(document.getElementById('communityList')).render(<CommunitiesList />);
}

export default CommunitiesList;
