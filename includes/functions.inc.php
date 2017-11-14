<?php

function myCalDaysInMonth($month, $year)
{
    return date('t', mktime(0, 0, 0, $month, 1, $year));
}

function buildMonthlyLabels($arrDate) {
    $daysOfMonth = myCalDaysInMonth($arrDate['month'], $arrDate['year']);
    $label = '';
    for($i = 1; $i <= $daysOfMonth; $i++) {
        $label .= "'" . $i . "', ";
    }

    return(substr($label, 0, -2));
}

function buildMyLabels($lCount) {
    $label = '';
    for($i = 1; $i <= $lCount; $i++) {
        $label .= "'" . $i . "', ";
    }

    return(substr($label, 0, -2));
}

function getMonthyDistance($tDistance, $mDate) {
    return (round($tDistance / $mDate, 2));
}

function buildTargetChart($tDistance, $tDate) {
    if(!isset($tDate['month']) AND isset($tDate['year'])) {
        $labelCount = date('z', mktime(0,0,0,12, 31, $tDate['year'])) + 1;
        $dailyDistance = round($tDistance / $labelCount, 2);
    } elseif (isset($tDate['month']) AND isset($tDate['year'])) {
        $labelCount = myCalDaysInMonth($tDate['month'], $tDate['year']);
        $mDistance = round($tDistance / 12, 2);
        $dailyDistance = round($mDistance/ $labelCount, 2);
    }


    $dailyTotalDistance = $dailyDistance;
    $targetCords = '';
    $labels = '';

    for($i = 1; $i <= $labelCount; $i++) {
        $targetCords .= "{x: " . $i . ", y: " . $dailyTotalDistance . "}, \n";
        $labels .= "'" . $i . "', ";
        $dailyTotalDistance += $dailyDistance;
    }

    $myTargetData = array('label' => substr($labels, 0, -2), 'targetLine' => substr($targetCords,0, -2));

    return ($myTargetData);
}