<?php
	$fichier="games";
	$tabfich = file($fichier);

	$fp = fopen('file.csv', 'w');

	$res_table= "";
	
	$ar_edit_val = array();
	$ar_edit_id = array();
	$cpt_edit = 0;
	$q_edit = "INSERT INTO editor(id, value) VALUES ";
	
	$ar_console_val = array();
	$ar_console_id = array();
	$cpt_console = 0;
	$q_console = "INSERT INTO plateform(id, value) VALUES ";

	$query = "INSERT INTO game(name, plateform, released_year, editor_1, editor_2, editor_3, game_type) VALUES ";

	$res_table .= "<table style='border:1px'>";
		$res_table .= "<tr>";
			$res_table .= "<td>NOM</td>";
			$res_table .= "<td>DATE</td>";
			$res_table .= "<td>EDITEUR</td>";
			$res_table .= "<td>CONSOLE</td>";
		$res_table .= "</tr>";
		$ar_line;
		$ar_data;
		$ar_consoles;
		$consoles;
		$fields = array();
		
		$query_cpt;
		
		foreach($tabfich as $line)
		{
			$i = 0;
				
			// On explose par '('
			$ar_line = explode("(", $line);
			
			// Le premier élément est le nom du jeu
			$fields[0] = $ar_line[$i];
			$i++;
			
			// On supprime '(' de l'élément suivant
			$temp = explode(")", $ar_line[$i]);
			// On explose ensuite par ','
			$ar_data = explode(",", $temp[0]);
			
			// Si le premier élément n'est pas un entier, c'est que nous avons un complément du nom du jeu
			if(!is_numeric($ar_data[0]))
			{
				$fields[0] .= '('.$ar_data[0].')';
				$i++;
				
				// On supprime '(' de l'élément suivant
				$temp = explode(")", $ar_line[$i]);
				// On explose ensuite par ','
				$ar_data = explode(",", $temp[0]);
			}
			$i++;
			
			$editeurs = "";
			$echo_editeurs = "";
			$cpt = 0;
			$id_edit = array();
			foreach ($ar_data as $e) 
			{
				if(is_numeric($e))
				{
					$e = trim($e);
					// C'est la date
					$fields[1] = $e;	
				}
				else
				{
					$e = trim(strtoupper($e));
					$echo_editeurs .= $e."<br />";
					$editeurs .= "$e\n";
					
					// On ne stock en bdd que les 3 premiers éditeurs
					if($cpt < 3)
					{
						// On récupère la clé correspondant à cet éditeur
						$k = array_search($e, $ar_edit_val);
						if(is_numeric($k))
						{
							// Si la clé existe, on récupère son id
							$id_edit[$cpt] = $ar_edit_id[$k];
						}
						else
						{
							// Sinon il faut enregistrer l'éditeur en bdd
						 	$q_edit .= "($cpt_edit, \"$e\"),";
							// On ajoute l'éditeur dans les tableaux (nom/id)
							$ar_edit_val[count($ar_edit_val)] = $e;
							$ar_edit_id[count($ar_edit_id)] = $cpt_edit;
							
							$id_edit[$cpt] = $cpt_edit;
							
							$cpt_edit++;
						}
						$cpt++;
					}
				}
			}
			$fields[2] = $editeurs;

			$temp = explode(")", $ar_line[$i]);
			$ar_consoles = explode(",", $temp[0]);
			$i++;
			
			$consoles = "";
			$echo_consoles = "";
			$id_console = array();
			$ar_game_console = array();
			foreach ($ar_consoles as $c) {
				$c = trim(strtoupper($c));
				
				$echo_consoles .= $c."<br />";
				$consoles .= "$c\n";
				
				// On récupère la clé correspondant à cette console
				$k = array_search($c, $ar_console_val);
				if(is_numeric($k))
				{
					// Si la clé existe, on récupère son id
					$id_console[count($id_console)] = $ar_console_id[$k];
				}
				else
				{
					// Sinon il faut enregistrer la console en bdd
				 	$q_console .= "($cpt_console, \"$c\"),";
					// On ajoute la console dans les tableaux (nom/id)
					$ar_console_val[count($ar_console_val)] = $c;
					$ar_console_id[count($ar_console_id)] = $cpt_console;
					
					$id_console[count($id_console)] = $cpt_console;
					
					$cpt_console++;
				}
				$ar_game_console[count($ar_game_console)] = $cpt_console - 1;	
			}
			$fields[4] = $consoles;
			
			fputcsv($fp, $fields);
			
			// Insertion en base de données
			foreach($ar_game_console as $a=>$b)
			{
				$query .= '(\"'.$fields[0].'\",'; // nom
				$query .= $b.','; // plateform
				$query .= $fields[1].','; // realeased_year
				if(is_numeric($id_edit[0]))
					$query .= $id_edit[0].",";
				else
					$query .= "NULL,";
				if(count($id_edit) > 0 && is_numeric($id_edit[1]))
					$query .= $id_edit[1].",";
				else
					$query .= "NULL,";
				if(count($id_edit) > 1 && is_numeric($id_edit[2]))
					$query .= $id_edit[2].",";
				else
					$query .= "NULL,";
				$query .= '1),'; // game_type
			}
			
			// Affichage des résultats
			$res_table .= "<tr>";
			$res_table .= "<td>".$fields[0]."</td>";
			$res_table .= "<td>".$fields[1]."</td>";
			$res_table .= "<td>".$echo_editeurs."</td>";
			$res_table .= "<td>".$echo_consoles."</td>";

			$res_table .= "</tr>";
		}
	$q_console 	= trim($q_console, 	",") . ";";
	$q_edit 	= trim($q_edit, 	",") . ";";
	$query 		= trim($query, 		",") . ";";
	
	$res_table .= "</table>";
	/*try
	{
		$pdo = new PDO('mysql:host=rompy-db-instance.cwazuxifehxl.us-west-2.rds.amazonaws.com;dbname=rompy', 'rompy', '10ApQmWn');
		$pdo->beginTransaction();
		
		$pdo->query($q_console);
		$pdo->query($q_edit);
		$pdo->query($query);
		
		$pdo->commit();
	}
	catch (Exception $e)
	{
	        echo '/ ! \ Erreur : <br />' . $e->getMessage().'<br /><br /><br />';
	}*/
	echo "<pre>";
	var_dump($ar_console_val);
	echo "</pre>";
	//echo "$q_console <br /><br />";
	//echo "$q_edit <br /><br />";
	//echo "$query <br /><br />";
	
	//echo $res_table;

	fclose($fp);
?>