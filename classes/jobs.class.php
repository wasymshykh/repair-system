<?php 

class Jobs
{
    private $db;
    private $logs;
    private $class_name;
    private $class_name_lower;
    private $table_name;

    public function __construct(PDO $db) {
        $this->logs = new Logs((new DB())->connect());
        $this->db = $db;
        $this->class_name = "Jobs";
        $this->class_name_lower = "jobs_class";
        $this->table_name = "jobs";
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

}
