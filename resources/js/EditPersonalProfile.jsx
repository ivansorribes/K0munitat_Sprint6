import React, { useState, useEffect } from 'react';
import { createRoot } from 'react-dom/client';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'; // Importa FontAwesomeIcon
import { faEye, faEyeSlash } from '@fortawesome/free-solid-svg-icons'; // Importa los iconos de ojo abierto y cerrado

export default function EditPersonalProfile() {
    const [user, setUser] = useState({});
    const [showMessage, setShowMessage] = useState(false);
    const [imageModalOpen, setImageModalOpen] = useState(false);
    const [actualPassword, setActualPassword] = useState('');
    const [newPassword, setNewPassword] = useState('');
    const [confirmNewPassword, setConfirmNewPassword] = useState('');
    const [error, setError] = useState(null);
    const [passwordModalOpen, setPasswordModalOpen] = useState(false);
    const [showActualPassword, setShowActualPassword] = useState(false);
    const [showNewPassword, setShowNewPassword] = useState(false);
    const [showRepeatPassword, setShowRepeatPassword] = useState(false);
    const [selectedImage, setSelectedImage] = useState(null);
    const [selectedFile, setSelectedFile] = useState(null); // Agrega estado para el archivo seleccionado
    const [deleteUserImageConfirmationOpen, setDeleteUserImageConfirmationOpen] = useState(false);


    useEffect(() => {
        const fetchUserData = async () => {
            try {
                const response = await fetch('/postUser');
                if (response.ok) {
                    const data = await response.json();
                    setUser(data.user || {});
                } else {
                    console.error('Error al obtener datos del usuario');
                }
            } catch (error) {
                console.error('Error inesperado', error);
            }
        };

        fetchUserData();
    }, []);

    const handleChange = (e, field) => {
        setUser({ ...user, [field]: e.target.value });
    };



    const saveUserInfo = async () => {
        try {
            const formData = new FormData();
            if (selectedImage) {
                formData.append('profile_image', user.profile_image);
            }
            // Agrega el resto de los campos de usuario al formulario
            formData.append('firstname', user.firstname);
            formData.append('lastname', user.lastname);
            formData.append('username', user.username);
            formData.append('email', user.email);
            formData.append('telephone', user.telephone);
            formData.append('city', user.city);
            formData.append('postcode', user.postcode);

            const response = await fetch('/updateUserInfo', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': window.csrf_token,
                },
            });

            if (response.ok) {
                setShowMessage(true);
                setTimeout(() => {
                    setShowMessage(false);
                    setImageModalOpen(false);
                }, 3000);
                setSelectedImage(URL.createObjectURL(selectedFile));
            } else {
                console.error('Error al guardar la información del usuario');
            }
        } catch (error) {
            console.error('Error inesperado', error);
        }
    };


    const handleTogglePasswordModal = () => {
        setPasswordModalOpen(!passwordModalOpen);
    };

    const handleClosePasswordModal = () => {
        setPasswordModalOpen(false);
    };

    const changePassword = async () => {
        try {
            const actualPassword = document.getElementById('actualPassword').value;
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
    
            const formData = new FormData();
            formData.append('actual_password', actualPassword);
            formData.append('new_password', newPassword);
            formData.append('confirm_password', confirmPassword);
    
            const response = await fetch('/changePassword', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': window.csrf_token,
                },
                body: formData,
            });
    
            const responseData = await response.json();
    
            if (response.ok) {
                setShowMessage(true);
                setTimeout(() => {
                    setShowMessage(false);
                }, 3000);
    
                setActualPassword('');
                setNewPassword('');
                setConfirmNewPassword('');
                setPasswordModalOpen(false);
            } else {
                setError(responseData.error);
            }
        } catch (error) {
            console.error('Error inesperado', error);
        }
    };
    



const handleOpenPasswordModal = () => {
    setPasswordModalOpen(true);
};

const handleOpenImageModal = () => {
    setImageModalOpen(true);
};

const handleImageChange = (e) => {
    const file = e.target.files[0];
    setSelectedImage(URL.createObjectURL(file)); // Guarda la URL de la imagen seleccionada
    setSelectedFile(file); // Guarda el archivo de imagen seleccionado
};

const handleSaveImage = async () => {
    try {
        if (selectedFile) { // Verifica si hay un archivo seleccionado
            const formData = new FormData();
            formData.append('profile_image', selectedFile); // Agrega el archivo al FormData
            formData.append('firstname', user.firstname);
            formData.append('lastname', user.lastname);
            formData.append('username', user.username);
            formData.append('email', user.email);
            formData.append('telephone', user.telephone);
            formData.append('city', user.city);
            formData.append('postcode', user.postcode);

            const response = await fetch('/updateUserInfo', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': window.csrf_token
                }
            });

            if (response.ok) {
                setShowMessage(true);
                setTimeout(() => {
                    setShowMessage(false);
                    setImageModalOpen(false); // Cerrar el modal de imagen después de guardar la información
                    window.location.reload(); // Recargar la página
                }, 3000);
            } else {
                console.error('Error al guardar la información del usuario');
            }
        } else {
            console.error('No se ha seleccionado ninguna imagen');
        }
    } catch (error) {
        console.error('Error inesperado', error);
    }
};
const handleDeleteUserImage = async () => {
    try {
        // Realiza la lógica para eliminar la imagen del usuario
        const response = await fetch('/deleteUserImage', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': window.csrf_token,
            },
        });

        if (response.ok) {
            // Actualiza el estado local para reflejar que la imagen del usuario ha sido eliminada
            setSelectedImage(null); // Cambio: establece la imagen seleccionada como nula
            setUser({ ...user, profile_image: null }); // Actualiza el estado del usuario para reflejar que la imagen ha sido eliminada
            setShowMessage(true); // Muestra un mensaje de éxito
            setTimeout(() => {
                setShowMessage(false);
            }, 3000);
        } else {
            console.error('Error deleting user image');
        }
    } catch (error) {
        console.error('Unexpected error', error);
    }

    // Cierra el modal de confirmación
    closeDeleteUserImageConfirmation();
};


const openDeleteUserImageConfirmation = () => {
    setDeleteUserImageConfirmationOpen(true);
};
const closeDeleteUserImageConfirmation = () => {
    setDeleteUserImageConfirmationOpen(false);
};


const handleToggleActualPasswordVisibility = () => {
    setShowActualPassword(!showActualPassword);
};

const handleToggleNewPasswordVisibility = () => {
    setShowNewPassword(!showNewPassword);
};

const handleToggleRepeatPasswordVisibility = () => {
    setShowRepeatPassword(!showRepeatPassword);
};


return (
    <div className="container mx-auto mt-8">
        <div className="bg-white shadow-md rounded p-8 mb-4">
            <div className="flex items-center justify-between mb-4">
                <h1 className="text-3xl font-bold">{user.username}</h1>
                <a href="/personalProfile">
                    <button className="mt-6 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Back to Profile
                    </button>
                </a>
            </div>

            <div className="flex flex-col sm:flex-row items-center sm:items-start">
                <div className="w-full sm:w-1/4 text-center mb-4 sm:mb-0">
                    <div className="flex flex-col items-center relative">
                        <img
                            className="w-32 h-32 rounded-full mb-4 cursor-pointer"
                            src={user.profile_image ? `/profile/images/${user.profile_image}` : '/profile/images/DefaultImage.png'}
                            id="userImage"
                        />
                        <p className="font-bold">{`${user.firstname} ${user.lastname}`}</p>
                    </div>
                </div>

                {/* Información del usuario */}
                <div className="w-full sm:w-3/4">
                    <div className="overflow-auto rounded-lg">
                        <table className="min-w-full bg-white border-solid border">
                            <tbody>
                                <tr>
                                    <th className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-solid border">Name</th>
                                    <th className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-solid border">Value</th>
                                </tr>
                                <tr>
                                    <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-solid border"><strong>First Name:</strong></td>
                                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-solid border">
                                        <input type="text" value={user.firstname || ''} onChange={(e) => handleChange(e, 'firstname')} />
                                    </td>
                                </tr>
                                <tr>
                                    <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-solid border"><strong>Last Name:</strong></td>
                                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-solid border">
                                        <input type="text" value={user.lastname || ''} onChange={(e) => handleChange(e, 'lastname')} />
                                    </td>
                                </tr>
                                <tr>
                                    <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-solid border"><strong>User Name:</strong></td>
                                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-solid border">
                                        <input type="text" value={user.username || ''} onChange={(e) => handleChange(e, 'username')} />
                                    </td>
                                </tr>
                                <tr>
                                    <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-solid border"><strong>Email:</strong></td>
                                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-solid border">
                                        <input type="email" value={user.email || ''} onChange={(e) => handleChange(e, 'email')} />
                                    </td>
                                </tr>
                                <tr>
                                    <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-solid border"><strong>Telephone:</strong></td>
                                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-solid border">
                                        <input type="tel" value={user.telephone || ''} onChange={(e) => handleChange(e, 'telephone')} />
                                    </td>
                                </tr>
                                <tr>
                                    <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-solid border"><strong>City:</strong></td>
                                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-solid border">
                                        <input type="text" value={user.city || ''} onChange={(e) => handleChange(e, 'city')} />
                                    </td>
                                </tr>
                                <tr>
                                    <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-solid border"><strong>Postcode:</strong></td>
                                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-solid border">
                                        <input type="text" value={user.postcode || ''} onChange={(e) => handleChange(e, 'postcode')} />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div className="flex justify-end mt-4 sm:justify-start">
                        <button className="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-2 sm:mb-0 sm:mr-4" onClick={saveUserInfo}>Save</button>
                        <button className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2 sm:mb-0 sm:mr-4" onClick={handleOpenPasswordModal}>Edit Password</button>
                        <button className="bg-pink-500 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded mb-2 sm:mb-0" onClick={handleOpenImageModal}>Change Image</button>
                    </div>



                </div>
            </div>
        </div>

        {showMessage && (
            <div className="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded absolute top-0 right-0 mt-4 mr-4" role="alert">
                <strong className="font-bold">Success!</strong>
                <span className="block sm:inline"> User information updated successfully.</span>
            </div>
        )}

        {/* Password Modal */}
        {passwordModalOpen && (
            <div className="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50">
                <div className="modal-content bg-white p-4 rounded-xl overflow-hidden" style={{ width: '600px', height: '400px' }}>
                    <div className="flex flex-col">
                        <h1>Change Password</h1>
                        <div className="relative">
                            <input
                                type={showActualPassword ? "text" : "password"} // Cambio aquí
                                id="actualPassword"
                                value={actualPassword}
                                onChange={(e) => setActualPassword(e.target.value)}
                                placeholder="Enter current password"
                                className="border rounded p-2 mb-4 w-full"
                            />
                            <FontAwesomeIcon icon={showActualPassword ? faEye : faEyeSlash} onClick={handleToggleActualPasswordVisibility} className="absolute right-4 top-4 cursor-pointer" />
                        </div>
                        <label>New Password</label>
                        <div className="relative">
                            <input
                                type={showNewPassword ? "text" : "password"} // Cambio aquí
                                id="newPassword"
                                value={newPassword}
                                onChange={(e) => setNewPassword(e.target.value)}
                                placeholder="Enter new password"
                                className="border rounded p-2 mb-4 w-full"
                            />
                            <FontAwesomeIcon icon={showNewPassword ? faEye : faEyeSlash} onClick={handleToggleNewPasswordVisibility} className="absolute right-4 top-4 cursor-pointer" />
                        </div>
                        <label>Repeat Password</label>
                        <div className="relative">
                            <input
                                type={showRepeatPassword ? "text" : "password"} // Cambio aquí
                                id="confirmPassword"
                                value={confirmNewPassword}
                                onChange={(e) => setConfirmNewPassword(e.target.value)}
                                placeholder="Repeat new password"
                                className="border rounded p-2 mb-4 w-full"
                            />
                            <FontAwesomeIcon icon={showRepeatPassword ? faEye : faEyeSlash} onClick={handleToggleRepeatPasswordVisibility} className="absolute right-4 top-4 cursor-pointer" />
                        </div>
                        <div className="flex justify-end">
                            <button className="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-2" onClick={changePassword}>Save</button>
                            <button className="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded" onClick={handleClosePasswordModal}>Cancel</button>
                        </div>

                    </div>
                </div>
            </div>
        )}



        {/* Image Modal */}
        {imageModalOpen && (
            <div className="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50">
                <div className="modal-content bg-white p-4 rounded-xl overflow-hidden relative">
                    <span className=" mt-3 close absolute top-0 right-0 m-4 text-3xl cursor-pointer" onClick={(e) => { e.stopPropagation(); setImageModalOpen(false); }}>&times;</span>
                    <div className="flex flex-col justify-between h-full">
                        <div className="mb-4">
                            <h2 className="text-2xl font-bold mb-1 text-center">Change Image</h2>
                        </div>
                        <div>
                            <img
                                className="w-32 h-32 rounded-full mb-4 cursor-pointer mx-auto"
                                src={selectedImage || (user.profile_image ? `/profile/images/${user.profile_image}` : '/profile/images/DefaultImage.png')}
                                id="userImage"
                            />
                        </div>
                        <div className="flex justify-center">
                            <label className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2 cursor-pointer">
                                Select Image
                                <input type="file" style={{ display: "none" }} onChange={handleImageChange} accept="image/*" />
                            </label>
                            <button className="bg-red-500 text-white px-4 py-2 rounded mr-2" onClick={openDeleteUserImageConfirmation}>Delete</button>
                            <button className="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded" onClick={() => { handleSaveImage(); window.location.reload(); }}>Save</button>
                        </div>
                        {deleteUserImageConfirmationOpen && (
                            <div className="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50">
                                <div className="modal-content bg-white p-4 rounded-xl overflow-hidden">
                                    <p className="text-center text-lg font-semibold mb-4">Are you sure you want to delete your profile image?</p>
                                    <div className="flex justify-center">
                                        <button className="bg-red-500 text-white px-4 py-2 rounded mr-2" onClick={handleDeleteUserImage}>Yes</button>
                                        <button className="bg-blue-500 text-white px-4 py-2 rounded" onClick={closeDeleteUserImageConfirmation}>No</button>
                                    </div>
                                </div>
                            </div>
                        )}

                    </div>
                </div>
            </div>
        )}

    </div>
);
}

if (document.getElementById('EditPersonalProfile')) {
    createRoot(document.getElementById('EditPersonalProfile')).render(<EditPersonalProfile />);
}
