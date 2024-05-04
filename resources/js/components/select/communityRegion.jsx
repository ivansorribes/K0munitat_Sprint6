import React, { useState, useEffect } from "react";
import Select from "react-select";
import axios from "axios";

const CommunitySelector = ({ onCommunityChange, onRegionChange }) => {
  const [communities, setCommunities] = useState([]);
  const [selectedCommunity, setSelectedCommunity] = useState(null);
  const [regions, setRegions] = useState([]);
  const [selectedRegion, setSelectedRegion] = useState(null);

  useEffect(() => {
    // Obtener la lista de comunidades autónomas
    const fetchCommunities = async () => {
      try {
        const response = await axios.get("/comuAut/list");
        setCommunities(response.data.data);
      } catch (error) {
        console.error("Error fetching communities:", error);
      }
    };
    fetchCommunities();
  }, []);

  const handleCommunityChange = async (selectedOption) => {
    setSelectedCommunity(selectedOption);
    setSelectedRegion(null); // Limpiar la región seleccionada al cambiar la comunidad
    if (selectedOption) {
      // Obtener la lista de regiones para la comunidad autónoma seleccionada
      try {
        const response = await axios.get(
          `/comuAut/regList/${selectedOption.value}`
        );
        setRegions(response.data.data);
      } catch (error) {
        console.error("Error fetching regions:", error);
      }
    } else {
      setRegions([]);
    }
    // Llamar a la función de cambio de comunidad si está definida
    if (onCommunityChange) {
      onCommunityChange(selectedOption);
    }
  };
  const handleRegionChange = (selectedOption) => {
    setSelectedRegion(selectedOption);
    // Llamar a la función de cambio de región si está definida
    if (onRegionChange) {
      onRegionChange(selectedOption);
    }
  };

  return (
    <div style={{ display: "flex", alignItems: "center" }}>
      <div style={{ marginRight: "10px" }}>
        <h2>Select Autonomous Community:</h2>
        <Select
          options={communities.map((community) => ({
            value: community.id_autonomousCommunity,
            label: community.community_name,
          }))}
          value={selectedCommunity}
          onChange={handleCommunityChange}
        />
      </div>
      {regions.length > 0 && (
        <div>
          <h2>Select Region:</h2>
          <Select
            options={regions.map((region) => ({
              value: region.id_region,
              label: region.region_name,
            }))}
            value={selectedRegion}
            onChange={handleRegionChange}
          />
        </div>
      )}
    </div>
  );
};

export default CommunitySelector;
