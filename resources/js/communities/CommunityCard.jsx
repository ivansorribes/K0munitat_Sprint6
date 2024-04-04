import React, { useState } from 'react';
import 'tailwindcss/tailwind.css';
import '../../css/community.css';
import { ButtonSave, ButtonEdit, ButtonCancel } from '../components/buttons';

const CommunityCard = ({ community, option }) => {
  const [communityUrl, setCommunityUrl] = useState(""); // Usamos useState para manejar el estado de la URL

  let buttonComponent;

  const handleButtonClick = () => {
    if (option === 'enter') {
      window.open(`/communities/${community.id}`, "_blank"); // Abre la URL en una nueva pestaña
    } else if (option === 'send') {
      //
    }
  };

  if (option === 'enter') {
    buttonComponent = <ButtonSave label="Enter community" onClick={handleButtonClick} />;
  } else if (option === 'send') {
    buttonComponent = <ButtonEdit label="Send request" onClick={handleButtonClick} />;
  } else {
    buttonComponent = null;
  }

  return (
    <div className="bg-white p-6 rounded-md shadow-md flex flex-col">
      <div className="flex-grow">
        <h2 className="text-2xl font-bold mb-2">{community.name}</h2>
        <p className="text-gray-500 mb-4">{community.description}</p>
      </div>
      
      <a href={communityUrl} target="_blank" rel="noopener noreferrer">
        {buttonComponent}
      </a>
    </div>
  );
};

export default CommunityCard;
