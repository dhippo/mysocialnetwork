<?php
class Message
{

    public function __construct(
        private $expediteur,
        private $recepteur,
        private $message,
        private $date,
        private $pdo
    ) {
        $this->pdo = $pdo;
    }

    public function getExpediteur()
    {
        return $this->expediteur;
    }
    public function setExpediteur($expediteur)
    {
        $this->expediteur = $expediteur;

        return $this;
    }
    public function getRecepteur()
    {
        return $this->recepteur;
    }
    public function setRecepteur($recepteur)
    {
        $this->recepteur = $recepteur;

        return $this;
    }
    public function getMessage()
    {
        return $this->message;
    }
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }
    public function getDate()
    {
        return $this->date;
    }
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    //envoie message
    function send_msg($id_user, $id_r, $msg)
    {
        if (empty($msg)) {
        } else {

            $sql = "INSERT INTO messages VALUES (NULL,'$id_user', '$id_r', '$msg', NOW(), null)";

            if ($this->pdo->query($sql)) {
            } else {
            }
        }
    }

    function all_discu($id_user)
    {
        $sql = "SELECT DISTINCT receiver_id FROM messages WHERE sender_id = '$id_user' ";
        $sql1 = "SELECT DISTINCT sender_id FROM messages WHERE receiver_id = '$id_user' ";


        $stmt = $this->pdo->query($sql);
        $stmt1 = $this->pdo->query($sql1);

        $contacts = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $contacts[] = $row;
        }
        while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {
            $contacts[] = $row;
        }

        $contacts = array_map(function ($item) {

            //toute les key s'appellerons 'id'
            $item["id"] = isset($item["receiver_id"]) ? $item["receiver_id"] : $item["sender_id"];
            unset($item["receiver_id"], $item["sender_id"]);

            return $item;
        }, $contacts);

        $values = array();
        foreach ($contacts as $key => $subArray) {
            $value = reset($subArray);
            if (in_array($value, $values)) {
                unset($contacts[$key]);
            } else {
                $values[] = $value;
            }
        }

        return $contacts;
    }

    function last_discu($id_user)
    {


        $sql = "SELECT* FROM messages WHERE ( receiver_id = '$id_user' OR sender_id = '$id_user' ) ORDER by sent_at DESC LIMIT 1";
        $stmt = $this->pdo->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$row){
            return null;
        }
        if($row['sender_id'] == $id_user){
            $id_to = $row['receiver_id'];
        }else{
            $id_to = $row['sender_id'];

        }
        //  var_dump($id_to);
        return $id_to;
    }

    function get_messages($id_user, $id_r)
    {
        $sql = "SELECT messages.*, users.last_name, users.first_name FROM messages INNER JOIN users ON messages.sender_id = users.id_user
        WHERE (messages.sender_id = '$id_user' AND messages.receiver_id = '$id_r') OR (messages.receiver_id = '$id_user' AND messages.sender_id = '$id_r') ORDER BY sent_at ASC";


        $stmt = $this->pdo->query($sql);
        if($stmt){
            $messages = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $messages[] = $row;
            }
        }else{
            echo'ereur';
        }

        // var_dump($messages);
        return $messages;
    }
}
