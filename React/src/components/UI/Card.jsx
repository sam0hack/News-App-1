import formatTimeAgo from '../../lib/DateTimeHelper';
export const Card = (props) => {
  const { title, content, source, web_url, image, date, author } =
    props.article;

  const currentDate = new Date(date);
  const relative_date = formatTimeAgo(currentDate);
  return (
    <>
      <div className="card text-center mb-3">
        <div className="card-header ">
          <span className="blockquote">
            <p>{source ?? ''}</p>
          </span>
        </div>
        <div className="card-body">
          <h5 className="card-title ">{title}</h5>
          <img loading='lazy' src={image ?? ''} className="card-img-top" alt={title}></img>
          <p className="card-text text-justify lead">{content ?? ''}</p>
          <a
            href={web_url ?? '/'}
            target="_blank"
            rel="noreferrer"
            className="btn btn-primary"
          >
            Visit page
          </a>
        </div>
        <div className="card-footer text-muted">{relative_date}</div>
      </div>
    </>
  );
};
