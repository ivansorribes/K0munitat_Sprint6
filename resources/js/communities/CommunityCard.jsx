import React from 'react';
import 'tailwindcss/tailwind.css';

const CommunityCard = ({ community, onViewClick }) => {
  return (
    <div className="bg-white p-6 rounded-md shadow-md">
      <h2 className="text-2xl font-bold mb-2">{community.name}</h2>
      <p className="text-gray-500 mb-4">{community.description}</p>

      <div className="bg-white p-6 rounded-md shadow-md">
        <button onClick={onViewClick} className="text-green-500 hover:underline mr-2">
          Ver Comunidad
        </button>
      </div>
    </div>
  );
};

export default CommunityCard;
