import React, { useState } from 'react';
import styles from './Search.module.css';
import { Button } from 'antd';

export default function Search() {
    const [activeTab, setActiveTab] = useState('tour'); // 'hotel' là giá trị mặc định

    return (
        <div className='position-relative d-flex justify-content-center'>
            <div className={styles.Container}>
                <div className={styles.HeaderSearch}>
                    <div>
                        <span
                            className={`${styles.Tab} ${activeTab === 'hotel' ? styles.active : ''}`}
                            onClick={() => setActiveTab('hotel')}
                        >
                            Khách sạn
                        </span>
                        <span
                            className={`${styles.Tab} ${activeTab === 'tour' ? styles.active : ''}`}
                            onClick={() => setActiveTab('tour')}
                        >
                            Tour du lịch
                        </span>
                    </div>
                </div>

                <div className='mt-4 mx-3'>
                    {activeTab === 'hotel' &&
                        <div className='d-flex align-items-center justify-content-between mx-4'>
                            <div className='d-flex align-items-baseline'>
                                <i style={{ top: 12, right: 10 }} className="fa-solid fa-map-location-dot fs-3 position-relative"></i>
                                <div>
                                    <span className='text-uppercase fw-bold'>Địa điểm</span>
                                    <p style={{ color: '#444', fontWeight: 500 }}>Bạn muốn đi đâu?</p>
                                </div>
                            </div>
                            <div className='d-flex align-items-baseline'>
                                <i style={{ top: 12, right: 10 }} className="fa-solid fa-location-dot fs-3 position-relative"></i>
                                <div>
                                    <span className='text-uppercase fw-bold'>Khởi hành từ</span>
                                    <p style={{ color: '#444', fontWeight: 500 }}>Vui lòng chọn?</p>
                                </div>
                            </div>
                            <Button style={{height: 50, width: 150, background: '#e9680c', color: '#fff', fontSize: 18}} type="primary">Tìm ngay</Button>
                        </div>
                    }
                    {activeTab === 'tour' &&
                        <div className='d-flex align-items-center justify-content-between mx-4'>
                            <div className='d-flex align-items-baseline'>
                                <i style={{ top: 12, right: 10 }} className="fa-solid fa-map-location-dot fs-3 position-relative"></i>
                                <div>
                                    <span className='text-uppercase fw-bold'>Địa điểm</span>
                                    <p style={{ color: '#444', fontWeight: 500 }}>Bạn muốn đi đâu?</p>
                                </div>
                            </div>
                            <div className='d-flex align-items-baseline'>
                                <i style={{ top: 12, right: 10 }} className="fa-solid fa-location-dot fs-3 position-relative"></i>
                                <div>
                                    <span className='text-uppercase fw-bold'>Khởi hành từ</span>
                                    <p style={{ color: '#444', fontWeight: 500 }}>Vui lòng chọn?</p>
                                </div>
                            </div>
                            <Button style={{height: 50, width: 150, background: '#e9680c', color: '#fff', fontSize: 18}} type="primary">Tìm ngay</Button>
                        </div>
                    }
                </div>
            </div>
        </div>
    );
}
