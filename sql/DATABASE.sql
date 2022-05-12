CREATE TABLE Client(
    clientId int PRIMARY KEY,
    clientName varchar NOT NULL,
    email varchar NOT NULL,
    phoneNumber int NOT NULL,
    adress varchar NOT NULL,
    password varchar NOT NULL,
    username varchar NOT NULL
);

CREATE TABLE Restaurant(
    restaurantId int PRIMARY KEY,
    reataurantName varchar NOT NULL,
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

CREATE TABLE Comments(
    clientId int,
    restaurantId int,
    comment varchar,
    CONSTRAINT fk_clientId FOREIGN KEY (clientId)
        REFERENCES Client(clientId) 
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT fk_restaurantId FOREIGN KEY (restaurantId)
        REFERENCES Restaurant(restaurantId) 
        ON DELETE CASCADE
        ON UPDATE CASCADE 
)



INSERT INTO Client VALUES(1, "António Ferreira", "antonio@gmail.com",
    912345678, "Maia", "password", "antol");

INSERT INTO Client VALUES(2, "Ricardo Cavalheiro", "ricardao@yahoo.com",
    912121299, "Póvoa", "Password", "ricardi");

----//----

INSERT INTO Restaurant VALUES(1, "Bar de Minas", "FEUP", "Tradicional", "220202020", 5);
INSERT INTO Restaurant VALUES(2, "McDonald's", "Campus", "Fast-Food", "220202020", 3.7);
INSERT INTO Restaurant VALUES(3, "Snack-Bar", "Porto", "Snack", "220202020", 4.1);
INSERT INTO Restaurant VALUES(4, "Pizza-Hut", "Maia", "Italiano", "220202020", 4.3);

----//----

INSERT INTO Dish VALUES(1, 1, "Massa com Atum", 4.0, "Prato Principal");
INSERT INTO Dish VALUES(2, 1, "Peitos de Frango com Arroz", 4.5, "Prato Principal");
INSERT INTO Dish VALUES(3, 1, "Bife de Novilho com Legumes", 5.0, "Prato Principal");
INSERT INTO Dish VALUES(4, 1, "Sopa de Legumes", 2.5, "Entrada");
INSERT INTO Dish VALUES(5, 1, "Canja", 2.5, "Entrada");
INSERT INTO Dish VALUES(6, 1, "Bolo de Cenoura", 2.0, "Sobremesa");
INSERT INTO Dish VALUES(7, 1, "Fruta do Dia", 1.5, "Sobremesa");

INSERT INTO Dish VALUES(8, 2, "Grande Mac", 5.0, "Prato Principal");
INSERT INTO Dish VALUES(9, 2, "McGalinha", 4.0, "Prato Principal");
INSERT INTO Dish VALUES(10, 2, "Cola", 2.5, "Bebida");
INSERT INTO Dish VALUES(11, 2, "Nujetes", 1.0, "Entrada");
INSERT INTO Dish VALUES(12, 2, "Gelado de Oreo", 1.5, "Sobremesa");
INSERT INTO Dish VALUES(13, 2, "Tarte de Maçã", 1.0, "Sobremesa");

INSERT INTO Dish VALUES(14, 3, "Sandes de Presunto", 1.0, "Prato Principal");
INSERT INTO Dish VALUES(15, 3, "Cachorro Especial", 2.5, "Prato Principal");
INSERT INTO Dish VALUES(16, 3, "Cerveja", 0.5, "Bebida");
INSERT INTO Dish VALUES(17, 3, "Batatas Fritas", 1.0, "Entrada");
INSERT INTO Dish VALUES(18, 3, "Tremoços", 0.4, "Entrada");
INSERT INTO Dish VALUES(19, 3, "Vinho Tinto", 0.3, "Bebida");

INSERT INTO Dish VALUES(20, 4, "Pizza de Pepperoni", 10.0, "Prato Principal");
INSERT INTO Dish VALUES(21, 4, "Lasanha", 15.0, "Prato Principal");
INSERT INTO Dish VALUES(22, 4, "Água", 2.0, "Bebida");
INSERT INTO Dish VALUES(23, 4, "Pão de Alho", 5.0, "Entrada");
INSERT INTO Dish VALUES(24, 4, "Esparguete à Bolonhesa", 17.0, "Prato Principal");
INSERT INTO Dish VALUES(25, 4, "Almôndegas com Massa", 16.0, "Prato Principal");
INSERT INTO Dish VALUES(26, 4, "Pizza Vegetariana", 11.0, "Prato Principal");
INSERT INTO Dish VALUES(27, 4, "Gelado", 13.0, "Sobremesa");

----//----

INSERT INTO Request VALUES(1,1,"Completed");
INSERT INTO Request VALUES(2,1,"Processing");
INSERT INTO Request VALUES(3,1,"Completed");
INSERT INTO Request VALUES(4,2,"Completed");
INSERT INTO Request VALUES(5,2,"Completed");
INSERT INTO Request VALUES(6,2,"Processing");

----//----

INSERT INTO Currentrequest VALUES(3,2,2);
INSERT INTO Currentrequest VALUES(6,1,1);
INSERT INTO Currentrequest VALUES(20,1,4);
INSERT INTO Currentrequest VALUES(14,6,3);
INSERT INTO Currentrequest VALUES(23,5,1);
INSERT INTO Currentrequest VALUES(11,4,5);

----//----

INSERT INTO FavRestaurant VALUES(1,1);

----//----

INSERT INTO FavDish VALUES(1,12);
INSERT INTO FavDish VALUES(1,16);
INSERT INTO FavDish VALUES(2,23);

----//----

INSERT INTO Comments VALUES(1,1,"Muito bom");
INSERT INTO Comments VALUES(1,2,"Não gostei da comida, ambiente muito mau, e preços muito elevados para esta economia");
INSERT INTO Comments VALUES(2,3,"Já comi melhor");
INSERT INTO Comments VALUES(2,4,"Paguei um rim, mas gostei muito da comida, especialmente do pão de alho");
INSERT INTO Comments VALUES(2,2,"Não passou o vibe check");


INSERT INTO RestaurantOwner VALUES(1, 1,  "Francisco Maldonado", "kiko@gmail.com",
    934343431, "Gaia", "ronaldo7", "kmaldonado");