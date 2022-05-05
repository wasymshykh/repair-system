<?php

class Settings
{
    
    private $db;
    private $settings;
    private $logs;
    private $class_name;
    private $class_name_lower;
    private $table_name;

    public function __construct(PDO $db) {
        $this->logs = new Logs((new DB())->connect());
        $this->db = $db;

        $this->class_name = "Settings";
        $this->class_name_lower = "settings_class";
        $this->table_name = "settings";

        $this->settings = $this->get_settings()['data'];
    }
    
    private function get_settings ()
    {
        $q = "SELECT * FROM `{$this->table_name}`";
        $s = $this->db->prepare($q);
        if (!$s->execute()) {
            $failure = $this->class_name.'.get_settings - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode($s->errorInfo()));
            return ['status' => false, 'message' => $failure];
        }
        $d = $s->fetchAll();
        $arr = [];
        foreach ($d as $a) {
            $arr[$a['setting_name']] = $a['setting_value'];
        }
        return ['status' => true, 'data' => $arr];
    }

    public function get_all ()
    {
        return $this->settings;
    }
    
    public function get_one ($setting_name)
    {
        $q = "SELECT * FROM `{$this->table_name}` WHERE `setting_name`=:setting_name";
        $s = $this->db->prepare($q);
        $s->bindParam(':setting_name', $setting_name);

        if (!$s->execute()) {
            $failure = $this->class_name.'.get_one - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode($s->errorInfo()));
            return ['status'=>false, 'message'=>$failure];
        }
        $d = $s->fetch();
        if(count($d) > 0) {
            return ['status' => true, 'data' => $d['setting_value']];
        }
        
        return ['status' => true, 'data' => ''];
    }

    public function fetch (string $key)
    {
        if (!array_key_exists($key, $this->settings)) {
            $this->logs->create('settings_fetch', $key.' was undefined in settings array');
            return "";
        }
        return $this->settings[$key];
    }

    
    public function protocol () {
        return $this->fetch('protocol');
    }

    public function site_url ()
    {
        return $this->fetch('site_url');
    }
    
    public function url () {
        return $this->protocol().'://'.$this->site_url();
    }
    
    public function base_url () {
        return $this->protocol().'://'.$this->fetch('base_url');
    }

    public function update_settings ($key, $value)
    {
        $q = "UPDATE `{$this->table_name}` SET `setting_value` = :v WHERE `setting_name` = :k";
        $s = $this->db->prepare($q);
        $s->bindParam(':k', $key);
        $s->bindParam(':v', $value);
        if (!$s->execute()) {
            $failure = $this->class_name.'.update_settings - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode(['error' => $s->errorInfo(), 'param' => func_get_args()]));
            return ['status' => false, 'data' => $failure];
        }

        return ['status' => true];
    }
    
}
