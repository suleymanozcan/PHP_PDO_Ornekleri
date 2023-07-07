CREATE TABLE products (
  id int(11) NOT NULL,
  name varchar(255) DEFAULT NULL,
  url varchar(255) DEFAULT NULL,
  price decimal(10,2) DEFAULT NULL,
  vat int(11) DEFAULT NULL,
  stock_code varchar(255) NOT NULL,
  stock_quantity int(11) NOT NULL,
  image varchar(255) DEFAULT NULL,
  details text,
  created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO products (id, `name`, url, price, vat, stock_code, stock_quantity, image, details, created_at, updated_at) VALUES
(13, 'Coca Cola 1LT', 'coca-cola-1lt.html', '30.00', 20, 'CC1LT0001', 100, 'a983c9de5d34cb881ec83bcf448ed6fd.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.\r\n', '2023-07-07 22:32:04', '2023-07-07 22:58:44');


ALTER TABLE products
  ADD PRIMARY KEY (id);


ALTER TABLE products
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;
