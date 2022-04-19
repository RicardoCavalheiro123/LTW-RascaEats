CREATE TABLE Client(
    clientId int PRIMARY KEY,
    name varchar NOT NULL,
    email varchar NOT NULL,
    phoneNumber int NOT NULL,
    adress varchar NOT NULL,
    password varchar NOT NULL,
    username varchar NOT NULL
);

CREATE TABLE Restaurant(
    restaurantId int PRIMARY KEY,
    name varchar NOT NULL,
    adress varchar NOT NULL,
    category varchar NOT NULL,
    phoneNumber int NOT NULL,
    rating real
);

CREATE TABLE RestaurantOwner (
    ownerId int PRIMARY KEY,
    restaurantId int,
    name varchar,
    email varchar,
    phoneNumber int,
    adress varchar,
    password varchar,
    username varchar,
    CONSTRAINT fk_restaurantId FOREIGN KEY (restaurantId)
        REFERENCES Restaurant(restaurantId) 
        ON DELETE CASCADE
        ON UPDATE CASCADE    
);

CREATE TABLE Dish(
    dishId int PRIMARY KEY,
    restaurantId int,
    name varchar,
    price real,
    category varchar,
    CONSTRAINT fk_restaurantId FOREIGN KEY (restaurantId)
        REFERENCES Restaurant(restaurantId) 
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE DishPhoto(
    dishId int PRIMARY KEY,
    photo varchar,
    CONSTRAINT fk_dishId FOREIGN KEY (dishId)
        REFERENCES Dish(dishId) 
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Request(
    requestId int PRIMARY KEY,
    clientId int,
    state varchar,
    CONSTRAINT fk_clientId FOREIGN KEY (clientId)
        REFERENCES Client(clientId) 
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Currentrequest(
    dishId int,
    requestId int,
    quantidade int,
    CONSTRAINT fk_dishId FOREIGN KEY (dishId)
        REFERENCES Dish(dishId) 
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT fk_requestId FOREIGN KEY (requestId)
        REFERENCES request(requestId) 
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE FavRestaurant(
    clientId int,
    restaurantId int,
    CONSTRAINT fk_clientId FOREIGN KEY (clientId)
        REFERENCES Client(clientId) 
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT fk_restaurantId FOREIGN KEY (restaurantId)
        REFERENCES Restaurant(restaurantId) 
        ON DELETE CASCADE
        ON UPDATE CASCADE 
);

CREATE TABLE FavDish(
    clientId int,
    dishId int,
    CONSTRAINT fk_clientId FOREIGN KEY (clientId)
        REFERENCES Client(clientId) 
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT fk_dishId FOREIGN KEY (dishId)
        REFERENCES Dish(dishId) 
        ON DELETE CASCADE
        ON UPDATE CASCADE
);



INSERT INTO Client VALUES(1, "António Ferreira", "antonio@gmail.com",
    912345678, "Maia", "password", "antol");

INSERT INTO Client VALUES(2, "Ricardo Cavalheiro", "ricardao@yahoo.com",
    912121299, "Póvoa", "Password", "ricardi");

INSERT INTO Restaurant VALUES(1, "Bar de Minas", "FEUP", "Snack", "220202020", 5);
INSERT INTO Restaurant VALUES(2, "McDonald's", "Campus", "Fast-Food", "220202020", 3.7);
INSERT INTO Restaurant VALUES(3, "Snack-Bar", "Porto", "Snack", "220202020", 4.1);
INSERT INTO Restaurant VALUES(4, "Pizza-Hut", "Maia", "Fast-Food", "220202020", 4.3);

INSERT INTO RestaurantOwner VALUES(1, 1,  "Francisco Maldonado", "kiko@gmail.com",
    934343431, "Gaia", "ronaldo7", "kmaldonado");