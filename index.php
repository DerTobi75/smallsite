<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 21.10.17
 * Time: 10:05
 */

require_once 'vendor/autoload.php';
require_once 'includes/functions.inc.php';

use Symfony\Component\HttpFoundation\Request;
$request = Request::createFromGlobals();
$uri = $request->getPathInfo();

$myTest = $request->query->all();


switch ($myTest['p']) {
    case 'tobi':
        echo "Tobi - Learning to Code, ...<br />";
        break;

    case 'running':
        echo "Stay healthy, ...<br />";
        break;

    case 'git':
        echo "You you are becoming the next GIT Ninja, ...<br />";
        break;
}


print_r($myTest);

echo "<br />" . $_GET['page'];

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
    'cache' => false,
    'debug' => true,
));
$twig->addExtension(new Twig_Extension_Debug());

$pFFA = new adriangibbons\phpFITFileAnalysis('2183997374.fit');

echo "<pre>";
    print_r($pFFA->data_mesgs['session']);
echo "</pre>";

$startTime = date('d.M.Y h:m:s', $pFFA->data_mesgs['session']['start_time']);

$tobi = $pFFA->data_mesgs['session'];
$day = $pFFA->data_mesgs['session']['start_time'];
$totalTime = $pFFA->data_mesgs['session']['total_timer_time'] / 60;


$myDate = array('month' => date('m'), 'year' => date('Y'));
$myDate = array('month' => '2', 'year' => '2017');

$dayFormat = array('date' => date('Y-M-d', $day), 'day' => date('z', $day + 86400));

$arrTester = array('month' => '2', 'year' => 2017);
$dailyLabels = buildTargetChart('2000', $arrTester);

//$tester = buildTargetChart('1200', $arrTester);

echo $twig->render('chart.twig', array('totalTime' => $totalTime, 'startTime' => $startTime, 'tobi' => $tobi, 'datum' => $dayFormat, 'XLabels' => $dailyLabels['label'], 'targetLine' => $dailyLabels['targetLine']));
