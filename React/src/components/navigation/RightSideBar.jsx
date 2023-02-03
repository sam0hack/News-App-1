import { List } from '../UI/List';
import axios from '../../apis/serverApi';
import useAxios from '../../hooks/useAxios';
import { GET_TOP_HEADLINES } from '../../apis/endPoints';
import { useEffect } from 'react';

export const RightSideBar = () => {
  const [articles, error, loading, axiosFetch] = useAxios();

  const getArticles = async () => {
    await axiosFetch({
      axiosInstance: axios,
      method: 'get',
      url: GET_TOP_HEADLINES + 'theGuardian'
    });
  };

  useEffect(() => {
    getArticles();
    // eslint-disable-next-line
  }, []);

  return (
    <>
      <p className="fw-bold">What's Happening </p>
      <ol className="list-group list-group-numbered">
        {loading && <p>Loading...</p>}

        {!loading && error && <p className="errMsg">{error}</p>}

        {!loading &&
          !error &&
          articles?.length &&
          articles.map((article, i) => <List article={article} key={i} />)}

        {!loading && !error && !articles && (
          <p className="alert alert-danger">No articles to display!</p>
        )}
      </ol>
    </>
  );
};
