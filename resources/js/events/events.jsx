import { createRoot } from 'react-dom/client';
import React, { useState, useEffect } from 'react';
import { Calendar, momentLocalizer } from 'react-big-calendar';
import moment from 'moment';
import 'moment-timezone';
import Modal from 'react-modal';
import { Formik, Field, Form, ErrorMessage } from 'formik';
import axios from 'axios';
import 'react-big-calendar/lib/css/react-big-calendar.css';
import '../../css/event.css';

const localizer = momentLocalizer(moment);
moment.tz.setDefault('Europe/Madrid');

const customStyles = {
    content: {
        top: '50%',
        left: '50%',
        right: 'auto',
        bottom: 'auto',
        transform: 'translate(-50%, -50%)', // Centrar la modal horizontal y verticalmente
        maxWidth: '90%', // Ancho máximo relativo al tamaño de la ventana
        maxHeight: '90%', // Altura máxima relativa al tamaño de la ventana
        width: 'auto', // Permitir que el ancho se ajuste al contenido
        height: 'auto', // Permitir que la altura se ajuste al contenido
        padding: '20px', // Espaciado interno
        borderRadius: '8px', // Bordes redondeados
        boxShadow: '0px 0px 20px rgba(0, 0, 0, 0.1)', // Sombra
        overflow: 'auto' // Permitir desplazamiento si el contenido es demasiado grande
    },
    overlay: { 
        zIndex: 1000, 
        backgroundColor: 'rgba(0, 0, 0, 0.5)' // Color de fondo del overlay
    }
};
const EventCalendar = () => {
    const [events, setEvents] = useState([]);
    const [user, setUser] = useState([]);
    const [modalIsOpen, setModalIsOpen] = useState(false);
    const [selectedDate, setSelectedDate] = useState(null);
    const [formValues, setFormValues] = useState({
        title: '',
        start: '',
        end: '',
        id_user: null,
    });

    useEffect(() => {
        fetch('http://localhost/eventsList')
            .then(response => response.json())
            .then(data => {
                setEvents(data.events);
                setUser(data.user);
            })
            .catch(error => console.error('Error fetching events:', error));
    }, []);

    const handleSelect = ({ start }) => {
        setModalIsOpen(true);

        const selectedDate = moment(start).startOf('day');
        const formattedDate = selectedDate.format('YYYY-MM-DD');

        setSelectedDate(selectedDate);

        setFormValues(prevValues => ({
            ...prevValues,
            start: formattedDate,
        }));
    };

    const handleModalClose = () => {
        setModalIsOpen(false);
        setSelectedDate(null);
    };

    const handleFormSubmit = (values, { resetForm }) => {
        values.start = formValues.start;
        axios.post('http://localhost/eventsList', values, {
            headers: {
                'X-CSRF-TOKEN': window.csrf_token 
            }
        })
            .then(response => {
                setEvents(prevEvents => [...prevEvents, response.data]);
                setModalIsOpen(false);
                resetForm();
                setSelectedDate(null);
                setFormValues({
                    title: '',
                    start: '',
                    end: '',
                    id_user: user.id,
                });
                window.location.reload();
            })
            .catch(error => {
                // Manejar errores
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
                    initialValues={{ title: '', start: '', end: '', id_user: user.id }}
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
                            <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="start">
                                Init date:
                            </label>
                            <Field
                                type="date"
                                name="start"
                                id="start"
                                value={formValues.start}
                                onChange={(e) => setFormValues({ ...formValues, start: e.target.value })}
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
                                type="date"
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
                className="custom_background letter"
                localizer={localizer}
                events={events}
                startAccessor="start"
                endAccessor={event => moment(event.end).endOf('day').toDate()}
                style={{ height: 700 }}
                selectable
                onSelectSlot={handleSelect}
            />
        </div>
    );
};


if (document.getElementById('MyCalendar')) {
    createRoot(document.getElementById('MyCalendar')).render(<EventCalendar />);
}
