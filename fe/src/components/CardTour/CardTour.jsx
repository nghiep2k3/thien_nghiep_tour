import React from 'react'
import "./CardTour.css"

export default function CardTour({ title, description, price, timeFrame, rate, discount }) {
    return (
        <div style={{ width: '367px', height: 490, boxShadow: '0 0 10px 5px rgba(0,0,0,0.06)', marginBottom: 20 }}>
            <div style={{ width: 366, height: 206 }}><img className='w-100' src="https://owa.bestprice.vn/images/tours/430_242/du-lich-thai-lan-5n4d-hai-phong-ha-noi-bangkok-pattaya-muang-boran-66fbb7dfa8410.jpg" alt="" /></div>
            <div className='px-3'>
                <div><p className='text-uppercase fw-bold'>{title}</p></div>
                <div className='d-flex '>
                    <div className='me-2 rounded-3 border px-2 d-flex fw-bold' style={{ background: '#297aa8', color: 'white' }}>{rate}</div>
                    <div><span style={{ color: '#297aa8', fontWeight: 600 }}>Rất tốt</span> - 3 đánh giá</div>
                </div>

                <div className='mt-3'>
                    <span className="text-ellipsis"><i className="fa-solid fa-quote-left me-2 fs-4 text-dark"></i>{description}<i className="fa-solid fa-quote-right ms-2 fs-4"></i></span>
                </div>

                <p className='d-flex align-items-center mt-3'><i className="fa-solid fa-location-dot fs-4 me-2"></i>Campuchia - Siem Reap</p>
                <div className='d-flex align-items-center justify-content-between mx-2 mt-5'>
                    <div style={{ backgroundColor: '#f3f3f3', borderRadius: 4, padding: '5px 10px', width: 'max-content' }}>{timeFrame}</div>
                    <div className="borderPrice">{(price * (1 - discount / 100)).toLocaleString()}đ</div>
                </div>
            </div>
        </div>
    )
}
