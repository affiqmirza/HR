<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include_once 'config/Database.php';
include_once 'models/Report.php';

$database = new Database();
$db = $database->getConnection();

$report = new Report($db);

$data = json_decode(file_get_contents("php://input"));

if(
    !empty($data->incident_date) &&
    !empty($data->reporter_name) &&
    !empty($data->reporter_email) &&
    !empty($data->incident_description)
) {
    $report->incident_date = $data->incident_date;
    $report->reporter_name = $data->reporter_name;
    $report->reporter_email = $data->reporter_email;
    $report->incident_description = $data->incident_description;
    $report->witnesses = $data->witnesses ?? '';
    
    if($report->create()) {
        // Send email notification to HR
        $to = "hr@company.com";
        $subject = "New Harassment Report Submitted";
        
        $message = "A new harassment report has been submitted.\n\n";
        $message .= "Reporter: " . $report->reporter_name . "\n";
        $message .= "Date of Incident: " . $report->incident_date . "\n";
        $message .= "Description: " . $report->incident_description . "\n";
        
        $headers = 'From: noreply@company.com' . "\r\n" .
            'Reply-To: ' . $report->reporter_email . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        
        mail($to, $subject, $message, $headers);
        
        http_response_code(201);
        echo json_encode(array("message" => "Report was created successfully."));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create report."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create report. Data is incomplete."));
}
?>