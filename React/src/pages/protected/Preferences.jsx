import axiosInstance from '../../apis/serverApi';
import { useState, useEffect } from 'react';
import {
  ADD_USER_PREFERENCE,
  GET_CATEGORIES,
  GET_SOURCES,
  GET_USER_PREFERENCE
} from '../../apis/endPoints';
import { useSelector } from 'react-redux';
import { getToken } from '../../features/auth/AuthSlice';

export const Preferences = () => {
  const [sourceInput, setSourceInput] = useState('');
  const [categoryInput, setCategoryInput] = useState('');
  const [categories, setCategories] = useState([]);
  const [sources, setSources] = useState([]);
  const [formMessage, setMessage] = useState({ message: '', class: '' });
  const alert = { success: 'alert alert-success', error: 'alert alert-danger' };
  const handleSourceInput = (e) => {setSourceInput(e.target.value); setFeed(e.target.value);};
  const handleCategoryInput = (e) => {setCategoryInput(e.target.value);setFeedCategory(e.target.value);};
  const token = useSelector(getToken);
  const [feed, setFeed] = useState('');
  const [feedCategory, setFeedCategory] = useState('');
 
  const getCategories = async () => {
    const get_categories = await axiosInstance.get(GET_CATEGORIES);
    setCategories(get_categories.data);
  };

  const getSources = async () => {
    const get_sources = await axiosInstance.get(GET_SOURCES);
    setSources(get_sources.data.sources);
  };

  const getSavedOption = async () => {
    axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${token}`;
    const feed = await axiosInstance.post(GET_USER_PREFERENCE, {
      meta: 'feed'
    });

    
    setFeed(feed.data.value);
    setFeedCategory(feed.data.value);
    //setCategoryInput(feed.data.value);
  };

  const onSave = async (e) => {
    setMessage({ message: '', class: '' });
    e.preventDefault();

    

    if (sourceInput !== '' && categoryInput !== '') {
      setMessage({
        message: 'You can not select both values!',
        class: alert.error
      });
      return;
    }

    let data = { meta: '', value: '' };
    
    if (sourceInput !== '') {
      data.value = sourceInput;
      data.meta = 'source';
    }
    if (categoryInput !== '') {
      data.value = categoryInput;
      data.meta = 'category';
    }

    axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${token}`;

    try {
      await axiosInstance.post(ADD_USER_PREFERENCE, data);
      setMessage({ message: 'Successfully Added', class: alert.success });
    } catch (err) {
      setMessage({ message: err, class: alert.error });
    }
  };

  useEffect(() => {
    getCategories();
    getSources();
    getSavedOption();

    // eslint-disable-next-line
  }, []);
  return (
    <>
      <div>
        <div className="">
          <h1 className="lead">Set Your Preferences</h1>
          <small>
            This will allow you to customize the feeds on the "For you" Page
          </small>
        </div>
        {formMessage.message ? (
          <div className={formMessage.class}>{formMessage.message}</div>
        ) : (
          <></>
        )}
        <form>
          <div className="mt-4">
            <select
              className="form-select"
              aria-label="Select news Source"
              onChange={handleSourceInput}
              value={feed}
            >
              <option value="">Select Source</option>
              {sources
                ? sources.map((source) => (
                    <option key={source.id} value={source.id}>
                      {source.name}
                    </option>
                  ))
                : ''}
            </select>
          </div>

          <h1 className="lead mt-2 mx-auto" style={{ width: '500px' }}>
            Choose either source or category Both can't be used
          </h1>

          <div className="mt-2">
            <select
              className="form-select"
              aria-label="Select news Category"
              onChange={handleCategoryInput}
              value={feedCategory}
            >
              <option value="">Select Category</option>
              {categories
                ? categories.map((c) => (
                    <option key={c.id} value={c.title}>
                      {c.title}
                    </option>
                  ))
                : ''}
            </select>
          </div>

          <div className="mt-4">
            <button
              type="submit"
              onClick={onSave}
              className="col-md-12 btn btn-success btn-md"
            >
              Save
            </button>
          </div>
        </form>
      </div>
    </>
  );
};
