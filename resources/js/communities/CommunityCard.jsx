import React from 'react';
import 'tailwindcss/tailwind.css';
import '../../css/community.css';
import { ButtonSave, ButtonEdit, ButtonCancel } from '../components/buttons';

const CommunityCard = ({ community, option }) => {
  const communityUrl = `/communities/${community.id}`;

  let buttonComponent;

  if (option === 'enter') {
    buttonComponent = <ButtonSave label="Enter community" />;
  } else if (option === 'send') {
    buttonComponent = <ButtonEdit label="Send request" />;
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