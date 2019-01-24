<?php
 function get_price($find){

	$tmp = "book.json";
	$str = file_get_contents($tmp);
	$books = json_decode($str, true); 
	 
	 foreach($books['book'] as $book)
	 {
		 if($book['name']==$find)
		 {
			 return $book['price'];
			 break;
		 }
	 }
	 
	 
 }

?>