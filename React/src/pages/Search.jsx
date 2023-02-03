import { useState, useEffect } from 'react';
import { getKeywords } from '../features/search/searchSlice';
import { useSelector } from 'react-redux';
import axios from '../apis/serverApi';
import useAxios from '../hooks/useAxios';
import { GET_CATEGORIES, GET_SOURCES, SEARCH } from '../apis/endPoints';
import { Card } from '../components/UI/Card';
const Search = () => {
  const keyword = useSelector(getKeywords);
  const [articles, error, loading, axiosFetch] = useAxios();

  const [searchInput, setSearchInput] = useState(keyword);
  const [sourceInput, setSourceInput] = useState('');
  const [categoryInput, setCategoryInput] = useState('');
  const [authorInput, setAuthorInput] = useState('');
  const [categories, setCategories] = useState([]);
  const [sources, setSources] = useState([]);
  const [fromDateInput, setFromDate] = useState('');
  const [toDateInput, setToDate] = useState('');

  const handleSearchInput = (e) => setSearchInput(e.target.value);
  const handleSourceInput = (e) => setSourceInput(e.target.value);
  const handleCategoryInput = (e) => setCategoryInput(e.target.value);
  const handleAuthorInput = (e) => setAuthorInput(e.target.value);
  const handleFromDate = (e) => setFromDate(e.target.value);
  const handleToDate = (e) => setToDate(e.target.value);

  const getCategories = async () => {
    const get_categories = await axios.get(GET_CATEGORIES);

    setCategories(get_categories.data);
  };

  const getSources = async () => {
    const get_sources = await axios.get(GET_SOURCES);
    setSources(get_sources.data.sources);
  };

  const searchArticles = (query) => {
    axiosFetch({
      axiosInstance: axios,
      method: 'get',
      url: `${SEARCH}?${query}`
    });
  };

  const handleOnSearch = (e) => {
    e.preventDefault();

    //Build Query
    let query = '';

    if (searchInput !== '') {
      query += `keywords=${searchInput}`;
    }

    if (categoryInput !== '') {
      query += `&category=${categoryInput}`;
    }

    if (sourceInput !== '') {
      query += `&source=${sourceInput}`;
    }

    if (authorInput !== '') {
      query += `&author=${authorInput}`;
    }

    if (fromDateInput !== '') {
      query += `&from_date=${fromDateInput}`;
    }
    if (toDateInput !== '') {
      query += `&to_date=${toDateInput}`;
    }

    searchArticles(query);
  };

  useEffect(() => {
    getCategories();
    getSources();

    if (keyword !== '') {
      searchArticles(`keywords=${keyword}`)
    }
    // eslint-disable-next-line
  }, []);

  return (
    <div className="container">
      <div>
        <form className="row g-3">
          <div className="col-md-12">
            <input
              type="text"
              className="form-control"
              id="inputSearch"
              defaultValue={keyword ?? ''}
              onChange={handleSearchInput}
              placeholder="Search Keyword"
            />
          </div>

          <div className="col-4">
            <select
              id="inputSource"
              className="form-select"
              onChange={handleSourceInput}
            >
              <option defaultValue value="">
                Choose Source
              </option>

              {sources
                ? sources.map((source) => (
                    <option key={source.id} value={source.id}>
                      {source.name}
                    </option>
                  ))
                : ''}
            </select>
          </div>

          <div className="col-4">
            <select
              id="inputCategory"
              className="form-select"
              onChange={handleCategoryInput}
            >
              <option defaultValue value="">
                Choose Category
              </option>

              {categories
                ? categories.map((c) => (
                    <option key={c.id} value={c.title}>
                      {c.title}
                    </option>
                  ))
                : ''}
            </select>
          </div>

          <div className="col-3">
            <input
              type="text"
              placeholder="Author"
              className="form-control"
              id="inputAuthor"
              onChange={handleAuthorInput}
            />
          </div>

          <div className="col-4">
            <input
              type="date"
              placeholder=""
              className="form-control"
              id="from-date"
              onChange={handleFromDate}
            />
          </div>

          <div className="col-4">
            <input
              type="date"
              placeholder=""
              className="form-control"
              id="to-date"
              onChange={handleToDate}
            />
          </div>

          <div className="col-4">
            <button
              onClick={handleOnSearch}
              type="submit"
              className="btn btn-primary"
            >
              Search
            </button>
          </div>
        </form>

        <div className="ScrollStyle mt-3 ">
          {loading && <p>Loading...</p>}

          {!loading && error && <p className="errMsg">{error}</p>}

          {!loading &&
            !error &&
            articles?.length &&
            articles.map((article, i) => <Card article={article} key={i} />)}

          {!loading && !error && !articles && (
            <p className="alert alert-danger">No articles to display!</p>
          )}
        </div>
      </div>
    </div>
  );
};

export default Search;
