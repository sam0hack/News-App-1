import React from 'react';
import {Routes, Route } from 'react-router-dom';
import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min';
import { NavBar } from './components/navigation/NavBar';
import { LeftSideBar } from './components/navigation/LeftSideBar';
import { RightSideBar } from './components/navigation/RightSideBar';
import { Home } from './pages/Home';
import { Login } from './pages/Auth/Login';
import { Registration } from './pages/Auth/Registration';
import { Preferences } from './pages/protected/Preferences';
import { Settings } from './pages/protected/Settings';
import { MyPage } from './pages/protected/MyPage';
import RequireAuth from './features/auth/RequireAuth';
import Search from './pages/Search';


function App() {
  return (
    <div className="container-fluid">
      <div className="col-md-12 mb-4">
        <NavBar />
      </div>
      <div className="row">
        <div className="col-md-2 col col-sm-12 col-xs-12">
          <LeftSideBar />
        </div>
        <div className="col">
          
            <Routes>
              {/* Public Routes */}
              <Route index element={<Home />}></Route>
              <Route path="/login" element={<Login />}></Route>
              <Route path="/registration" element={<Registration />}></Route>
              <Route path="/search" element={<Search />}></Route>

              {/* Protected Routes */}
              <Route element={<RequireAuth />}>
                <Route path="/my-page" element={<MyPage />}></Route>
                <Route path="/preferences" element={<Preferences />}></Route>
                <Route path="/settings" element={<Settings />}></Route>
               
              </Route>
            </Routes>
          
        </div>
        <div className="col col-md-4 col-sm-12 col-xs-12">
          <RightSideBar />
        </div>
      </div>
    </div>
  );
}

export default App;
