<?php  
$arr = array();

for($i=1; $i<=100; $i++)
{

array_push($arr, $i);
}


for($j=0; $j<100; $j++)
{
 if(($arr[$j] % 3 == 0) && ($arr[$j] % 5 == 0))
 {
  $arr[$j] = "foobar";	
 }
 else if($arr[$j] % 3 == 0)
 {
  $arr[$j] = "foo";	
 }
 else if($arr[$j] % 5 == 0)
 {
  $arr[$j] = "bar";	
 }
  echo $arr[$j]. ", ";
}

?>