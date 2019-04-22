<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
</style>
</head>
<body>

<?php include 'php_golf_pool_signup.php'; ?>

<div class="container">
  <form action="" method="POST">
    <div class="row">
      <div class="col-25">
        <label for="fname">Full Name:</label>
      </div>
      <div class="col-75">
        <input type="text" id="name" name="name" placeholder="Your name...">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="email">Email:</label>
      </div>
      <div class="col-75">
        <input type="text" id="email" name="email" placeholder="Your email...">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="tier1">Tier 1 Golfer:</label>
      </div>
      <div class="col-75">
        <select id="tier1" name="tier1">
            <option value="dummy">-- Choose One --</option>
            <?php
            for ($i = 0; $i < sizeof($tier1_golfers); $i++) {
                echo "<option value='" . $tier1_golfers[$i] . "'>" . $tier1_golfers[$i] . "</option>";
            }
            ?>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="tier2">Tier 2 Golfer:</label>
      </div>
      <div class="col-75">
        <select id="tier2" name="tier2">
            <option value="dummy">-- Choose One --</option>
            <?php
            for ($i = 0; $i < sizeof($tier2_golfers); $i++) {
                echo "<option value='" . $tier2_golfers[$i] . "'>" . $tier2_golfers[$i] . "</option>";
            }
            ?>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="tier3">Tier 3 Golfer:</label>
      </div>
      <div class="col-75">
        <select id="tier3" name="tier3">
            <option value="dummy">-- Choose One --</option>
            <?php
            for ($i = 0; $i < sizeof($tier3_golfers); $i++) {
                echo "<option value='" . $tier3_golfers[$i] . "'>" . $tier3_golfers[$i] . "</option>";
            }
            ?>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="tier4">Tier 4 Golfer:</label>
      </div>
      <div class="col-75">
        <select id="tier4" name="tier4">
            <option value="dummy">-- Choose One --</option>
            <<?php
            for ($i = 0; $i < sizeof($tier4_golfers); $i++) {
                echo "<option value='" . $tier4_golfers[$i] . "'>" . $tier4_golfers[$i] . "</option>";
            }
            ?>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="tiebreak">Winning Score:</label>
      </div>
      <div class="col-75">
        <input type="text" id="score" name="score" placeholder="Your score...">
      </div>
    </div>
    <br>
    <br>
    <div class="row">
      <input name="submit" type="submit" value="Submit">
    </div>
  </form>
  <?php
  if (isset($_POST["submit"])) {
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['tier1']) && !empty($_POST['tier2']) && !empty($_POST['tier3']) && !empty($_POST['tier4']) && !empty($_POST['score'])) {
        $servername = "localhost";
        $username = "root";
        $password = "";

        $con = new mysqli($servername, $username, $password);
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }
        if (!mysqli_select_db($con, "golf_pool"))  {  
            echo "Unable to locate the database";   
            exit();  
        }

        $event_id = '012';
        $name = $_POST['name'];
        $email = $_POST['email'];
        $tier1 = $_POST['tier1'];
        $tier2 = $_POST['tier2'];
        $tier3 = $_POST['tier3'];
        $tier4 = $_POST['tier4'];
        $score = $_POST['score'];

        $sql = "INSERT INTO entries (event_id, name, email, tier1_golfer, tier2_golfer, tier3_golfer, tier4_golfer, score) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $con->prepare($sql)) {
            $stmt->bind_param("ssssssss", $event_id, $name, $email, $tier1, $tier2, $tier3, $tier4, $score);
            if ($stmt->execute()) {
                echo "<script type='text/javascript'>alert('You have successfully submitted your entry!');</script>";
                echo "<script type='text/javascript'>window.location = '/golf_pool.php';</script>";
            } else {
                echo "<script type='text/javascript'>alert('Error submitting entry');</script>";    
            }
        } else {
            echo "<script type='text/javascript'>alert('Error: Could not connect to database');</script>";
        }
    } else {
        echo "<br>You must fill out all the fields!";
    }
  }
  ?>
</div>

</body>
</html>