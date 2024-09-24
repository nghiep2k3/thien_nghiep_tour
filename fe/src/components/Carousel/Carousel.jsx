import React from 'react'
import { Carousel } from 'antd';

export default function Slider() {
    return (
        <div style={{ marginTop: 50 }}>
            <Carousel autoplay arrows={true} draggable={true} dots={false}>
                <div>
                    <img className='w-100' src="https://owa.bestprice.vn/images/slide/dat-du-lich-ngay-vali-cao-cap-trao-tay-665e9f0d4de94.jpg" alt="" />
                </div>
                <div>
                    <img className='w-100' src="https://owa.bestprice.vn/images/slide/giai-chay-viettel-marathon-2024-66ea75f2128a7.jpg" alt="" />
                </div>
                <div>
                    <img className='w-100' src="https://owa.bestprice.vn/images/slide/dat-du-lich-ngay-vali-cao-cap-trao-tay-665e9f0d4de94.jpg" alt="" />
                </div>
                <div>
                    <img className='w-100' src="https://owa.bestprice.vn/images/slide/giai-chay-viettel-marathon-2024-66ea75f2128a7.jpg" alt="" />
                </div>
            </Carousel>
        </div>
    )
}
