DROP TABLE IF EXISTS Client;
DROP TABLE IF EXISTS Restaurant;
DROP TABLE IF EXISTS RestaurantPhoto;
DROP TABLE IF EXISTS Dish;
DROP TABLE IF EXISTS Request;
DROP TABLE IF EXISTS Currentrequest;
DROP TABLE IF EXISTS FavRestaurant;
DROP TABLE IF EXISTS FavDish;
DROP TABLE IF EXISTS Comments;
DROP TABLE IF EXISTS Answer;

CREATE TABLE Client(
    clientId integer PRIMARY KEY,
    clientName varchar NOT NULL,
    email varchar NOT NULL UNIQUE,
    phoneNumber integer NOT NULL UNIQUE,
    adress varchar NOT NULL,
    password varchar NOT NULL,
    username varchar NOT NULL UNIQUE,
    photo varchar

);

CREATE TABLE Restaurant(
    restaurantId integer PRIMARY KEY,
    restaurantName varchar NOT NULL,
    adress varchar NOT NULL,
    category varchar NOT NULL,
    phoneNumber integer NOT NULL,
    rating real NOT NULL ON CONFLICT REPLACE DEFAULT 0.0,
    ownerId integer NOT NULL,
    photo varchar NOT NULL,
    CONSTRAINT fk_clientId FOREIGN KEY (ownerId)
        REFERENCES Client(clientId)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Dish(
    dishId integer PRIMARY KEY,
    restaurantId integer NOT NULL,
    dishName varchar NOT NULL,
    price real NOT NULL,
    category varchar NOT NULL,
    photo varchar NOT NULL,
    CONSTRAINT fk_restaurantId FOREIGN KEY (restaurantId)
        REFERENCES Restaurant(restaurantId) 
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Request(
    requestId integer PRIMARY KEY,
    clientId integer NOT NULL,
    state varchar NOT NULL,
    CONSTRAINT fk_clientId FOREIGN KEY (clientId)
        REFERENCES Client(clientId) 
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Currentrequest(
    dishId integer,
    requestId integer,
    quantidade integer NOT NULL,
    CONSTRAINT fk_dishId FOREIGN KEY (dishId)
        REFERENCES Dish(dishId) 
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT fk_requestId FOREIGN KEY (requestId)
        REFERENCES request(requestId) 
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    PRIMARY KEY(requestId, dishId)
);

CREATE TABLE FavRestaurant(
    clientId integer,
    restaurantId integer,
    CONSTRAINT fk_clientId FOREIGN KEY (clientId)
        REFERENCES Client(clientId) 
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT fk_restaurantId FOREIGN KEY (restaurantId)
        REFERENCES Restaurant(restaurantId) 
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    PRIMARY KEY(clientId, restaurantId)
);

CREATE TABLE FavDish(
    clientId integer,
    dishId integer,
    CONSTRAINT fk_clientId FOREIGN KEY (clientId)
        REFERENCES Client(clientId) 
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT fk_dishId FOREIGN KEY (dishId)
        REFERENCES Dish(dishId) 
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    PRIMARY KEY(clientId, dishId)
);

CREATE TABLE Comments(
    commentId integer PRIMARY KEY,
    clientId integer NOT NULL,
    restaurantId integer NOT NULL,
    comment varchar NOT NULL,
    rating integer NOT NULL,
    published date NOT NULL,
    CONSTRAINT check_rating CHECK(rating <= 5 AND rating >= 0),
    CONSTRAINT fk_clientId FOREIGN KEY (clientId)
        REFERENCES Client(clientId) 
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT fk_restaurantId FOREIGN KEY (restaurantId)
        REFERENCES Restaurant(restaurantId) 
        ON DELETE CASCADE
        ON UPDATE CASCADE
    
);

CREATE TABLE Answer(
    commentId integer PRIMARY KEY,
    comment varchar NOT NULL,
    CONSTRAINT fk_commentId FOREIGN KEY (commentId)
        REFERENCES Comments(commentId)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);



INSERT INTO Client VALUES(1, "António Ferreira", "antonio@gmail.com",
    912345678, "Maia", "$2y$10$YuSkSIe/xhgLIMDLCJhlpellgYApo7tr9xkPMP6tp/PLWcK.DBspy", "antol",NULL);
INSERT INTO Client VALUES(2, "João Maldonado", "kiko@gmail.com", 1234,
    "Gaia","$2y$10$V7M5v1jVe132qLj7jGNzsOEQqXtXksnOqipN07FqyyTm7W9V/NjoG", "user", NULL);

----//----

INSERT INTO Restaurant VALUES(1, "Bar de Minas", "R. Dr. Roberto Frias", "Tradicional", "220202020", NULL,2,'../images/Restaurant1.png');
INSERT INTO Restaurant VALUES(2, "McDonald's", "Estr. da Circunvalação 8114 8116, 4200-163 Porto", "Fast-Food", "220202020", NULL,2,'../images/Restaurant2.jpg');
INSERT INTO Restaurant VALUES(3, "San Martino", "R. Caetano Remeão 84, 4405-537 Valadares", "Italiano", "220202020", NULL,1, '../images/Restaurant3.jpg');
INSERT INTO Restaurant VALUES(4, "Capa Negra", "Rua do Campo Alegre 191, 4150-177 Porto", "Tradicional", "220202020", NULL,1, '../images/Restaurant4.jpg');
INSERT INTO Restaurant VALUES(5, "O Buraco", "R. do Bolhão 95", "Tradicional", "220202020", NULL,1, '../images/Restaurant5.jpg');
INSERT INTO Restaurant VALUES(6, "Pizza-Hut", "Av. de Fernão de Magalhães 1862, 4350-158 Porto", "Fast-Food", "220202020", NULL,1,'../images/Restaurant6.png');
INSERT INTO Restaurant VALUES(7, "Telepizza", "R. de Soares dos Reis 528, 4400-315 Porto", "Fast-Food", "220202020", NULL,1,'../images/Restaurant7.jpg');
INSERT INTO Restaurant VALUES(8, "Casa d'Oro", "R. do Ouro 797, Porto", "Italiano", "220202020", NULL,1,"../images/Restaurant8.png");
INSERT INTO Restaurant VALUES(9, "Di Casa", "R. Fernando Lopes Vieira 262, 4430-703 Vila Nova de Gaia", "Italiano", "220202020", NULL,1, "../images/Restaurant9.jpg");

----//----

INSERT INTO Dish VALUES(1, 1, "Salada Mista", 4.0, "Entrada",'../images/Dish1.jpg');
INSERT INTO Dish VALUES(2, 1, "Legumes Fritos", 2.5, "Entrada",'../images/Dish2.jpg');
INSERT INTO Dish VALUES(3, 1, "Croissant", 2.0, "Sobremesa", '../images/Dish3.jpg');

INSERT INTO Dish VALUES(4, 2, "BigMc", 5.0, "Prato Principal",'../images/Dish4.jpg');
INSERT INTO Dish VALUES(5, 2, "McChicken", 4.0, "Prato Principal",'../images/Dish5.jpg');
INSERT INTO Dish VALUES(6, 2, "Coca-Cola", 2.5, "Bebida",'../images/Dish6.jpg');
INSERT INTO Dish VALUES(7, 2, "Nuggets", 1.0, "Entrada",'../images/Dish7.jpg');
INSERT INTO Dish VALUES(8, 2, "McFlurry Oreo", 1.5, "Sobremesa", '../images/Dish8.jpg');
INSERT INTO Dish VALUES(9, 2, "Tarte de Maçã", 1.0, "Sobremesa", '../images/Dish9.jpg');

INSERT INTO Dish VALUES(10, 3, "Mousse", 3.0, "Sobremesa",'../images/Dish10.jpg');
INSERT INTO Dish VALUES(11, 3, "Salmão Grelhado", 12.5, "Prato Principal",'../images/Dish11.jpg');

INSERT INTO Dish VALUES(12, 4, "Pizza de Pepperoni", 10.0, "Prato Principal",'../images/Dish12.jpg');
INSERT INTO Dish VALUES(13, 4, "Lasanha", 15.0, "Prato Principal",'../images/Dish13.jpg');
INSERT INTO Dish VALUES(14, 4, "Gelado", 13.0, "Sobremesa",'../images/Dish14.jpg');

----//----

INSERT INTO Request VALUES(1,1,"Pronto");
INSERT INTO Request VALUES(2,1,"Em Preparação");
INSERT INTO Request VALUES(3,1,"Pronto");
/*INSERT INTO Request VALUES(4,2,"Pronto");*/
INSERT INTO Request VALUES(5,2,"Entregue");
INSERT INTO Request VALUES(6,2,"Em Preparação");

----//----

INSERT INTO Currentrequest VALUES(3,2,2);
INSERT INTO Currentrequest VALUES(6,1,1);
/*INSERT INTO Currentrequest VALUES(20,1,4);*/
INSERT INTO Currentrequest VALUES(14,6,3);
INSERT INTO Currentrequest VALUES(23,5,1);
INSERT INTO Currentrequest VALUES(11,4,5);
INSERT INTO Currentrequest VALUES(11,3,5);

----//----

INSERT INTO FavRestaurant VALUES(1,1);

----//----

INSERT INTO FavDish VALUES(1,12);
INSERT INTO FavDish VALUES(1,16);

----//----

INSERT INTO Comments VALUES(1, 1,1,"Muito bom",5,'2022-5-13');
INSERT INTO Comments VALUES(2, 1,2,"Não gostei da comida, ambiente muito mau, e preços muito elevados.",2,'2022-4-11');
INSERT INTO Comments VALUES(3, 2,3,"Já comi melhor",3,'2022-2-1');
INSERT INTO Comments VALUES(4, 2,4,"Caro mas vale a pena",4,'2022-1-22');
INSERT INTO Comments VALUES(5, 2,2,"Atendimento fraco",1,'2022-6-17');
INSERT INTO Comments VALUES(6, 1,1,"Antipáticos",1,'2022-5-12');
INSERT INTO Comments VALUES(7, 1,1,"Comida razoável.",3,'2021-1-12');


----//----

INSERT INTO Answer VALUES(1,"Em nome da Casa agradecemos a comentário. Volte Sempre!");
INSERT INTO Answer VALUES(7,"Agradecemos a avaliação. Esperemos que de uma próxima seja ainda mais agradável!");
