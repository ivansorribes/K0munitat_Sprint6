import React from 'react';

const Card = ({ community, onEditClick, onDeleteClick }) => {
    const handleEditClick = () => {
        onEditClick(community);
      };
    
      const handleDeleteClick = () => {
        onDeleteClick(community.id);
      };
    
      return (
        <div className="bg-white p-6 rounded-md shadow-md">
          <h2 className="text-2xl font-bold mb-2">{community.name}</h2>
          <p className="text-gray-500 mb-4">{community.description}</p>
    
          <button onClick={handleEditClick} className="text-blue-500 hover:underline mr-2">
            Editar Comunidad
          </button>
          <button onClick={handleDeleteClick} className="text-red-500 hover:underline">
            Borrar Comunidad
          </button>
        </div>
      );
    };

export default Card;