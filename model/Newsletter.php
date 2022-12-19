<?php

namespace model;

class Newsletter
{
 private $id;
 private $email;
 private $created_at;
 private $verified; // verified = NULL, not verified = NOT NULL
    private $delrequest;  // no delrequest = NULL, delrequest = NOT NULL

 /**
     * Newsletter constructor
     */
    public function __construct()
    {
        $this->created_at = date("Y-m-d H:i:s");
    }

    /**
     * @return mixed
     */
    public function getNLCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setNLCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

 /**
     * @return int
     */
    public function getNLid()
    {
        return $this->id;
    }

    /**
     * @param int $NLId
     */
    public function setNLid($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNLmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $NLmail
     */
    public function setNLmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getNLverified()
    {
        return $this->verified;
    }

    /**
     * @param mixed $NLverified
     */
    public function setNLverified($verified)
    {
        $this->verified = $verified;
    }

    /**
     * @return mixed
     */
    public function getNLdelrequest()
    {
        return $this->delrequest;
    }

    /**
     * @param mixed $NLdelrequest
     */
    public function setNLdelrequest($delrequest)
    {
        $this->delrequest = $delrequest;
    }

}

?>

