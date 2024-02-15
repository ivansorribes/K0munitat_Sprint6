import React, { useState, useEffect } from 'react';
import axios from 'axios';
import CommunityCard from './CommunityCard';

const CommunitiesList = () => {
  const [communities, setCommunities] = useState([]);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await axios.get('http://localhost/communities');
        setCommunities(response.data);
      } catch (error) {
        console.error('Error loading communities:', error.message);
      }
    };

    fetchData();
  }, []);

  return (
    <div className="grid grid-cols-3 gap-4">
      {communities.map((community) => (
        <CommunityCard key={community.id} community={community} />
      ))}
    </div>
  );
};

export default CommunitiesList;