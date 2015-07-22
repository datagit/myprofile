<?php

namespace DataSourceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Profile
 */
class Profile
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $first_name;

    /**
     * @var string
     */
    private $last_name;

    /**
     * @var string
     */
    private $birthday;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $photo;

    /**
     * @var string
     */
    private $job_title;

    /**
     * @var string
     */
    private $social_network;

    /**
     * @var integer
     */
    private $sex;

    /**
     * @var integer
     */
    private $salary_min;

    /**
     * @var integer
     */
    private $salary_max;

    /**
     * @var integer
     */
    private $major_category_id;

    /**
     * @var string
     */
    private $categories_json;

    /**
     * @var string
     */
    private $education_json;

    /**
     * @var string
     */
    private $skill_json;

    /**
     * @var string
     */
    private $job_history_json;

    /**
     * @var \DateTime
     */
    private $last_view;

    /**
     * @var \DateTime
     */
    private $last_login;

    /**
     * @var integer
     */
    private $profile_type;

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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $activities;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $comments;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->activities = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set email
     *
     * @param string $email
     * @return Profile
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Profile
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set first_name
     *
     * @param string $firstName
     * @return Profile
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;

        return $this;
    }

    /**
     * Get first_name
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set last_name
     *
     * @param string $lastName
     * @return Profile
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;

        return $this;
    }

    /**
     * Get last_name
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set birthday
     *
     * @param string $birthday
     * @return Profile
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return string 
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Profile
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set photo
     *
     * @param string $photo
     * @return Profile
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set job_title
     *
     * @param string $jobTitle
     * @return Profile
     */
    public function setJobTitle($jobTitle)
    {
        $this->job_title = $jobTitle;

        return $this;
    }

    /**
     * Get job_title
     *
     * @return string 
     */
    public function getJobTitle()
    {
        return $this->job_title;
    }

    /**
     * Set social_network
     *
     * @param string $socialNetwork
     * @return Profile
     */
    public function setSocialNetwork($socialNetwork)
    {
        $this->social_network = $socialNetwork;

        return $this;
    }

    /**
     * Get social_network
     *
     * @return string 
     */
    public function getSocialNetwork()
    {
        return $this->social_network;
    }

    /**
     * Set sex
     *
     * @param integer $sex
     * @return Profile
     */
    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get sex
     *
     * @return integer 
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set salary_min
     *
     * @param integer $salaryMin
     * @return Profile
     */
    public function setSalaryMin($salaryMin)
    {
        $this->salary_min = $salaryMin;

        return $this;
    }

    /**
     * Get salary_min
     *
     * @return integer 
     */
    public function getSalaryMin()
    {
        return $this->salary_min;
    }

    /**
     * Set salary_max
     *
     * @param integer $salaryMax
     * @return Profile
     */
    public function setSalaryMax($salaryMax)
    {
        $this->salary_max = $salaryMax;

        return $this;
    }

    /**
     * Get salary_max
     *
     * @return integer 
     */
    public function getSalaryMax()
    {
        return $this->salary_max;
    }

    /**
     * Set major_category_id
     *
     * @param integer $majorCategoryId
     * @return Profile
     */
    public function setMajorCategoryId($majorCategoryId)
    {
        $this->major_category_id = $majorCategoryId;

        return $this;
    }

    /**
     * Get major_category_id
     *
     * @return integer 
     */
    public function getMajorCategoryId()
    {
        return $this->major_category_id;
    }

    /**
     * Set categories_json
     *
     * @param string $categoriesJson
     * @return Profile
     */
    public function setCategoriesJson($categoriesJson)
    {
        $this->categories_json = $categoriesJson;

        return $this;
    }

    /**
     * Get categories_json
     *
     * @return string 
     */
    public function getCategoriesJson()
    {
        return $this->categories_json;
    }

    /**
     * Set education_json
     *
     * @param string $educationJson
     * @return Profile
     */
    public function setEducationJson($educationJson)
    {
        $this->education_json = $educationJson;

        return $this;
    }

    /**
     * Get education_json
     *
     * @return string 
     */
    public function getEducationJson()
    {
        return $this->education_json;
    }

    /**
     * Set skill_json
     *
     * @param string $skillJson
     * @return Profile
     */
    public function setSkillJson($skillJson)
    {
        $this->skill_json = $skillJson;

        return $this;
    }

    /**
     * Get skill_json
     *
     * @return string 
     */
    public function getSkillJson()
    {
        return $this->skill_json;
    }

    /**
     * Set job_history_json
     *
     * @param string $jobHistoryJson
     * @return Profile
     */
    public function setJobHistoryJson($jobHistoryJson)
    {
        $this->job_history_json = $jobHistoryJson;

        return $this;
    }

    /**
     * Get job_history_json
     *
     * @return string 
     */
    public function getJobHistoryJson()
    {
        return $this->job_history_json;
    }

    /**
     * Set last_view
     *
     * @param \DateTime $lastView
     * @return Profile
     */
    public function setLastView($lastView)
    {
        $this->last_view = $lastView;

        return $this;
    }

    /**
     * Get last_view
     *
     * @return \DateTime 
     */
    public function getLastView()
    {
        return $this->last_view;
    }

    /**
     * Set last_login
     *
     * @param \DateTime $lastLogin
     * @return Profile
     */
    public function setLastLogin($lastLogin)
    {
        $this->last_login = $lastLogin;

        return $this;
    }

    /**
     * Get last_login
     *
     * @return \DateTime 
     */
    public function getLastLogin()
    {
        return $this->last_login;
    }

    /**
     * Set profile_type
     *
     * @param integer $profileType
     * @return Profile
     */
    public function setProfileType($profileType)
    {
        $this->profile_type = $profileType;

        return $this;
    }

    /**
     * Get profile_type
     *
     * @return integer 
     */
    public function getProfileType()
    {
        return $this->profile_type;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Profile
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
     * @return Profile
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
     * @return Profile
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
     * @return Profile
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
     * Add activities
     *
     * @param \DataSourceBundle\Entity\Activity $activities
     * @return Profile
     */
    public function addActivity(\DataSourceBundle\Entity\Activity $activities)
    {
        $this->activities[] = $activities;

        return $this;
    }

    /**
     * Remove activities
     *
     * @param \DataSourceBundle\Entity\Activity $activities
     */
    public function removeActivity(\DataSourceBundle\Entity\Activity $activities)
    {
        $this->activities->removeElement($activities);
    }

    /**
     * Get activities
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getActivities()
    {
        return $this->activities;
    }

    /**
     * Add comments
     *
     * @param \DataSourceBundle\Entity\Comment $comments
     * @return Profile
     */
    public function addComment(\DataSourceBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \DataSourceBundle\Entity\Comment $comments
     */
    public function removeComment(\DataSourceBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
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
     * @var string
     */
    private $summary;

    /**
     * @var string
     */
    private $research_interests;


    /**
     * Set summary
     *
     * @param string $summary
     * @return Profile
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get summary
     *
     * @return string 
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Set research_interests
     *
     * @param string $researchInterests
     * @return Profile
     */
    public function setResearchInterests($researchInterests)
    {
        $this->research_interests = $researchInterests;

        return $this;
    }

    /**
     * Get research_interests
     *
     * @return string 
     */
    public function getResearchInterests()
    {
        return $this->research_interests;
    }
}
