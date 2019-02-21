<?php

//query per test vari e debug
 function get_price($find){
	$tmp = "Filejson/book.json";
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
 
 function get_comics()
 {
	 
	 $queryBooks = array();
	 
	 $tmp = "Filejson/book.json";
	 $str = file_get_contents($tmp);
	 $books = json_decode($str, true);
	 
	 $length = 0;
	 
	 foreach($books['book'] as $book)
	 {
		 if($book['reparto']==9)
		 {
			 array_push($queryBooks, $book['id']);
			 $length++;
		 }
	 }
	 $tmp = "Filejson/libricateg.json";
	 $str = file_get_contents($tmp);
	 $categ = json_decode($str, true);
	 $cont=0;
	 $totalComics=0;
	 
	 foreach($categ['libricateg'] as $categoria)
	 {
	 if($categoria['categoria']==3)
		foreach($queryBooks as $query)
		{
			if($categoria['id']==$query)
			{
				$totalComics++;
			}
		}
	 }
	 return $totalComics;
 }
 
 function get_sales()
 {
	 
	 //associazione tra id del libro e categ di libricateg, attraverso categ si accese a categoria e si prelevano gli sconti.
	 
	 $queryBooks = array();
	 
	 $tmp = "Filejson/book.json";
	 $str = file_get_contents($tmp);
	 $books = json_decode($str, true);
	 
	 
	 
	 $tmp = "Filejson/libricateg.json";
	 $str = file_get_contents($tmp);
	 $categ = json_decode($str, true);
	 
	 $tmp = "Filejson/categoria.json";
	 $str = file_get_contents($tmp);
	 $discount = json_decode($str, true);
	 
	 
	 $idLibro;
	 $idCateg;
	
	
	/*foreach($discount['categoria'] as $sconto)
	{
		if($sconto['sconto'] > 0)
		{
			echo $sconto['sconto'];
			array_push($queryBooks, array($sconto['sconto'],$sconto['id']));
		}
	}
	
	echo $queryBooks;
	*/
	 
	 foreach($books['book'] as $book)
	 {
		 $id = $book['id'];
		foreach($categ['libricateg'] as $categoria)
		{
			if($id == $categoria['id'])
			{
				$idCateg=$categoria['categoria'];
				foreach($discount['categoria'] as $sconto)
				{
					if($idCateg == $sconto['id'])
					{
						$queryBooks[$id]['id'] = $id;
						$queryBooks[$id]['sconto']=$sconto['sconto'];
						$queryBooks[$id]['titolo']=$book['titolo'];

					}
				}
			}
		}
	 }
	 
	 $sort = array();
	 
	 foreach($queryBooks as $key => $row)
	 {
		 $sort[$key] = $row['sconto'];
	 }
	 
	 array_multisort($sort, SORT_ASC, $queryBooks);
	 
	 $result="";
	 
	foreach($queryBooks as $query)
	{
		if($query['sconto'] > 0)
			$result .=" ". $query['titolo']." sconto : ".$query['sconto'];
		
	}
	return $result;
		
 }
 
 function get_by_date($data1, $data2)
 {
	 //formato data : aaaa-mm-gg
	 
	 $queryBooks = array();
	 
	 $tmp = "Filejson/book.json";
	 $str = file_get_contents($tmp);
	 $books = json_decode($str, true);
	 
	 foreach($books['book'] as $book)
	 {
		 
	 }
 }
 
 //array_push($CatSconto, array('Sconto'=>$cat['Sconto'],'Tipo'=>$cat['Tipo']));
 //asort($CatSconto)
 
 //fumetti id 9 reparti.json
 //ultimi arrivi id 3 categoria.json

?>