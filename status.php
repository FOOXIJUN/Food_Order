<?php
require 'Connectdb.php';
?>
<?php

// Initialize variables
$currentStatus = "preparing";
$trackingNo = "";

// Check if a tracking number is provided
if (isset($_POST['tracking_number'])) {
    $trackingNo = trim($_POST['tracking_number']);//trim=ingore spacing

    // Query the database to retrieve the status based on the tracking number
    $sql = "SELECT status FROM orders WHERE tracking_no = '$trackingNo'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the row and get the value of the "status" column
        $row = $result->fetch_assoc();
        $currentStatus = $row["status"];
    } else {
        // Set a default status if no rows are found
        $currentStatus = "Not found";
        echo '<script>alert("Tracking number not valid! Please enter again.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<header>
   
       <style>
         * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Poppins", sans-serif;
            width: fit-content;
        }

        .step-wizard {
            height: 30vh;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .step-wizard-list {
            background: #fff;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
            color: #333;
            width: 200%;
            list-style-type: none;
            border-radius: 10px;
            display: flex;
            padding: 20px 10px;
            position: relative;
            z-index: 10;
            
        }

        .step-wizard-item {
            padding: 0 20px;
            flex-basis: 0;
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            max-width: 100%;
            display: flex;
            flex-direction: column;
            text-align: center;
            min-width: 170px;
            position: relative;
            
        }

        .step-wizard-item+.step-wizard-item:after { /*蓝色横线一条 */
            content: "";
            position: absolute;
            left: 0;
            top: 19px;
            background: #21d4fd;
            width: 100%;
            height: 2px;
            transform: translateX(-50%);
            z-index: -10;
            
        }
     
        .progress-count {
            height: 40px;
            width: 40px;
    font-size: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-weight: 600;
            margin: 0 auto;
            position: relative;
            z-index: 10;
            color: transparent;  /*隐藏字*/
            
        }
   
        .progress-count:after {  /*给蓝色圈圈*/
            content: "";/*没这个蓝色圈圈会不见掉没有content这个containner*/
            height: 40px;
            width: 40px;
            background: #21d4fd; /*蓝色圈圈*/
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);/*蓝色圈圈的位子*/
            border-radius: 50%;
            z-index: -10;
            
        }

        .progress-count:before {/*给全部给勾勾*/
            content: "";
            height: 10px;
            width: 20px;
            border-left: 3px solid #fff;
            border-bottom: 3px
            solid #fff;
position: absolute;
left: 50%;
top: 50%;
transform: translate(-50%, -60%) rotate(-45deg);
transform-origin: center center;
content: "\2713"; /*打勾/ right symbol */
font-size: 20px;
}

.progress-label {
    font-size: 18px;
    font-weight: 600;
    margin-top: 10px;
    
}

.current-item .progress-count:before,
.current-item~.step-wizard-item .progress-count:before {
    display: none; /*现在status和还没到现在status(过后的)全部display none for before(打勾勾)*/
    
}

.current-item~.step-wizard-item .progress-count:after {
    height: 12px;
    width: 12px;
}

.current-item~.step-wizard-item .progress-label {
    opacity: 0.5;
}
.current-item .progress-count:after{  /*选择的球白掉*/
    color: black;
    border: 2px solid #21d4fd;
}

.current-item .progress-count{
    color: black;
    position: relative;
    z-index: 20; /* Set a higher z-index value to bring the font to the front */
} 


.lg
{
    background-image: url("menu/logo_nb.png");
            width: 250px;
            height: 250px;
            margin:auto;
            background-size: contain;  /*符合border的大小*/
            background-repeat: no-repeat;
            background-position: center;
            margin-bottom: 20px;
            padding: -100px;
}
.nav-item{
      display: none;
    }
        /* delivery status checking icon */
        .cdit{
      display:none;
    }
</style>
</header>
<?php
include('userheader.php');
?>
<body>
    <section>
        <div class="lg"></div>
        <form method="POST" action="">
            <input type="text" style="margin-left:20px; margin-right: 20px; height:45px; width:460px; border:1px black solid; padding: 5px;" name="tracking_number" placeholder="     Enter tracking number" required>
            <button type="submit" style="margin-left:20px;">Search</button>
        </form>
    </section>

    <?php if ($trackingNo !== "" && $currentStatus !== "Not found") : ?>
        <section class="step-wizard">
       
            <ul class="step-wizard-list">
        <li class="step-wizard-item<?php echo ($currentStatus == "checkout") ? ' current-item' : ''; ?>">
            <span class="progress-count">1</span>
            <span class="progress-label">Checkout</span>
        </li>
        <li class="step-wizard-item<?php echo ($currentStatus == "preparing") ? ' current-item' : ''; ?>">
            <span class="progress-count">2</span>
            <span class="progress-label">Preparing</span>
        </li>
        <li class="step-wizard-item<?php echo ($currentStatus == "delivering") ? ' current-item' : ''; ?>">
            <span class="progress-count">3</span>
            <span class="progress-label">Delivering</span>
        </li>
        <li class="step-wizard-item<?php echo ($currentStatus == null) ? ' current-item' : ''; ?>">
    <span class="progress-count" >4</span>
    <span class="progress-label">Success</span>
</li>
<div style="display: none;">
            </ul>
        </section>
    <?php endif; ?>

    <section>
        <?php if ($trackingNo !== "" && $currentStatus !== "Not found") : ?>
            <h3 style="padding: 5px; margin-top:-40px ">Tracking Number: <?php echo $trackingNo; ?></h3>
            <h4 style="padding: 5px;">Current Status: <?php echo $currentStatus; ?></h4>
        <?php endif; ?>
    </section>

    <?php
    include('userfooter.php');
    ?>
</body>
</html>