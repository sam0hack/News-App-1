import {
  configureStore,
  combineReducers,
  getDefaultMiddleware
} from '@reduxjs/toolkit';

import authReducer from '../features/auth/AuthSlice';
import searchReducer from '../features/search/searchSlice';
import { persistReducer } from 'redux-persist';
import storage from 'redux-persist/lib/storage';

const persistConfig = {
  key: 'root',
  version: 1,
  storage
};

const reducers = combineReducers({
  auth: authReducer,
  search: searchReducer
});

const persistRed = persistReducer(persistConfig, reducers);

export const store = configureStore({
  reducer: persistRed,
  middleware: getDefaultMiddleware({
    serializableCheck: false
  })
});
