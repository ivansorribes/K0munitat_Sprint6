import React, { useState, useEffect } from 'react';
import ReactSelect from 'react-select';

const CommunityRegionSelector = ({ width, onCommunityChange, onRegionChange }) => {
  const [communitiesData, setCommunitiesData] = useState([]);
  const [selectedCommunity, setSelectedCommunity] = useState('');
  const [selectedRegion, setSelectedRegion] = useState('');
  const [loading, setLoading] = useState(true);
  const [regions, setRegions] = useState([]);
  const [inputValue, setInputValue] = useState('');

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

  const handleCommunityFilter = (inputValue) => {
    setInputValue(inputValue);
  };

  const handleCommunitySelect = (selectedOption) => {
    setSelectedCommunity(selectedOption.value);
    setSelectedRegion(''); // Limpiar el valor seleccionado de la región
    setInputValue('');
  };

  const handleRegionSelect = (selectedOption) => {
    setSelectedRegion(selectedOption.value);
  };

  return (
    <div>
      <label htmlFor="communitySelector" className="block text-sm font-medium text-gray-600">
      Select a community:
      </label>
      <ReactSelect
        options={communitiesData.map((community) => ({
          value: community.id_autonomousCommunity,
          label: community.community_name
        }))}
        value={selectedCommunity ? { value: selectedCommunity, label: communitiesData.find((community) => community.id_autonomousCommunity === selectedCommunity)?.community_name } : null}
        onChange={handleCommunitySelect}
        onInputChange={handleCommunityFilter}
        placeholder="Write to filter..."
      />

      {selectedCommunity && (
        <div className="mt-4">
          <label htmlFor="regionSelector" className="block text-sm font-medium text-gray-600">
           Select a region:
          </label>
          <ReactSelect
            options={regions.map((region) => ({
              value: region.id_region,
              label: region.region_name
            }))}
            value={selectedRegion ? { value: selectedRegion, label: regions.find((region) => region.id_region === selectedRegion)?.region_name } : null}
            onChange={handleRegionSelect}
            placeholder="Selecciona una opción"
          />
        </div>
      )}
    </div>
  );
};

export default CommunityRegionSelector;
