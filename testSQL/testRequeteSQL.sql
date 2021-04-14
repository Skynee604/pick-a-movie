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
  idMovie = 3