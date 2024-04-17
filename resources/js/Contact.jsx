import React, { useState } from 'react';

function Contact() {
    const [formData, setFormData] = useState({
        user_name: '',
        user_phone: '',
        user_email: '',
        message: ''
    });
    const [submitSuccess, setSubmitSuccess] = useState(false); // Estado para el mensaje de confirmación
    const [showEmptyFieldsMessage, setShowEmptyFieldsMessage] = useState(false); // Estado para mostrar el mensaje de campos vacíos
    const [phoneError, setPhoneError] = useState(false); // Estado para mostrar el mensaje de error en el campo de teléfono

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData({
            ...formData,
            [name]: value
        });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();

        // Check if any of the fields are empty
        if (formData.user_name === '' || formData.user_phone === '' || formData.user_email === '' || formData.message === '') {
            setShowEmptyFieldsMessage(true); // Set state to show empty fields message

            // Reset the state after 2 seconds
            setTimeout(() => {
                setShowEmptyFieldsMessage(false);
            }, 2000);

            return; // Exit the function early
        }

        // Send form data to the server
        sendFormData();
    };

    const sendFormData = async () => {
        try {
            const response = await fetch('/contact', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(formData),
            });

            if (response.ok) {
                // Reset form data and show submit success message
                setSubmitSuccess(true);
                setFormData({
                    user_name: '',
                    user_phone: '',
                    user_email: '',
                    message: ''
                });
            } else {
                console.error('Error al enviar el formulario:', response.statusText);
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
                                autoComplete="off"
                                id="user_name"
                                name="user_name"
                                type="text"
                                className="peer h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600"
                                onChange={handleChange}
                                value={formData.user_name}
                            />
                            <label
                                htmlFor="user_name"
                                className="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm"
                            >
                                Name
                            </label>
                        </div>
                        <div className="mb-4 relative">
                            <input
                                autoComplete="off"
                                id="user_phone"
                                name="user_phone"
                                type="tel"
                                className="peer h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600"
                                onChange={handleChange}
                                value={formData.user_phone}
                            />
                            <label
                                htmlFor="user_phone"
                                className="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm"
                            >
                                Phone
                            </label>
                        </div>
                        <div className="mb-4 relative">
                            <input
                                autoComplete="off"
                                id="user_email"
                                name="user_email"
                                type="email"
                                className="peer h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600"
                                onChange={handleChange}
                                value={formData.user_email}
                            />
                            <label
                                htmlFor="user_email"
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
                                onChange={handleChange}
                                value={formData.message}
                            ></textarea>
                            <label
                                htmlFor="message"
                                className="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm"
                            >
                                Message
                            </label>
                        </div>
                        <div className="relative mb-4">
                            <button type="submit" className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Send</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    );
}

export default Contact;
