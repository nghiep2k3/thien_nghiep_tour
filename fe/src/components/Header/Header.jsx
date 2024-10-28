import React, { useState, useEffect } from 'react';
import styles from './Header.module.css';
import axios from 'axios';
import url from '../../config';
import { Modal } from 'antd';

export default function Header() {
    const iconMapping = {
        home: 'fa-house',
        promotion: 'fa-gifts',
        tour: 'fa-plane-departure',
        cruise: 'fa-ship',
        hotel: 'fa-hotel',
    };
    const [isModalOpen, setIsModalOpen] = useState(false);
    const showModal = () => {
        setIsModalOpen(true);
    };
    const handleOk = () => {
        setIsModalOpen(false);
    };
    const handleCancel = () => {
        setIsModalOpen(false);
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

            {/* Chỉ hiện các Item và input khi menuOpen là true */}
            <div className={`${styles.Menu} ${menuOpen ? styles.ShowMenu : ''}`}>
                <input type="text" placeholder="Search..." className={styles.SearchInput} />
                {data.map((item, index) => (
                    <div key={index} className={styles.Item}>
                        <i className={`fa-solid ${iconMapping[item.type]}`}></i> {item.title}
                    </div>
                ))}
            </div>

            {/* Thêm lớp styles.WorkingHours để điều khiển */}
            <div className={`d-flex ${styles.WorkingHours}`}>
                <div className={styles.User} onClick={showModal}>
                    <i className="fs-5 fa-regular fa-user"></i>
                </div>
                <div>
                    <i className="fs-5 fa-solid fa-magnifying-glass"></i>
                </div>
            </div>
            <Modal title="Basic Modal" open={isModalOpen} onOk={handleOk} onCancel={handleCancel}>
                <p>Some contents...</p>
                <p>Some contents...</p>
                <p>Some contents...</p>
            </Modal>
        </div>
    );
}
