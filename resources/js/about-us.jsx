// resources/js/Codea.jsx
import React from 'react';
import { createRoot } from 'react-dom/client'

export default function AboutUs(){
    return(
        <main className="mt-24 z-40 relative">
      <div className="container py-24 flex justify-between px-4 mx-auto gap-x-2">
        <article className="w-full px-4 rounded-lg mx-auto format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
          {/* First section */}
          <div className="relative py-4 lg:py-16 pt-0 lg:pt-24 max-w-8xl mx-auto">
            <h2 className="mb-0 lg:mb-6 font-sans text-lg lg:text-3xl text-center lg:text-left font-bold leading-none tracking-tight text-gray-900 md:mx-auto">
              <span className="relative inline-block">
                <svg viewBox="0 0 52 24" fill="currentColor" className="absolute text-black -top-4 left-12 z-0 hidden w-32 -mt-8 -ml-20 text-blue-gray-100 lg:w-32 lg:-ml-28 lg:-mt-10 sm:block">
                  <defs>
                    <pattern id="70326c9b-4a0f-429b-9c76-792941e326d5" x="0" y="0" width=".135" height=".30">
                      <circle cx="1" cy="1" r="1"></circle>
                    </pattern>
                  </defs>
                  <rect fill="url(#70326c9b-4a0f-429b-9c76-792941e326d5)" width="52" height="52"></rect>
                </svg>
                <span className="relative text-xl lg:text-3xl text-center"> Catalog </span>
              </span>
            </h2>
            <p className="pt-4">
              {/* Your paragraph content here */}
            </p>
            {/* Your grid with cards here */}
          </div>

          {/* Second section */}
          <div className="relative py-2 lg:py-16 max-w-8xl mx-auto">
            <h2 className="mb-0 lg:mb-6 font-sans text-lg lg:text-3xl text-center lg:text-left font-bold leading-none tracking-tight text-gray-900 md:mx-auto">
              <span className="relative inline-block">
                <svg viewBox="0 0 52 24" fill="currentColor" className="absolute text-black -top-4 left-12 z-0 hidden w-32 -mt-8 -ml-20 text-blue-gray-100 lg:w-32 lg:-ml-28 lg:-mt-10 sm:block">
                  <defs>
                    <pattern id="70326c9b-4a0f-429b-9c76-792941e326d5" x="0" y="0" width=".135" height=".30">
                      <circle cx="1" cy="1" r="1"></circle>
                    </pattern>
                  </defs>
                  <rect fill="url(#70326c9b-4a0f-429b-9c76-792941e326d5)" width="52" height="52"></rect>
                </svg>
                <span className="relative text-xl lg:text-3xl text-center"> Tempor amet et. </span>
              </span>
            </h2>
            <p className="pt-4">
              {/* Your paragraph content here */}
            </p>
            {/* Your grid with cards here */}
          </div>

          {/* Repeat the structure for other sections as needed */}
        </article>
      </div>
    </main>
    );
}

if(document.getElementById('aboutus')){
    createRoot(document.getElementById('aboutus')).render(<AboutUs/>)
}