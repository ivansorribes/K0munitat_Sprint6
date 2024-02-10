import React, { useState, useEffect } from 'react';

const RegionSelector = ({ regions, selectedCommunityId, onSelectRegion }) => {
  const [selectedRegion, setSelectedRegion] = useState('');

  useEffect(() => {
    if (!selectedCommunityId) {
      // Limpiar las regiones si no hay comunidad seleccionada
      setSelectedRegion('');
    }
  }, [selectedCommunityId]);

  const handleSelectRegion = (event) => {
    setSelectedRegion(event.target.value);
    onSelectRegion(event.target.value);
  };

  return (
    <div>
      <label htmlFor="regionSelector">Selecciona una región:</label>
      <select
        id="regionSelector"
        value={selectedRegion}
        onChange={handleSelectRegion}
        disabled={!selectedCommunityId}
      >
        <option value="" disabled>Selecciona una opción</option>
        {Array.isArray(regions) && regions.map((region) => (
          <option key={region.region_id} value={region.region_id}>
            {`${region.region_id} - ${region.region_name}`}
          </option>
        ))}
      </select>
    </div>
  );
};

export default RegionSelector;
