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