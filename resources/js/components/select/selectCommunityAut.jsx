import React, { useState, useEffect } from 'react';

const CommunityAutSelector = () => {
  const [communitiesAut, setCommunitiesAut] = useState([]);
  const [selectedCommunityAut, setSelectedCommunityAut] = useState('');

  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await fetch('http://localhost/communities/list'); // Reemplaza con la URL correcta
        const data = await response.json();
        setCommunitiesAut(data.data);
      } catch (error) {
        console.error('Error loading data:', error);
      }
    };

    fetchData();
  }, []);

  const handleSelectChange = (event) => {
    setSelectedCommunityAut(event.target.value);
  };

  return (
    <div>
      <label htmlFor="communityAutSelector">Selecciona una comunidad: </label>
      <select
        id="communityAutSelector"
        value={selectedCommunityAut}
        onChange={handleSelectChange}
      >
        <option value="" disabled>Selecciona una opción</option>
        {communitiesAut.map((communityAut) => (
          <option key={communityAut.community_id} value={communityAut.community_id}>
            {`${communityAut.community_id} - ${communityAut.community_name}`}
          </option>
        ))}
      </select>
      <p>Comunidad seleccionada: {selectedCommunityAut}</p>
    </div>
  );
};

export default CommunityAutSelector;
