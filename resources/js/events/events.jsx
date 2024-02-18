import { createRoot } from 'react-dom/client';
import React, { useState, useEffect } from 'react';
import { Calendar, momentLocalizer } from 'react-big-calendar';
import moment from 'moment';
import Modal from 'react-modal';
import { Formik, Field, Form, ErrorMessage } from 'formik';
import axios from 'axios';
import 'react-big-calendar/lib/css/react-big-calendar.css';

const localizer = momentLocalizer(moment);

const customStyles = {
    content: {
      top: '50%',
      left: '50%',
      right: 'auto',
      bottom: 'auto',
      marginRight: '-50%',
      transform: 'translate(-70%, -70%)',
    },
    overlay: {zIndex: 1000},

  };

const EventCalendar = () => {
    const [events, setEvents] = useState([]);
    const [modalIsOpen, setModalIsOpen] = useState(false);

    useEffect(() => {
        // Cargar eventos desde la API al montar el componente
        fetch('http://localhost/api/events')
            .then(response => response.json())
            .then(data => setEvents(data))
            .catch(error => console.error('Error fetching events:', error));
    }, []);

    const handleSelect = ({ start, end }) => {
        console.log('Opening modal...');
        setModalIsOpen(true);
    };

    const handleModalClose = () => {
        setModalIsOpen(false);
    };

    const handleFormSubmit = (values, { resetForm }) => {
        values.id_community = parseInt(values.id_community, 10);
        axios.post('http://localhost/api/events', values)
            .then(response => {
                setEvents(prevEvents => [...prevEvents, response.data]);
                setModalIsOpen(false);
                resetForm();
            })
            .catch(error => {
                console.error('Error saving event:', error);
                if (error.response) {
                    // El servidor respondió con un código de error
                    console.error('Response data:', error.response.data);
                    console.error('Response status:', error.response.status);
                    console.error('Response headers:', error.response.headers);
                } else if (error.request) {
                    // La solicitud se hizo pero no se recibió respuesta
                    console.error('No response received:', error.request);
                } else {
                    // Algo sucedió en la configuración de la solicitud que generó un error
                    console.error('Error setting up the request:', error.message);
                }
            });
    };

    return (
        <div className="my-6 mx-auto max-w-6xl">
            <Modal
                isOpen={modalIsOpen}
                onRequestClose={handleModalClose}
                contentLabel="New Event"
                style={customStyles}
            >
                <h2>New Event</h2>
                <Formik
                    initialValues={
                        { 
                            title: '',
                            start: '',
                            end: '',
                            id_user: 7,
                            id_community:'',
                        }
                    }
                    onSubmit={handleFormSubmit}
                >
                    <Form className="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                        <div className="mb-4">
                            <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="title">
                                Title:
                            </label>
                            <Field
                                type="text"
                                name="title"
                                id="title"
                                className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required
                            />
                            <ErrorMessage name="title" component="p" className="text-red-500 text-xs italic" />
                        </div>
                        <div className="mb-4">
                            <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="title">
                                Community:
                            </label>
                            <Field
                                type="text"
                                name="id_community"
                                id="id_community"
                                className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required
                            />
                            <ErrorMessage name="title" component="p" className="text-red-500 text-xs italic" />
                        </div>
                        <div className="mb-4">
                            <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="start">
                                Init date:
                            </label>
                            <Field
                                type="datetime-local"
                                name="start"
                                id="start"
                                className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required
                            />
                            <ErrorMessage name="start" component="p" className="text-red-500 text-xs italic" />
                        </div>
                        <div className="mb-6">
                            <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="end">
                                End Date:
                            </label>
                            <Field
                                type="datetime-local"
                                name="end"
                                id="end"
                                className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required
                            />
                            <ErrorMessage name="end" component="p" className="text-red-500 text-xs italic" />
                        </div>
                        <div className="flex items-center justify-between">
                            <button
                                type="submit"
                                className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            >
                                Save
                            </button>
                        </div>
                    </Form>
                </Formik>
            </Modal>
            <Calendar
                localizer={localizer}
                events={events}
                startAccessor="start"
                endAccessor="end"
                style={{ height: 600 }}
                selectable
                onSelectSlot={handleSelect}
            />
        </div>
    );
};

Modal.setAppElement('#MyCalendar'); 
if (document.getElementById('MyCalendar')) {
    createRoot(document.getElementById('MyCalendar')).render(<EventCalendar />);
}
