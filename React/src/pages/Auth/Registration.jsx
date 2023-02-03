import { useRef, useState, useEffect } from 'react';
import isEmail from 'validator/es/lib/isEmail';
import equals from 'validator/es/lib/equals';
import isEmpty from 'validator/es/lib/isEmpty';
import axiosInstance from '../../apis/serverApi';
import { REGISTRATION } from '../../apis/endPoints';

export const Registration = () => {
  const [email, setEmail] = useState('');
  const [name, setName] = useState('');
  const [password, setPassword] = useState('');
  const [passwordConfirmation, setPasswordConfirmation] = useState('');
  const [formMessage, setMessage] = useState({ message: '', class: '' });
  const alert = { success: 'alert alert-success', error: 'alert alert-danger' };

  const handleEmail = (e) => setEmail(e.target.value);
  const handlePassword = (e) => setPassword(e.target.value);
  const handleName = (e) => setName(e.target.value);
  const handlePasswordConfirmation = (e) =>
    setPasswordConfirmation(e.target.value);
  const userRef = useRef();

  const handleOnSubmit = async (e) => {
    setMessage({ message: '', class: '' });
    e.preventDefault();

    if (
      isEmpty(email) ||
      isEmpty(password) ||
      isEmpty(passwordConfirmation) ||
      isEmpty(name)
    ) {
      setMessage({ message: 'All fields are required!', class: alert.error });
      return;
    }

    if (!isEmail(email)) {
      setMessage({ message: 'Invalid Email Address!', class: alert.error });
      return;
    }

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
      await axiosInstance.post(REGISTRATION, {
        name: name,
        email: email,
        password: password,
        password_confirmation: passwordConfirmation
      });

      //@todo Check if response has same email ~ just to confirm everything went smoothly!

      setMessage({
        message: 'Yay! You are successfully registered!',
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
  }, [email, password, passwordConfirmation]);
  return (
    <>
      <form>
        {formMessage.message ? (
          <div className={formMessage.class}>{formMessage.message}</div>
        ) : (
          <></>
        )}
        <div className="mb-3">
          <label htmlFor="name" className="form-label">
            Name
          </label>
          <input
            ref={userRef}
            type="email"
            className="form-control"
            id="name"
            autoComplete="on"
            onChange={handleName}
          />
        </div>
        <div className="mb-3">
          <label htmlFor="email" className="form-label">
            Email address
          </label>
          <input
            ref={userRef}
            type="email"
            className="form-control"
            id="email"
            aria-describedby="emailHelp"
            autoComplete="on"
            onChange={handleEmail}
          />
          <div id="emailHelp" className="form-text">
            We'll never share your email with anyone else.
          </div>
        </div>
        <div className="mb-3">
          <label htmlFor="new-password" className="form-label">
            Password
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
            Confirm Password
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

        <button
          type="submit"
          onClick={handleOnSubmit}
          className="btn btn-md btn-primary"
        >
          Submit
        </button>
      </form>
    </>
  );
};
