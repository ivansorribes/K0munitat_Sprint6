// resources/js/Codea.jsx
import React from 'react';
import { createRoot } from 'react-dom/client'
import MapaComponent from './components/Map';

export default function HomePage() {
    return (
        <>
            <MapaComponent />
        </>
    );
}

if (document.getElementById('homepage')) {
    createRoot(document.getElementById('homepage')).render(<HomePage />)
}