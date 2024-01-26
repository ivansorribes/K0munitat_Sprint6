// resources/js/App.jsx
import React from 'react';
import { createRoot } from 'react-dom/client'
import { DashboardLayout } from './layout'
export default function App(){
    return(
        <>
        <Routes>
            <Route
             path="/dashboard/*"
             element={
                <DashboardLayout>
                    
                </DashboardLayout>
             }/>
        </Routes>
        </>
    );
}

if(document.getElementById('root')){
    createRoot(document.getElementById('root')).render(<App />)
}

