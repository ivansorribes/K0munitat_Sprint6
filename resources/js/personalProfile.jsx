import React, { useState } from 'react';
import { createRoot } from 'react-dom/client';

export default function PersonalProfile() {
    // Aquí debes manejar el estado del usuario, reemplaza este ejemplo con tu lógica.
    const [user, setUser] = useState({
        profile_image: 'imagen.jpg', // Ruta de la imagen de perfil
        username: 'NombreUsuario',
        firstname: 'Nombre',
        lastname: 'Apellido',
        city: 'Ciudad',
        // ... otros campos del usuario
    });

    const openModal = (imageSrc, likes, comments) => {
        // Lógica para abrir el modal
        // Puedes usar useState para manejar el estado del modal
        // y pasar la información de la publicación al modal.
    };

    return (
        <div className="container mx-auto mt-8">
            <div className="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <h1 className="text-3xl font-bold mb-4">Mi Perfil</h1>

                <div className="flex">
                    <div className="w-1/4">
                        <img
                            className="w-32 h-32 rounded-full mb-4 cursor-pointer"
                            src={`perfil_images/${user.profile_image}`}
                            alt="Imagen de Usuario"
                            id="userImage"
                        />
                        <p className="text-center font-bold">{user.username}</p>
                    </div>
                    <div className="w-3/4 pl-8">
                        <div className="mb-4">
                            <table className="table-auto">
                                <tbody>
                                    <tr>
                                        <td className="font-bold">Nombre completo:</td>
                                        <td>{`${user.firstname} ${user.lastname}`}</td>
                                    </tr>
                                    <tr>
                                        <td className="font-bold">Ciudad:</td>
                                        <td>{user.city}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <p className="font-bold">Descripción:</p>
                        <p>{/* Coloca la descripción del usuario aquí */}</p>
                    </div>
                </div>

                <div className="mt-6">
                    <h2 className="text-2xl font-bold mb-4">Publicaciones</h2>
                    <div className="grid grid-cols-2 gap-4">
                        {/* Publicación 1 */}
                        <div
                            className="post-card border border-gray-300 p-4 bg-gray-100 cursor-pointer"
                            onClick={() => openModal('perfil_images/imatge1.jpg', '50 likes', '10 comentarios')}
                        >
                            <img className="w-full h-32 object-cover rounded" src="perfil_images/imatge1.jpg" alt="Publicación 1" />
                            <p className="text-center mt-2">Publicación 1</p>
                        </div>

                        {/* Publicación 2 */}
                        <div
                            className="post-card border border-gray-300 p-4 bg-gray-100 cursor-pointer"
                            onClick={() => openModal('perfil_images/imatge2.jpg', '30 likes', '5 comentarios')}
                        >
                            <img className="w-full h-32 object-cover rounded" src="perfil_images/imatge2.jpg" alt="Publicación 2" />
                            <p className="text-center mt-2">Publicación 2</p>
                        </div>
                    </div>
                </div>

                <button className="mt-6 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Editar Perfil
                </button>
            </div>
        </div>
    );
}

if (document.getElementById('personalProfile')) {
    createRoot(document.getElementById('personalProfile')).render(<PersonalProfile />);
}
