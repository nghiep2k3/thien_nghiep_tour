import React from 'react'
import Header from '../../components/Header/Header'
import Slider from '../../components/Carousel/Carousel'
import Search from '../../components/Search/Search'
import ListTourSuggest from '../ListTourSuggest/ListTourSuggest'
import Test from '../Test/Test'
import CardTour from '../../components/CardTour/CardTour'
import BannerTour from '../../components/BannerTour/BannerTour'
import BannerTourSquare from '../../components/BannerTourSquare/BannerTourSquare'
import TourHot from '../TourHot/TourHot'

export default function Home() {
    const tourData = [
        { image: 'https://owa.bestprice.vn/images/destinations/large/thai-lan-5f36610f951cf-476x476.jpg', country: 'Thái Lan', tours: 26 },
        { image: 'https://owa.bestprice.vn/images/destinations/large/nhat-ban-54212477d51ab-476x476.jpg', country: 'Việt Nam', tours: 15 },
        { image: 'https://owa.bestprice.vn/images/destinations/large/han-quoc-5f719bf7befc0-476x476.jpg', country: 'Nhật Bản', tours: 10 },
        { image: 'https://owa.bestprice.vn/images/destinations/large/uc-5f719cd813094-476x476.jpg', country: 'Úc', tours: 8 },
        { image: 'https://owa.bestprice.vn/images/destinations/large/trung-quoc-5fbccc80590c5-476x476.jpg', country: 'Trung Quốc', tours: 12 },
    ];

    const tourData2 = [
        { image: 'https://owa.bestprice.vn/images/destinations/large/sapa-60a39553465e7-476x476.png', destination: 'Đà Nẵng', tours: 25 },
        { image: 'https://owa.bestprice.vn/images/destinations/large/sapa-60a39553465e7-476x476.png', destination: 'Hà Nội', tours: 30 },
        { image: 'https://owa.bestprice.vn/images/destinations/large/sapa-60a39553465e7-476x476.png', destination: 'Hồ Chí Minh', tours: 22 },
        { image: 'https://owa.bestprice.vn/images/destinations/large/sapa-60a39553465e7-476x476.png', destination: 'Hạ Long', tours: 18 },
        { image: 'https://owa.bestprice.vn/images/destinations/large/sapa-60a39553465e7-476x476.png', destination: 'Phú Quốc', tours: 15 },
    ];

    return (
        <div>
            <Slider />
            <Search />
            {/* <Test/> */}
            <ListTourSuggest />
            <TourHot/>
            <h2>Khám phá địa danh nước ngoài</h2>
            <div style={{ display: 'flex', flexWrap: 'wrap', justifyContent: 'center' }}>
                {tourData.map((tour, index) => (
                    <BannerTour
                        key={index}
                        image={tour.image}
                        country={tour.country}
                        tours={tour.tours}
                    />
                ))}
            </div>
            <div style={{ display: 'flex', flexWrap: 'wrap', justifyContent: 'center' }}>
            {tourData2.map((tour, index) => (
                <BannerTourSquare 
                    key={index} 
                    image={tour.image} 
                    destination={tour.destination} 
                    tours={tour.tours} 
                />
            ))}
        </div>
        </div>
    )
}
