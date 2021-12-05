<?php
declare(strict_types=1);

include_once "../src/MyPDO.php";

header('Content-type: application/json');

if(isset($_GET['timeSlotId']) && !empty($_GET['timeSlotId']))
{
    $timeSlotId = $_GET['timeSlotId'];
    $rq = MyPDO::getInstance()->prepare(<<<SQL
        SELECT * FROM TimeSlot
        WHERE timeSlotId = :timeSlotId;
    SQL);
    $rq->execute(["timeSlotId" => $timeSlotId]);
    $array = $rq->fetchAll();
    if($array)
        echo json_encode($array);
    else
        echo json_encode(["error" => "time_slot_id_doesnt_exist"]);

}else echo json_encode(["error" => "no_time_slot_id_mentionned"]);
