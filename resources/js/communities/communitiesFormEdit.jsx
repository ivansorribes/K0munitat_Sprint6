import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import { Formik, Form, Field, ErrorMessage } from 'formik';


const CommunitiesFormEdit = ({ communityData, onCancel, onSubmit }) => {
    const [community, setCommunity] = useState(null);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await axios.get(`http://localhost/api/communities/${communityId}`);
        console.log('API Response:', response.data);
        setCommunity(response.data);
      } catch (error) {
        console.error('Error loading community data:', error.message);
      }
    };

    fetchData();
  }, [communityId]);

  const handleSubmit = async (values) => {
    try {
      const response = await axios.put(`http://localhost/communities/${communityId}`, values);

      if (response.data.message) {
        console.log('Community updated successfully');
      }
    } catch (error) {
      console.error('Error updating community:', error.message);
    }
  };

  if (!community) {
    return <div>Loading...</div>;
  }

  return (
     <Formik
      initialValues={{
        name: community.name,
        description: community.description,
        id_autonomousCommunity: community.id_autonomousCommunity,
        id_region: community.id_region,
        private: community.private ? '1' : '0',
        id_admin: community.id_admin,
      }}
      onSubmit={handleSubmit}
    >
      <Form>
      <h1 className="text-4xl font-bold mb-5">Edit Community</h1>
        <div>
          <label htmlFor="name">Community Name</label>
          <Field
            type="text"
            id="name"
            name="name"
            placeholder="Community name"
          />
          <ErrorMessage name="name" component="div" />
        </div>

        <div>
          <label htmlFor="description">Community Description</label>
          <Field
            as="textarea"
            id="description"
            name="description"
            placeholder="Type your message"
          />
          <ErrorMessage name="description" component="div" />
        </div>

        <div>
          <label htmlFor="id_autonomousCommunity">Autonomous Community</label>
          <Field
            type="text"
            id="id_autonomousCommunity"
            name="id_autonomousCommunity"
            placeholder="Autonomous Community ID"
          />
          <ErrorMessage name="id_autonomousCommunity" component="div" />
        </div>

        <div>
          <label htmlFor="id_region">Region</label>
          <Field
            type="text"
            id="id_region"
            name="id_region"
            placeholder="Region ID"
          />
          <ErrorMessage name="id_region" component="div" />
        </div>

        <div>
          <label htmlFor="private">Type</label>
          <Field as="select" id="private" name="private">
            <option value="0">Public</option>
            <option value="1">Private</option>
          </Field>
          <ErrorMessage name="private" component="div" />
        </div>

        <div>
          <label htmlFor="id_admin">Admin ID</label>
          <Field
            type="text"
            id="id_admin"
            name="id_admin"
            placeholder="Admin ID"
          />
          <ErrorMessage name="id_admin" component="div" />
        </div>

        <div>
          <button type="submit">Update</button>
        </div>
      </Form>
    </Formik> 
    
  );
};

export default CommunitiesFormEdit;  // No cambies el nombre de la exportación