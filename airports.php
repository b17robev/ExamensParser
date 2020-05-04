<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
    <?php

    $file = fopen("data/airports.csv", "r");
    try {
        $conn = mysqli_connect("localhost","root","admin","examensarbete");
    } catch (Exception $e) {
        die($e->getMessage());
    }

    // Drop Database and reset
    $commands = file_get_contents('examensarbete.sql');
    if ($conn->multi_query($commands))
    {
        while(($stmt = ($conn->more_results() ? $conn->next_result() : false)) !== FALSE) {
            if ($stmt = $conn->store_result()) {
                $stmt ->free();
            }
        }
    }

    $conn->set_charset("UTF-8");

    // each line into the local $data variable
    $count = 0;
    $flag = true;
    echo "Parsing airports \n";
    while (($data = fgetcsv($file, 9999, ",")) !== FALSE)
    {
        if($flag) {
            $flag = false;
            continue;
        }

        $res = array_map("utf8_decode", $data) ;

        $sql = "INSERT INTO airports (airport_id, name, city, country, iata, icao, latitude, longitude, altitude, timezone, dst, tz_database_time_zone, type, source, location) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        try {
            if($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("isssssddissssss", $res[0],$res[1],$res[2],$res[3],$res[4],$res[5],$res[6],$res[7],$res[8],$res[9],$res[10],$res[11],$res[12],$res[13],$res[14]);
                $execute = $stmt->execute();
                if(!$execute) {
                    echo "Error: " . mysqli_error($conn);
                }
                $count++;
            } else {
                echo $conn->error;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }

    }
    fclose($file);
    $conn->close();

    echo "Data parsed successfully, added $count airports";
    ?>
    </body>
</html>

