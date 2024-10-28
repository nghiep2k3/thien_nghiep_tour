// categoryReducer.js
import {
    FETCH_CATEGORIES_REQUEST,
    FETCH_CATEGORIES_SUCCESS,
    FETCH_CATEGORIES_FAILURE,
    ADD_CATEGORY,
} from '../Action/categoryActions';

const initialState = {
    loading: false,
    categories: [],
    error: '',
};

const categoryReducer = (state = initialState, action) => {
    switch (action.type) {
        case FETCH_CATEGORIES_REQUEST:
            return {
                ...state,
                loading: true,
                error: '',
            };
        case FETCH_CATEGORIES_SUCCESS:
            return {
                loading: false,
                categories: action.payload.data, // Chỉ định lấy data từ response
                error: '',
            };
        case FETCH_CATEGORIES_FAILURE:
            return {
                loading: false,
                categories: [],
                error: action.payload,
            };
        case ADD_CATEGORY:
            return {
                ...state,
                categories: [...state.categories, action.payload],
            };
        default:
            return state;
    }
};

export default categoryReducer;
