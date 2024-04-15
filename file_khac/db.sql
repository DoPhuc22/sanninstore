CREATE DATABASE sanninstore;
USE sanninstore;

CREATE TABLE brands (
	id INT auto_increment,
    brand_name VARCHAR(255),
    PRIMARY KEY (id)
);

CREATE TABLE ages (
	id INT auto_increment,
    age_name VARCHAR(13),
    description TEXT,
    PRIMARY KEY (id)
);

CREATE TABLE categories (
	id INT auto_increment,
    category_name VARCHAR(100),
    description TEXT,
    PRIMARY KEY (id)
);

CREATE TABLE countries (
	id INT auto_increment,
    country_name VARCHAR(100),
    PRIMARY KEY (id)
);

CREATE TABLE products (
	id INT auto_increment,
    product_name VARCHAR(255),
    quantity INT,
    price FLOAT,
    description TEXT,
    image TEXT,
    category_id INT,
    country_id INT,
    age_id INT,
    brand_id INT,
    PRIMARY KEY (id),
    FOREIGN KEY (category_id) REFERENCES categories(id),
    FOREIGN KEY (country_id) REFERENCES countries(id),
    FOREIGN KEY (age_id) REFERENCES ages(id),
    FOREIGN KEY (brand_id) REFERENCES brands(id)
);

CREATE TABLE admins (
	id INT auto_increment,
    email VARCHAR(255) unique,
    password VARCHAR(255),
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    phone_number VARCHAR(13),
    level INT,
    PRIMARY KEY (id)
);

CREATE TABLE customers (
	id INT auto_increment,
    email VARCHAR(255) unique,
    password VARCHAR(255),
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    phone_number VARCHAR(13),
    address TEXT,
    PRIMARY KEY (id)
);

CREATE TABLE payment_methods (
	id INT auto_increment,
    method_name VARCHAR(100),
    PRIMARY KEY (id)
);

CREATE TABLE orders (
	id INT auto_increment,
    order_date DATETIME,
    order_status INT,
    receiver_name VARCHAR(255),
    receiver_phone VARCHAR(13),
    receiver_address TEXT,
    admin_id INT,
    customer_id INT,
    method_id INT,
    PRIMARY KEY (id),
    FOREIGN KEY (admin_id) REFERENCES admins(id),
    FOREIGN KEY (customer_id) REFERENCES customers(id),
    FOREIGN KEY (method_id) REFERENCES payment_methods(id)
);

CREATE TABLE orders_details (
	order_id INT,
    product_id INT,
    sold_price FLOAT,
    sold_quantity INT,
    PRIMARY KEY (order_id, product_id),
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

/*================================================================*/

INSERT INTO brands(brand_name) VALUES
("Mojang Studios"),
("Disney"),
("Marvel"),
("DC"),
("Sega"),
("Nintendo");

INSERT INTO ages(age_name) VALUES
("1.5+"),
("4+"),
("6+"),
("9+"),
("13+"),
("18+");

INSERT INTO categories(category_name) VALUES
("Batman"),
("Minecraft"),
("Lunar New Year"),
("Valentine"),
("Disney"),
("Marvel");

INSERT INTO countries(country_name) VALUES
("United States"),
("Korea"),
("Italy"),
("China"),
("Japan"),
("Vietnam");

INSERT INTO products(product_name, quantity, price, description, image, category_id, country_id, age_id, brand_id) VALUES
("Auspicious Dragon", 100, 89.99, "", "images/products/product_1.webp", 3, 1, 6, 2),
("Batmobile™: Batman™ vs. The Joker™ Chase", 100, 47.99, "", "images/products/product_2.webp", 1, 2, 3, 4),
("Spring Festival Mickey Mouse", 100, 9.99, "", "images/products/product_3.webp", 5, 3, 1, 2),
("Nano Gauntlet", 100, 69.99, "", "images/products/product_4.webp", 3, 4, 2, 6),
("The Abandoned Mine", 100, 19.99, "", "images/products/product_5.webp", 2, 5, 4, 1),
("Heart Ornament", 100, 12.99, "", "images/products/product_6.webp", 4, 6, 5, 5),
("2Auspicious Dragon", 100, 89.99, "", "images/products/product_1.webp", 3, 1, 6, 2),
("2Batmobile™: Batman™ vs. The Joker™ Chase", 100, 47.99, "", "images/products/product_2.webp", 1, 2, 3, 4),
("2Spring Festival Mickey Mouse", 100, 9.99, "", "images/products/product_3.webp", 5, 3, 1, 2),
("2Nano Gauntlet", 100, 69.99, "", "images/products/product_4.webp", 3, 4, 2, 6),
("2The Abandoned Mine", 100, 19.99, "", "images/products/product_5.webp", 2, 5, 4, 1),
("2Heart Ornament", 100, 12.99, "", "images/products/product_6.webp", 4, 6, 5, 5);