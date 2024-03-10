import { useState, useEffect } from 'react';
import axios from 'axios';

const useAuth = () => {
  const storedToken = sessionStorage.getItem('authToken');
  const storedUserId = sessionStorage.getItem('userId');
  const [token, setToken] = useState(storedToken || (window.authData ? window.authData.token : null));
  const [userId, setUserId] = useState(storedUserId || (window.authData ? window.authData.userId : null));


  useEffect(() => {
    if (token && !storedToken) {
      sessionStorage.setItem('authToken', token);
    }

    if (userId && !storedUserId) {
      sessionStorage.setItem('userId', userId);
    }
  }, [token, userId, storedToken, storedUserId]);

  const updateAuth = (newToken, newUserId) => {
    setToken(newToken);
    setUserId(newUserId);
  };

  const clearAuth = () => {
    setToken(null);
    setUserId(null);
    sessionStorage.removeItem('authToken');
    sessionStorage.removeItem('userId');
  };

  const getNewToken = async () => {
    try {
      const response = await axios.post('http://localhost/tokenReturn', {}, {
        headers: {
          Authorization: `Bearer ${token}`, // Puedes incluir el token actual si es necesario
        },
      });

      const { token: newToken, userId: newUserId } = response.data;
      updateAuth(newToken, newUserId);
    } catch (error) {
      console.error('Error getting new token:', error.message);
    }
  };

  return { token, userId, updateAuth, clearAuth, getNewToken };
};

export default useAuth;
