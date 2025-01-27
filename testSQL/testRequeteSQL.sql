select
  review.textReview,
  date_format(date(review.dateReview), '%d/%m/%Y') as 'dateReview',
  review.noteReview,
  client.nickNameClient
from
  review
  inner join client using(idClient)
where
  idMovie = 2;
insert into
  review (
    textReview,
    dateReview,
    noteReview,
    idClient,
    idMovie
  )
values
  ('test de review', now(), '5', '15', '2');
select
  *,
  date_format(dateSession, '%d/%m/%Y')
from
  session
where
  idMovie = 3;
select
  idTicket,
  movie.thumbnail,
  movie.titleMovie,
  session.dateSession,
  session.timeSession,
  price.namePrix,
  price.prix,
  quant
from
  price,
  ticket
  inner join session using(idSession)
  inner join movie using(idMovie)
WHERE
  ticket.idPrice = price.idPrix
  AND idClient = 15;
insert into
  movie (
    titleMovie,
    summaryMovie,
    director,
    poster,
    header,
    thumbnail
  )
values
  (
    "testT1",
    "testS1",
    "testD1",
    "testP1",
    null,
    "testT1"
  );



UPDATE movie SET titleMovie = :title, director = :director, summaryMovie = :summary, poster = :poster, thumbnail = :thumbnail, header = :header WHERE idMovie = :idMovie;