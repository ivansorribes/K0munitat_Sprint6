import React, { useState } from 'react';
import { createRoot } from 'react-dom/client';
import { ButtonSave } from './components/buttons';
import { GoogleReCaptcha, GoogleReCaptchaProvider } from 'react-google-recaptcha-v3';


function Contact() {
    const [formData, setFormData] = useState({
        name: '',
        phone: '',
        email: '',
        message: ''
    });
    const [submitSuccess, setSubmitSuccess] = useState(false); // Estado para el mensaje de confirmación
    const [showEmptyFieldsMessage, setShowEmptyFieldsMessage] = useState(false); // Estado para mostrar el mensaje de campos vacíos
    const [phoneError, setPhoneError] = useState(false); // Estado para mostrar el mensaje de error en el campo de teléfono

    const handleChange = (e) => {
        const { name, value } = e.target;

        // Verificar si el campo es el teléfono y si contiene letras
        if (name === 'phone' && !/^\d+$/.test(value) && value !== '') {
            // Mostrar mensaje de error
            setPhoneError(true);
        } else {
            // Si no hay letras, actualizar el estado normalmente
            setPhoneError(false);
            setFormData({
                ...formData,
                [name]: value
            });
        }
    };

    const [captchaIsDone, setCaptchaDone] = useState(false);
    const key = '6LcGRZ8pAAAAAGFU9n6NNljY4TncKxkDhUz0PRCc';

    function handleVerify(){
        console.log('changed')
        setCaptchaDone(true)
    }

    

    const handleSubmit = async (e) => {
        e.preventDefault();

        // Check if any of the fields are empty
        if (formData.name === '' || formData.phone === '' || formData.email === '' || formData.message === '') {
            setShowEmptyFieldsMessage(true); // Set state to show empty fields message

            // Reset the state after 2 seconds
            setTimeout(() => {
                setShowEmptyFieldsMessage(false);
            }, 2000);

            return; // Exit the function early
        }

        try {
            const response = await fetch('/contact', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window.csrf_token,
                },
                body: JSON.stringify(formData)
            });

            if (response.ok) {
                console.log('Formulario enviado exitosamente');
                setSubmitSuccess(true); // Establecer el estado para mostrar el mensaje de confirmación

                // Reiniciar el formulario después de 1 segundos
                setTimeout(() => {
                    setSubmitSuccess(false);
                    setFormData({
                        name: '',
                        phone: '',
                        email: '',
                        message: ''
                    });
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
                    <h1 className="text-2xl font-bold mb-4">Contacto</h1>
                    {submitSuccess && <div className="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                        <strong className="font-bold">Success!</strong>
                        <span className="block sm:inline"> Form submitted successfully.</span>
                    </div>} {/* Mostrar mensaje de confirmación */}
                    {showEmptyFieldsMessage && <div className="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                        <strong className="font-bold">Error!</strong>
                        <span className="block sm:inline"> Fields cannot be empty.</span>
                    </div>} {/* Mostrar mensaje de campos vacíos */}
                    {phoneError && <div className="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                        <strong className="font-bold">Error!</strong>
                        <span className="block sm:inline"> Phone number can only contain numbers.</span>
                    </div>} {/* Mostrar mensaje de error en el campo de teléfono */}
                    <form onSubmit={handleSubmit}>
                        <div className="mb-4 relative">
                            <input
                                autoComplete="off"
                                id="name"
                                name="name"
                                type="text"
                                className="peer h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600"
                                value={formData.name}
                                onChange={handleChange}
                            />
                            <label
                                htmlFor="name"
                                className="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm"
                            >
                                Name
                            </label>
                        </div>
                        <div className="mb-4 relative">
                            <input
                                autoComplete="off"
                                id="phone"
                                name="phone"
                                type="tel"
                                className="peer h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600"
                                value={formData.phone}
                                onChange={handleChange}
                            />
                            <label
                                htmlFor="phone"
                                className="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm"
                            >
                                Phone
                            </label>
                        </div>
                        <div className="mb-4 relative">
                            <input
                                autoComplete="off"
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
                        <GoogleReCaptchaProvider reCaptchaKey={key}>
                            <GoogleReCaptcha onVerify={handleVerify} />
                        </GoogleReCaptchaProvider>,
                        <div className="relative mb-4">
                            {captchaIsDone && <ButtonSave type="submit" label="Send" />}
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
