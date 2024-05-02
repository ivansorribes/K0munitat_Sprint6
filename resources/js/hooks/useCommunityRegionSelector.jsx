import { useState, useEffect } from "react";
import axios from "axios";

const useCommunityRegionSelector = () => {
  const [communities, setCommunities] = useState([]);
  const [regions, setRegions] = useState([]);
  const [selectedCommunity, setSelectedCommunity] = useState(null);
  const [selectedRegion, setSelectedRegion] = useState(null);

  useEffect(() => {
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

  useEffect(() => {
    const fetchRegions = async () => {
      if (selectedCommunity) {
        try {
          const response = await axios.get(
            `/comuAut/regList/${selectedCommunity.value}`
          );
          setRegions(response.data.data);
        } catch (error) {
          console.error("Error fetching regions:", error);
        }
      } else {
        setRegions([]);
      }
    };
    fetchRegions();
  }, [selectedCommunity]);

  return {
    communities,
    regions,
    selectedCommunity,
    selectedRegion,
    setSelectedCommunity, // Asegúrate de retornar la función setSelectedCommunity
    setSelectedRegion, // Asegúrate de retornar la función setSelectedRegion
  };
};

export default useCommunityRegionSelector;
