TRUNCATE TABLE users;
TRUNCATE TABLE Article;

INSERT INTO users (username, password, last_connection)
VALUES('mtti', 'mdr', NOW());
INSERT INTO users (username, password, last_connection)
VALUES('stays', 'lol', NOW());

INSERT INTO Article (title, content, id_user)
VALUES('MDR', 'Lorem ipsum', 1);
INSERT INTO Article (title, content, id_user)
VALUES('LOL', 'Lorem ipsum', 2);