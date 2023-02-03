import { useEffect, useState, useRef } from 'react';
import isEmail from 'validator/es/lib/isEmail';
import { LOGIN } from '../../apis/endPoints';
import axiosInstance from '../../apis/serverApi';
import { useDispatch } from 'react-redux';
import { setCredentials } from '../../features/auth/AuthSlice';
import { Navigate, useLocation } from 'react-router-dom';

export const Login = () => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [formError, setError] = useState('');
  const [auth, setAuth] = useState(false);
  const dispatch = useDispatch();

  const userRef = useRef();
  const errRef = useRef();
  const location = useLocation();

  const doAuth = async (email, password) => {
    try {
      const auth_token = await axiosInstance.post(LOGIN, { email, password });
      dispatch(setCredentials({ ...auth_token.data }));
      setAuth(true);
    } catch (err) {
      setError(err.response.data.message);
      errRef.current.focus();
    }
  };

  const handleEmail = (e) => setEmail(e.target.value);
  const handlePassword = (e) => setPassword(e.target.value);

  const onSubmit = (e) => {
    e.preventDefault();
    if (isEmail(email)) {
      doAuth(email, password);
      setError('');
      //Redirect to home page
    } else {
      setError('Invalid Email address');
      errRef.current.focus();
    }
  };

  useEffect(() => {
    userRef.current.focus();
    // eslint-disable-next-line
  }, []);

  useEffect(() => {
    setError('');
  }, [email, password]);

  return (
    <>
      {auth ? (
        <Navigate to="/" state={{ from: location }} replace />
      ) : (
        <form>
          <div ref={errRef} className={formError ? 'alert alert-danger' : ''}>
            {formError}
          </div>

          <div className="mb-3">
            <label htmlFor="email" className="form-label">
              Email address
            </label>
            <input
              type="text"
              ref={userRef}
              autoComplete="on"
              className="form-control"
              id="email"
              aria-describedby="emailHelp"
              onChange={handleEmail}
            />
          </div>
          <div className="mb-3">
            <label htmlFor="current-password" className="form-label">
              Password
            </label>
            <input
              ref={userRef}
              autoComplete="on"
              type="password"
              className="form-control"
              id="current-password"
              onChange={handlePassword}
            />
          </div>

          <button
            type="submit"
            onClick={(e) => onSubmit(e)}
            className="btn btn-md btn-primary"
          >
            Login
          </button>
        </form>
      )}
    </>
  );
};
