<?php

class Customer extends DatabaseManager
{
    function selectAll()
    {
        $query = "SELECT * FROM customer";
        $query_result = $this->mysql->query($query);
        $result = array();

        while ($row = $query_result->fetch_assoc()) {
            $result[$row['id']] = $row;
        }
        
        return $result;
    }

    function selectById($id)
    {

var_dump($id);
exit();
        if (!isset($id)) {
            return array();
        }
        
        $id = $this->mysql->real_escape_string($id);
        $query = "SELECT * FROM customer where id = " . $id;

var_dump($query);
exit();

        $query_result = $this->mysql->query($query);
        $result = array();

        while ($row = $query_result->fetch_assoc()) {
            $result[$row['id']] = $row;
        }
        
        return $result;
    }

    function updatePlayCount($id)
    {
        if (!isset($id)) {
            return false;
        }
        
        $id = $this->mysql->real_escape_string($id);
        $query = "UPDATE customer SET play_count = play_count + 1 WHERE id = " . $id;
        $query_result = $this->mysql->query($query);

        return $query_result;
    }
}
