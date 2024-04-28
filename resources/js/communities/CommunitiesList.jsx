import React, { useState, useEffect, useRef } from 'react';
import axios from 'axios';
import { createRoot } from 'react-dom/client';
import CommunityCard from './CommunityCard';
import 'tailwindcss/tailwind.css';
import '../../css/community.css';
import useApiSwitcher from '../hooks/useApiSwitcher';
import ToggleButton from '../components/buttons/toggle';
import { animateScroll as scroll } from 'react-scroll';
import {ButtonCreate} from '../components/buttons';

const CommunitiesList = () => {
  const [option, setOption] = useState('option1');
  const [currentPage, setCurrentPage] = useState(1);
  const [communities, setCommunities] = useState([]);
  const [loading, setLoading] = useState(true);
  const scrollRef = useRef();
  const [userCommunities, setUserCommunities] = useState([]);
  const [searchTerm, setSearchTerm] = useState('');
  const [showScrollButton, setShowScrollButton] = useState(false);
  const { data: responseData, loading: apiLoading } = useApiSwitcher(option);
  const [user, setUser] = useState([]);
  const [filteredCommunities, setFilteredCommunities] = useState([]);




  const fetchDataAllComunities = () => {    
    console.log("hola")
    return axios.get('/communitiesList')
      .then((response) => { 
        console.log(response.data.communities.data);
        setUserCommunities(response.data.communities.data);  });

  }
  
  const fetchDataUserComunities = () => {    
    return axios.get('/communitiesUser')
      .then((response) => { 
        console.log( "fetch del user " , response.data.communities);
        setUserCommunities(response.data.communities);  });

  }
  useEffect(() => {
    fetchDataUserComunities();
    fetchDataAllComunities();
  }, [])


  useEffect(() => {
    // Verificar si el usuario tiene comunidades o no
    if (!apiLoading && responseData) {
      if (responseData.hasCommunities) {
        setUserCommunities(responseData.communities);
      } else {
        // Mostrar "Hola Mundo" cuando el usuario no tiene comunidades
        console.log("error el usuario no tiene comunidades");
      }
    }
  }, [apiLoading, responseData]);
 
  useEffect(() => {
    const handleScroll = () => {
      if (scrollRef.current) {
        const { scrollTop, scrollHeight, clientHeight } = scrollRef.current;
        setShowScrollButton(scrollTop > clientHeight / 2);
        if (scrollTop + clientHeight >= scrollHeight && !loading && currentPage < responseData.communities.last_page) {
          fetchData();
        }
      }
    };

    scrollRef.current.addEventListener('scroll', handleScroll);

    return () => {
      if (scrollRef.current) {
        scrollRef.current.removeEventListener('scroll', handleScroll);
      }
    };
  }, [loading, currentPage, responseData]);

  const fetchData = async () => {
    setLoading(true);
    setCurrentPage(prevPage => prevPage + 1);
    try {
      const response = await axios.get(`/communitiesList?page=${currentPage + 1}`);
      setUserCommunities(prevCommunities => [...prevCommunities, ...response.data.communities.data]);
    } catch (error) {
      console.error('Error fetching communities:', error);
    } finally {
      setLoading(false); 
    }
  };
  const toggleOption = async () => {
    setOption(option === 'option1' ? 'option2' : 'option1');
    setCurrentPage(1);
    scrollToTop();
  
    try {
      setLoading(true);
      if (option === 'option1') {
        await fetchDataAllComunities();
        console.log("option 1");
      }
      if (option === 'option2') {
        await fetchDataUserComunities();
        console.log("option 2");
      }
    } catch (error) {
      console.error('Error fetching communities:', error);
    } finally {
      setLoading(false);
    }
  };
  

  const scrollToTop = () => {
    scroll.scrollToTop({
      containerId: 'scroll-container',
      duration: 500,
      smooth: 'easeInOutQuad'
    });
  };

  const handleSearchChange = (event) => {
    setSearchTerm(event.target.value);
  };

  useEffect(() => {
    const filtered = userCommunities.filter(community =>
      community.name.toLowerCase().includes(searchTerm.toLowerCase())
    );
    setFilteredCommunities(filtered);
  }, [userCommunities, searchTerm]);
  
  

  const handleScrollToTop = () => {
    scroll.scrollToTop({
      containerId: 'scroll-container',
      duration: 500,
      smooth: 'easeInOutQuad'
    });
  };

  return (
    <div className="container mx-auto mt-[6vw] md:mt-[8] lg:mt-[10] xl:mt-[12] relative">
      <div className="flex justify-between items-center mb-4">
        <ToggleButton onToggle={toggleOption} checked={option === 'option2'} text={option === 'option1' ? 'My Communities' : 'All Communities'}  />
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
        {showScrollButton && (
          <button onClick={handleScrollToTop} className="fixed bottom-4 right-4 bg-blue-500 text-white px-4 py-2 rounded-full shadow-md hover:bg-blue-600 focus:outline-none">
            <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
            </svg>
          </button>
        )}
        <div className="grid grid-cols-1 md:grid-cols-4 gap-4">
         
       
        {userCommunities.length > 0 && filteredCommunities.map((community) => (
  <CommunityCard
    key={community.id}
    community={community}
    option={userCommunities.includes(community.id) || community.private === 0 ? 'enter' : 'send'}
    user={user}
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
