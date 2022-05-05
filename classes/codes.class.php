<?php 

class Codes
{
    private $db;
    private $logs;
    private $class_name;
    private $class_name_lower;
    private $table_name;

    public function __construct(PDO $db) {
        $this->logs = new Logs((new DB())->connect());
        $this->db = $db;
        $this->class_name = "Codes";
        $this->class_name_lower = "codes_class";
        $this->table_name = "codes";
    }

    public function get_by ($col, $val)
    {
        $q = "SELECT * FROM `{$this->table_name}` JOIN `users` ON `code_user_id` = `user_id` WHERE `$col` = :v";
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

    public function insert_code ($code_uuid, $user_id, $code_type)
    {
        $q = "INSERT INTO `{$this->table_name}` (`code_uuid`, `code_user_id`, `code_type`, `code_created`) VALUE (:i, :ui, :ct, :dt)";
        $s = $this->db->prepare($q);
        $s->bindParam(":i", $code_uuid);
        $s->bindParam(":ui", $user_id);
        $s->bindParam(":ct", $code_type);
        $dt = current_date();
        $s->bindParam(":dt", $dt);

        if (!$s->execute()) {
            $failure = $this->class_name.'.insert_code - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode(['error' => $s->errorInfo(), 'param' => func_get_args()]));
            return ['status' => false, 'data' => $failure];
        }
        
        return ['status' => true];
    }

    public function update_code ($changes, $code_uuid)
    {
        if (!empty($changes)) {

            $vals = "";
            foreach ($changes as $c => $v) {
                if (!empty($vals)) {
                    $vals .= ", ";
                }
                $vals .= "`$c`='$v'";
            }
            $q = "UPDATE `{$this->table_name}` SET $vals WHERE `code_uuid` = :c";

            $s = $this->db->prepare($q);
            $s->bindParam(":c", $code_uuid);
            if (!$s->execute()) {
                $failure = $this->class_name.'.update_code - E.02: Failure';
                $this->logs->create($this->class_name_lower, $failure, json_encode(['data' => $s->errorInfo(), 'data' => ['changes' => $changes, 'code_uuid' => $code_uuid]]));
                return ['status' => false, 'type' => 'query', 'data' => $failure];
            }
            
        }

        return ['status' => true, 'data' => "Updated successfully!"];
    }

}
