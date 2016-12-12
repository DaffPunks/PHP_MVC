<?php

/**
 * @Entity @Table(name="feedbacks")
 * @HasLifecycleCallbacks
 **/
class Feedback
{
    /** @Id @Column(type="integer") @GeneratedValue * */
    protected $id;

    /** @Column(type="string") * */
    protected $name;

    /** @Column (type="string") * */
    protected $email;

    /** @Column (type="text") * */
    protected $text;

    /** @Column (type="datetime") * */
    protected $created;

    /** @Column (type="boolean", options={"default":0}) * */
    protected $edited = 0;

    /** @Column (type="integer", options={"default":0}) * */
    protected $status = 0;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getEdited()
    {
        return $this->edited;
    }

    public function setEdited($edited)
    {
        $this->edited = $edited;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @PrePersist
     */
    public function setCreated()
    {
        $this->created = new \DateTime("now");;
    }

}