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
        $q = "SELECT * FROM `{$this->table_name}` JOIN `roles` ON `user_role_id` = `role_id` WHERE `$col` = :v";
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

    public function get_all ($with_role = false)
    {
        $q = "SELECT * FROM `{$this->table_name}`";

        if ($with_role) {
            $q .= " LEFT JOIN `roles` ON `user_role_id` = `role_id`";
        }

        $s = $this->db->prepare($q);
        if (!$s->execute()) {
            $failure = $this->class_name.'.get_all - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode(['error' => $s->errorInfo(), 'param' => func_get_args()]));
            return ['status' => false, 'data' => $failure];
        }

        return ['status' => true, 'data' => $s->fetchAll()];
    }
    
    public function delete_transaction ($user_id, $user_email, $logged_user_id, Users $Users)
    {
        try {
            $this->db->beginTransaction();

            $this->delete($user_id);

            $Users->record_log($logged_user_id, 'USER_DELETE', 'At '.normal_date(current_date()).' user deleted a user [ID-"'.$user_id.'"] [EMAIL-"'.$user_email.'"]');

            $this->db->commit();
            
            return ['status' => true, 'data' => 'Transaction successful'];

        } catch (Exception $e) {
            $this->db->rollBack();
            
            $failure = $this->class_name.'.delete_transaction - E.10: Exception';
            $this->logs->create($failure, json_encode(['error' => $e->getMessage(), 'exception' => $e, 'param' => func_get_args()]));

            return ['status' => false, 'data' => 'Transaction failed'];
        }
    }
    
    public function delete ($user_id)
    {
        $q = "DELETE FROM `{$this->table_name}` WHERE `user_id` = :ui";
        $s = $this->db->prepare($q);
        $s->bindParam(":ui", $user_id);
        if (!$s->execute()) {
            $failure = $this->class_name.'.delete - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode(['error' => $s->errorInfo(), 'param' => func_get_args()]));
            return ['status' => false, 'data' => $failure];
        }

        return ['status' => true];
    }

    public function insert_transaction ($name, $email, $password, $role, $phone, $status, $user_id, Users $Users)
    {
        try {
            $this->db->beginTransaction();

            $dt = current_date();

            $this->insert($name, $email, $password, $role, $phone, $status, $dt);

            $new_user_id = $this->db->lastInsertId();

            $Users->record_log($user_id, 'USER_CREATE', 'At '.normal_date($dt).' user created a new user [ID-"'.$new_user_id.'"] [EMAIL-"'.$email.'"]');

            $this->db->commit();

            return ['status' => true, 'data' => 'Transaction successful', 'user_id' => $new_user_id];

        } catch (Exception $e) {
            $this->db->rollBack();
            
            $failure = $this->class_name.'.insert_transaction - E.10: Exception';
            $this->logs->create($failure, json_encode(['error' => $e->getMessage(), 'exception' => $e, 'param' => func_get_args()]));

            return ['status' => false, 'data' => 'Transaction failed'];
        }
    }

    public function insert ($name, $email, $password, $role, $phone, $status, $dt = null)
    {
        $q = "INSERT INTO `{$this->table_name}` (`user_name`, `user_email`, `user_password`, `user_role_id`, `user_status`, `user_created`) VALUE (:n, :e, :p, :ri, :us, :dt)";
        $s = $this->db->prepare($q);
        $s->bindParam(":n", $name);
        $s->bindParam(":e", $email);
        $s->bindParam(":p", $phone);
        $s->bindParam(":ri", $role);
        $s->bindParam(":us", $status);
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

    public function get_permission ($string)
    {
        $permission = [
            'types' => [
                'read' => false,
                'write' => false,
                'create' => false,
                'delete' => false
            ],
            'manufacturers' => [
                'read' => false,
                'write' => false,
                'create' => false,
                'delete' => false
            ],
            'jobs' => [
                'read' => false,
                'write' => false,
                'create' => false,
                'delete' => false,
                'logs' => false
            ],
            'settings' => [
                'read' => false,
                'write' => false
            ],
            'users' => [
                'read' => false,
                'write' => false,
                'create' => false
            ],
            'roles' => [
                'read' => false,
                'write' => false,
                'create' => false
            ]
        ];

        if ($string == '*' || json_decode($string) === false) {
            foreach ($permission as $key => $types) {
                foreach ($types as $_key => $val) {
                    $permission[$key][$_key] = true;
                }
            }
            return $permission;
        } 

        $string = json_decode($string, true);

        foreach ($string as $key => $vals) {
            foreach ($vals as $_key => $_vals) {
                $permission[$key][$_key] = $_vals == '1' ? true : false;
            }
        }

        return $permission;
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

    public function logout ()
    {
        if (isset($_SESSION['logged'])) {
            unset($_SESSION['logged']);
        }
    }

    public function get_user_logs ($user_id, $limit = false)
    {
        $q = "SELECT * FROM `{$this->table_logs}` WHERE `ulog_user_id` = :u ORDER BY `ulog_id` DESC";

        if ($limit !== false) {
            $q .= " LIMIT $limit";
        }

        $s = $this->db->prepare($q);
        $s->bindParam(":u", $user_id);
        if (!$s->execute()) {
            $failure = $this->class_name.'.get_user_logs - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode(['error' => $s->errorInfo(), 'param' => func_get_args()]));
            return ['status' => false, 'data' => $failure];
        }
        
        return ['status' => true, 'data' => $s->fetchAll()];
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
