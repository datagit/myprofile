<?php

namespace DataSourceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 */
class Comment
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $comment;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DataSourceBundle\Entity\Profile
     */
    private $profileComment;

    /**
     * @var \DataSourceBundle\Entity\Activity
     */
    private $activity;


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
     * Set comment
     *
     * @param string $comment
     * @return Comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Comment
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
     * Set profileComment
     *
     * @param \DataSourceBundle\Entity\Profile $profileComment
     * @return Comment
     */
    public function setProfileComment(\DataSourceBundle\Entity\Profile $profileComment = null)
    {
        $this->profileComment = $profileComment;

        return $this;
    }

    /**
     * Get profileComment
     *
     * @return \DataSourceBundle\Entity\Profile 
     */
    public function getProfileComment()
    {
        return $this->profileComment;
    }

    /**
     * Set activity
     *
     * @param \DataSourceBundle\Entity\Activity $activity
     * @return Comment
     */
    public function setActivity(\DataSourceBundle\Entity\Activity $activity = null)
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Get activity
     *
     * @return \DataSourceBundle\Entity\Activity 
     */
    public function getActivity()
    {
        return $this->activity;
    }
    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        // Add your code here
    }
}
