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
  const [currentPage, setCurrentPage] = useState(1); // Empezamos desde la página 1
  const perPage = 9;
  const [communities, setCommunities] = useState([]);
  const [loading, setLoading] = useState(true);
  const scrollRef = useRef();

  // Usa el hook useApiSwitcher con el valor de la opción actual
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

  const fetchData = async () => {
    try {
      setCurrentPage(prevPage => prevPage + 1);
    } catch (error) {
      console.error('Error fetching data:', error);
    }
  };

  const toggleOption = () => {
    setOption(option === 'option1' ? 'option2' : 'option1');
    setCurrentPage(1); // Reiniciamos la página cuando cambiamos la opción
    setCommunities([]); // Limpiamos las comunidades cuando cambiamos la opción
    fetchData(); // Volvemos a cargar los datos con la nueva opción
    scrollToTop(); // Desplazamos al principio de la lista
  };

  const scrollToTop = () => {
    scroll.scrollToTop({
      containerId: 'scroll-container',
      duration: 500,
      smooth: 'easeInOutQuad'
    });
  };

  return (
    <div className="container mx-auto mt-[5vw] md:mt-[8] lg:mt-[10] xl:mt-[12]">
      <div className="flex justify-between items-center mb-4">
        <ToggleButton onToggle={toggleOption} checked={option === 'option2'} text={option === 'option1' ? 'All Communities' : 'My Communities'} />
        <a
          href="/communities/create"
          rel="noopener noreferrer"
        >
          <ButtonCreate label = 'Create' />
        </a>
      </div>
      <div id="scroll-container" ref={scrollRef} style={{ overflowY: 'scroll', height: '60vh' }}>
        <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
          {communities.map((community) => (
            <CommunityCard
              key={community.id}
              community={community}
              communityPath={`/community/${community.id}`}
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
