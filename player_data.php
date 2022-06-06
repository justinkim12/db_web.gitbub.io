<?php

//data.php

$connect = new PDO("mysql:host=localhost;dbname=nba_db", "root", "!@#jung4609");

if(isset($_POST["action"]))
{
	if($_POST["action"] == 'search')
	{
		
		$language=$_POST["language"];
		$language2=$_POST['language2'];

		$query = "
		select player_id as id from player_info 
		where f_name= '$language'
		and l_name='$language2'
		";
		//echo $query;
		$result = $connect->query($query);		
		foreach($result as $row)
		{
			$output=$row['id'];

		}
		//echo json_encode($data);
		echo $output;
	}

	if($_POST["action"] == 'fetch')
	{
		$id=$_POST['id'];
		$category=$_POST['category'];

		$query = "
		SELECT month(game_date) as month,round(avg(points),2) as pts,
        round(avg(rebounds),2) as rbd,round(avg(assists),2) as ast,
        round(avg(blocks),2) as blk,round(avg(steals),2) as stl
		FROM player_info inner join player_all_game 
		on player_info.player_id=player_all_game.player_id
        where player_info.player_id=$id and minutes>0
        and $category
        group by month(game_date);"
		;

		$result = $connect->query($query);

		$data = array();

		foreach($result as $row)
		{
			$data[] = array(
				'month'		=>	$row["month"],
				'pts'			=>	$row["pts"],
				'rbd'			=>	$row["rbd"],
				'ast'			=>	$row["ast"],
				'blk'			=>	$row["blk"],
				'stl'			=>	$row["stl"],
				'color'			=>	'#' . rand(100000, 999999) . ''
			);
		}

		echo json_encode($data);
	}
}


?>