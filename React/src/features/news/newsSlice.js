import { createSlice } from "@reduxjs/toolkit";

const initialState  = [

    { title:null, content:null, source:null, web_url:null, image:null, date:null, author:null}

]

const newsSlice = createSlice({
        name: 'articles',
        initialState,
        reducers:{}

});



export default newsSlice.reducer;