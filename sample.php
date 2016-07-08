<?php


$str='
<?xml version="1.0" encoding="UTF-8"?>
<BookOrder>
  <Order>
    <ID>01</ID>
    <Name>Amy</Name>
    <Detail>
      <item>Apple</item>
      <price>10</price>
    </Detail> 
    <Detail>
      <item>Banana</item>
      <price>15</price>
    </Detail>    
  </Order>
  <Order>
    <ID>02</ID>
    <Name>Jack</Name>
    <Detail>
       <item>Apple</item>
       <price>10</price>
    </Detail>    
  </Order>
</BookOrder>
';

require_once('SofeeXmlParser.php');
$file = $str;
$xml = new SofeeXmlParser();
$xml->parseFile($file);
$tree = $xml->getTree();
unset($xml);

//----------------------存到二維陣列-------START-------------------------------//
if(isset($tree["BookOrder"]["Order"]["ID"]))
{
    $ID[0][0]=$tree["BookOrder"]["Order"]["ID"];
    $Name[0][0]=$tree["BookOrder"]["Order"]["Name"];
    if(isset($tree["BookOrder"]["Order"]["Detail"]))
    {
        $item[0][0]=$tree["BookOrder"]["Order"]["Detail"]["item"]["value"];
        $price[0][0]=$tree["BookOrder"]["Order"]["Detail"]["price"]["value"];
    }
    else
    {
        $Num=count($tree["BookOrder"]["Order"]["Detail"])
        for($j=0;$j<Num;$j++)
            {

            $item[0][$j]=$tree["BookOrder"]["Order"]["Detail"][$j]["item"]["value"];
            $price[0][$j]=$tree["BookOrder"]["Order"]["Detail"][$j]["price"]["value"];

            }
        
    }
    
}
else
{
    $OrderNum=count($tree["BookOrder"]["Order"]);
    for($i=0;$i<$OrderNum;$i++)
    {
        if(isset($tree["BookOrder"]["Order"][$i]["Detail"]["item"]))
        {
            $item[[$i]][0]=$tree["BookOrder"]["Order"][$i]["Detail"]["item"]["value"];
            $price[[$i]][0]=$tree["BookOrder"]["Order"][$i]["Detail"]["price"]["value"];
        }
        else
        {
            $Num=count($tree["BookOrder"]["Order"][$i]["Detail"])
            for($j=0;$j<Num;$j++)
                {

                $item[0][$j]=$tree["BookOrder"]["Order"][$i]["Detail"][$j]["item"]["value"];
                $price[0][$j]=$tree["BookOrder"]["Order"][$i]["Detail"][$j]["price"]["value"];

                }

        }
    }
}
//----------------------存到二維陣列------END--------------------------------//

//方式A
//原本的方式  //  但如果只有單筆 就會產生問題
$cntOrder=count($tree["BookOrder"]["Order"]);
for($i=0;$i<$cntOrder;$i++)
{
    $cntD=count($tree["BookOrder"]["Order"][$i]["Detail"]);
    for($j=0;$j<$cntOrder;$j++)
    {
        $item[$i][$j];
        $price[$i][$j];
        echo "price".$price[$i][$j];
        
        //做後續的存資料庫處理
        
    }
    
}

//方式B foreach  //問題點為 多個陣列無法一次讀取全部的陣列

foreach($price as $val1){
    
    foreach($val1 as $value){
        
        
        
    }
    
}




?>