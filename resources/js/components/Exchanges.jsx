import React, { useEffect } from 'react';
import { createRoot } from 'react-dom/client';

const contadorIniciado = {};

export default function Exchanges() {


    return (
        <div className="justify-center items-center py-5 text-center bg-light mx-auto">
            <div className="py-5 text-center justify-center items-center border p-3 mb-3 bg-white/50 rounded-lg">
                <h1 className="titulo-principal my-5 text-black text-xl">Are you joining the exchange?</h1>

                <div className="flex flex-row gap-6">
                    <div className="border p-3 mb-3 bg-white/50 rounded-lg" onMouseOver={() => iniciarContador('contador-herramientas', 470)}>
                        <h2 className="mb-3 p-3 text-black text-xl">Exchanges</h2>
                        <h3 className="contador-herramientas text-black text-4xl">+300</h3>
                        <div className="flex items-center justify-center">
                            <img
                                src="https://cdn-icons-png.flaticon.com/512/4866/4866732.png"
                                className="m-3"
                                alt="Icono de Herramientas"
                                style={{ maxWidth: '30%', marginTop: '3%' }}
                            />
                        </div>
                    </div>
                    <div className="border p-3 mb-3 bg-white/50 rounded-lg">
                        <h2 className="mb-3 p-3 text-black text-xl">Preserved vegetables</h2>
                        <h3 className="contador-verduras text-black text-4xl">+2000</h3>
                        <div className="flex items-center justify-center">
                            <img
                                src="https://cdn-icons-png.flaticon.com/512/4251/4251938.png"
                                className="m-3"
                                alt="Icono de Verduras"
                                style={{ maxWidth: '30%', marginTop: '3%' }}
                            />
                        </div>
                    </div>
                    <div className="border p-3 mb-3 bg-white/50 rounded-lg">
                        <h2 className="mb-3 p-3 text-black text-xl">Saved Fuel</h2>
                        <h3 className="contador-gasolina text-black text-4xl">+300L</h3>
                        <div className="flex items-center justify-center">

                            <img
                                src="https://cdn-icons-png.flaticon.com/512/523/523340.png"
                                className="m-3"
                                alt="Icono de Gasolina"
                                style={{ maxWidth: '30%', marginTop: '3%' }}
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div >
    );
}

if (document.getElementById('exchanges')) {
    createRoot(document.getElementById('exchanges')).render(<Exchanges />);
}
