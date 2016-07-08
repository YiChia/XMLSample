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
if(isset($tree["BookOrder"]["Order"]["ID"])) //判斷是否為單筆訂單
{
    
    if(isset($tree["BookOrder"]["Order"]["Detail"])) //訂購數目是否為單筆
    {
        $item[0][0]=$tree["BookOrder"]["Order"]["Detail"]["item"]["value"];
        $price[0][0]=$tree["BookOrder"]["Order"]["Detail"]["price"]["value"];
    }
    else  
    {      //客人訂購多樣商品
        $Num=count($tree["BookOrder"]["Order"]["Detail"])
        for($j=0;$j<Num;$j++)
            {

            $item[0][$j]=$tree["BookOrder"]["Order"]["Detail"][$j]["item"]["value"];
            $price[0][$j]=$tree["BookOrder"]["Order"]["Detail"][$j]["price"]["value"];

            }
        
    }
    
}
else
{    //多筆訂單
    $OrderNum=count($tree["BookOrder"]["Order"]); //計算訂單數
    for($i=0;$i<$OrderNum;$i++)
    {
      
      
        if(isset($tree["BookOrder"]["Order"][$i]["Detail"]["item"])) //客人訂購單一商品
        {
            $item[$i][0]=$tree["BookOrder"]["Order"][$i]["Detail"]["item"]["value"];
            $price[$i][0]=$tree["BookOrder"]["Order"][$i]["Detail"]["price"]["value"];
        }
        else
        {  //客人訂購多個商品
          
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
//原本的方式  //  但如果只有單筆 就會產生問題，目前也只想出這種寫法，不過好像很累贅
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
        
        echo "price".$price;
        //做後續的存資料庫處理
    }
    
}




?>
