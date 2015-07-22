<?php

namespace DataSourceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Logger
 */
class Logger
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $todo;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DataSourceBundle\Entity\User
     */
    private $user;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set todo
     *
     * @param string $todo
     * @return Logger
     */
    public function setTodo($todo)
    {
        $this->todo = $todo;

        return $this;
    }

    /**
     * Get todo
     *
     * @return string 
     */
    public function getTodo()
    {
        return $this->todo;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Logger
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set user
     *
     * @param \DataSourceBundle\Entity\User $user
     * @return Logger
     */
    public function setUser(\DataSourceBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \DataSourceBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        // Add your code here
    }
}
