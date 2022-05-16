<?php
  declare(strict_types = 1);

  class Client {
    public int $clientId;
    public string $clientName;
    public string $email;
    public string $adress;
    public string $phoneNumber;
    public string $password;
    public string $username;

    public function __construct(int $clientId, string $clientName, string $email, string $adress, string $phoneNumber, string $password, string $username)
    {
      
        $this->$clientId = $clientId;
        $this->$clientName = $clientName;
        $this->$email = $email;
        $this->$adress = $adress;
        $this->$phoneNumber = $phoneNumber;
        $this->$password = $password;
        $this->$username = $username;
    }

  

    static function getClientId(PDO $db, string $username, string $password) : ?Client {
        $stmt = $db->prepare('SELECT clientId, clientName, email, adress, phoneNumber, username FROM client WHERE username = ? and password = ?');
        $stmt->execute(array($username,$password));
    
        if ($client = $stmt->fetch()) {
          return new Client(
            $client['clientId'],
            $client['clientName'],
            $client['email'],
            $client['adress'],
            $client['phoneNumber'],
            $client['username'],
          );
          
        } else return null;

      }
    
     
  
 
    static function getclient(PDO $db, int $id) : Client {
      $stmt = $db->prepare('
        SELECT clientId, clientName, email, adress, phoneNumber, password, username
        FROM client 
        WHERE clientId = ?
      ');
      

      $stmt->execute(array($id));
      $client = $stmt->fetch();
  
      return new client(
        $client['clientId'],
        $client['clientName'],
        $client['email'],
        $client['adress'],
        $client['phoneNumber'],
        $client['password'],
        $client['username'],
      );
    }
  }
?>

