import React, { useState, useEffect } from 'react';
import { createRoot } from 'react-dom/client';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faEye, faEyeSlash } from '@fortawesome/free-solid-svg-icons';
import { ButtonCancel, ButtonDelete, ButtonChangePage, ButtonChangePassword, ButtonSave, ButtonChangeImage} from './components/buttons';



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
    const [selectedFile, setSelectedFile] = useState(null);
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
                console.error('Unespected Error', error);
            }
        };

        fetchUserData();
    }, []);

    const handleChange = (e, field) => {
        setUser({ ...user, [field]: e.target.value });
        setError({ ...error, [field]: null }); // Clear error when user starts typing
    };

    const saveUserInfo = async () => {
        try {
            const formData = new FormData();
            if (selectedImage) {
                formData.append('profile_image', selectedFile);
            }
            formData.append('firstname', user.firstname);
            formData.append('lastname', user.lastname);
            formData.append('username', user.username);
            formData.append('email', user.email);
            formData.append('telephone', user.telephone);
            formData.append('city', user.city);
            formData.append('postcode', user.postcode);

            // Verificar si algún campo está vacío
            const emptyFields = Object.entries(user).some(([key, value]) => {
                if (value === '') {
                    setError({ ...error, [key]: 'This field cannot be empty' });
                    return true;
                }
                return false;
            });
            if (emptyFields) {
                return;
            }

            const phonePattern = /^\d+$/;
            if (!phonePattern.test(user.telephone)) {
                setError({ ...error, telephone: 'The phone can only contain numbers' });
                return;
            }

            const postcodePattern = /^\d+$/;
            if (!postcodePattern.test(user.postcode)) {
                setError({ ...error, postcode: 'The podt code can only contain numbers' });
                return;
            }

            const response = await fetch('/updateUserInfo', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': window.csrf_token,
                },
            });

            const responseData = await response.json();
            if (response.ok) {
                setShowMessage(true);
                setTimeout(() => {
                    setShowMessage(false);
                    setImageModalOpen(false);
                }, 3000);
                setSelectedImage(URL.createObjectURL(selectedFile));
            } else {
                // Mostrar el mensaje de error del servidor en el frontend
                setError(responseData.error);
            }
        } catch (error) {
            console.error('Error inesperado', error);
        }
    };


    const handleTogglePasswordModal = () => {
        setPasswordModalOpen(!passwordModalOpen);
        setActualPassword('');
        setNewPassword('');
        setConfirmNewPassword('');
        setError(null);
    };

    const handleClosePasswordModal = () => {
        setPasswordModalOpen(false);
        setError(null);
    };

    const validatePasswordFields = () => {
        let isValid = true;
        if (!actualPassword || !newPassword || !confirmNewPassword) {
            isValid = false;
            setError('All fields are required');
        } else if (newPassword !== confirmNewPassword) {
            isValid = false;
            setError('New password and confirm password must match');
        }
        return isValid;
    };

    const changePassword = async () => {
        try {
            if (!validatePasswordFields()) {
                return;
            }

            const formData = new FormData();
            formData.append('actual_password', actualPassword);
            formData.append('new_password', newPassword);
            formData.append('confirm_password', confirmNewPassword);

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
        setError(null);
    };

    const handleOpenImageModal = () => {
        setImageModalOpen(true);
    };

    const handleImageChange = (e) => {
        const file = e.target.files[0];
        setSelectedImage(URL.createObjectURL(file));
        setSelectedFile(file);
    };

    const handleSaveImage = async () => {
        try {
            if (selectedFile) {
                const formData = new FormData();
                formData.append('profile_image', selectedFile);
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
                        setImageModalOpen(false);
                        window.location.reload();
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
            const response = await fetch('/deleteUserImage', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': window.csrf_token,
                },
            });

            if (response.ok) {
                setSelectedImage(null);
                setUser({ ...user, profile_image: null });
                setShowMessage(true);
                setTimeout(() => {
                    setShowMessage(false);
                }, 3000);
            } else {
                console.error('Error deleting user image');
            }
        } catch (error) {
            console.error('Unexpected error', error);
        }

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
                        <ButtonChangePage label="Back to Profile"/>

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
                                            <input type="text" value={user.firstname || ''} onChange={(e) => handleChange(e, 'firstname')} className={`border rounded p-2 ${error && error.firstname && 'border-red-500'}`} />
                                            {error && error.firstname && <p className="text-red-500 text-xs mt-1">{error.firstname}</p>}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-solid border"><strong>Last Name:</strong></td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-solid border">
                                            <input type="text" value={user.lastname || ''} onChange={(e) => handleChange(e, 'lastname')} className={`border rounded p-2 ${error && error.lastname && 'border-red-500'}`} />
                                            {error && error.lastname && <p className="text-red-500 text-xs mt-1">{error.lastname}</p>}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-solid border"><strong>User Name:</strong></td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-solid border">
                                            <input type="text" value={user.username || ''} onChange={(e) => handleChange(e, 'username')} className={`border rounded p-2 ${error && error.username && 'border-red-500'}`} />
                                            {error && error.username && <p className="text-red-500 text-xs mt-1">{error.username}</p>}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-solid border"><strong>Email:</strong></td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-solid border">
                                            <input type="email" value={user.email || ''} readOnly />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-solid border"><strong>Telephone:</strong></td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-solid border">
                                            <input type="tel" value={user.telephone || ''} onChange={(e) => handleChange(e, 'telephone')} className={`border rounded p-2 ${error && error.telephone && 'border-red-500'}`} />
                                            {error && error.telephone && <p className="text-red-500 text-xs mt-1">{error.telephone}</p>}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-solid border"><strong>City:</strong></td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-solid border">
                                            <input type="text" value={user.city || ''} onChange={(e) => handleChange(e, 'city')} className={`border rounded p-2 ${error && error.city && 'border-red-500'}`} />
                                            {error && error.city && <p className="text-red-500 text-xs mt-1">{error.city}</p>}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-solid border"><strong>Postcode:</strong></td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-solid border">
                                            <input type="text" value={user.postcode || ''} onChange={(e) => handleChange(e, 'postcode')} className={`border rounded p-2 ${error && error.postcode && 'border-red-500'}`} />
                                            {error && error.postcode && <p className="text-red-500 text-xs mt-1">{error.postcode}</p>}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                       
                        <div className="flex justify- space-x-2 mb-4 mt-2">        
                                <ButtonSave  onClick={saveUserInfo}label="Save"/>
                                <ButtonChangePassword onClick={handleOpenPasswordModal}label="Change Password"/>
                                <ButtonChangeImage  onClick={handleOpenImageModal}label="Change Image"/>


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

            {passwordModalOpen && (
                <div className="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50">
                    <div className="modal-content bg-white p-4 rounded-xl overflow-hidden" style={{ width: '600px', height: '400px' }}>
                        <div className="flex flex-col justify-between h-full">
                            <h2 className="text-2xl font-bold mb-1 text-center">Change Password</h2>
                            {error && <span className="text-red-500">{error}</span>}
                            <label>Current Password</label>
                            <div className="relative">
                                <input
                                    type={showActualPassword ? "text" : "password"}
                                    id="actualPassword"
                                    value={actualPassword}
                                    onChange={(e) => setActualPassword(e.target.value)}
                                    placeholder="Enter current password"
                                    className={`border rounded p-2 mb-4 w-full ${error && !actualPassword && 'border-red-500'}`}
                                />
                                <FontAwesomeIcon icon={showActualPassword ? faEye : faEyeSlash} onClick={handleToggleActualPasswordVisibility} className="absolute right-4 top-4 cursor-pointer" />
                            </div>
                            <label>New Password</label>
                            <div className="relative">
                                <input
                                    type={showNewPassword ? "text" : "password"}
                                    id="newPassword"
                                    value={newPassword}
                                    onChange={(e) => setNewPassword(e.target.value)}
                                    placeholder="Enter new password"
                                    className={`border rounded p-2 mb-4 w-full ${error && !newPassword && 'border-red-500'}`}
                                />
                                <FontAwesomeIcon icon={showNewPassword ? faEye : faEyeSlash} onClick={handleToggleNewPasswordVisibility} className="absolute right-4 top-4 cursor-pointer" />
                            </div>
                            <label>Repeat Password</label>
                            <div className="relative">
                                <input
                                    type={showRepeatPassword ? "text" : "password"}
                                    id="confirmPassword"
                                    value={confirmNewPassword}
                                    onChange={(e) => setConfirmNewPassword(e.target.value)}
                                    placeholder="Repeat new password"
                                    className={`border rounded p-2 mb-4 w-full ${error && !confirmNewPassword && 'border-red-500'}`}
                                />
                                <FontAwesomeIcon icon={showRepeatPassword ? faEye : faEyeSlash} onClick={handleToggleRepeatPasswordVisibility} className="absolute right-4 top-4 cursor-pointer" />
                            </div>
                            <div className="flex justify-end space-x-2 mb-4">        
                                <ButtonSave  onClick={changePassword}label="Save"/>
                                <ButtonCancel onClick={handleClosePasswordModal}label="Cancel"/>

                            </div>
                        </div>
                    </div>
                </div>
            )}


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
                            <div className="flex justify-center space-x-2">
                                <label >
                                <ButtonChangeImage onChange={handleImageChange} label="Select Image"/>
                                    <input type="file" style={{ display: "none" }} onChange={handleImageChange} accept="image/*" />
                                </label>
                              
                                <div className="flex justify-end space-x-2 mb-4">        
                                <ButtonSave onClick={handleSaveImage}label="Save"/>
                                <ButtonDelete  onClick={openDeleteUserImageConfirmation}label="Delete Image"/>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            )}

            {deleteUserImageConfirmationOpen && (
                <div className="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50">
                    <div className="modal-content bg-white p-4 rounded-xl overflow-hidden relative">
                        <span className=" mt-3 close absolute top-0 right-0 m-4 text-3xl cursor-pointer" onClick={(e) => { e.stopPropagation(); closeDeleteUserImageConfirmation(); }}>&times;</span>
                        <div className="flex flex-col justify-between h-full">
                            <div className="mb-4">
                                <h2 className="text-2xl font-bold mb-1 text-center">Delete Image</h2>
                                <p className="text-gray-700 text-center">Are you sure you want to delete your profile image?</p>
                            </div>
                                <div className="flex justify-center space-x-2 mb-4">        
                                <ButtonDelete  onClick={handleDeleteUserImage}label="Delete"/>
                                <ButtonCancel  onClick={closeDeleteUserImageConfirmation}label="Cancel"/>
                            </div>
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