<?php


class User
{
    private $id;
    private $email;
    private $first_name;
    private $last_name;
    private $password;
    private $promo;
    private $statut;
    private $bio;
    private $birth_date;
    private $profile_picture;
    private $interests;
    private $validated;
    private $is_blocked;

    public function __construct($data)
    {
        $this->id = $data['id_user'];
        $this->email = $data['email'];
        $this->first_name = $data['first_name'];
        $this->last_name = $data['last_name'];
        $this->password = $data['password'];
        $this->promo = $data['promo'];
        $this->statut = $data['statut'];
        $this->bio = $data['bio'];
        $this->birth_date = $data['birth_date'];
        $this->profile_picture = $data['profile_picture'];
        $this->interests = $data['interests'];
        $this->validated = $data['validated'];
        $this->is_blocked = $data['is_blocked'];
    }

    public function getId()
    {
        return $this->id;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getFirstName()
    {
        return $this->first_name;
    }
    public function getLastName()
    {
        return $this->last_name;
    }

    public function getPromo()
    {
        return $this->promo;
    }
    public function getStatut()
    {
        return $this->statut;
    }
    public function getBio()
    {
        return $this->bio;
    }
    public function getBirthDate()
    {
        return $this->birth_date;
    }
    public function getProfilePicture()
    {
        return $this->profile_picture;
    }
    public function getInterests()
    {
        return $this->interests;
    }
}


