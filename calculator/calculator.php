<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <center>
    <h3>Calculate</h3>
    <form action="" method="post">
        <label for="">Voltage</label><br>
        <input type="text" name="voltage">
        <p>Voltage(V)</p>

        <label for="">Current</label><br>
        <input type="text" name="ampere">
        <p>Ampere(A)</p>

        <label for="">Current Rate</label><br>
        <input type="text" name="rate">
        <p>sen/kWh</p>

        <button type="submit" name="calc">Calculate</button>
    </form>
    <br>

    <!-- PHP function for the calculator -->
    <?php 
        function calc(){
            if (isset($_POST['calc'])) {
                # code...
                // Getting the data from the form
                $volt = $_POST['voltage'];
                $amp = $_POST['ampere'];
                $cent = $_POST['rate'];

                // Calculating the rate exchange to change from sen to MYR 
                // and calculating power for the next process
                $rate = $cent/100;
                $power = ($volt * $amp)/1000;
                ?>
                <div class="card wrap-content">
                <p>Power: <?php echo $power; ?> kw</p>
                <p>Rate: RM <?php echo $rate; ?></p>
                </div>

                <table class="table">
                    <tr>
                        <th>#</th>
                        <th>Hour</th>
                        <th>Energy (kWh)</th>
                        <th>Total (RM)</th>
                    </tr>
                    <!-- The calulating process for the table  -->
                <?php
                    for ($i=1; $i <=24 ; $i++) { 
                        # code...
                        $totalEnergy[$i] = 0;
                        $totalPrice[$i] = 0;
                        $energy[$i] = $power * $i * 1000;
                        $total[$i] = $energy[$i] * ($rate/100);
                        $exchangeRate[$i] = $total[$i]/10;
                        $energyExchange[$i] = $energy[$i]/1000;
    
                        $totalEnergy[$i] = $totalEnergy[$i] + $energyExchange[$i];
                        $totalPrice[$i] = $totalPrice[$i] + $exchangeRate[$i];
                    
                    ?>
                    <!-- The final output -->
                    <tr>
                        <th><?php echo $i;?></th>
                        <td><?php echo $i;?></td>
                        <td><?php echo $totalEnergy[$i]; ?></td>
                        <td><?php echo number_format($totalPrice[$i],2,"."); ?></td>
                    </tr>
                    <?php
                     } 
                    ?>
                    
                </table>
                <?php    
                
            }

        }
        return calc();
    
    ?>
    </center>
</body>
</html>