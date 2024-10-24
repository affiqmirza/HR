<?php
class Report {
    private $conn;
    private $table_name = "reports";
    
    public $id;
    public $incident_date;
    public $reporter_name;
    public $reporter_email;
    public $incident_description;
    public $witnesses;
    public $created_at;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
                SET
                    incident_date = :incident_date,
                    reporter_name = :reporter_name,
                    reporter_email = :reporter_email,
                    incident_description = :incident_description,
                    witnesses = :witnesses,
                    created_at = :created_at";
        
        $stmt = $this->conn->prepare($query);
        
        $this->created_at = date('Y-m-d H:i:s');
        
        $stmt->bindParam(":incident_date", $this->incident_date);
        $stmt->bindParam(":reporter_name", $this->reporter_name);
        $stmt->bindParam(":reporter_email", $this->reporter_email);
        $stmt->bindParam(":incident_description", $this->incident_description);
        $stmt->bindParam(":witnesses", $this->witnesses);
        $stmt->bindParam(":created_at", $this->created_at);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>