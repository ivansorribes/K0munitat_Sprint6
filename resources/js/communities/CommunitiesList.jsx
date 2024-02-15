import React, { useState, useEffect } from 'react';
import axios from 'axios';
import CommunityCard from './CommunityCard';
import { createRoot } from 'react-dom/client';
import { Link } from 'react-router-dom';

import 'tailwindcss/tailwind.css';

const CommunitiesList = () => {
  const [communities, setCommunities] = useState([]);

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

  return (
    <div className="grid grid-cols-1 md:grid-cols-3 gap-4 mx-4 md:mx-auto">
      <div className="md:col-span-3 text-center">
        <h1 className="text-4xl font-bold my-4">Listado de comunidades</h1>
        <div className="md:col-span-1 flex flex-col justify-center items-center mt-4 md:mt-0">
        <a href="http://localhost/communities/create" target="_blank" rel="noopener noreferrer">
          <button className="bg-green-500 text-white px-4 py-2 rounded-lg text-lg mt-4">
            Crear
          </button>
        </a>
      </div>
        {communities.map((community) => (
          <CommunityCard
            key={community.id}
            community={community}
            communityPath={`/community/${community.id}`}
          />
        ))}
      </div>
    </div>
  );
};

const root = createRoot(document.getElementById('communityList'));
root.render(<CommunitiesList />);
