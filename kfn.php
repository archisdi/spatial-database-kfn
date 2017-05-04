
<?php
	ini_set("display_errors","Off");

	// echo "Titik Awal";
	// echo "<BR>";


	$content = file_get_contents('data.txt');
	list($long_1, $lat_1) = explode(',', $content);
	$long_old = $long_1;
	$lat_old = $lat_1;

  $start = ['lat' => floatval(str_replace(' ','',$long_old)),'lng' => floatval(str_replace(' ','',$lat_old))];
  $destination = array();
	// echo "$long_old,$lat_old<BR>";

	$fh = fopen('format.txt','r');

	while ($line = fgets($fh))
	{
	// <... Do your work with the line ...>
		list($long_new, $lat_new) = explode(',', $line);

		if ($long_new == "#" or $long_new == "!")
		{
			if ($long_new == "#")
			{
				$rute = $lat_new;
				// echo "<BR>";
				// echo "Rute $rute";
				// echo "<BR>";
        $temp = [];
				$i += 1;

			}
			else if($long_new == "!")
			{
        array_push($destination,['index' => $i ,'coordinate' => end($temp)]);
				// echo "Jarak : $jarak[$i]";
				// echo "<BR>";
				$long_old = $long_1;
				$lat_old = $lat_1;
			}
		}
		else
		{
			if($i>=1)
			{
				$total_new= $long_new + $lat_new;

				// echo "$long_new,$lat_new<br>";
        $data = ['lat' => floatval(str_replace(' ','',$long_new)),'lng' => floatval(str_replace(' ','',$lat_new))];
        array_push($temp,$data);
        // echo $i.' - '.$data.' <br>';

				$jarak[$i] = $jarak[$i] + sqrt( ($long_new-$long_old)*($long_new-$long_old) + ($lat_new-$lat_old)*($lat_new-$lat_old) );
				$long_old = $long_new;
				$lat_old = $lat_new;
			}
		}
	}
	fclose($fh);
	//////////////SORTIR
	;
	// echo "<br>";
	for ($irute=1 ; $irute<=$rute ; $irute++)
	{
		if($jarak[$irute] > $max1   )
		{
			$max1 = $jarak[$irute];
			$irute_max1 = $irute;
		}
	}

	for ($irute=1 ; $irute<=$rute ; $irute++)
	{
		if($irute == $irute_max1)
			continue;
		else
		{
			if($jarak[$irute] > $max2   )
			{
				$max2 = $jarak[$irute];
				$irute_max2 = $irute;
			}
		}
	}

	// echo "Jarak terjauh <br>";
	// echo "Rute $irute_max1 dengan jarak $max1<br>";
	// echo "Rute $irute_max2 dengan jarak $max2<br>";
  //print_r($destination[$irute_max1]);

  $output = [
    "start" => $start,
    "finish" => $destination,
    'max' => $irute_max1 - 1
  ];

   echo json_encode($output);
	?>
