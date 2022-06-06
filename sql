CREATE TABLE users
(
  user_name VARCHAR NOT NULL,
  user_surname VARCHAR NOT NULL,
  user_password VARCHAR NOT NULL,
  user_email VARCHAR NOT NULL,
  user_id INT  IDENTITY(1,1) NOT NULL,
  logged_in CHAR NOT NULL,
  first_login CHAR NOT NULL,
  last_login_date DATE NOT NULL,
  PRIMARY KEY (user_id),
  UNIQUE (email)
);

CREATE TABLE products
(
  image_link VARCHAR NOT NULL,
  product_id INT IDENTITY(1,1) NOT NULL,
  name VARCHAR NOT NULL,
  price INT NOT NULL,
  PRIMARY KEY (product_id)
);

CREATE TABLE orders
(
  user_id VARCHAR NOT NULL,
  order_id INT IDENTITY(1,1) NOT NULL,
  total_price INT NOT NULL,
  date DATE NOT NULL,
  PRIMARY KEY (order_id)
);

CREATE TABLE users_orders
(
  user_id INT NOT NULL,
  order_id INT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(user_id),
  FOREIGN KEY (order_id) REFERENCES orders(order_id)
);

CREATE TABLE carts
(
  price INT NOT NULL,
  quantity INT NOT NULL,
  user_id INT NOT NULL,
  product_id INT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(user_id),
  FOREIGN KEY (product_id) REFERENCES products(product_id)
);

CREATE TABLE orders_products
(
  order_id INT NOT NULL,
  product_id INT NOT NULL,
  FOREIGN KEY (order_id) REFERENCES orders(order_id),
  FOREIGN KEY (product_id) REFERENCES products(product_id)
);