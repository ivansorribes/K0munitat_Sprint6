// resources/js/Codea.jsx
import React from 'react';
import { createRoot } from 'react-dom/client'
import image1 from '../../public/img/imgSobre1.png';
import image2 from '../../public/img/imgSobre3.jpg';
import image3 from '../../public/img/imgSobre4.jpeg';

export default function AboutUs(){
    return(
          <div className="relative max-w-8xl mx-auto">
            <h2 className="mb-0 lg:mb-6 font-sans text-lg lg:text-3xl text-cente lg:text-left font-bold leading-none tracking-tight text-gray-900 md:mx-auto">
              <span className="relative inline-block">
                <svg viewBox="0 0 52 24" fill="currentColor" className="absolute text-black -top-4 left-12 z-0 hidden w-32 -mt-8 -ml-20 text-blue-gray-100 lg:w-32 lg:-ml-28 lg:-mt-10 sm:block">
                </svg>
                <span className="relative text-xl lg:text-3xl text-center"> About Us </span>
              </span>
            </h2>
            <p className="pt-4 mb-10 text-gray-600">
            ¡Bienvenido a K0munitat! Nos entusiasma tenerte con nosotros mientras navegamos por la emocionante travesía del segundo año de Desarrollo de Aplicaciones Web. En nuestro grupo, no solo compartimos aulas y proyectos, sino también una visión común: construir una comunidad vibrante y colaborativa que fusiona la tecnología con la sostenibilidad.
            </p>
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

              <div className="shadow-lg rounded-lg overflow-hidden">
                <img src={image1}/>
              </div>


              <div className="shadow-lg rounded-lg overflow-hidden">
                <img src={image2}/>
              </div>


              <div className="shadow-lg rounded-lg overflow-hidden">
                <img src={image3}/>
              </div>
            </div>
            <p className="pt-10 text-gray-600">
            En K0munitat, nos hemos propuesto fortalecer los vínculos con la naturaleza y abordar la sobreproducción de alimentos y productos. Creemos en el poder de la innovación tecnológica para impulsar cambios positivos en nuestra sociedad y el medio ambiente. Y así es como nace nuestra aplicación web, una herramienta que va más allá de lo convencional.
            </p>
            <p className="pt-4 text-gray-600">
            Imagina una plataforma donde puedes explorar diversas comunidades en tu región, cada una con su identidad única y propósito compartido. Ya sea que te apasione la agricultura sostenible, desees compartir tus habilidades artesanales o simplemente busques un espacio donde tus valores encuentren eco, K0munitat es el lugar perfecto para conectarte con personas afines.
            </p>
            <p className="pt-4 text-gray-600">
            A través de nuestra aplicación web, te invitamos a descubrir historias inspiradoras, participar en proyectos emocionantes y contribuir a un movimiento que busca un equilibrio armonioso entre la tecnología y la sostenibilidad. Cada miembro es una pieza esencial de esta comunidad en crecimiento, y queremos que tu voz, tu experiencia y tu entusiasmo se sumen a la riqueza de K0munitat.
            </p>
            <p className="pt-4 text-gray-600">
            ¿Estás listo para embarcarte en este viaje emocionante con nosotros? La aventura apenas comienza, y estamos emocionados de contar contigo. ¡Bienvenido a K0munitat, donde la tecnología se encuentra con la sostenibilidad, y la comunidad se convierte en el motor del cambio positivo!
            </p>
          </div>
    );
}

if(document.getElementById('aboutus')){
    createRoot(document.getElementById('aboutus')).render(<AboutUs/>)
}