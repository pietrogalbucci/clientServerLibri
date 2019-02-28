<?php
// process client request (via URL)
	header ("Content-Type_application/json");
	include ("function.php");
	if(!empty($_GET['op']))
	{
		$operation=$_GET['op'];
		
		switch($operation)
		{
			case 1:
				$name=$_GET['name'];
				$price=get_price($name);
				if(empty($price))
				deliver_response(200,"book not found", NULL);
				else
				deliver_response(200,"book found", $price);
				break;
			case 2:
				$name = get_comics();
				if(empty($name))
				deliver_response(200, "no comics found", NULL);
				else
				deliver_response(200, "quantity", $name);
				break;
			case 3:		
				$result=get_sales();
				if(empty($result))
					deliver_response(200, "no discount found", NULL);
				else
					deliver_response(200,"",$result);
				break;
			case 4:
				$data1=$_GET['data1'];
				$data2=$_GET['data2'];
				$result=get_by_date($data1,$data2);
				if(empty($result))
					deliver_response(200, "no books found", NULL);
				else
					deliver_response(200,"",$result);
				break;
			case 5:
				$id=$_GET['id'];
				$result=get_shopping_cart($id);
				if(empty($result))
					deliver_response(200,"no cart found", NULL);
				else
					deliver_response(200,"",$result);
			default:
				break;
		}
	}
	else
	{
		//throw invalid request
		deliver_response(400,"Invalid request", NULL);
	}
	
	function deliver_response($status, $status_message, $data)
	{
		header("HTTP/1.1 $status $status_message");
		
		$response ['status']=$status;
		$response['status_message']=$status_message;
		$response['data']=$data;
		
		$json_response=json_encode($response);
		echo $json_response;
	}

?>