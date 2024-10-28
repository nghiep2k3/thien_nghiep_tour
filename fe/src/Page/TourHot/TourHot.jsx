import React, { useEffect, useState } from 'react'
import axios from 'axios';
import url from '../../config';
import CardTour from '../../components/CardTour/CardTour';
export default function TourHot() {
    const [data, setData] = useState();
    const [loading, setLoading] = useState(true);
    useEffect(() => {
        const fetchData = async () => {
            try {
                const response = await axios.get(`${url}/tourhot.php`);
                setData(response.data.data);
                console.log(response.data.data);
            } catch (error) {
                console.log(error);
            } finally {
                setLoading(false);
            }
        };

        fetchData();
    }, []);

    if (loading) return <div>Loading...</div>;
    return (
        <div className='d-flex flex-wrap justify-content-between my-5' style={{margin: '0 180px'}}>
            {data.map((tour) =>{
                return (
                    <CardTour
                    key={tour.id}
                    title={tour.title}
                    description={tour.description}
                    price={tour.price}
                    timeFrame={tour.time_frame}
                    rate={tour.rate}
                    discount={tour.discount}
                  />
                )
            })}
        </div>
    )
}
