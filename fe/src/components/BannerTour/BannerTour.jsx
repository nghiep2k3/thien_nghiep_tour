// TourItem.js
import React from 'react';
import styles from './BannerTour.module.css';

const BannerTour = ({ image, country, tours }) => {
    return (
        <div className={styles.TourItem}>
            <img src={image} alt={country} className={styles.Image} />
            <div className={styles.Overlay}>
                <h3 className={styles.Country}>{country}</h3>
                <p className={styles.Tours}>{tours} tour</p>
            </div>
        </div>
    );
};

export default BannerTour;
