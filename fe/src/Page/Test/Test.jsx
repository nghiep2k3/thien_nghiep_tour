import React, { useEffect, useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { fetchCategories, addCategory } from '../../Redux/Action/categoryActions';

const Test = () => {
    const dispatch = useDispatch();
    const categoryState = useSelector((state) => state.categories);

    // Destructure các giá trị từ categoryState
    const { loading = false, categories = [], error = '' } = categoryState;

    const [newCategory, setNewCategory] = useState('');

    useEffect(() => {
        dispatch(fetchCategories());
    }, [dispatch]);

    const handleAddCategory = () => {
        if (newCategory) {
            dispatch(addCategory({ id: Date.now(), title: newCategory }));
            setNewCategory('');
        }
    };

    if (loading) return <h2>Loading...</h2>;
    if (error) return <h2>{error}</h2>;

    console.log(1111, categories);
    console.log(2222, categoryState);
    console.log(3333, loading);

    return (
        <div>
            <h2>Danh sách Category</h2>
            <ul>
                {categories.map((category) => (
                    <li key={category.id}>{category.title}</li>
                ))}
            </ul>
            <input
                type="text"
                value={newCategory}
                onChange={(e) => setNewCategory(e.target.value)}
                placeholder="Thêm category mới"
            />
            <button onClick={handleAddCategory}>Thêm Category</button>
        </div>
    );
};

export default Test;

