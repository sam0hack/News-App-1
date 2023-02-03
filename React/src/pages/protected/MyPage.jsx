import { useEffect, useState } from 'react';
import { Card } from '../../components/UI/Card';
import axiosInstance from '../../apis/serverApi';
import { useSelector } from 'react-redux';
import { getToken } from '../../features/auth/AuthSlice';
import { GET_USER_ALL_PREFERENCES, SEARCH } from '../../apis/endPoints';

export const MyPage = () => {
  
  const [articles, setArticles] = useState([]);
  const [loading, setLoading] = useState(true);
  const token = useSelector(getToken);
  const [formMessage, setMessage] = useState({ message: '', class: '' });
  const alert = { success: 'alert alert-success', error: 'alert alert-danger' };
  const searchArticles = async (query) => {
    const articles = await axiosInstance.get(`${SEARCH}?${query}`);

    setArticles(articles.data);
  };

  const getPreferences = async () => {
    axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${token}`;
    const preferences = await axiosInstance.post(GET_USER_ALL_PREFERENCES);
    if (preferences.data !== '') {
      let feed = '';
      let source = '';
      let category = '';
      preferences.data.forEach((element) => {
        if (element.meta === 'feed') {
          feed = element.value;
        }
        if (element.meta === 'source') {
          source = element.value;
        }
        if (element.meta === 'category') {
          category = element.value;
        }
      });
      let query = '';
      if (feed === source) {
        query = `source=${source}`;
      } else if (feed === category) {
        query = `category=${category}`;
      }

      try {
        await searchArticles(query);
      } catch (err) {
        setMessage({ message: err.response.data.message, class: alert.error });
      }
      setLoading(false);
    }
  };

  useEffect(() => {
    getPreferences();
    // eslint-disable-next-line
  }, []);

  return (
    <>
      <div className="ScrollStyle">
        {formMessage.message ? (
          <div className={formMessage.class}>{formMessage.message}</div>
        ) : (
          <></>
        )}
        {loading && <p>Loading...</p>}

        {articles.map((article, i) => (
          <Card article={article} key={i} />
        ))}
      </div>
    </>
  );
};
