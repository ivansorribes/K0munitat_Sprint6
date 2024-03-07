import React, { useState, useEffect } from 'react';
import { createRoot } from 'react-dom/client';

export default function EditPersonalProfile() {
    const [user, setUser] = useState({});
    const [showMessage, setShowMessage] = useState(false);

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
            const response = await fetch('/updateUserInfo', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window.csrf_token,
                },
                body: JSON.stringify(user),
            });
    
            if (response.ok) {
                // Mostrar mensaje de éxito durante 3 segundos
                setShowMessage(true);
                setTimeout(() => {
                    setShowMessage(false);
                }, 3000);
            } else {
                console.error('Error al guardar la información del usuario');
            }
        } catch (error) {
            console.error('Error inesperado', error);
        }
    };

    return (
        <div className="container mx-auto mt-8">
            <div className="bg-white shadow-md rounded p-8 mb-4">
                <div className="flex items-center justify-between mb-4">
                    <h1 className="text-3xl font-bold">{`${user.username}`}</h1>
                    <a href="/personalProfile"><button className="mt-6 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Back to Profile
                    </button></a>
                </div>

                <div className="flex items-center">
                    <div className="w-1/4 text-center">
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
                    <div className="w-3/4">
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
                                            <input type="text" value={user.firstname} onChange={(e) => handleChange(e, 'firstname')} />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-solid border"><strong>Last Name:</strong></td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-solid border">
                                            <input type="text" value={user.lastname} onChange={(e) => handleChange(e, 'lastname')} />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-solid border"><strong>User Name:</strong></td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-solid border">
                                            <input type="text" value={user.username} onChange={(e) => handleChange(e, 'username')} />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-solid border"><strong>Email:</strong></td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-solid border">
                                            <input type="email" value={user.email} onChange={(e) => handleChange(e, 'email')} />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-solid border"><strong>Telephone:</strong></td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-solid border">
                                            <input type="tel" value={user.telephone} onChange={(e) => handleChange(e, 'telephone')} />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-solid border"><strong>City:</strong></td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-solid border">
                                            <input type="text" value={user.city} onChange={(e) => handleChange(e, 'city')} />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-solid border"><strong>Postcode:</strong></td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-solid border">
                                            <input type="text" value={user.postcode} onChange={(e) => handleChange(e, 'postcode')} />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div className="flex justify-end mt-4">
                            <button className="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" onClick={saveUserInfo}>Save</button>
                            <button className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-4">Edit Password</button>
                            <button className="bg-pink-500 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded ml-4">Change Image</button>

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
        </div>
    );
}

if (document.getElementById('EditPersonalProfile')) {
    createRoot(document.getElementById('EditPersonalProfile')).render(<EditPersonalProfile />);
}
