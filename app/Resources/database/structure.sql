CREATE TABLE place (
  id      SERIAL PRIMARY KEY,
  name    CHARACTER VARYING(64) NOT NULL UNIQUE,
  address TEXT                  NOT NULL
);

CREATE TABLE account (
  id        SERIAL PRIMARY KEY,
  firstname CHARACTER VARYING(64) NOT NULL,
  lastname  CHARACTER VARYING(64) NOT NULL,
  email     CHARACTER VARYING(64) NOT NULL UNIQUE
);


CREATE TABLE price (
  id    SERIAL PRIMARY KEY,
  place_id INTEGER not null REFERENCES place(id),
  type  CHARACTER VARYING(64),
  value FLOAT
);

