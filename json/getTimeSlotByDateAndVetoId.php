<?php
declare(strict_types=1);
if(isset($_POST['lowDate']) && isset($_POST['upDate']) && $_POST['vetoId'])
{
    $value1=$_POST['lowDate'];
    $value2=$_POST['upDate'];
    $value3=$_POST['vetoId'];

    $reqTimeSlot=MyPDO::getInstance()->prepare(<<<SQL
    SELECT * 
    FROM TimeSlot
    WHERE timeSlotId NOT IN(SELECT timeSlotId
                            FROM Concern
                            WHERE meetingId IN(SELECT meetingId
                                               FROM Meeting
                                               WHERE meetingDate > STR_TO_DATE(?, '%Y-%m-%d')
                                               AND meetingDate < STR_TO_DATE(?, '%Y-%m-%d')
                                               AND vetoId=?))
    SQL);

    $reqTimeSlot->execute([$value1,$value2,$value3]);
    $reqTimeSlot=$reqTimeSlot->fetchAll();
    echo json_encode($reqTimeSlot);
}
else json_encode(array([]));