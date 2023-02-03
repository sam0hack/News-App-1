import { createSlice } from '@reduxjs/toolkit';

const SearchSlice = createSlice({
  name: 'search',
  initialState: { keywords: '', category:'',source:'',author:'' },
  reducers: {
    setKeywords(state, action) {
      const { keywords } = action.payload;
      state.keywords = keywords;
    },
    setSource(state, action) {
      const { source } = action.payload;
      state.source = source;
    },
    setCategory(state, action) {
      const { category } = action.payload;
      state.category = category;
    },
    setAuthor(state, action) {
      const { author } = action.payload;
      state.author = author;
    },
    removeKeywords(state, action) {
      state.keywords = '';
    }
  }
});

export const getKeywords = (state) => state.search.keywords;

export const {
  setKeywords,
  removeKeywords,
  setSource,
  setCategory,
  setAuthor
} = SearchSlice.actions;

export default SearchSlice.reducer;
