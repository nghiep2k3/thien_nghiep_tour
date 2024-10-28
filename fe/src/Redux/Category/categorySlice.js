// src/Redux/Category/categorySlice.js
import { createSlice, createAsyncThunk } from '@reduxjs/toolkit';
import axios from 'axios';
import url from '../../config';  // Import URL từ file url.js

// Thunk để gọi API bằng Axios và fetch dữ liệu từ category.php
export const fetchCategories = createAsyncThunk(
  'category/fetchCategories',
  async () => {
    const response = await axios.get(`${url}/category.php`);
    return response.data;
  }
);

const categorySlice = createSlice({
  name: 'category',
  initialState: {
    categories: [],
    status: 'idle', // idle, loading, succeeded, failed
    error: null,
  },
  reducers: {},
  extraReducers: (builder) => {
    builder
      .addCase(fetchCategories.pending, (state) => {
        state.status = 'loading';
      })
      .addCase(fetchCategories.fulfilled, (state, action) => {
        state.status = 'succeeded';
        state.categories = action.payload;
      })
      .addCase(fetchCategories.rejected, (state, action) => {
        state.status = 'failed';
        state.error = action.error.message;
      });
  },
});

export default categorySlice.reducer;
