
CREATE TABLE user (

	id INT AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(255),
	email VARCHAR(255),
	password VARCHAR(255)

);

CREATE TABLE game (

	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255),
	description TEXT,
	category VARCHAR(255),
	author INT,
	FOREIGN KEY (author) REFERENCES user(id)

);

CREATE TABLE login (

	id INT AUTO_INCREMENT PRIMARY KEY,
	ip VARCHAR(255),
	status VARCHAR(255),
	user_id INT,
	FOREIGN KEY (user_id) REFERENCES user(id)

);

INSERT INTO user (username, email, password) VALUES ('admin', 'admin@gmail.com', 'admin');

INSERT INTO game (name, description, category, author) VALUES ('game1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum interdum.', 'video', 1);
INSERT INTO game (name, description, category, author) VALUES ('game2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum interdum.', 'video', 1);
INSERT INTO game (name, description, category, author) VALUES ('game3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum interdum.', 'video', 1);
INSERT INTO game (name, description, category, author) VALUES ('game4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum interdum.', 'video', 1);

INSERT INTO game (name, description, category, author) VALUES ('game5', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum interdum.', 'board', 1);
INSERT INTO game (name, description, category, author) VALUES ('game6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum interdum.', 'board', 1);
INSERT INTO game (name, description, category, author) VALUES ('game7', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum interdum.', 'board', 1);
INSERT INTO game (name, description, category, author) VALUES ('game8', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum interdum.', 'board', 1);

INSERT INTO game (name, description, category, author) VALUES ('game9', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum interdum.', 'others', 1);
INSERT INTO game (name, description, category, author) VALUES ('game10', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum interdum.', 'others', 1);
INSERT INTO game (name, description, category, author) VALUES ('game11', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum interdum.', 'others', 1);
INSERT INTO game (name, description, category, author) VALUES ('game12', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum interdum.', 'others', 1);