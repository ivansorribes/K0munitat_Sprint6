import React from 'react';
import { createRoot } from 'react-dom/client'

const Formulario = () => {
    const [datos, setDatos] = useState({
      nombre: '',
      email: '',
    });
  
    const handleChange = (e) => {
      setDatos({
        ...datos,
        [e.target.name]: e.target.value,
      });
    };
  
    const handleSubmit = (e) => {
      e.preventDefault();
  
      fetch('http://tu-api-laravel.com/api/guardar-datos', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(datos),
      })
        .then(response => response.json())
        .then(data => {
          console.log(data);
        })
        .catch(error => {
          console.error('Error al enviar los datos:', error);
        });
    };
  
    return (
      <form onSubmit={handleSubmit}>
        <label>
          Nombre:
          <input type="text" name="nombre" value={datos.nombre} onChange={handleChange} />
        </label>
        <label>
          Email:
          <input type="email" name="email" value={datos.email} onChange={handleChange} />
        </label>
        <button type="submit">Enviar</button>
      </form>
    );
  };
  
  export default Formulario;