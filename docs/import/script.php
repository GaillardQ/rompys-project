<?php
	$fichier="games";
	$tabfich = file($fichier);

	$fp = fopen('file.csv', 'w');

	echo "<table style='border:1px'>";
		echo "<tr>";
			echo "<td>NOM</td>";
			echo "<td>DATE</td>";
			echo "<td>EDITEUR</td>";
			echo "<td>CONSOLE</td>";
		echo "</tr>";
		$ar_line;
		$ar_data;
		$ar_consoles;
		$consoles;
		$fields = array();
		foreach($tabfich as $line)
		{
			echo "<tr>";

				$ar_line = explode("(", $line);
				echo "<td>".$ar_line[0]."</td>";
				$fields[0] = $ar_line[0];

				$temp = explode(")", $ar_line[1]);
				$ar_data = explode(",", $temp[0]);
				echo "<td>".$ar_data[0]."</td>";
				$fields[1] = $ar_data[0];
				echo "<td>".$ar_data[1]."</td>";
				$fields[2] = $ar_data[1];

				$temp = explode(")", $ar_line[2]);
				$ar_consoles = explode(",", $temp[0]);
				echo "<td>";
				$consoles = "";
				foreach ($ar_consoles as $c) {
					echo $c."<br />";
					$consoles .= "$c\n";
				}
				$fields[4] = $consoles;
				echo "</td>";

			echo "</tr>";
			fputcsv($fp, $fields);
		}
	echo "</table>";

	fclose($fp);
	/* ALGO */
	//explode selon (
		// explode[0] = nom du jeu
		// explode[1] = [DATE], [EDITEUR])
		// explode[2] = [CONSOLE 1], [CONSOLE 2], ... [CONSOLE N])
?>