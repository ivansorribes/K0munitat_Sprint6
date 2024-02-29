import React from "react";
import { createRoot } from "react-dom/client";

const Sidebar = () => {
    return (
        <div className="bg-gray-800 text-white w-64 flex-none h-screen sticky top-0">
            <div className="p-4 flex flex-col justify-between h-full">
                <div>
                    <h2 className="text-lg font-bold mb-4">Panel Administrativo</h2>
                    <ul className="space-y-2">
                        <li>
                            <a href="/paneladminPosts" className="hover:bg-gray-700 px-4 py-2 rounded flex items-center">
                                <svg className="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
                                </svg>
                                Posts
                            </a>
                        </li>
                        <li>
                            <a href="/paneladminComunitats" className="hover:bg-gray-700 px-4 py-2 rounded flex items-center">
                                <svg className="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Communities
                            </a>
                        </li>
                        <li>
                            <a href="/paneladminUsers" className="hover:bg-gray-700 px-4 py-2 rounded flex items-center">
                                <svg className="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 4a4 4 0 00-8 0v8a4 4 0 008 0V4zM16 4a4 4 0 00-8 0v8a4 4 0 008 0V4z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v3m0 0l-4-4m4 4l4-4"></path>
                                </svg>
                                Users
                            </a>
                        </li>
                        <li>
                            <a href="/paneladminAdvertisements" className="hover:bg-gray-700 px-4 py-2 rounded flex items-center">
                                <svg className="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M3 12l9-9 9 9-9 9-9-9zm0 0v-8m18 8v8m-18-8h18"></path>
                                </svg>
                                Advertisements
                            </a>
                        </li>
                        <li>
                            <a href="#" className="hover:bg-gray-700 px-4 py-2 rounded flex items-center">
                                <svg className="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H3"></path>
                                </svg>
                                Log Out
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

    );
};

if (document.getElementById("sidebar-container")) {
    createRoot(document.getElementById("sidebar-container")).render(<Sidebar />);
}

export default Sidebar;
