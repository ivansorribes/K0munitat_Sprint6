import React, { useEffect, useState } from 'react';
import { createRoot } from 'react-dom/client';
// import MapSvg from './map.min.svg'; // Suponiendo que este es tu archivo SVG
import arbol from './arbol.json';
import SvgComponent from './MapSVGComponent';

const Map = () => {
    useEffect(() => {
        // Como los datos ya están importados, no necesitas cargarlos asíncronamente
        console.log("Datos cargados:", arbol);
        // Aquí puedes utilizar los datos directamente
    }, []);

    const handleSvgClick = async (event) => {
        const path = event.target.closest("path");
        if (path) {
            const pathId = path.getAttribute("id");
            console.log(`Clic en path con id: ${pathId}`);
            // Implementa tu lógica aquí
        }
    };

    return (
        <div>
            <SvgComponent onClick={handleSvgClick} />
        </div>
    );
};

export default Map;

if (document.getElementById('map')) {
    const root = createRoot(document.getElementById('map'));
    root.render(<Map />);
}
