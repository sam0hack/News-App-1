import { useState } from 'react';
import { setKeywords } from '../../features/search/searchSlice';
import { useDispatch } from 'react-redux';
import { useNavigate } from "react-router-dom";

export const NavBar = () => {
  const [searchInput, setSearchInput] = useState('');
  const dispatch = useDispatch();
  const navigate = useNavigate();

  const handleSearchInput = (e) => setSearchInput(e.target.value);

  const handleOnClick = (e) => {
    e.preventDefault();
    dispatch(setKeywords({keywords:searchInput}));
    setSearchInput('')
    navigate("/search");
  };

  return (
    <>
      <nav className="navbar navbar-expand-lg navbar-dark bg-primary ">
        <div className="container-fluid">
          <a className="navbar-brand" href="/">
            App
          </a>

          <div
            className=" "
            id="navbarSupportedContent"
          >
            <form className="d-flex" role="search">
              <input
                className="form-control me-2"
                type="search"
                placeholder="Search"
                aria-label="Search"
                onChange={handleSearchInput}
                defaultValue={searchInput}
              />
              <button
                onClick={handleOnClick}
                className="btn btn-light"
                type="submit"
              >
                Search
              </button>
            </form>
          </div>
        </div>
      </nav>
    </>
  );
};
