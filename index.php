<?php
require('simple_html_dom.php');
$html = file_get_html('https://marketdata.set.or.th/mkt/marketsummary.do?language=th&country=TH');

$i = 0;
$mArry = array();
foreach($html->find('td') as $e){
    array_push($mArry,$e->innertext);
    // echo $e->innertext  .'</br>';
    $i++;
    if($i>7){
        break;
    }
    
}

$first = str_split($mArry[1]);
$second = str_split($mArry[7]);
$pointps = strpos($mArry[7],'.');

$result = array();
if(empty($second[$pointps-1])){
$result["result"] = "";
$result["set"] ="";
$result["value"] ="";
}else{
 $result["result"] = $first[count($first)-1] .''.$second[$pointps-1];
$result["set"] = $mArry[1];
$result["value"] = $mArry[7];   
}


echo json_encode($result);

?>