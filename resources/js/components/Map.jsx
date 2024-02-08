import React, { useEffect, useState } from 'react';
import { createRoot } from 'react-dom/client';
import SvgComponent from './MapSVGComponent';

const Map = () => {
    return (
        <>
            <div>
                <SvgComponent />
            </div>
        </>
    );
};

export default Map;

if (document.getElementById('map')) {
    const root = createRoot(document.getElementById('map'));
    root.render(<Map />);
}
