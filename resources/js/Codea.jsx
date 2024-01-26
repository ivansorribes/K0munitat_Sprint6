// resources/js/Codea.jsx
import React from 'react';
import { createRoot } from 'react-dom/client'

export default function Codea(){
    return(
        <div class="font-bold">ESTAMOS EN CODEA.APP PUT</div>
    );
}

if(document.getElementById('codeareact')){
    createRoot(document.getElementById('codeareact')).render(<Codea/>)
}