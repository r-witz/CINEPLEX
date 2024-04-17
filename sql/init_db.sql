CREATE TABLE Users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  pseudo VARCHAR(70) NOT NULL,
  email VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(60) NOT NULL
);

CREATE TABLE Directors (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(70) NOT NULL UNIQUE,
  image_name VARCHAR(70) NOT NULL UNIQUE
);

CREATE TABLE Actors (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(70) NOT NULL UNIQUE,
  image_name VARCHAR(70) NOT NULL UNIQUE
);

CREATE TABLE Categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(10) NOT NULL UNIQUE
);

CREATE TABLE Films (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(50) NOT NULL UNIQUE,
  plot VARCHAR(255) NOT NULL UNIQUE,
  price FLOAT NOT NULL,
  image_name VARCHAR(50) NOT NULL UNIQUE,
  director_id INT NOT NULL,
  FOREIGN KEY (director_id) REFERENCES Directors(id)
);

CREATE TABLE Films_Actors (
  id INT AUTO_INCREMENT PRIMARY KEY,
  film_id INT NOT NULL,
  actor_id INT NOT NULL,
  FOREIGN KEY (film_id) REFERENCES Films(id),
  FOREIGN KEY (actor_id) REFERENCES Actors(id)
);

CREATE TABLE Films_Categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  film_id INT NOT NULL,
  category_id INT NOT NULL,
  FOREIGN KEY (film_id) REFERENCES Films(id),
  FOREIGN KEY (category_id) REFERENCES Categories(id)
);

CREATE TABLE Carts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  film_id INT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES Users(id),
  FOREIGN KEY (film_id) REFERENCES Films(id)
);

CREATE TABLE Library (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  film_id INT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES Users(id),
  FOREIGN KEY (film_id) REFERENCES Films(id)
);
