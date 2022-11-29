<?php
class databaseTable{
    public $table;

    //constructor with $table as argument
    function __construct($table){
        //store argument in a class variable
        $this->table = $table;
    }

    //displays records from a table which meet the where condition
    function find($field, $value){
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM ' . $this->table . 
            ' WHERE ' . $field . ' = :value');
        $criteria = [
            'value' => $value
        ];
        $stmt->execute($criteria);
        return $stmt;
    }
    //displays all records from a table
    function findAll() {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM ' . $this->table );
        $stmt->execute();
        return $stmt;
    }
     //displays all records from a table in order of an attribute and limits number of rows
    function findLimitAndOrderBy($field, $value, $field2, $value2, $attribute, $order, 
    $limit) {
        global $pdo;   
        $stmt = $pdo->prepare('SELECT * FROM ' . $this->table . 
            ' WHERE ' . $field . ' = :value AND '. $field2 .' = :value2 
            ORDER BY ' . $attribute .' ' . $order
            .' LIMIT ' .$limit);
        $criteria = [
            'value' => $value,
            'value2' => $value2
        ];
        $stmt->execute($criteria);
        return $stmt;
    }
   
    function findAndOrderBy($field, $value, $attribute, $order) {
        global $pdo;   
        $stmt = $pdo->prepare('SELECT * FROM ' . $this->table . 
            ' WHERE ' . $field . ' = :value ORDER BY ' . $attribute .' ' . $order);
    
        $criteria = [
            'value' => $value
        ];
        $stmt->execute($criteria);
        return $stmt;
    }

    //function to find records with AND in the where condition
    function findWhere($field, $value, $field2, $value2) {
        global $pdo;   
        $stmt = $pdo->prepare('SELECT * FROM ' . $this->table . 
            ' WHERE ' . $field . ' = :value AND ' .$field2 . ' = :value2');
    
        $criteria = [
            'value' => $value,
            'value2' => $value2,

        ];
        $stmt->execute($criteria);
        return $stmt;
    }

    //to insert a record to a table
    function insert($record) {
        global $pdo;
        $keys = array_keys($record);
        //every element has a , in front of them
        $values = implode(', ', $keys);
        //every element has a ,: in front of them
        $valuesWithC = implode(', :', $keys);
    
        $query = 'INSERT INTO ' . $this -> table . ' (' . $values . ') 
                  VALUES (:' . $valuesWithC . ')';
        $stmt = $pdo->prepare($query);
        $stmt->execute($record);
    }

    //to delete a record from a table, using primary keys
    function delete($field, $value) {
        global $pdo;
        $stmt = $pdo->prepare('DELETE FROM ' . $this->table . 
                ' WHERE ' . $field . ' = :pk');
        $criteria = [
        'pk' => $value
        ];
        $stmt->execute($criteria);
        return $stmt;
    }
    //test query statement once again
    //to update an existing record from a table, using primary keys
    function update($record, $primaryKey) {
        global $pdo;
        $query = 'UPDATE ' . $this->table . ' SET ';
        $parameters = [];
        //store fields to be updated in parameters (field=:field,...)
        foreach ($record as $key => $value) {
                $parameters[] = $key . ' = :' .$key;
        }
        $query .= implode(', ', $parameters);
        
        $query .= ' WHERE ' . $primaryKey . ' = :primaryKey';
        //get pk from record array
        $record['primaryKey'] = $record[$primaryKey];
        $stmt = $pdo->prepare($query);
        $stmt->execute($record);    
    } 

    //updates a record if pk exists, if not adds a new record
    function save($record, $primaryKey = ''){
        try{
            $this->insert($record);
        }
        catch(Exception $e){
            $this->update($record,$primaryKey);
        }
    }
}


