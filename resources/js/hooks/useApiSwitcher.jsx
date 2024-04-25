import { useState, useEffect } from 'react';
import axios from 'axios';

const useApiSwitcher = (value) => {
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(true);

  const fetchData = async () => {
    try {
      // Comprobar el valor para determinar la URL de la API
      let apiUrl;
      if (value === 'option2') {
        apiUrl = '/communitiesList';
      } else if (value === 'option1') {
        apiUrl = '/communitiesUser';
      }

      const response = await axios.get(apiUrl);
      console.log('Response del hook', response.data);
      setData(response.data);
      setLoading(false);
    } catch (error) {
      console.error('Error fetching data:', error);
      setLoading(false);
    }
  };

  useEffect(() => {
    fetchData(); // Llama a fetchData dentro de useEffect
  }, [value]); // Ejecutar efecto cuando cambie el valor

  return { data, loading };
};

export default useApiSwitcher;
