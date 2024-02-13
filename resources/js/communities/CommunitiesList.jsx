import React, { useState, useEffect } from 'react';
import axios from 'axios';
import CommunityCard from './CommunityCard';
import { createRoot } from 'react-dom/client';

import 'tailwindcss/tailwind.css';

const CommunitiesList = () => {
  const [communities, setCommunities] = useState([]);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await axios.get('http://localhost/api/communities');
        setCommunities(response.data);
        console.log(response.data);
      } catch (error) {
        console.error('Error loading communities:', error.message);
      }
    };

    fetchData();
  }, []);

  return (
    <div className="grid grid-cols-3 gap-4">
      {communities.map((community) => (
        <CommunityCard
          key={community.id}
          community={community}
          communityPath={`/community/${community.id}`}
        />
      ))}
    </div>
  );
};

const root = createRoot(document.getElementById('communityList'));
root.render(<CommunitiesList />);
