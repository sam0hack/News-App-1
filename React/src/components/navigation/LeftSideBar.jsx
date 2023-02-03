import { Link } from 'react-router-dom';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import {
  faHome,
  faHeart,
  faStar,
  faGear,
  faCircleArrowLeft,
  faKey
} from '@fortawesome/free-solid-svg-icons';
import { getToken } from '../../features/auth/AuthSlice';
import { useSelector } from 'react-redux';
import { useDispatch } from 'react-redux';
import { logOut } from '../../features/auth/AuthSlice';
import axiosInstance from '../../apis/serverApi';
import { LOGOUT } from '../../apis/endPoints';

export const LeftSideBar = () => {
  const token = useSelector(getToken);
  const dispatch = useDispatch();

  const logoutSession = async () => {
    axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${token}`;

    dispatch(logOut());
    await axiosInstance.post(LOGOUT);
    
  };

  return (
    <>
      <div>
        <div>
          <ul className="list-group ">
            <Link to="/" className="list-group-item list-group-item-action">
              <FontAwesomeIcon icon={faHome} /> Home
            </Link>

            {token ? (
              <>
                {' '}
                <Link
                  to="/my-page"
                  className="list-group-item list-group-item-action"
                >
                  <FontAwesomeIcon icon={faHeart} color="" /> For You
                </Link>
                <Link
                  to="/preferences"
                  className="list-group-item list-group-item-action"
                >
                  <FontAwesomeIcon icon={faStar} color="" /> Preferences
                </Link>
                <Link
                  to="/settings"
                  className="list-group-item list-group-item-action"
                >
                  <FontAwesomeIcon icon={faGear} /> Settings
                </Link>
                <button
                  onClick={logoutSession}
                  className="list-group-item list-group-item-action"
                >
                  <FontAwesomeIcon icon={faCircleArrowLeft} /> Logout
                </button>
              </>
            ) : (
              <>
                {' '}
                <Link
                  to="/login"
                  className="list-group-item list-group-item-action"
                >
                  <FontAwesomeIcon icon={faKey} color="" /> Login
                </Link>
                <Link
                  to="/registration"
                  className="list-group-item list-group-item-action"
                >
                  <FontAwesomeIcon icon={faStar} color="" /> New user?
                </Link>
              </>
            )}
          </ul>
        </div>
      </div>
    </>
  );
};
