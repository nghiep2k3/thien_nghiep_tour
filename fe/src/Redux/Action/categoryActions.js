import axios from 'axios';

// Action types
export const FETCH_CATEGORIES_REQUEST = 'FETCH_CATEGORIES_REQUEST';
export const FETCH_CATEGORIES_SUCCESS = 'FETCH_CATEGORIES_SUCCESS';
export const FETCH_CATEGORIES_FAILURE = 'FETCH_CATEGORIES_FAILURE';
export const ADD_CATEGORY = 'ADD_CATEGORY';

// Action creators
export const fetchCategoriesRequest = () => ({
    type: FETCH_CATEGORIES_REQUEST,
});

export const fetchCategoriesSuccess = (categories) => ({
    type: FETCH_CATEGORIES_SUCCESS,
    payload: categories,
});

export const fetchCategoriesFailure = (error) => ({
    type: FETCH_CATEGORIES_FAILURE,
    payload: error,
});

// Action creator cho việc thêm category
export const addCategory = (category) => ({
    type: ADD_CATEGORY,
    payload: category,
});

// Thunk action creator để fetch categories
export const fetchCategories = () => {
    return async (dispatch) => {
        dispatch({ type: FETCH_CATEGORIES_REQUEST });
        try {
            const response = await axios.get('http://localhost:8081/thien_nghiep_tour/be/api/category.php');
            console.log('Dữ liệu trả về từ API:', response.data); // Thêm dòng này để kiểm tra
            dispatch({ type: FETCH_CATEGORIES_SUCCESS, payload: response.data });
        } catch (error) {
            dispatch({ type: FETCH_CATEGORIES_FAILURE, payload: error.message });
        }
    };
};

