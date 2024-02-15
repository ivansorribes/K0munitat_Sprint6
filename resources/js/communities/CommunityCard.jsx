import React, { useState, useEffect } from 'react';
import { createRoot } from 'react-dom';
import Card from '../components/cards/Card';  // Ajusta la ruta según tu estructura de archivos


const CommunityCard = () => {

    const [communityId, setCommunityId] = useState(1); // Puedes inicializar el ID según tus necesidades

    const fetchData = async () => {
      try {
        const response = await fetch(`http://localhost/api/communities/${communityId}`);
        if (!response.ok) {
          throw new Error('Error al obtener datos de la comunidad');
        }
    
        const data = await response.json();
        setCommunityId(data);
      } catch (error) {
        console.error(error);
      }
    };
    
    // Llamada inicial cuando el componente se monta
    useEffect(() => {
      fetchData();
    }, [communityId]); // Asegura que se vuelva a llamar cuando communityId cambie
    
    // Puedes cambiar el ID de la comunidad y volver a cargar datos según sea necesario
    const handleEdit = (community) => {
      console.log('Editar comunidad:', community);
      // programar editar
    };
    
    const handleDelete = (communityId) => {
      console.log('Borrar comunidad con ID:', communityId);
      // hay que programa borrar
    };
    
    // Renderiza CommunityCard solo si los datos de la comunidad están disponibles
    return communityId ? (
      <Card
        community={communityId}
        onEditClick={handleEdit}
        onDeleteClick={handleDelete}
      />
    ) : null;
};

// Usa createRoot y render
const root = createRoot(document.getElementById('communityShow'));
root.render(<CommunityCard />);