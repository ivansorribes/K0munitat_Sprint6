import React, { useState } from 'react';
import { Calendar, momentLocalizer } from 'react-big-calendar';
import moment from 'moment';
import 'react-big-calendar/lib/css/react-big-calendar.css';

const localizer = momentLocalizer(moment);

const MyCalendar = () => {
  const [events, setEvents] = useState([
    {
      title: 'Evento 1',
      start: new Date(),
      end: new Date(),
    },
  ]);

  const handleSelect = ({ start, end }) => {
    const title = window.prompt('Nuevo evento:');
    if (title) {
      setEvents([...events, { start, end, title }]);
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

export default MyCalendar;
if (document.getElementById('MyCalendar')) {
  const root = createRoot(document.getElementById('MyCalendar'));
  root.render(<MyCalendar />);
}
