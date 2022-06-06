<?php 

class Jobs
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
        $this->class_name = "Jobs";
        $this->class_name_lower = "jobs_class";
        $this->table_name = "jobs";
        $this->table_logs = "job_logs";
    }

    public function delete ($job_id)
    {
        $q = "DELETE FROM `{$this->table_name}` WHERE `job_id` = :i";
        $s = $this->db->prepare($q);
        $s->bindParam(":i", $job_id);
        if (!$s->execute()) {
            $failure = $this->class_name.'.delete - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode(['error' => $s->errorInfo(), 'param' => func_get_args()]));
            return ['status' => false, 'data' => $failure];
        }

        return ['status' => true];
    }

    public function delete_transaction ($job_id, $name, $user_id, Users $Users)
    {
        try {
            $this->db->beginTransaction();

            $this->delete($job_id);

            $Users->record_log($user_id, 'JOB_DELETE', 'At '.normal_date(current_date()).' user deleted a job [ID-"'.$job_id.'"] [NAME-"'.$name.'"]');

            $this->db->commit();
            
            return ['status' => true, 'data' => 'Transaction successful'];

        } catch (Exception $e) {
            $this->db->rollBack();
            
            $failure = $this->class_name.'.delete_transaction - E.10: Exception';
            $this->logs->create($failure, json_encode(['error' => $e->getMessage(), 'exception' => $e, 'param' => func_get_args()]));

            return ['status' => false, 'data' => 'Transaction failed'];
        }
    }

    public function insert_transaction ($manu_id, $type_id, $customer_name, $customer_email, $customer_phone, $item_name, $description, $price, $receiving_date, $status, $assigned_roles, $user_id, Users $Users)
    {
        try {
            $this->db->beginTransaction();

            $dt = current_date();

            $this->insert($manu_id, $type_id, $customer_name, $customer_email, $customer_phone, $item_name, $description, $price, $receiving_date, $status, $dt);
            $job_id = $this->db->lastInsertId();
            $this->job_role_insert($assigned_roles, $job_id);

            $Users->record_log($user_id, 'JOB_CREATE', 'At '.normal_date($dt).' user created a new job [ID-"'.$job_id.'"] [NAME-"'.$item_name.'"]');

            $this->db->commit();

            return ['status' => true, 'data' => 'Transaction successful', 'job_id' => $job_id];

        } catch (Exception $e) {
            $this->db->rollBack();
            
            $failure = $this->class_name.'.insert_transaction - E.10: Exception';
            $this->logs->create($failure, json_encode(['error' => $e->getMessage(), 'exception' => $e, 'param' => func_get_args()]));
            return ['status' => false, 'data' => 'Transaction failed'];
        }

    }

    public function insert ($manu_id, $type_id, $customer_name, $customer_email, $customer_phone, $item_name, $description, $price, $receiving_date, $status, $dt = null)
    {
        $q = "INSERT INTO `{$this->table_name}` (`job_manufacturer_id`, `job_item_type_id`, `job_customer_name`, `job_customer_email`, `job_customer_phone`, `job_item_name`, `job_description`, `job_price`, `job_receiving_date`, `job_status`, `job_created`) VALUE (:mi, :ti, :cn, :ce, :cp, :jin, :jd, :jp, :jrd, :s, :dt)";
        $s = $this->db->prepare($q);
        $s->bindParam(":mi", $manu_id);
        $s->bindParam(":ti", $type_id);
        $s->bindParam(":cn", $customer_name);
        $s->bindParam(":ce", $customer_email);
        $s->bindParam(":cp", $customer_phone);
        $s->bindParam(":jin", $item_name);
        $s->bindParam(":jd", $description);
        $s->bindParam(":jp", $price);
        $s->bindParam(":jrd", $receiving_date);
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

    public function job_role_insert ($assigned_roles, $job_id)
    {
        $data = [];
        $vals = "";
        foreach ($assigned_roles as $i => $role_id) {
            if (!empty($vals)) { $vals .= ", "; }
            $vals .= "(:j$i, :r$i)";
            $data[":j$i"] = $job_id;
            $data[":r$i"] = $role_id;
        }

        $q = "INSERT INTO `job_roles` (`job_roles_job_id`, `job_roles_role_id`) VALUES $vals";
        $s = $this->db->prepare($q);
        if (!$s->execute($data)) {
            $failure = $this->class_name.'.job_role_insert - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode(['error' => $s->errorInfo(), 'param' => func_get_args()]));
            return ['status' => false, 'data' => $failure];
        }
        return ['status' => true];
    }

    public function get_detailed_by ($col, $val)
    {
        $q = "SELECT * FROM `{$this->table_name}` JOIN `manufacturers` ON `manufacturer_id` = `job_manufacturer_id` JOIN `item_types` ON `job_item_type_id` = `item_type_id` WHERE `$col` = :v";
        $s = $this->db->prepare($q);
        $s->bindParam(":v", $val);
        if (!$s->execute()) {
            $failure = $this->class_name.'.get_detailed_by - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode(['error' => $s->errorInfo(), 'param' => func_get_args()]));
            return ['status' => false, 'data' => $failure];
        }

        if ($s->rowCount() == 0) { return ['status' => false, 'data' => 'Not found']; }

        return ['status' => true, 'data' => $s->fetch()];
    }

    public function get_job_logs_by ($col, $val, $desc = false)
    {
        $q = "SELECT * FROM `{$this->table_logs}` JOIN `users` ON `jlog_user_id` = `user_id` WHERE `$col` = :v";
        if ($desc) {
            $q .= " ORDER BY `jlog_created` DESC";
        }
        $s = $this->db->prepare($q);
        $s->bindParam(":v", $val);
        if (!$s->execute()) {
            $failure = $this->class_name.'.get_job_logs_by - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode(['error' => $s->errorInfo(), 'param' => func_get_args()]));
            return ['status' => false, 'data' => $failure];
        }

        if ($s->rowCount() == 0) { return ['status' => false, 'data' => 'Not found']; }

        return ['status' => true, 'data' => $s->fetchAll()];
    }

    public function get_all_detailed_by ($desc = false)
    {
        $q = "SELECT * FROM `{$this->table_name}` JOIN `manufacturers` ON `manufacturer_id` = `job_manufacturer_id` JOIN `item_types` ON `job_item_type_id` = `item_type_id`";
        if ($desc) {
            $q .= " ORDER BY `job_created` DESC";
        }
        $s = $this->db->prepare($q);
        if (!$s->execute()) {
            $failure = $this->class_name.'.get_all_detailed_by - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode(['error' => $s->errorInfo(), 'param' => func_get_args()]));
            return ['status' => false, 'data' => $failure];
        }

        if ($s->rowCount() == 0) { return ['status' => false, 'data' => 'Not found']; }

        return ['status' => true, 'data' => $s->fetchAll()];
    }

    public function get_all_detailed_by_role_id ($role_id, $desc = false)
    {
        $q = "SELECT * FROM `{$this->table_name}` JOIN `job_roles` ON `job_id` = `job_roles_job_id` JOIN `manufacturers` ON `manufacturer_id` = `job_manufacturer_id` JOIN `item_types` ON `job_item_type_id` = `item_type_id` WHERE `job_roles_role_id` = :r";
        if ($desc) {
            $q .= " ORDER BY `job_created` DESC";
        }
        $s = $this->db->prepare($q);
        $s->bindParam(":r", $role_id);
        if (!$s->execute()) {
            $failure = $this->class_name.'.get_all_detailed_by_role_id - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode(['error' => $s->errorInfo(), 'param' => func_get_args()]));
            return ['status' => false, 'data' => $failure];
        }

        if ($s->rowCount() == 0) { return ['status' => false, 'data' => 'Not found']; }

        return ['status' => true, 'data' => $s->fetchAll()];
    }

    public function mark_job_transaction ($changes, $current, $job_id, $user_id, Users $Users, $type = "Repair")
    {
        try {
            $this->db->beginTransaction();

            $dt = current_date();

            $changes ['job_updated'] = $dt;

            $this->update($changes, $job_id);

            $text = "";
            if (array_key_exists('job_repair_date', $changes)) {
                $text .= "$type date is updated to '".normal_date($changes['job_repair_date'], 'M d, Y')."'. ";
            }
            if (array_key_exists('job_status', $changes)) {
                $text .= "Job status is changed from ['".$current['job_status']."'] to ['".$changes['job_status']."']. ";
            }
            if (array_key_exists('job_repair_cost', $changes)) {
                $text .= "$type cost is updated from '".$current['job_repair_cost']." CHK' to '".$changes['job_repair_cost']." CHR'. ";
            }
            if (array_key_exists('job_repair_description', $changes)) {
                $text .= "$type description is updated to '".$changes['job_repair_description']."'. ";
            }

            $this->record_log($job_id, $user_id, 'REPAIRED', $text);

            $Users->record_log($user_id, 'JOB_REPAIRED', 'At '.normal_date($dt).' user changed status of job [ID-"'.$job_id.'"] to repaired');

            $this->db->commit();

            return ['status' => true, 'data' => 'Transaction successful', 'job_id' => $job_id];

        } catch (Exception $e) {
            $this->db->rollBack();
            
            $failure = $this->class_name.'.mark_job_transaction - E.10: Exception';
            $this->logs->create($failure, json_encode(['error' => $e->getMessage(), 'exception' => $e, 'param' => func_get_args()]));
            return ['status' => false, 'data' => 'Transaction failed'];
        }

    }

    public function update_transaction ($changes, $assigned_roles, $job_id, $user_id, Users $Users)
    {
        try {
            $this->db->beginTransaction();

            $dt = current_date();
            $changes ['job_updated'] = $dt;
            $this->update($changes, $job_id);

            if (!empty($assigned_roles)) {
                $this->delete_assigned_roles ($job_id);
                $this->job_role_insert($assigned_roles, $job_id);
            }

            $Users->record_log($user_id, 'JOB_UPDATED', 'At '.normal_date($dt).' user changed job details [ID-"'.$job_id.'"].');
            
            $this->db->commit();

            return ['status' => true, 'data' => 'Transaction successful'];

        } catch (Exception $e) {
            $this->db->rollBack();
            $failure = $this->class_name.'.update_transaction - E.10: Exception';
            $this->logs->create($failure, json_encode(['error' => $e->getMessage(), 'exception' => $e, 'param' => func_get_args()]));
            return ['status' => false, 'data' => 'Transaction failed'];
        }
    }

    public function delete_assigned_roles ($job_id)
    {
        
        $q = "DELETE FROM `job_roles` WHERE `job_roles_job_id` = :ji";
        $s = $this->db->prepare($q);
        if (!$s->execute([':ji' => $job_id])) {
            $failure = $this->class_name.'.delete_assigned_roles - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode(['error' => $s->errorInfo(), 'param' => func_get_args()]));
            return ['status' => false, 'data' => $failure];
        }
        return ['status' => true];
    }

    public function update ($changes, $job_id)
    {
        if (!empty($changes)) {
            $vals = "";
            foreach ($changes as $c => $v) {
                if (!empty($vals)) {
                    $vals .= ", ";
                }
                $vals .= "`$c`='$v'";
            }
            $q = "UPDATE `{$this->table_name}` SET $vals WHERE `job_id` = :ji";

            $s = $this->db->prepare($q);
            $s->bindParam(":ji", $job_id);
            if (!$s->execute()) {
                $failure = $this->class_name.'.update - E.02: Failure';
                $this->logs->create($this->class_name_lower, $failure, json_encode(['data' => $s->errorInfo(), 'data' => ['changes' => $changes, 'job_id' => $job_id]]));
                return ['status' => false, 'type' => 'query', 'data' => $failure];
            }
            
        }

        return ['status' => true, 'data' => "Updated successfully!"];
    }

    public function get_job_roles_by_job_id ($job_id)
    {
        $q = "SELECT * FROM `job_roles` WHERE `job_roles_job_id` = :ji";
        $s = $this->db->prepare($q);
        $s->bindParam(":ji", $job_id);
        if (!$s->execute()) {
            $failure = $this->class_name.'.get_job_roles_by_job_id - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode(['error' => $s->errorInfo(), 'param' => func_get_args()]));
            return ['status' => false, 'data' => $failure];
        }
        
        return ['status' => true, 'data' => $s->fetchAll()];
    }

    
    public function record_log ($job_id, $user_id, $action, $text)
    {
        $q = "INSERT INTO `{$this->table_logs}` (`jlog_job_id`, `jlog_user_id`, `jlog_action`, `jlog_text`, `jlog_created`) VALUES (:ji, :ui, :ja, :tx, :dt)";
        $s = $this->db->prepare($q);
        $s->bindParam(":ji", $job_id);
        $s->bindParam(":ui", $user_id);
        $s->bindParam(":ja", $action);
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

}
