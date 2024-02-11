import React, {useState} from 'react';
import { createRoot } from 'react-dom/client';
import { Formik, Form, Field } from 'formik';
import axios from 'axios';
import CommunityRegionSelector from '../components/select/selectCommunityAut';

export default function CommunitiesFormCreate() {
  const [idAutonomousCommunity, setIdAutonomousCommunity] = useState('');
  const [idRegion, setIdRegion] = useState('');

  const handleSubmit = async (values) => {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const formValues = { ...values, id_autonomousCommunity: idAutonomousCommunity, id_region: idRegion };
    console.log('Datos del formulario:', formValues);
    try {
      const response = await axios.post('http://localhost/communities', formValues);
  
      if (response.status === 302) {
        // Redirección exitosa, puedes manejar esto según tus necesidades
        console.log('Form submitted successfully');
      } else {
        // Si la solicitud no tiene éxito (cualquier código diferente de 302)
        throw new Error(`Failed to submit the form. Server returned ${response.statusText}`);
      }
    } catch (error) {
      if (error.response) {
        // Si el servidor devuelve un código de estado diferente de 2xx
        console.error('Server error:', error.response.data);
      } else if (error.request) {
        // Si la solicitud fue realizada pero no se recibió respuesta
        console.error('No response received:', error.request);
      } else {
        // Otros errores
        console.error('Error submitting the form:', error.message);
      }
    }
  };

  return (
    <div className="flex justify-center items-center p-12 min-h-screen">
      <div className="w-full max-w-[700px]">
        <Formik
          initialValues={{
            id_autonomousCommunity: '',
            id_region: '',
            private: '',
            name: '',
            description: '',
            id_admin: 2,

          }}
          onSubmit={handleSubmit}
        >
          <Form className="bg-white p-8 rounded-md shadow-md">
            <h1 className="text-4xl font-bold mb-5">Create Community Form</h1>

            <div className="mb-5">
              <label htmlFor="name" className="mb-3 block text-base font-medium text-[#07074D]">
                Community Name
              </label>
              <Field
                type="text"
                name="name"
                placeholder="Community name"
                className="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-[#6B7280] focus:outline-none focus:border-[#6A64F1] focus:shadow-md"
              />
            </div>

            <div className="mb-5">
              <label htmlFor="message" className="mb-3 block text-base font-medium text-[#07074D]">
                Community Description
              </label>
              <Field
                as="textarea"
                rows="4"
                name="description"
                placeholder="Type your message"
                className="w-full resize-none rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-[#6B7280] focus:outline-none focus:border-[#6A64F1] focus:shadow-md"
              />
            </div>

            <div className="mb-5">
              <label htmlFor="name" className="mb-3 block text-base font-medium text-[#07074D]">
                Community Ubication
              </label>
              <CommunityRegionSelector 
                  width="w-full"
                  onCommunityChange={setIdAutonomousCommunity}
                onRegionChange={setIdRegion}
             />
            </div>

            <div className="mb-5">
              <label className="block text-base font-medium text-[#07074D]">Type</label>
              <div className="mt-2">
                <Field type="radio" id="public" name="private" value="0" className="mr-2" />
                <label htmlFor="public" className="mr-4">Public</label>
                <Field type="radio" id="private" name="private" value="1" className="mr-2" />
                <label htmlFor="private">Private</label>
              </div>
            </div>

            <div>
              <button
                type="submit"
                className="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-base font-semibold text-white focus:outline-none"
              >
                Submit
              </button>
            </div>
          </Form>
        </Formik>
      </div>
    </div>
  );
}

if (document.getElementById('communityform')) {
  createRoot(document.getElementById('communityform')).render(
    <CommunitiesFormCreate />
  );
}
