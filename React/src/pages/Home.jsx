import { React, useEffect } from 'react';
import { Card } from '../components/UI/Card';
import axios from '../apis/serverApi';
import useAxios from '../hooks/useAxios';
import { GET_TOP_HEADLINES } from '../apis/endPoints';

export const Home = () => {
  const [articles, error, loading, axiosFetch] = useAxios();


  const getTopArticles =  () => {
     axiosFetch({
      axiosInstance: axios,
      method: 'get',
      url: `${GET_TOP_HEADLINES}newsOrg`
    });
  };


  useEffect(() => {
    getTopArticles();
    // eslint-disable-next-line
  }, []);

  return (
    <>
      <div className="ScrollStyle">
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
    </>
  );
};
