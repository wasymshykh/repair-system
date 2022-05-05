<?php

class Logs
{
    private $db;
    
    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function create($type, $text, $raw = '') {
        $q = 'INSERT INTO `logs` (`log_text`, `log_type`, `log_raw`, `log_created`) VALUES (:tx, :ty, :rw, :dt)';
        $s = $this->db->prepare($q);
        $s->bindParam(':tx', $text);
        $s->bindParam(':ty', $type);
        $s->bindParam(':rw', $raw);
        $dt = current_date();
        $s->bindParam(':dt', $dt);
        if (!$s->execute()) {
            $d = ['status' => false, 'message' => 'Logs.create - E.02: Failure', 'type' => $type, 'text' => $text, 'raw' => $raw, 'created' => $dt];
            $this->store(json_encode($d));
        }
        return ['status' => true];
    }

    /**
     * 
     * @purpose
     *      Record log to file (if query fails)
     * 
     * @return null
    */
    private function store (string $text, $file = 'system')
    {
        $dir = DIR.'logs/';
        if (!is_dir($dir)) {
            mkdir($dir);
        }
        $f = fopen($dir.$file.'.log', "a") or die("E.03: Failure!");
        $d = $text."\n";
        fwrite($f, $d);
        fclose($f);
    }

}
