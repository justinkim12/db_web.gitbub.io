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
		$season=$_POST['season'];
		$team_id=$_POST['team_id'];
		$query = "
		select 	month(team_all_game.game_date) as month,
		round(avg(total_points),2)as pts,
		round(avg(total_rebounds),2)as rbd,
		round(avg(total_assists),2)as ast,
		round(avg(total_blocks),2)as blk,
		round(avg(total_steals),2)as stl,
        count(case when outcome='w' then 1 end)/count(*) as win
 		from team_all_game inner join season_type 
		on  season_type.game_date = team_all_game.game_date
		where season_type='regular' and team_id='$team_id' 
		and $season
		group by month(team_all_game.game_date);
		";

		$result = $connect->query($query);

		$data = array();

		foreach($result as $row)
		{
			$data[] = array(
				'win'       	=>  $row["win"],
				'month'			=>	$row["month"],
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