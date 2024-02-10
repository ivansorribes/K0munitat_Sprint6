import React, { useState } from 'react';
import { createRoot } from 'react-dom/client';
import CommunityRegionSelector from '../components/select/selectCommunityAut';
import RegionSelector from '../components/select/selectRegion';


export default function CommunitiesFormCreate() {
  const [selectedCommunity, setSelectedCommunity] = useState('');
  const [selectedRegion, setSelectedRegion] = useState('');

  const handleSelectCommunity = (communityId) => {
    setSelectedCommunity(communityId);
  };

  const handleSelectRegion = (regionId) => {
    setSelectedRegion(regionId);
  };

  const handleSubmit = (event) => {
    event.preventDefault();
    console.log("Comunidad seleccionada:", selectedCommunity);
    console.log("Región seleccionada:", selectedRegion);
    // Agrega la lógica para enviar el formulario al servidor si es necesario
  };

    return (
      <div className="flex justify-center items-center p-12 min-h-screen">
      <div className="w-full max-w-[700px]">   
        <form action="#" method="POST" className="bg-white p-8 rounded-md shadow-md">
          <h1 className="text-4xl font-bold mb-5">Create Community Form</h1>
    
          <div className="mb-5">
            <label
              htmlFor="name"
              className="mb-3 block text-base font-medium text-[#07074D]"
            >
              Community Name
            </label>
            <input
              type="text"
              name="name"
              id="name"
              placeholder="Community name"
              className="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
            />
          </div>
    
          <div className="mb-5">
            <label
              htmlFor="message"
              className="mb-3 block text-base font-medium text-[#07074D]"
            >
              Community Description
            </label>
            <textarea
              rows="4"
              name="message"
              id="message"
              placeholder="Type your message"
              className="w-full resize-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
            ></textarea>
          </div>
    
          <div>
            <CommunityRegionSelector />
          </div>

          <div>
            <button
              className="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-base font-semibold text-white outline-none"
            >
              Submit
            </button>
          </div>
        </form>    
      </div>
    </div>    
    );
  }


if (document.getElementById('communityform')) {
    createRoot(document.getElementById('communityform')).render(<CommunitiesFormCreate />);
}
