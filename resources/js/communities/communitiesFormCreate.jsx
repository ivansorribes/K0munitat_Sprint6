import React, { useState, useEffect } from 'react';
import { createRoot } from 'react-dom/client';
import { Formik, Form, Field, ErrorMessage } from 'formik';
import axios from 'axios';
import CommunityRegionSelector from '../components/select/selectCommunityAut';
import {ButtonSave, ButtonCancel} from '../components/buttons';
import * as Yup from 'yup';
import DOMPurify from 'dompurify';

export default function CommunitiesFormCreate() {
  const [idAutonomousCommunity, setIdAutonomousCommunity] = useState('');
  const [idRegion, setIdRegion] = useState('');
  const [submitting, setSubmitting] = useState(false);
  const [serverErrors, setServerErrors] = useState(null);
  const [communityRegionError, setCommunityRegionError] = useState('');
  const [userData, setUserData] = useState(null); // Estado para almacenar los datos del usuario
  const [adminId, setAdminId] = useState(''); // Estado para almacenar el ID del administrador
  const [error, setError] = useState(''); // Estado para almacenar el mensaje de error
  const [success, setSuccess] = useState(''); // Estado para almacenar el mensaje de éxito

  const fetchData = async () => {
    try {
      // Realizar la solicitud GET a la API para obtener los datos del usuario
      const response = await axios.get('/communitiesUserActual'); // Ajusta la ruta según la API
      setUserData(response.data); // Almacena los datos del usuario en el estado
    } catch (error) {
      console.error('Error fetching user data from API:', error);
    }
  };

  useEffect(() => {
    // Llamar a la función fetchData al montar el componente
    fetchData();
  }, []);

  useEffect(() => {
    if (userData) {
      setAdminId(userData.id);
    }
  }, [userData]);


  const handleSubmit = async (values) => {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const formValues = {
      ...values,
      id_autonomousCommunity: idAutonomousCommunity,
      id_region: idRegion,
      id_admin:adminId,
      name: DOMPurify.sanitize(values.name), // Sanitize name input
      description: DOMPurify.sanitize(values.description) // Sanitize description input
    };
    setSubmitting(true);
    try {
      const response = await axios.post('/communities', formValues);
    
      if (response.data.message) {
        setSuccess('Form submitted successfully');
        setTimeout(() => {
          setSuccess('');
          window.location.href = '/communities';
        }, 3000); // Borra el mensaje de éxito después de 3 segundos y redirige
      }
    } catch (error) {
      if (error.response && error.response.data.errors) {
        // Errores de validación
        setServerErrors(error.response.data.errors);
      } else {
        // Otros errores
        setError('Error submitting the form');
        setTimeout(() => setError(''), 3000); // Borra el mensaje de error después de 3 segundos
      }
    } finally {
      setSubmitting(false);
    }
  };


  const cancelForm = () => {
    window.location.href = '/communities';
  };

  const validationSchema = Yup.object().shape({
    name: Yup.string().required('Community Name is required'),
    description: Yup.string().required('Community Description is required'),
    private: Yup.string().required('Please select the Type'),
  });

  return (
    <div className="container mx-auto mt-[8vw] md:mt-[8] lg:mt-[10] xl:mt-[12] mb-[4vw] relative">
    <div className="min-h-screen flex items-center justify-center bg-white-500">
      <div className="relative py-3 sm:max-w-3xl sm:mx-auto">
        <div className="absolute inset-0 bg-gradient-to-r from-yellow-300 to-yellow-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl"></div>
        <div className="relative px-4 py-10 bg-white shadow-2xl sm:rounded-3xl sm:p-20 w-full">
          <div className="max-w-[900px] mx-auto">
          {error && <div className="text-red-500">{error}</div>}
          {success && <div className="text-green-500">{success}</div>}
          <Formik
            initialValues={{
              id_autonomousCommunity: '',
              id_region: '',
              private: '',
              name: '',
              description: '',
              id_admin:adminId,
            }}
            validationSchema={validationSchema}
            onSubmit={handleSubmit}
          >
              <Form className="bg-white p-8 rounded-md shadow-md">
                <h1 className="text-2xl font-bold mb-4">Create Community Form</h1>
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
                    setCommunityRegionError={setCommunityRegionError}
                  />
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

                <div className="flex justify-between">
                  <div>
                    <ButtonCancel label='Cancel' onClick={cancelForm} />
                  </div>
                  <button
                    className="text-white px-4 py-2 rounded"
                    style={{ background: '#64a858'}}
                    type='submit'
                    disabled={submitting || success || error} // Deshabilita el botón cuando se está enviando el formulario o se muestra un mensaje de éxito/error
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
      </div>
    </div>
    </div>
  );
}

if (document.getElementById('communityForm') && !document.getElementById('communityForm').hasChildNodes()) {
  createRoot(document.getElementById('communityForm')).render(<CommunitiesFormCreate />);
}