import React, { useState, useEffect } from 'react';
import { createRoot } from 'react-dom/client';
import { ButtonSave } from './components/buttons';

function Contact() {
    const [formData, setFormData] = useState({
        name: '',
        phone: '',
        email: '',
        message: ''
    });
    const [submitSuccess, setSubmitSuccess] = useState(false);
    const [showEmptyFieldsMessage, setShowEmptyFieldsMessage] = useState(false);
    const [phoneError, setPhoneError] = useState(false);

    useEffect(() => {
        const fetchUserInfo = async () => {
            try {
                const response = await fetch('/getUserInfo', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                    }
                });

                if (response.ok) {
                    const userData = await response.json();
                    setFormData({
                        ...formData,
                        name: userData.firstname,
                        email: userData.email,
                        phone: userData.telephone
                    });
                } else {
                    console.error('Error al obtener la información del usuario');
                }
            } catch (error) {
                console.error('Error al obtener la información del usuario:', error);
            }
        };

        fetchUserInfo();
    }, []);

    const handleChange = (e) => {
        const { name, value } = e.target;
        if (name === 'phone' && !/^\d+$/.test(value) && value !== '') {
            setPhoneError(true);
        } else {
            setPhoneError(false);
            setFormData({
                ...formData,
                [name]: value
            });
        }
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        if (formData.message === '' || formData.user_phone === '' || formData.user_email === '' || formData.user_name === '') {
            setShowEmptyFieldsMessage(true);
            setTimeout(() => {
                setShowEmptyFieldsMessage(false);
            }, 2000);
            return;
        }

        try {
            const response = await fetch('/sendEmail', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window.csrf_token,
                },
                body: JSON.stringify(formData)
            });

            if (response.ok) {
                console.log(formData);

                console.log('Formulario enviado exitosamente');
                setSubmitSuccess(true);
                // Aquí vuelves a obtener la información del usuario y actualizas el estado del formulario
                const fetchUserInfo = async () => {
                    try {
                        const response = await fetch('/getUserInfo', {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json',
                            }
                        });

                        if (response.ok) {
                            const userData = await response.json();
                            setFormData({
                                ...formData,
                                name: userData.firstname,
                                email: userData.email,
                                phone: userData.telephone,
                                message: ''
                            });
                        } else {
                            console.error('Error al obtener la información del usuario');
                        }
                    } catch (error) {
                        console.error('Error al obtener la información del usuario:', error);
                    }
                };

                fetchUserInfo();

                setTimeout(() => {
                    setSubmitSuccess(false);
                }, 1000);
            } else {
                console.error('Error al enviar el formulario');
            }
        } catch (error) {
            console.error('Error al enviar el formulario:', error);
        }
    };

    return (
        <div className="min-h-screen flex items-center justify-center bg-white-500 mt-14 mb-4">
            <div className="relative py-3 sm:max-w-xl sm:mx-auto">
                <div className="absolute inset-0 bg-gradient-to-r from-yellow-300 to-yellow-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl"></div>
                <div className="relative px-4 py-10 bg-white shadow-2xl sm:rounded-3xl sm:p-20 w-full max-w-md text-center">
                    <h1 className="text-2xl font-bold mb-4">Contact</h1>
                    <hr className="border-gray-800 my-0 mb-10" />
                    {submitSuccess && <div className="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                        <strong className="font-bold">Success!</strong>
                        <span className="block sm:inline"> Form submitted successfully.</span>
                    </div>}
                    {showEmptyFieldsMessage && <div className="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                        <strong className="font-bold">Error!</strong>
                        <span className="block sm:inline"> Fields cannot be empty.</span>
                    </div>}
                    {phoneError && <div className="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                        <strong className="font-bold">Error!</strong>
                        <span className="block sm:inline"> Phone number can only contain numbers.</span>
                    </div>}
                    <form onSubmit={handleSubmit}>
                        <div className="mb-4 relative">
                            <input
                                readOnly
                                id="firstname"
                                name="name"
                                type="text"
                                className="peer h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600"
                                value={formData.name}
                                onChange={handleChange}
                            />
                            <label
                                htmlFor="firstname"
                                className="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm"
                            >
                                Name
                            </label>
                        </div>
                        <div className="mb-4 relative">
                            <input
                                readOnly
                                id="telephone"
                                name="phone"
                                type="tel"
                                className="peer h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600"
                                value={formData.phone}
                                onChange={handleChange}
                            />
                            <label
                                htmlFor="telephone"
                                className="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm"
                            >
                                Phone
                            </label>
                        </div>
                        <div className="mb-4 relative">
                            <input
                                readOnly
                                id="email"
                                name="email"
                                type="email"
                                className="peer h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600"
                                value={formData.email}
                                onChange={handleChange}
                            />
                            <label
                                htmlFor="email"
                                className="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm"
                            >
                                Email
                            </label>
                        </div>
                        <div className="mb-4 relative">
                            <textarea
                                id="message"
                                name="message"
                                className="peer h-32 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600 resize-none"
                                value={formData.message}
                                onChange={handleChange}
                            ></textarea>
                            <label
                                htmlFor="message"
                                className="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm"
                            >
                                Message
                            </label>
                        </div>
                        <div className="relative mb-4">
                            <ButtonSave type="submit" label="Send" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    );
}

if (document.getElementById('Contact')) {
    createRoot(document.getElementById('Contact')).render(<Contact />);
}

export default Contact;
