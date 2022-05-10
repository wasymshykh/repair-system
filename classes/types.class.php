<?php 

class Types
{
    private $db;
    private $logs;
    private $class_name;
    private $class_name_lower;
    private $table_name;

    public function __construct(PDO $db) {
        $this->logs = new Logs((new DB())->connect());
        $this->db = $db;
        $this->class_name = "Types";
        $this->class_name_lower = "types_class";
        $this->table_name = "item_types";
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

    public function delete ($type_id)
    {
        $q = "DELETE FROM `{$this->table_name}` WHERE `item_type_id` = :ti";
        $s = $this->db->prepare($q);
        $s->bindParam(":ti", $type_id);
        if (!$s->execute()) {
            $failure = $this->class_name.'.delete - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode(['error' => $s->errorInfo(), 'param' => func_get_args()]));
            return ['status' => false, 'data' => $failure];
        }

        return ['status' => true];
    }

    public function delete_transaction ($type_id, $type_name, $user_id, Users $Users)
    {
        try {
            $this->db->beginTransaction();

            $this->delete($type_id);

            $Users->record_log($user_id, 'TYPE_DELETE', 'At '.normal_date(current_date()).' user deleted a type [ID-"'.$type_id.'"] [NAME-"'.$type_name.'"]');

            $this->db->commit();
            
            return ['status' => true, 'data' => 'Transaction successful'];

        } catch (Exception $e) {
            $this->db->rollBack();
            
            $failure = $this->class_name.'.delete_transaction - E.10: Exception';
            $this->logs->create($failure, json_encode(['error' => $e->getMessage(), 'exception' => $e, 'param' => func_get_args()]));

            return ['status' => false, 'data' => 'Transaction failed'];
        }
    }

    public function insert_transaction ($type_name, $type_description, $type_status, $user_id, Users $Users)
    {
        try {
            $this->db->beginTransaction();

            $dt = current_date();

            $this->insert($type_name, $type_description, $type_status, $dt);

            $type_id = $this->db->lastInsertId();

            $Users->record_log($user_id, 'TYPE_CREATE', 'At '.normal_date($dt).' user created a new type [ID-"'.$type_id.'"] [NAME-"'.$type_name.'"]');

            $this->db->commit();

            return ['status' => true, 'data' => 'Transaction successful', 'type_id' => $type_id];

        } catch (Exception $e) {
            $this->db->rollBack();
            
            $failure = $this->class_name.'.insert_transaction - E.10: Exception';
            $this->logs->create($failure, json_encode(['error' => $e->getMessage(), 'exception' => $e, 'param' => func_get_args()]));

            return ['status' => false, 'data' => 'Transaction failed'];
        }

    }

    public function insert ($type_name, $type_description, $type_status, $dt = null)
    {
        $q = "INSERT INTO `{$this->table_name}` (`item_type_name`, `item_type_description`, `item_type_status`, `item_type_created`) VALUE (:tn, :td, :ts, :dt)";
        $s = $this->db->prepare($q);
        $s->bindParam(":tn", $type_name);
        $s->bindParam(":td", $type_description);
        $s->bindParam(":ts", $type_status);
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


    public function update_transaction ($changes, $type_id, $user_id, Users $Users)
    {
        try {
            $this->db->beginTransaction();
            
            $this->update($changes, $type_id);

            $Users->record_log($user_id, 'TYPE_UPDATE', 'At '.normal_date(current_date()).' user updated a type [ID-"'.$type_id.'"]');

            $this->db->commit();
            
            return ['status' => true, 'data' => 'Transaction successful'];

        } catch (Exception $e) {
            $this->db->rollBack();
            
            $failure = $this->class_name.'.update_transaction - E.10: Exception';
            $this->logs->create($failure, json_encode(['error' => $e->getMessage(), 'exception' => $e, 'param' => func_get_args()]));

            return ['status' => false, 'data' => 'Transaction failed'];
        }
    }

    public function update ($changes, $type_id)
    {
        if (!empty($changes)) {
            $vals = "";
            foreach ($changes as $c => $v) {
                if (!empty($vals)) {
                    $vals .= ", ";
                }
                $vals .= "`$c`='$v'";
            }
            $q = "UPDATE `{$this->table_name}` SET $vals WHERE `item_type_id` = :ti";

            $s = $this->db->prepare($q);
            $s->bindParam(":ti", $type_id);
            if (!$s->execute()) {
                $failure = $this->class_name.'.update - E.02: Failure';
                $this->logs->create($this->class_name_lower, $failure, json_encode(['data' => $s->errorInfo(), 'data' => ['changes' => $changes, 'type_id' => $type_id]]));
                return ['status' => false, 'type' => 'query', 'data' => $failure];
            }
            
        }

        return ['status' => true, 'data' => "Updated successfully!"];
    }

}
