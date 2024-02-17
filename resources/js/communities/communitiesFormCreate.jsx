import React, { useState } from 'react';
import { createRoot } from 'react-dom/client';
import { Formik, Form, Field, ErrorMessage } from 'formik';
import axios from 'axios';
import CommunityRegionSelector from '../components/select/selectCommunityAut';

export default function CommunitiesFormCreate() {
  const [idAutonomousCommunity, setIdAutonomousCommunity] = useState('');
  const [idRegion, setIdRegion] = useState('');
  const [submitting, setSubmitting] = useState(false);
  const [serverErrors, setServerErrors] = useState(null);
  const id = document.getElementById("id_user").value;

  const handleSubmit = async (values) => {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const formValues = { ...values, id_autonomousCommunity: idAutonomousCommunity, id_region: idRegion };
    setSubmitting(true);
    try {
      const response = await axios.post('http://localhost/communities', formValues);

      if (response.data.message) {
        // La comunidad se creó exitosamente
        // Puedes redirigir o mostrar un mensaje de éxito
        console.log('Form submitted successfully');
      }
    } catch (error) {
      if (error.response && error.response.data.errors) {
        // Errores de validación
        setServerErrors(error.response.data.errors);
      } else {
        // Otros errores
        console.error('Error submitting the form:', error.message);
      }
    } finally {
      setSubmitting(false);
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
            id_admin: id,
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
              <ErrorMessage name="name" component="div" className="text-red-500" />
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
              <ErrorMessage name="description" component="div" className="text-red-500" />
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
              <ErrorMessage name="id_autonomousCommunity" component="div" className="text-red-500" />
              <ErrorMessage name="id_region" component="div" className="text-red-500" />
            </div>

            <div className="mb-5">
              <label className="block text-base font-medium text-[#07074D]">Type</label>
              <div className="mt-2">
                <Field type="radio" id="public" name="private" value="0" className="mr-2" />
                <label htmlFor="public" className="mr-4">
                  Public
                </label>
                <Field type="radio" id="private" name="private" value="1" className="mr-2" />
                <label htmlFor="private">Private</label>
              </div>
              <ErrorMessage name="private" component="div" className="text-red-500" />
            </div>

            <div>
              <button
                type="submit"
                className="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-base font-semibold text-white focus:outline-none"
              >
                Submit
              </button>
            </div>

            {serverErrors && (
              <div className="mt-5 text-red-500">
                {/* Muestra los errores del servidor */}
                {Object.values(serverErrors).map((error, index) => (
                  <div key={index}>{error}</div>
                ))}
              </div>
            )}
          </Form>
        </Formik>
      </div>
    </div>
  );
}

if (document.getElementById('communityForm')) {
  createRoot(document.getElementById('communityForm')).render(<CommunitiesFormCreate />);
}
