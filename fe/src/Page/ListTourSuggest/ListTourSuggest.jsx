import React, { useEffect, useState } from 'react'
import SuggetsTour from '../../components/SuggetsTour/SuggetsTour';
import axios from 'axios';
import url from '../../config';

export default function ListTourSuggest() {
    const [data, setData] = useState();
    const [loading, setLoading] = useState(true);
    const data2 = [
        {
            id: 1,
            title: 'Tour Du Lịch Mùa Lá Đỏ 2024'
        }, {
            id: 2,
            title: 'Tour Du Lịch Mùa Lá Đỏ 2024'
        }, {
            id: 3,
            title: 'Tour Du Lịch Mùa Lá Đỏ 2024'
        }, {
            id: 4,
            title: 'Tour Du Lịch Mùa Lá Đỏ 2024'
        }, {
            id: 5,
            title: 'Tour Du Lịch Mùa Lá Đỏ 2024'
        }, {
            id: 6,
            title: 'Tour Du Lịch Mùa Lá Đỏ 2024'
        },
    ];


    
    return (
        <div style={{ marginTop: 150}} className='mx-5 d-flex justify-content-around'>
            {data2.map((item, index) => {
                return (
                    <SuggetsTour key={index} title={item.title} />
                )
            })}
        </div>
    )
}
