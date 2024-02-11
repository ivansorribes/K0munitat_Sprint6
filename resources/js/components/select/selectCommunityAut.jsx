import React, { useState, useEffect } from 'react';

const CommunityRegionSelector = ({ width, onCommunityChange, onRegionChange  }) => {
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

  useEffect(() => {
    onCommunityChange(selectedCommunity);
  }, [selectedCommunity, onCommunityChange]);

  useEffect(() => {
    onRegionChange(selectedRegion);
  }, [selectedRegion, onRegionChange]);

  return (
    <div>
      <label htmlFor="communitySelector" className="block text-sm font-medium text-gray-600">
        Selecciona una comunidad:
      </label>
      <select
        id="communitySelector"
        value={selectedCommunity}
        onChange={(e) => setSelectedCommunity(e.target.value)}
        className={`mt-1 p-2 border rounded-md ${width}`}
      >
        <option value="" disabled>Selecciona una opción</option>
        {communitiesData && communitiesData.map((community) => (
          <option key={community.id_autonomousCommunity} value={community.id_autonomousCommunity}>
            {`${community.id_autonomousCommunity} - ${community.community_name}`}
          </option>
        ))}
      </select>

      {selectedCommunity && (
        <div className="mt-4">
          <label htmlFor="regionSelector" className="block text-sm font-medium text-gray-600">
            Selecciona una región:
          </label>
          <select
            id="regionSelector"
            value={selectedRegion}
            onChange={(e) => setSelectedRegion(e.target.value)}
            className={`mt-1 p-2 border rounded-md ${width}`}
            
          >
            <option value="" disabled>Selecciona una opción</option>
            {regions && regions.map((region) => (
              <option key={region.id_region} value={region.id_region}>
                {`${region.id_region} - ${region.region_name}`}
              </option>
            ))}
          </select>
        </div>
      )}
    </div>
  );
};

export default CommunityRegionSelector;
