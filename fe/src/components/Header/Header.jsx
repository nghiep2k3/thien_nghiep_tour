import React, { useState, useEffect } from 'react'
import styles from './Header.module.css'
import axios from 'axios';
import url from '../../config';

export default function Header() {
    const iconMapping = {
        home: 'fa-house',
        promotion: 'fa-gifts',
        tour: 'fa-plane-departure',
        cruise: 'fa-ship',
        hotel: 'fa-hotel',
    };

    const [data, setData] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const [menuOpen, setMenuOpen] = useState(false); // State để điều khiển việc hiện/ẩn menu

    useEffect(() => {
        const fetchData = async () => {
            try {
                const response = await axios.get(`${url}/category.php`);
                setData(response.data.data);
                console.log(response.data.data);
            } catch (error) {
                setError(error);
            } finally {
                setLoading(false);
            }
        };

        fetchData();
    }, []);

    if (loading) return <div className={styles.Container}></div>;
    if (error) return <div>Error: {error.message}</div>;

    return (
        <div className={styles.Container}>
            <div className='text-uppercase fw-bold fs-5 text-warning'>Thiennghiep tour</div>
            <button className={styles.Hamburger} onClick={() => setMenuOpen(!menuOpen)}>
                <i className="fa-solid fa-bars"></i>
            </button>

            {/* Chỉ hiện các Item khi menuOpen là true */}
            <div className={`${styles.Menu} ${menuOpen ? styles.ShowMenu : ''}`}>
                {data.map((item, index) => (
                    <div key={index} className={styles.Item}>
                        <i className={`fa-solid ${iconMapping[item.type]}`}></i> {item.title}
                    </div>
                ))}
            </div>

            {/* Thêm lớp styles.WorkingHours để điều khiển */}
            <div className={`d-flex ${styles.WorkingHours}`}>
                Giờ làm việc: <span className='d-flex fw-bold'>8h <i className="ti ti-arrow-right fw-bold"></i> 12h</span>
            </div>

        </div>
    );
}
