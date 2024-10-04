import React from 'react'

export default function SuggetsTour(props) {
    return (
        <div style={{ width: 200 }} className='fw-bold py-2 px-3 rounded-3 border border-secondary d-flex align-items-center justify-content-center text-center'>
            <span>{props.title}</span>
        </div>
    )
}
