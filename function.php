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
	 
	 $data1= new DateTime($data1);
	 $data2= new DateTime($data2);
	 
	 $result="";
	 $id=0;
	 
	 foreach($books['book'] as $book)
		{
			$currentDate = new DateTime($book['dataarcm']);
			
			if(date_diff($data1, $currentDate)->format('%R%a') > 0)
				if ((date_diff($data1, $currentDate)->format('%R%a')) <= (date_diff($data1, $data2)->format('%R%a'))){
					$queryBooks[$id]['titolo']=$book['titolo'];
					$id++;
				}
			
		}
	foreach($queryBooks as $query)
	{
		$result .=" ".$query['titolo'];
	}
	return $result;
 }
 
 function get_shopping_cart($id)
 {
	 //dato l'id di un carrello elencare i titoli dei libri acquistati con relatia quantità e username utente
	 
	 $queryBooks = array();
	 
	 $tmp = "Filejson/libricarrello.json";
	 $str = file_get_contents($tmp);
	 $libricarrello = json_decode($str, true);
	 
	 $tmp = "Filejson/utenti.json";
	 $str = file_get_contents($tmp);
	 $utenti = json_decode($str, true);
	 
	 $tmp = "Filejson/book.json";
	 $str = file_get_contents($tmp);
	 $books = json_decode($str, true);
	 
	 $tmp = "Filejson/carrello.json";
	 $str = file_get_contents($tmp);
	 $carrello = json_decode($str, true);
	 
	 //Verificare ID Carrello, andare in libricarrello e prelevare l'id del libro, andare in libri
	 //e prelevare il titolo del libro dall'id, andare in utenti e prelevare l'utente dal numero di telefono del carrello
	 
	 foreach($libricarrello['libricarrello'] as $cart)
	 {
		 
	 }
	 
 }
 
 //array_push($CatSconto, array('Sconto'=>$cat['Sconto'],'Tipo'=>$cat['Tipo']));
 //asort($CatSconto)
 
 //fumetti id 9 reparti.json
 //ultimi arrivi id 3 categoria.json

?>