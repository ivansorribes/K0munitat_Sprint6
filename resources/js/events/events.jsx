import { createRoot } from 'react-dom/client';
import React, { useState, useEffect } from 'react';
import { Calendar, momentLocalizer } from 'react-big-calendar';
import moment from 'moment';
import 'react-big-calendar/lib/css/react-big-calendar.css';

const localizer = momentLocalizer(moment);

const EventCalendar = () => {
    const [events, setEvents] = useState([]);

    useEffect(() => {
        // Cargar eventos desde la API al montar el componente
        fetch('/api/events')
            .then(response => response.json())
            .then(data => setEvents(data))
            .catch(error => console.error('Error fetching events:', error));
    }, []);

    const handleSelect = ({ start, end }) => {
        const title = window.prompt('Nuevo evento:');
        if (title) {
            // Guardar evento en la API
            fetch('/api/events', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ title, start, end }),
            })
            .then(response => response.json())
            .then(data => setEvents([...events, data]))
            .catch(error => console.error('Error saving event:', error));
        }
    };

    return (
        <div>
            <Calendar
                localizer={localizer}
                events={events}
                startAccessor="start"
                endAccessor="end"
                style={{ height: 500 }}
                selectable
                onSelectSlot={handleSelect}
            />
        </div>
    );
};

if (document.getElementById('MyCalendar')) {
  createRoot(document.getElementById('MyCalendar')).render(<EventCalendar />);
}
