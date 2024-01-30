import React, { useState } from 'react';
import { createRoot } from 'react-dom/client';
import snoopyImage from '../views/profile/image/snoopy17.jpg';
import vegetablePatch from '../views/profile/image/huerto2.jpg';
import vegetablePatchImage from '../views/profile/image/huerto.jpeg';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faEdit, faSave, faTimes, faHeart, faComment } from '@fortawesome/free-solid-svg-icons';

export default function PersonalProfile() {
    const [user, setUser] = useState({
        profile_image: snoopyImage,
        username: 'Tivik17',
        firstname: 'Tatiana',
        lastname: 'Valentiny',
        city: 'Ciudad',
        description: 'Esta es mi descripción',
    });

    const [editingDescription, setEditingDescription] = useState(false);
    const [newDescription, setNewDescription] = useState(user.description);

    const startEditingDescription = () => {
        setNewDescription(user.description);
        setEditingDescription(true);
    };

    const saveDescription = () => {
        setUser({ ...user, description: newDescription });
        setEditingDescription(false);
    };

    const cancelEditingDescription = () => {
        setEditingDescription(false);
    };

    const [modalImage, setModalImage] = useState(null);

    const openModal = (imageSrc, likes, comments, description) => {
        setModalImage({ imageSrc, likes, comments, description });
    };

    const closeModal = () => {
        setModalImage(null);
    };

    return (
        <div className="container mx-auto mt-8">
            <div className="bg-white shadow-md rounded p-8 mb-4">
                <h1 className="text-3xl font-bold mb-4">My Profile</h1>

                <div className="flex items-center">
                    <div className="w-1/4 text-center">
                        <div className="flex flex-col items-center">
                            <img
                                className="w-32 h-32 rounded-full mb-4 cursor-pointer"
                                src={user.profile_image}
                                alt="Imagen de Usuario"
                                id="userImage"
                            />
                            <p className="font-bold">{user.username}</p>
                        </div>
                    </div>
                    <div className="w-3/4 pl-8">
                        <div className="mb-4">
                            <table className="table-auto">
                                <tbody>
                                    <tr>
                                        <td>{`${user.firstname} ${user.lastname}`}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div className="flex items-center relative">
                            <p className="font-bold mb-2">Description:</p>
                            {editingDescription ? (
                                <div className="relative">
                                    <textarea
                                        className="w-full border rounded p-2 mb-4"
                                        value={newDescription}
                                        onChange={(e) => setNewDescription(e.target.value)}
                                    />
                                    <div className="flex items-center justify-end absolute bottom-0 right-0 mb-2 mr-2">
                                        <button className="bg-green-500 text-white px-2 py-1 rounded mb-2" onClick={saveDescription}>
                                            <FontAwesomeIcon icon={faSave} size="xs" />
                                        </button>
                                        <button className="ml-2 bg-red-500 text-white px-2 py-1 rounded mb-2" onClick={cancelEditingDescription}>
                                            <FontAwesomeIcon icon={faTimes} size="xs" />
                                        </button>
                                    </div>
                                </div>
                            ) : (
                                <div className="border rounded p-2 flex items-center justify-between">
                                    <div>{user.description}</div>
                                    <button className="bg-blue-500 text-white px-2 py-1 rounded" onClick={startEditingDescription}>
                                        <FontAwesomeIcon icon={faEdit} size="xs" />
                                    </button>
                                </div>
                            )}
                        </div>
                    </div>
                </div>

                <div className="mt-6">
                    <h2 className="text-2xl font-bold mb-4">Publications</h2>
                    <div className="grid grid-cols-2 gap-4">
                        {/* Publicación 1 */}
                        <div
                            className="post-card border border-gray-300 p-4 bg-gray-100 cursor-pointer"
                            onClick={() => openModal(vegetablePatch, '50 likes', '10 comentarios', 'Descripción de la publicación 1')}
                        >
                            <img
                                className="w-full h-32 object-cover rounded"
                                src={vegetablePatch}
                                alt="Publicación 1"
                                style={{ width: '800px', height: '350px' }}
                            />
                            <div className="mt-2">
                                <div className="flex mb-2">
                                    <div className="flex items-center mr-2">
                                        <FontAwesomeIcon icon={faHeart} className="text-red-500 mr-1" />
                                        {'50'}
                                    </div>
                                    <div className="flex items-center">
                                        <FontAwesomeIcon icon={faComment} className="text-blue-500 mr-1" />
                                        {'10'}
                                    </div>
                                </div>
                                <p className="">Mi pequeño paraíso verde 🌿🍅🌽 Este es mi rincón de la naturaleza, donde las frutas y verduras crecen con amor y dedicación. 🌱🥦 La diversidad de colores y sabores en mi huerto es simplemente mágica. 🌈 Desde jugosas fresas hasta tomates maduros, cada cosecha es una recompensa por el esfuerzo diario. 🍓🍆 ¡Bienvenidos a mi oasis de frescura y sabor! 🌻🍇 #HuertoEnCasa #AmoLaNaturaleza #CosechaPropia</p>
                                <p>{modalImage && modalImage.description}</p>
                            </div>
                        </div>

                        {/* Publicación 2 */}
                        <div
                            className="post-card border border-gray-300 p-4 bg-gray-100 cursor-pointer"
                            onClick={() => openModal(vegetablePatchImage, '30 likes', '5 comentarios', 'Descripción de la publicación 2')}
                        >
                            <img
                                className="w-full h-32 object-cover rounded"
                                src={vegetablePatchImage}
                                alt="Publicación 2"
                                style={{ width: '800px', height: '350px' }}
                            />
                            <div className="mt-2">
                                <div className="flex mb-2">
                                    <div className="flex items-center mr-2">
                                        <FontAwesomeIcon icon={faHeart} className="text-red-500 mr-1" />
                                        {'30'}
                                    </div>
                                    <div className="flex items-center">
                                        <FontAwesomeIcon icon={faComment} className="text-blue-500 mr-1" />
                                        {'5'}
                                    </div>
                                </div>
                                <p className="">Descubre mi pequeño edén verde 🌱🌿🍋 ¡Mi huerto está en pleno esplendor! 🌺🍅 Cada rincón rebosa vida y colores vibrantes. Desde las hojas verdes frescas hasta los frutos maduros listos para ser cosechados. 🍓🥒 Cuidar de estas plantas es un ritual que llena mi corazón de gratitud y conexión con la tierra. 🌍✨ ¡Únete a mí en este viaje de cultivo y descubrimiento! 🌾🍇 #CosechaFeliz #HuertoEnCasa #AmoLaNaturaleza</p>
                                <p>{modalImage && modalImage.description}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <button className="mt-6 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Edit profile
                </button>
            </div>

            {/* Modal */}
            {modalImage && (
                <div className="modal fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex items-center justify-center" onClick={closeModal}>
                    <div className="modal-content max-w-3/4 bg-white p-4 rounded overflow-hidden">
                        <span className="close absolute top-0 right-0 m-4 text-3xl cursor-pointer" onClick={closeModal}>&times;</span>
                        <img
                            className="w-full h-auto"
                            src={modalImage.imageSrc}
                            alt="Imagen Ampliada"
                            style={{ width: '600px', height: '600px' }}
                        />
                        <div className="mt-2">
                            <p className="text-center font-bold">Detalles</p>
                            <div className="flex justify-between mt-2">
                                <div className="flex items-center">
                                    <FontAwesomeIcon icon={faHeart} className="text-red-500 mr-1" />
                                    {modalImage.likes}
                                </div>
                                <div className="flex items-center">
                                    <FontAwesomeIcon icon={faComment} className="text-blue-500 mr-1" />
                                    {modalImage.comments}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            )}
        </div>
    );
}

if (document.getElementById('personalProfile')) {
    createRoot(document.getElementById('personalProfile')).render(<PersonalProfile />);
}
