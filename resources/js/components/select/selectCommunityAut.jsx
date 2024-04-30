import React, { useState, useEffect } from 'react';
import PropTypes from 'prop-types';
import ReactSelect from 'react-select';
import * as Yup from 'yup';

const CommunityRegionSelector = ({ width, onCommunityChange, onRegionChange }) => {
  const [communitiesData, setCommunitiesData] = useState([]);
  const [selectedCommunity, setSelectedCommunity] = useState('');
  const [selectedRegion, setSelectedRegion] = useState('');
  const [loading, setLoading] = useState(true);
  const [regions, setRegions] = useState([]);
  const [inputValue, setInputValue] = useState('');
  const [communityError, setCommunityError] = useState('');
  const [regionError, setRegionError] = useState('');
  const [errorMessage, setErrorMessage] = useState('');

  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await fetch('/comuAut/list');
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
          const response = await fetch(`/comuAut/regList/${selectedCommunity}`);
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
    setSelectedCommunity(selectedOption ? selectedOption.value : '');
    setSelectedRegion(''); // Limpiar el valor seleccionado de la región
    setInputValue('');
    setCommunityError('');
  };

  const handleRegionSelect = (selectedOption) => {
    setSelectedRegion(selectedOption ? selectedOption.value : '');
    setRegionError('');
  };

  useEffect(() => {
    const validate = async () => {
      const schema = Yup.object().shape({
        selectedCommunity: Yup.string().required('Community selection is required'),
        selectedRegion: Yup.string().required('Region selection is required'),
      });

      try {
        await schema.validate({ selectedCommunity, selectedRegion }, { abortEarly: false });
        setCommunityError('');
        setRegionError('');
        setErrorMessage('');
      } catch (err) {
        let errors = [];
        err.inner.forEach((error) => {
          if (error.path === 'selectedCommunity') {
            setCommunityError(error.message);
          } else if (error.path === 'selectedRegion') {
            setRegionError(error.message);
          }
          errors.push(error.message);
        });
        setErrorMessage(errors.join(' '));
      }
    };

    validate();
  }, [selectedCommunity, selectedRegion]);

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
        value={selectedCommunity ? { value: selectedCommunity, label: communitiesData.find((community) => community.id_autonomousCommunity === selectedCommunity)?.community_name } : ''}
        onChange={handleCommunitySelect}
        onInputChange={handleCommunityFilter}
        placeholder="Write to filter..."
      />
      {communityError && <div className="text-red-500">{communityError}</div>}
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
            value={selectedRegion ? { value: selectedRegion, label: regions.find((region) => region.id_region === selectedRegion)?.region_name } : ''}
            onChange={handleRegionSelect}
            placeholder="Select an option"
          />
          {regionError && <div className="text-red-500">{regionError}</div>}
        </div>
      )}

    </div>
  );
};

CommunityRegionSelector.propTypes = {
  width: PropTypes.string,
  onCommunityChange: PropTypes.func.isRequired,
  onRegionChange: PropTypes.func.isRequired,
};

export default CommunityRegionSelector;
