import { useRef, useState, useEffect } from 'react';
import equals from 'validator/es/lib/equals';
import isEmpty from 'validator/es/lib/isEmpty';
import axiosInstance from '../../apis/serverApi';
import { CHANGE_PASSWORD } from '../../apis/endPoints';
import { getToken } from '../../features/auth/AuthSlice';
import { useSelector } from 'react-redux';
export const Settings = () => {
  const userRef = useRef();
  const [password, setPassword] = useState('');
  const [passwordConfirmation, setPasswordConfirmation] = useState('');
  const [formMessage, setMessage] = useState({ message: '', class: '' });
  const alert = { success: 'alert alert-success', error: 'alert alert-danger' };
  const token = useSelector(getToken);
  const handlePassword = (e) => setPassword(e.target.value);
  const handlePasswordConfirmation = (e) =>
    setPasswordConfirmation(e.target.value);

  const handleOnSubmit = async (e) => {
    setMessage({ message: '', class: '' });
    e.preventDefault();

    if (password.length <= 7) {
      setMessage({
        message: 'Password length should be 8 characters long',
        class: alert.error
      });
      return;
    }

    if (!equals(password, passwordConfirmation)) {
      setMessage({
        message: 'Password and Password confirmation should match!',
        class: alert.error
      });
      return;
    }

    try {
      axiosInstance.defaults.headers.common[
        'Authorization'
      ] = `Bearer ${token}`;
      await axiosInstance.post(CHANGE_PASSWORD, {
        password: password,
        password_confirmation: passwordConfirmation
      });

      setMessage({
        message: 'Yay! Password has been changed',
        class: alert.success
      });
    } catch (err) {
      setMessage({ message: err.response.data.message, class: alert.error });
    }
  };

  useEffect(() => {
    userRef.current.focus();
    // eslint-disable-next-line
  }, []);
  useEffect(() => {
    setMessage({ message: '', class: '' });
  }, [password, passwordConfirmation]);

  return (
    <>
      <div className="card">
        <div className="card-body">
          <h5 className="card-title">Change Password</h5>
          <p className="card-text">
            {formMessage.message ? (
              <div className={formMessage.class}>{formMessage.message}</div>
            ) : (
              <></>
            )}
          </p>

          <div className="">
            <form>
              <div className="mb-3">
                <label htmlFor="new-password" className="form-label">
                  New Password
                </label>
                <input
                  ref={userRef}
                  type="password"
                  className="form-control"
                  id="new-password"
                  name="new-password"
                  autoComplete="off"
                  onChange={handlePassword}
                />
              </div>

              <div className="mb-3">
                <label htmlFor="confirm-password" className="form-label">
                  Confirm new Password
                </label>
                <input
                  ref={userRef}
                  type="password"
                  className="form-control"
                  id="confirm-password"
                  name="confirm-password"
                  autoComplete="off"
                  onChange={handlePasswordConfirmation}
                />
              </div>

              <div className="col-md-12 mb-3">
                <button
                  onClick={handleOnSubmit}
                  className="col-md-12 btn btn-success"
                >
                  Save
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </>
  );
};
