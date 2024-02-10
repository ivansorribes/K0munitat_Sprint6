import React, { useState, useEffect } from 'react';

const CommunityRegionSelector = () => {
  const [communitiesData, setCommunitiesData] = useState([]);
  const [selectedCommunity, setSelectedCommunity] = useState('');
  const [selectedRegion, setSelectedRegion] = useState('');
  const [loading, setLoading] = useState(true);
  const [regions, setRegions] = useState([]);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await fetch('http://localhost/comuAut/list');
        const data = await response.json();
        setCommunitiesData(data.data);
        setLoading(false);
      } catch (error) {
        console.error('Error loading data:', error);
        setLoading(false);
      }
    };

    fetchData();
  }, []);

  useEffect(() => {
    const fetchRegions = async () => {
      try {
        if (selectedCommunity) {
          const response = await fetch(`http://localhost/comuAut/regList/${selectedCommunity}`);
          const data = await response.json();
          setRegions(data.data);
        } else {
          setRegions([]);
        }
      } catch (error) {
        console.error('Error loading regions:', error);
        setRegions([]);
      }
    };

    fetchRegions();
  }, [selectedCommunity]);

  return (
    <div>
      <label htmlFor="communitySelector">Selecciona una comunidad:</label>
      <select
        id="communitySelector"
        value={selectedCommunity}
        onChange={(e) => setSelectedCommunity(e.target.value)}
      >
        <option value="" disabled>Selecciona una opción</option>

{communitiesData && communitiesData.map((community) => (
  <option key={community.community_id} value={community.community_id}>
    {`${community.community_id} - ${community.community_name}`}
  </option>
))}

      </select>

      {selectedCommunity && (
        <div>
          <label htmlFor="regionSelector">Selecciona una región:</label>
          <select
            id="regionSelector"
            value={selectedRegion}
            onChange={(e) => setSelectedRegion(e.target.value)}
          >
            <option value="" disabled>Selecciona una opción</option>
            {regions && regions.map((region) => (
              <option key={region.region_id} value={region.region_id}>
                {`${region.region_id} - ${region.region_name}`}
              </option>
            ))}
          </select>
        </div>
      )}
    </div>
  );
};

export default CommunityRegionSelector;
