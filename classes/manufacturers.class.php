<?php 

class Manufacturers
{
    private $db;
    private $logs;
    private $class_name;
    private $class_name_lower;
    private $table_name;

    public function __construct(PDO $db) {
        $this->logs = new Logs((new DB())->connect());
        $this->db = $db;
        $this->class_name = "Manufacturers";
        $this->class_name_lower = "manufacturers_class";
        $this->table_name = "manufacturers";
    }

    public function get_by ($col, $val)
    {
        $q = "SELECT * FROM `{$this->table_name}` WHERE `$col` = :v";
        $s = $this->db->prepare($q);
        $s->bindParam(":v", $val);
        if (!$s->execute()) {
            $failure = $this->class_name.'.get_by - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode(['error' => $s->errorInfo(), 'param' => func_get_args()]));
            return ['status' => false, 'data' => $failure];
        }

        if ($s->rowCount() == 0) {
            return ['status' => false, 'data' => 'Not found'];
        }

        return ['status' => true, 'data' => $s->fetch()];
    }

    public function get_all ()
    {
        $q = "SELECT * FROM `{$this->table_name}`";
        $s = $this->db->prepare($q);
        if (!$s->execute()) {
            $failure = $this->class_name.'.get_all - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode(['error' => $s->errorInfo(), 'param' => func_get_args()]));
            return ['status' => false, 'data' => $failure];
        }

        return ['status' => true, 'data' => $s->fetchAll()];
    }

    public function delete ($manufacturer_id)
    {
        $q = "DELETE FROM `{$this->table_name}` WHERE `manufacturer_id` = :i";
        $s = $this->db->prepare($q);
        $s->bindParam(":i", $manufacturer_id);
        if (!$s->execute()) {
            $failure = $this->class_name.'.delete - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode(['error' => $s->errorInfo(), 'param' => func_get_args()]));
            return ['status' => false, 'data' => $failure];
        }

        return ['status' => true];
    }

    public function delete_transaction ($manufacturer_id, $name, $user_id, Users $Users)
    {
        try {
            $this->db->beginTransaction();

            $this->delete($manufacturer_id);

            $Users->record_log($user_id, 'MANUFACTURER_DELETE', 'At '.normal_date(current_date()).' user deleted a manufacturer [ID-"'.$manufacturer_id.'"] [NAME-"'.$name.'"]');

            $this->db->commit();
            
            return ['status' => true, 'data' => 'Transaction successful'];

        } catch (Exception $e) {
            $this->db->rollBack();
            
            $failure = $this->class_name.'.delete_transaction - E.10: Exception';
            $this->logs->create($failure, json_encode(['error' => $e->getMessage(), 'exception' => $e, 'param' => func_get_args()]));

            return ['status' => false, 'data' => 'Transaction failed'];
        }
    }

    public function insert_transaction ($name, $description, $status, $user_id, Users $Users)
    {
        try {
            $this->db->beginTransaction();

            $dt = current_date();

            $this->insert($name, $description, $status, $dt);

            $manufacturer_id = $this->db->lastInsertId();

            $Users->record_log($user_id, 'MANUFACTURER_CREATE', 'At '.normal_date($dt).' user created a new manufacturer [ID-"'.$manufacturer_id.'"] [NAME-"'.$name.'"]');

            $this->db->commit();

            return ['status' => true, 'data' => 'Transaction successful', 'manufacturer_id' => $manufacturer_id];

        } catch (Exception $e) {
            $this->db->rollBack();
            
            $failure = $this->class_name.'.insert_transaction - E.10: Exception';
            $this->logs->create($failure, json_encode(['error' => $e->getMessage(), 'exception' => $e, 'param' => func_get_args()]));

            return ['status' => false, 'data' => 'Transaction failed'];
        }

    }

    public function insert ($name, $description, $status, $dt = null)
    {
        $q = "INSERT INTO `{$this->table_name}` (`manufacturer_name`, `manufacturer_desc`, `manufacturer_status`, `manufacturer_created`) VALUE (:n, :d, :s, :dt)";
        $s = $this->db->prepare($q);
        $s->bindParam(":n", $name);
        $s->bindParam(":d", $description);
        $s->bindParam(":s", $status);
        if (empty($dt)) {
            $dt = current_date();
        }
        $s->bindParam(":dt", $dt);

        if (!$s->execute()) {
            $failure = $this->class_name.'.insert - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode(['error' => $s->errorInfo(), 'param' => func_get_args()]));
            return ['status' => false, 'data' => $failure];
        }
        
        return ['status' => true];
    }


    public function update_transaction ($changes, $manufacturer_id, $user_id, Users $Users)
    {
        try {
            $this->db->beginTransaction();
            
            $this->update($changes, $manufacturer_id);

            $Users->record_log($user_id, 'MANUFACTURER_UPDATE', 'At '.normal_date(current_date()).' user updated a manufacturer [ID-"'.$manufacturer_id.'"]');

            $this->db->commit();
            
            return ['status' => true, 'data' => 'Transaction successful'];

        } catch (Exception $e) {
            $this->db->rollBack();
            
            $failure = $this->class_name.'.update_transaction - E.10: Exception';
            $this->logs->create($failure, json_encode(['error' => $e->getMessage(), 'exception' => $e, 'param' => func_get_args()]));

            return ['status' => false, 'data' => 'Transaction failed'];
        }
    }

    public function update ($changes, $manufacturer_id)
    {
        if (!empty($changes)) {
            $vals = "";
            foreach ($changes as $c => $v) {
                if (!empty($vals)) {
                    $vals .= ", ";
                }
                $vals .= "`$c`='$v'";
            }
            $q = "UPDATE `{$this->table_name}` SET $vals WHERE `manufacturer_id` = :i";

            $s = $this->db->prepare($q);
            $s->bindParam(":i", $manufacturer_id);
            if (!$s->execute()) {
                $failure = $this->class_name.'.update - E.02: Failure';
                $this->logs->create($this->class_name_lower, $failure, json_encode(['data' => $s->errorInfo(), 'data' => ['changes' => $changes, 'manufacturer_id' => $manufacturer_id]]));
                return ['status' => false, 'type' => 'query', 'data' => $failure];
            }
        }

        return ['status' => true, 'data' => "Updated successfully!"];
    }

}
