import formatTimeAgo from '../../lib/DateTimeHelper';

export const List = (props) => {
  const { title, web_url, date } = props.article;

  const currentDate = new Date(date);
  const relative_date = formatTimeAgo(currentDate);

  return (
    <>
      <li className="list-group-item d-flex justify-content-between align-items-start">
        <div className="ms-2 me-auto">
          <div className="fw-bold">{title}</div>
          <a
            className="App-link"
            target="_blank"
            rel="noreferrer"
            href={web_url}
            alt={title}
          >
            Read more....
          </a>
        </div>
        <span className="badge bg-primary rounded-pill">{relative_date}</span>
      </li>
    </>
  );
};
