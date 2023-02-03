import { createSlice } from "@reduxjs/toolkit";



const AuthSlice = createSlice({
        name: 'auth',
        initialState: { token: null},
        reducers:{

            setCredentials(state,action){
                
                const {token} = action.payload;
                state.token = token;
            },
            logOut(state,action){
                state.token = null
            }
        },

});

export const getToken = (state)=> state.auth.token;

export const {setCredentials,logOut} = AuthSlice.actions;

export default AuthSlice.reducer;