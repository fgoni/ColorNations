<?php
namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {
    //Atributos
    protected $clients;
    public $games = array();
    protected $playerCount = 0;

    //Constructor
    public function __construct() {
        $this->clients = new \SplObjectStorage;
        echo "Server started \n";
    }


    //Eventos de la clase
    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);
        $msg = "id".".".$conn->resourceId;
        $conn->send($msg);
        $this->listarJugadores();
        echo "New connection! ({$conn->resourceId})\n";
        echo "Player ".count($this->clients)." connected \n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $partes = explode('.', $msg);
        $games = $this->games;
        if ($partes[0] == "aceptar"){
            if ($partes[1]){
                $games[] = (object) array("id" => count($games), "player1" => $partes[2], "player2" => $partes[3]);
                echo "Game created: ", $partes[2], $partes[3], "\n";
                $msg = "ini"."."."1";
                $this->getClientById($partes[2])->send($msg);
                $msg = "ini"."."."2";
                $this->getClientById($partes[3])->send($msg);

            }
            $this->games = $games;
        }
        if ($partes[0] == "jugar"){
            foreach ($this->clients as $client){
                if ($client->resourceId == $partes[2]){
                    $client->send("invitacion".".".$partes[1]);
                }
            }
        }
        if ($partes[0] == "pos"){
            if (isset($games)) {
                //var_dump($games);
                foreach ($games as $game){
                    if ($game->player1 == $partes[1]){
                        foreach ($this->clients as $client){
                            if ($game->player2 == $client->resourceId){
                                $client->send($msg);
                            }
                        }
                    }
                    else if ($game->player2 == $partes[1]){
                        foreach ($this->clients as $client){
                            if ($game->player1 == $client->resourceId){
                                $client->send($msg);
                            }
                        }
                    }
                }
            }
        }
        if ($partes[0] == "mes") {
            $numRecv = count($this->clients) - 1;
            echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n", $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');
            $contador = 0;
            foreach ($this->clients as $client) {
                $contador++;
                //if ($from !== $client) {
                    $client->send($msg);
                //}
            }
        }

    }
    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
        $this->listarJugadores();
        $gameId = $this->getClientGame($conn->resourceId);
        unset($this->games[$gameId]);
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }

    //Métodos de la clase
    protected function listarJugadores(){
        $msg = "lista";
        foreach ($this->clients as $client){
            $msg .= "." . $client->resourceId;
        }
        foreach ($this->clients as $client){
            $client->send($msg);
        }
    }
    protected function getClientById($id){
        foreach ($this->clients as $client){
            if ($client->resourceId == $id){
                return $client;
            }
        }
    }
    protected function getClientGame($id){
        foreach ($this->games as $game){
            if ($game->player1 == $id || $game->player2 == $id){
                return $game->id;
            }
        }
    }

}