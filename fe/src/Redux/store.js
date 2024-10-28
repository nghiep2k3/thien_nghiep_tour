import { configureStore } from '@reduxjs/toolkit';
import { combineReducers } from 'redux';
import categoryReducer from './Reducer/categoryReducer'; // Đảm bảo đúng đường dẫn

const rootReducer = combineReducers({
    categories: categoryReducer, // Đặt tên cho phần state là 'categories'
    // Thêm các reducer khác nếu cần
});

const store = configureStore({
    reducer: rootReducer,
    middleware: (getDefaultMiddleware) => 
        getDefaultMiddleware().concat(/* các middleware khác nếu có */),
});

export default store;
