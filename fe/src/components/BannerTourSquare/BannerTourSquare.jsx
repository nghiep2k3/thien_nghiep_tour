// TourItem.js
import React from 'react';
import styles from './BannerTourSquare.module.css';

const BannerTourSquare = ({ image, destination, tours }) => {
    return (
        <div className={styles.TourItem}>
            <img src={image} alt={destination} className={styles.Image} />
            <div className={styles.Overlay}>
                <h3 className={styles.Destination}>{destination}</h3>
                <p className={styles.Tours}>{tours} tour</p>
            </div>
        </div>
    );
};

export default BannerTourSquare;
