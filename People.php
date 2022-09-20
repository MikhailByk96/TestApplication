<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

class People
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private mixed $birthDate;
    private bool $sex;
    private string $birthCity;

    /**
     * @param int $id
     * @param string $firstName
     * @param string $lastName
     * @param mixed $birthDate
     * @param bool $sex
     * @param string $birthCity
     */
    public function __construct(int $id, string $firstName, string $lastName, $birthDate, bool $sex, string $birthCity)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->birthDate = $birthDate;
        $this->sex = $sex;
        $this->birthCity = $birthCity;

    }

    public function save():void
    {
        $mysqli =new mysqli("localhost:3306", "root", "", "testDb");
        $mysqli->query("INSERT INTO `people`(`id`, `firstName`, `lastName`, `birthDate`,`sex`, `birthCity`) 
                                VALUES (`{$this->id}`), (`{$this->firstName}`), (`{$this->lastName}`),(`{$this->birthDate}`),(`{$this->sex}`),(`{$this->birthCity}`)");
    }
    public function deleteById(int $id):void
    {
        $mysqli =new mysqli("localhost:3306", "root", "", "testDb");
        if($id > 0)
        {
            $mysqli->query("DELETE FROM `people` WHERE `id` = `{$id}`");
        }
    }
    public function getAge()
    {
        $diff = date( 'Ymd' ) - date( 'Ymd', strtotime($this->birthDate) );

        return substr( $diff, 0, -4 );
    }
    public  function getSexString():string
    {
        if($this->sex == 0)
        {
            return "муж";
        }
        else
        {
            return "жен";
        }
    }

    public function getPeopleDetails():string
    {

        return "{$this->id} "."$this->firstName "."$this->lastName "."{$this->getSexString()} "."$this->birthDate "."{$this->getAge()}";
    }
    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param mixed $birthDate
     */
    public function setBirthDate($birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return bool
     */
    public function isSex(): bool
    {
        return $this->sex;
    }

    /**
     * @param bool $sex
     */
    public function setSex(bool $sex): void
    {
        $this->sex = $sex;
    }

    /**
     * @return string
     */
    public function getBirthCity(): string
    {
        return $this->birthCity;
    }

    /**
     * @param string $birthCity
     */
    public function setBirthCity(string $birthCity): void
    {
        $this->birthCity = $birthCity;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }


}