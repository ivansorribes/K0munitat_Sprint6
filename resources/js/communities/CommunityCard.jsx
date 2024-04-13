import React, { useState } from 'react';
import 'tailwindcss/tailwind.css';
import '../../css/community.css';
import CommunitySprite from "./communitySprite";
import { ButtonSave, ButtonEdit, ButtonCancel } from '../components/buttons';
import axios from 'axios'; // Importa Axios

const CommunityCard = ({ community, option, user }) => {
  const [showModal, setShowModal] = useState(false); // Estado para controlar la visibilidad del modal
  const [communityUrl, setCommunityUrl] = useState(""); // Usamos useState para manejar el estado de la URL

  let buttonComponent;

  const handleButtonClick = (event) => {
    event.preventDefault(); // Previene el comportamiento por defecto del botón

    if (option === 'enter') {
      window.open(`/communities/${community.id}`, "_blank"); // Abre la URL en una nueva pestaña
    } else if (option === 'send') {
      setShowModal(true); // Mostrar el modal cuando se haga clic en el botón
    }
  };

  const handleSendRequest = () => {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    axios.post('/communitiesRequest', {
        id_community: community.id,
        id_user: user.id
      })
      .then(response => {
        console.log(response.data);
        setShowModal(false); // Oculta el modal después de enviar la solicitud
      })
      .catch(error => {
        console.error('Error sending community request:', error);
      });
  };

  if (option === 'enter') {
    buttonComponent = <ButtonSave label="Enter community" onClick={handleButtonClick} />;
  } else if (option === 'send') {
    buttonComponent = <ButtonEdit label="Send request" onClick={handleButtonClick} />;
  } else {
    buttonComponent = null;
  }

  return (
    <div className="bg-white p-6 rounded-md shadow-md flex flex-col justify-center items-center" >
      <div className="flex flex-col items-center mb-2" style={{ width: '280px', height: '260px' }}>
      <h2 className="text-2xl font-bold mb-1 text-center overflow-hidden" style={{ maxHeight: '100px' }}>
          {community.name} </h2>
        <CommunitySprite communityId={community.id_autonomousCommunity} />
      </div>
     
      <a href={communityUrl} target="_blank" rel="noopener noreferrer">
        <div className="flex justify-center mb-1">
          {buttonComponent}
        </div>
      </a>
  
      {/* Modal para enviar la solicitud */}
      {showModal && (
        <div className="fixed inset-0 z-10 overflow-y-auto items-center">
          <div className="modal-overlay absolute w-full h-full bg-gray-900 ">
          <div className="modal-container bg-white w-full md:max-w-md mx-auto rounded shadow-lg overflow-y-auto">
            <div className="modal-content py-4 text-left px-6">
              <div className="pb-3">
                <p className="text-2xl font-bold text-center">Send Request to Join {community.name}</p>
              </div>
              <div className="my-5">{/* Contenido del formulario o mensaje aquí */}</div>
              <div className="flex justify-between">
                <div>
                  <ButtonCancel label="Cancel" onClick={() => setShowModal(false)} />
                </div>
                <div>
                  <ButtonSave label="Send Request" onClick={handleSendRequest} />
                </div>
              </div>
            </div>
          </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default CommunityCard;
