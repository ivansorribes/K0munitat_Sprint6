import React from 'react';
import { createRoot } from 'react-dom/client';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faEdit, faSave, faTimes, faHeart, faComment } from '@fortawesome/free-solid-svg-icons';
import { useEffect } from 'react'; // Agrega useEffect a la importación



export default function AdminPanel() {
    useEffect(() => {

        const sideMenu = document.querySelector('aside');
        const menuBtn = document.getElementById('menu-btn');
        const closeBtn = document.getElementById('close-btn')

        const darkMode = document.querySelector('.dark-mode')

        menuBtn.addEventListener('click', () => {
            sideMenu.style.display = 'block'
        });

        closeBtn.addEventListener('click', () => {
            sideMenu.style.display = 'none'
        });

        darkMode.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode-variables');
            darkMode.querySelector('span:nth-child(1)').classList.toggle('active');
            darkMode.querySelector('span:nth-child(2)').classList.toggle('active');

        })


        const Orders = [
            {
                productName: 'JavasCript Tutorial',
                productNumber: '85743',
                paymentStatus: 'Due',
                status: 'Pending'
            },
            {
                productName: 'Css full course',
                productNumber: '97245',
                paymentStatus: 'Refunded',
                status: 'Declined'
            },
            {
                productName: 'Flex-box tutorial',
                productNumber: '36452',
                paymentStatus: 'Paid',
                status: 'Active'
            },
        ];

        Orders.forEach(order => {
            const tr = document.createElement('tr');
            const trContent = `
                <td>${order.productName}</td>
                <td>${order.productNumber}</td>
                <td>${order.paymentStatus}</td>
                <td class="${order.status === 'Declined' ? 'danger' : order.status === 'Pending' ? 'warning' : 'primary'}">${order.status}</td>
                <td class="primary">Details</td>
            `;
            tr.innerHTML = trContent;
            document.querySelector('.recent-orders table tbody').appendChild(tr);
        });
    }, []);
    return (
        <div className="container">
            <aside>
                <div className="toggle">
                    <div className="logo">
                        <h2>K0<span className="danger">munitat</span></h2>
                    </div>
                    <div className="close" id="close-btn">
                        <span className="material-icons-sharp">
                            close
                        </span>
                    </div>
                </div>

                <div className="sidebar">
                    <a href="#">
                        <span className="material-icons-sharp">
                            dashboard
                        </span>
                        <h3>Dashboard</h3>
                    </a>
                    <a href="/paneladminUsers">
                        <span className="material-icons-sharp">
                            person_outline
                        </span>
                        <h3>Users</h3>
                    </a>
                    <a href="#">
                        <span className="material-icons-sharp">
                            receipt_long
                        </span>
                        <h3>Posts</h3>
                    </a>
                    <a href="#" className="active">
                        <span className="material-icons-sharp">
                            group
                        </span>
                        <h3>Communities</h3>
                    </a>
                    <a href="#">
                        <span className="material-icons-sharp">
                            mail_outline
                        </span>
                        <h3>Blog</h3>
                    </a>
                    <a href="#">
                        <span className="material-icons-sharp">
                            settings
                        </span>
                        <h3>Settings</h3>
                    </a>
                    <a href="#">
                        <span className="material-icons-sharp">
                            add
                        </span>
                        <h3>New login</h3>
                    </a>
                    <a href="#">
                        <span className="material-icons-sharp">
                            logout
                        </span>
                        <h3>Logout</h3>
                    </a>
                </div>
            </aside>

            <main>
                <h1>Analyticis</h1>
                <div className="analyse">
                    <div className="sales">
                        <div className="status">
                            <div className="info">
                                <h3>Total Sales</h3>
                                <h1>$65.024</h1>
                            </div>
                            <div className="progresss">
                                <svg>
                                    <circle cx="38" cy="38"
                                        r="36"></circle>
                                </svg>
                                <div className="percentage">
                                    <p>+81%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="visits">
                        <div className="status">
                            <div className="info">
                                <h3>Site visit</h3>
                                <h1>24,981</h1>
                            </div>
                            <div className="progresss">
                                <svg>
                                    <circle cx="38" cy="38"
                                        r="36"></circle>
                                </svg>
                                <div className="percentage">
                                    <p>-48%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="searches">
                        <div className="status">
                            <div className="info">
                                <h3>Searches</h3>
                                <h1>14,147</h1>
                            </div>
                            <div className="progresss">
                                <svg>
                                    <circle cx="38" cy="38"
                                        r="36"></circle>
                                </svg>
                                <div className="percentage">
                                    <p>+21%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div className="new-users">
                    <h2>New Users</h2>
                    <div className="user-list">
                        <div className="user">
                            <img src="profile/images/snoopy17.jpg"></img>
                            <h2>Tatiana</h2>
                            <p>54 min ago</p>
                        </div>
                        <div className="user">
                            <img src="profile/images/snoopy17.jpg"></img>
                            <h2>Ivan</h2>
                            <p>3 Hours Ago</p>
                        </div>
                        <div className="user">
                            <img src="profile/images/snoopy17.jpg"></img>
                            <h2>Cristian</h2>
                            <p>6 Hours Ago</p>
                        </div>
                        <div className="user">
                            <img src="img/plus_icon.png"></img>
                            <h2>More</h2>
                            <p>New User</p>
                        </div>
                    </div>
                </div>

                <div className="recent-orders">
                    <h2>Recent Orders</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Course Name</th>
                                <th>Course Number</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <a href="#">Show All</a>
                </div>


            </main>

            <div className="right-section">
                <div className="nav">
                    <button id="menu-btn">
                        <span className="material-icons-sharp">
                            menu
                        </span>
                    </button>
                    <div className="dark-mode">
                        <span className="material-icons-sharp active">
                            light_mode
                        </span>
                        <span className="material-icons-sharp">
                            dark_mode
                        </span>
                    </div>

                    <div className="profile">
                        <div className="info">
                            <p>Hey, <b>Reza</b></p>
                            <small className="text-muted">Admin</small>
                        </div>
                        <div className="profile-photo">
                            <img src="profile/images/snoopy17.jpg" />
                        </div>
                    </div>

                </div>

                <div className="user-profile">
                    <div className="logo">
                        <img src="img/Logo_K0munitat_Pequeño.png" />
                        <h2>K0munitat</h2>
                        <p>Create your blog</p>
                    </div>
                </div>
                <div className="reminders">
                    <div className="header">
                        <h2>Reminders</h2>
                        <span className="material-icons-sharp">
                            notifications_none
                        </span>
                    </div>
                    <div className="notification">
                        <div className="icon">
                            <span className="material-icons-sharp">
                                volume_up
                            </span>
                        </div>
                        <div className="content">
                            <div className="info">
                                <h3>Workshop</h3>
                                <small className="text_muted">
                                    08:00 AM - 12:00 PM
                                </small>
                            </div>
                            <span className="material-icons-sharp">
                                more_vert
                            </span>
                        </div>
                    </div>

                    <div className="notification deactive">
                        <div className="icon">
                            <span className="material-icons-sharp">
                                edit
                            </span>
                        </div>
                        <div className="content">
                            <div className="info">
                                <h3>Workshop</h3>
                                <small className="text_muted">
                                    08:00 AM - 12:00 PM
                                </small>
                            </div>
                            <span className="material-icons-sharp">
                                more_vert
                            </span>
                        </div>
                    </div>

                    <div className="notification add-reminder">
                        <div>
                            <span className="material-icons-sharp">
                                add
                            </span>
                            <h3>Add Reminder</h3>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    );
}

if (document.getElementById('adminPanel')) {
    createRoot(document.getElementById('adminPanel')).render(<AdminPanel />);
}
