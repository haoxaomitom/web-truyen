CREATE DATABASE IF NOT EXISTS id20992771_users;

USE id20992771_users;

CREATE TABLE user_stories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  story_id INT,
  date_read DATE,
  rating INT,
  favorite BOOLEAN,
  FOREIGN KEY (user_id) REFERENCES users(id)
);
