// resources/js/Codea.jsx
import React from 'react';
import { createRoot } from 'react-dom/client'

export default function HomePage() {
    return (
        <div>HOMEPAGE</div>
    );
}

if (document.getElementById('homepage')) {
    createRoot(document.getElementById('homepage')).render(<HomePage />)
}