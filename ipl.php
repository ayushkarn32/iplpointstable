<?php
@$year=$_GET['year'];
//http://localhost/stok/gettody.php?symbol=ahpc
include('main/simple_html_dom.php');
header("Content-Type:JSON");
if (isset($year))
    {
    $temp=[];
    $html = @file_get_html('https://www.iplt20.com/points-table/'.$year.'');


    error_reporting(E_ALL ^ E_NOTICE);  

    $error = error_get_last();
         // Fatal error, E_ERROR === 1
        if ($error['type'] === E_ERROR) {
             echo "Server is currently unavailabe,Please try again later.";
        }


    // Find all article blocks
    foreach($html->find('tr') as $article) {
        $item['s_no']   = $article->find('td', 0)->plaintext;
        if(!is_null($item['s_no']))
            {
                $item['team_name']    = $article->find('td[2]', 0)->plaintext;
                $item['matches_played'] = $article->find('td[3]', 0)->plaintext;
                $item['won'] = $article->find('td[4]', 0)->plaintext;
                $item['lost'] = $article->find('td[5]', 0)->plaintext;
                $item['tied'] = $article->find('td[6]', 0)->plaintext;
                $item['n/r'] = $article->find('td[7]', 0)->plaintext;
                $item['net_runrate'] = $article->find('td[8]', 0)->plaintext;
                $item['for'] = $article->find('td[9]', 0)->plaintext;
                $item['against'] = $article->find('td[10]', 0)->plaintext;
                $item['points'] = $article->find('td[11]', 0)->plaintext;
                $temp[] = $item;
            }
    }
    echo json_encode($temp);
}
else{
    echo "sorry incorrect year please check documentation ";
}
?>
