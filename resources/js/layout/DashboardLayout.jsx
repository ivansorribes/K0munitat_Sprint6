import React from 'react';
import { Header } from './components'
import { Footer } from './components'
const DashboardLayout = ({ children }) => {
  return (
    <div>
      <Header />
      {children}
      <Footer />
    </div>
  );
}

export default DashboardLayout;