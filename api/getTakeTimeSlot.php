<?php
declare(strict_types=1);

include_once "../src/MyPDO.php";

header('Content-type: application/json');
setlocale(LC_ALL, 'fr_FR', 'French_France', 'French');
date_default_timezone_set('Europe/Paris');

$meetingType = "CLINIQUE";
$vetoId = "";
$whereVeto = "";
$year = isset($_GET['year']) && !empty($_GET['year']) ? $_GET['year'] : date('o');
$week = isset($_GET['week']) && !empty($_GET['week']) ? $week = $_GET['week'] : date('W');
if($week > 53) echo json_encode(["error" => "week_number_greater_than_53"]);
if(isset($_GET['meetingType']) && !empty($_GET['meetingType'])) {
    $meetingType = $_GET['meetingType'];

    $rq = MyPDO::getInstance()->prepare(<<<SQL
        SELECT typeName FROM TimeSlotType
        WHERE UPPER(typeName) = UPPER(:typeName)
    SQL);
    $rq->execute(["typeName" => $meetingType]);
    $res = $rq->fetch();
    if(!$res){
        echo json_encode(["error" => "timeslot_type_not_found"]);
    }

}
if(isset($_GET['vetoId']) && !empty($_GET['vetoId'])) {
    $vetoId = $_GET['vetoId'];
    $whereVeto = " WHERE userId = :vetoId";

    $rq = MyPDO::getInstance()->prepare(<<<SQL
        SELECT userId FROM Users
        WHERE userId = :vetoId
        AND isVeto = 1
    SQL);
    $rq->execute(["vetoId" => $vetoId]);
    $res = $rq->fetch();
    if(!$res){
        echo json_encode(["error" => "veto_not_found"]);
    }
}
$lowerDate = date("Y-m-d", strtotime("o".$year."W".$week."1") );
$upperDate = date("Y-m-d", strtotime("o".$year."W".$week."6") );

$rq2 = MyPDO::getInstance()->prepare(<<<SQL
            SELECT * FROM TimeSlot
            WHERE timeSlotId IN (SELECT timeSlotId
                                 FROM Horaire
                                 {$whereVeto} )
            AND timeSlotId IN (SELECT timeSlotId 
                                   FROM Concern
                                   WHERE meetingId IN (SELECT meetingId
                                                       FROM Meeting
                                                       WHERE meetingDate > STR_TO_DATE(:lowerDate, '%Y-%m-%d')
                                                       AND meetingDate <= STR_TO_DATE(:upperDate, '%Y-%m-%d')))
            AND typeId IN (SELECT typeId FROM TimeSlotType
                           WHERE UPPER(typeName) = UPPER(:typeName))
        SQL);
$execute = ["lowerDate" => $lowerDate, "upperDate" => $upperDate, "typeName" => $meetingType];
if($vetoId)
    $execute["vetoId"] = $vetoId;
$rq2->execute($execute);
$array = $rq2->fetchAll();
if($array)
    echo json_encode($array);
else
    echo json_encode(["error" => "no_available_timeslots"]);