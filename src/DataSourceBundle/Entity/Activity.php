<?php

namespace DataSourceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activity
 */
class Activity
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $image;

    /**
     * @var string
     */
    private $profile_point_json;

    /**
     * @var integer
     */
    private $point;

    /**
     * @var integer
     */
    private $activity_type;

    /**
     * @var integer
     */
    private $status;

    /**
     * @var integer
     */
    private $view;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @var \DataSourceBundle\Entity\Profile
     */
    private $profileActivity;


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
     * Set title
     *
     * @param string $title
     * @return Activity
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Activity
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Activity
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set profile_point_json
     *
     * @param string $profilePointJson
     * @return Activity
     */
    public function setProfilePointJson($profilePointJson)
    {
        $this->profile_point_json = $profilePointJson;

        return $this;
    }

    /**
     * Get profile_point_json
     *
     * @return string 
     */
    public function getProfilePointJson()
    {
        return $this->profile_point_json;
    }

    /**
     * Set point
     *
     * @param integer $point
     * @return Activity
     */
    public function setPoint($point)
    {
        $this->point = $point;

        return $this;
    }

    /**
     * Get point
     *
     * @return integer 
     */
    public function getPoint()
    {
        return $this->point;
    }

    /**
     * Set activity_type
     *
     * @param integer $activityType
     * @return Activity
     */
    public function setActivityType($activityType)
    {
        $this->activity_type = $activityType;

        return $this;
    }

    /**
     * Get activity_type
     *
     * @return integer 
     */
    public function getActivityType()
    {
        return $this->activity_type;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Activity
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set view
     *
     * @param integer $view
     * @return Activity
     */
    public function setView($view)
    {
        $this->view = $view;

        return $this;
    }

    /**
     * Get view
     *
     * @return integer 
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Activity
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
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return Activity
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set profileActivity
     *
     * @param \DataSourceBundle\Entity\Profile $profileActivity
     * @return Activity
     */
    public function setProfileActivity(\DataSourceBundle\Entity\Profile $profileActivity = null)
    {
        $this->profileActivity = $profileActivity;

        return $this;
    }

    /**
     * Get profileActivity
     *
     * @return \DataSourceBundle\Entity\Profile 
     */
    public function getProfileActivity()
    {
        return $this->profileActivity;
    }
    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        // Add your code here
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        // Add your code here
    }
    /**
     * @var \DateTime
     */
    private $start_date;

    /**
     * @var \DateTime
     */
    private $end_date;


    /**
     * Set start_date
     *
     * @param \DateTime $startDate
     * @return Activity
     */
    public function setStartDate($startDate)
    {
        $this->start_date = $startDate;

        return $this;
    }

    /**
     * Get start_date
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * Set end_date
     *
     * @param \DateTime $endDate
     * @return Activity
     */
    public function setEndDate($endDate)
    {
        $this->end_date = $endDate;

        return $this;
    }

    /**
     * Get end_date
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->end_date;
    }
}
