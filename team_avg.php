<?php

//data.php

$connect = new PDO("mysql:host=localhost;dbname=nba_db", "root", "!@#jung4609");

if(isset($_POST["action"]))
{
	// if($_POST["action"] == 'insert')
	// {
	// 	$data = array(
	// 		':language'		=>	$_POST["language"]
	// 	);

	// 	$query = "
	// 	INSERT INTO survey_table 
	// 	(language) VALUES (:language)
	// 	";

	// 	$statement = $connect->prepare($query);

	// 	$statement->execute($data);

	// 	echo 'done';
	// }

	if($_POST["action"] == 'fetch')
	{
		$query = "
		select team_id,round(avg(total_points),2)as pts,
		round(avg(total_rebounds),2)as rbd,
		round(avg(total_assists),2)as ast,
		round(avg(total_blocks),2)as blk,
		round(avg(total_steals),2)as stl 
		from team_all_game inner join season_type 
		on season_type.game_date = team_all_game.game_date 
		where season_type ='regular' group by team_id
		order by team_id;
		";

		$result = $connect->query($query);

		$data = array();

		foreach($result as $row)
		{
			$data[] = array(
				'team_id'		=>	$row["team_id"],
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