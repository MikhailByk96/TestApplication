<?php
include 'People.php';
class PeopleList
{
    private array $ids;

    /**
     * @param array $ids
     */
    public function __construct()
    {
        $mysqli =new mysqli("localhost:3306", "root", "", "testDb");
       $this->ids = $mysqli->query("SELECT `id` FROM `people`");

    }
    public function getPeoples(array $ids): People
    {
        $peoples = new People[];
        $mysqli =new mysqli("localhost:3306", "root", "", "testDb");
        if ($mysqli -> num_rows > 0) {
            for ($i = 0; $i < count($ids); $i++) {
                $temp = new People();
                $mysqli->query("SELECT * FROM `people` WHERE `id` = `$ids[$i]`");
                while ($row = $mysqli ->fetch_assoc() )
                {
                    $temp->setId(`{$row["id"]}`);
                    $temp->setFirstName(`{$row["firstName"]}`);
                    $temp->setLastName(`{$row["lastName"]}`);
                    $temp->setBirthDate(`{$row["birthDate"]}`);
                    $temp->setSex(`{$row["sex"]}`);
                    $temp->setBirthCity(`{$row["birthCity"]}`);
                }
                $peoples[$i] = $temp;
            }
        }
        return $peoples;
    }

    public function deleteByPeoplesArray(array $arr):void
    {
        $mysqli =new mysqli("localhost:3306", "root", "", "testDb");
        for ($i = 0; $i < count($arr); $i++)
        {
                $mysqli->query("DELETE FROM people WHERE `id` = `{$arr[$i]}`");
        }
    }

}