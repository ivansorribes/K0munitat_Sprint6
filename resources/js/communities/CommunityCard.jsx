import React from 'react';
import 'tailwindcss/tailwind.css';
import '../../css/community.css'

const CommunityCard = ({ community, onViewClick }) => {
  const communityUrl = `http://localhost/communities/${community.id}`;

  return (
    <div className="bg-white p-6 rounded-md shadow-md">
      <h2 className="text-2xl font-bold mb-2">{community.name}</h2>
      <p className="text-gray-500 mb-4">{community.description}</p>

      <a href={communityUrl} target="_blank" rel="noopener noreferrer">
        <button className="button-card">
          Enter Community
        </button>
      </a>
    </div>
  );
};

export default CommunityCard;