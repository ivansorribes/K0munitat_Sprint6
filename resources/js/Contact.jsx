import React, { useState } from 'react';
import { createRoot } from 'react-dom/client';
import { ButtonSave } from './components/buttons';

function Contact() {
    const [formData, setFormData] = useState({
        name: '',
        phone: '',
        email: '',
        message: ''
    });
    const [submitSuccess, setSubmitSuccess] = useState(false); // Estado para el mensaje de confirmación

    const handleChange = (e) => {
        setFormData({
            ...formData,
            [e.target.name]: e.target.value
        });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
    
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

                // Reiniciar el formulario después de 3 segundos
                setTimeout(() => {
                    setSubmitSuccess(false);
                    setFormData({
                        name: '',
                        phone: '',
                        email: '',
                        message: ''
                    });
                }, 3000);
            } else {
                console.error('Error al enviar el formulario');
            }
        } catch (error) {
            console.error('Error al enviar el formulario:', error);
        }
    };
    
    return (
        <div className="min-h-screen flex items-center justify-center bg-white-500">
            <div className="relative py-3 sm:max-w-xl sm:mx-auto">
                <div className="absolute inset-0 bg-gradient-to-r from-yellow-300 to-yellow-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl"></div>
                <div className="relative px-4 py-10 bg-white shadow-2xl sm:rounded-3xl sm:p-20 w-full max-w-md text-center">
                    <h1 className="text-2xl font-bold mb-4">Contacto</h1>
                    {submitSuccess && <p className="text-green-500 mb-4">¡Formulario enviado correctamente!</p>} {/* Mostrar mensaje de confirmación */}
                    <form onSubmit={handleSubmit}>
                        <div className="mb-4 relative">
                            <input
                                autoComplete="off"
                                id="name"
                                name="name"
                                type="text"
                                className="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600"
                                placeholder="Nombre"
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
                                type="phone"
                                className="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600"
                                placeholder="Teléfono"
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
                                className="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600"
                                placeholder="Correo electrónico"
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
                                className="peer placeholder-transparent h-32 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600 resize-none"
                                placeholder="Mensaje"
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
                            <ButtonSave type="submit" label="Send"/>
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
