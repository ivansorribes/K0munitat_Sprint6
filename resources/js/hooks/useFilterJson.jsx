import { useState, useEffect } from 'react';

const useSelectOptions = ({ filterValue = '', filterField = '' } = {})=> {
  const [options, setOptions] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  const apiUrl = '/';

  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await fetch(apiUrl);

        if (!response.ok) {
          throw new Error('Error al obtener datos');
        }

        const data = await response.json();

        if (!Array.isArray(data)) {
          throw new Error('La propiedad "data" no es un array en la respuesta de la API.');
        }

        // Filter based on either value or field
        let filteredData;
        
        
        if (filterField !== '' && filterValue === '') {
          const uniqueValues = Array.from(new Set(data.map(item => item[filterField])));
          filteredData = uniqueValues.map(value => ({
            value,
            label: `${value}`, // Customize the label as needed
          }));
        } else if (filterField === '' && filterValue !== '') {
          const uniqueValues = Array.from(new Set(data.map(item => item.value===filterValue)));
          filteredData = uniqueValues.map(value => ({
            value,
            label: `${value}`, // Customize the label as needed
          }));
        }
        else {
          filteredData = data;
        }


        setOptions(filteredData);
      } catch (error) {
        setError(error.message);
      } finally {
        setLoading(false);
      }
    };

    fetchData();
  }, [apiUrl, filterValue, filterField]); // Include filterValue and filterField in the dependency array

  return { options, loading, error };
};

export default useSelectOptions;