<?php 

class Users
{
    private $db;
    private $logs;
    private $class_name;
    private $class_name_lower;
    private $table_name;
    private $table_logs;

    public function __construct(PDO $db) {
        $this->logs = new Logs((new DB())->connect());
        $this->db = $db;
        $this->class_name = "Users";
        $this->class_name_lower = "users_class";
        $this->table_name = "users";
        $this->table_logs = "user_logs";
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

    public function record_log ($user_id, $type, $text)
    {
        $q = "INSERT INTO `{$this->table_logs}` (`ulog_user_id`, `ulog_type`, `ulog_text`, `ulog_created`) VALUES (:u, :ty, :tx, :dt)";
        $s = $this->db->prepare($q);
        $s->bindParam(":u", $user_id);
        $s->bindParam(":ty", $type);
        $s->bindParam(":tx", $text);
        $dt = current_date();
        $s->bindParam(":dt", $dt);
        if (!$s->execute()) {
            $failure = $this->class_name.'.record_log - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode(['error' => $s->errorInfo(), 'param' => func_get_args()]));
            return ['status' => false, 'data' => $failure];
        }
        
        return ['status' => true];
    }

    
    public function update ($changes, $user_id)
    {
        if (!empty($changes)) {

            $vals = "";
            foreach ($changes as $c => $v) {
                if (!empty($vals)) {
                    $vals .= ", ";
                }
                $vals .= "`$c`='$v'";
            }
            $q = "UPDATE `{$this->table_name}` SET $vals WHERE `user_id` = :u";

            $s = $this->db->prepare($q);
            $s->bindParam(":u", $user_id);
            if (!$s->execute()) {
                $failure = $this->class_name.'.update - E.02: Failure';
                $this->logs->create($this->class_name_lower, $failure, json_encode(['data' => $s->errorInfo(), 'data' => ['changes' => $changes, 'user_id' => $user_id]]));
                return ['status' => false, 'type' => 'query', 'data' => $failure];
            }
            
        }

        return ['status' => true, 'data' => "Updated successfully!"];
    }

}
