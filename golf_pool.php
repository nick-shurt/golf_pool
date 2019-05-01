<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Golf</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
    <style type="text/css">
        .next_race {
            color: #fff;
            border: 3px solid #a3a6a8;
            background-color: #333;
            margin: 0 auto;
            width: 75%;
        }

        .leaderboard {
            visibility: visible;
            position: absolute;
            width: 100%;
            top: 20px;
        }

        .leaderboard2 {
            visibility: hidden;
        }

        body {
            /*background: url("https://amp.businessinsider.com/images/5cb37d0daefeef046521f545-750-419.jpg") no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;*/
            background: black;
        }

        #wrapper {
            width: 100%;
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        @media screen and (max-width: 767px) {
            .next_race {
                color: #fff;
                border: 3px solid #a3a6a8;
                background-color: #333;
                margin: 0 auto;
                width:100%;
            }

            .leaderboard {
                visibility: hidden;
            }

            .leaderboard2 {
                visibility: visible;
                position: relative;
                /*top: -190px;*/
                border: none;
                width: 100%;
                font-size: 9px;
            }
        }
    </style>
</head>
<body >

    <?php
    include 'php_golf_pool.php';
    ?>
    <h1 style="text-align: Center; color: #fff"><?php echo $current_tourney; ?> Pool</h1>
    <h4 style="text-align: Center; color: #fff">Leader: <?php echo $obj->leaderboard->players[0]->player_bio->first_name . " " . $obj->leaderboard->players[0]->player_bio->last_name . " (" . $leader_score . ")" ; ?></h4>
    <div id="wrapper">
        <button type="button" class="btn btn-primary" style="display: flex;justify-content: center;" onclick="document.location.href='/golf_pool_signup.php';">Sign Up for the Pool</button>
    </div>
    <br>
    <div class="container-fluid">
        <div class="row top_margin">
            <div class="col-lg-12">
                <div class='table-responsive leaderboard2' style='margin-top: 20px;margin-bottom: 20px;'>
                    <table class='table next_race'>
                    <tr>
                        <th colspan="4" style="border: 3px solid #a3a6a8;background:#133451;text-align: center;font-size:20px;">Standings</th>
                    </tr>
                    <tr>
                        <th width="17%" style="border-right: 3px solid #a3a6a8;border-bottom: 8px solid #a3a6a8;background:#2f70a8;font-size:12px;">Entrant</th>
                        <th colspan="2" width="20%" style="border-right: 3px solid #a3a6a8;border-bottom: 8px solid #a3a6a8;background:#2f70a8;font-size:12px;text-align:center;">Golfers</th>
                        <th width="3%" style="border-bottom: 8px solid #a3a6a8;background:#2f70a8;font-size:10px;">Total</th>
                    </tr>
                    <?php
                    if ($rowCount == 0) {
                        echo "<tr><td colspan='4' style='border-bottom: 8px solid #a3a6a8;background:#2f70a8;font-size:10px;font-style:oblique;text-align:center;'>No entries have been created yet</td></tr>";
                    }
                    for ($i = 0; $i < $rowCount; $i++) {
                        $entries[$i]->get_total();
                        echo "<tr>";
                        echo "<td rowspan='2' style='border-right: 3px solid #a3a6a8;border-bottom: 8px solid #a3a6a8;background:#133451;'>";
                        $name = explode(" ",$entries[$i]->get_name(), 2);
                        echo $name[0];
                        echo "<br>";
                        echo $name[1];
                        echo "<br>(T: ";
                        echo $entries[$i]->get_tiebreaker();
                        echo ")";
                        echo "</td>";
                        echo "<td style='border-right: 3px solid #a3a6a8;background:";
                        echo ($entries[$i]->get_golfer_isWorst(1)) ? "#af4141'>(" : "#133451'>(";
                        echo $entries[$i]->get_golfer_thru(1);
                        echo ") ";
                        echo $entries[$i]->get_golfer_name(1)[0] . ". " . strstr($entries[$i]->get_golfer_name(1), " ");
                        echo "<strong>:</strong> ";
                        echo ($entries[$i]->get_golfer_score(1) >= 0) ? ($entries[$i]->get_golfer_score(1) > 0 ? "+" . $entries[$i]->get_golfer_score(1) : "E") : $entries[$i]->get_golfer_score(1);                   
                        echo "</td>";
                        echo "<td style='border-right: 3px solid #a3a6a8;background:";
                        echo ($entries[$i]->get_golfer_isWorst(2)) ? "#af4141'>(" : "#133451'>(";
                        echo $entries[$i]->get_golfer_thru(2);
                        echo ") ";
                        echo $entries[$i]->get_golfer_name(2)[0] . ". " . strstr($entries[$i]->get_golfer_name(2), " ");
                        echo "<strong>:</strong> ";
                        echo ($entries[$i]->get_golfer_score(2) >= 0) ? ($entries[$i]->get_golfer_score(2) > 0 ? "+" . $entries[$i]->get_golfer_score(2) : "E") : $entries[$i]->get_golfer_score(2);
                        echo "</td>";
                        echo "<td rowspan='2' style='border-bottom: 8px solid #a3a6a8;background:#133451'>";
                        echo ($entries[$i]->get_total() >= 0) ? ($entries[$i]->get_total() > 0 ? "+" . $entries[$i]->get_total() : "E") : $entries[$i]->get_total();
                        echo "</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td style='border-right: 3px solid #a3a6a8;border-bottom: 8px solid #a3a6a8;background:";
                        echo ($entries[$i]->get_golfer_isWorst(3)) ? "#af4141'>(" : "#133451'>(";
                        echo $entries[$i]->get_golfer_thru(3);
                        echo ") ";
                        echo $entries[$i]->get_golfer_name(3)[0] . ". " . strstr($entries[$i]->get_golfer_name(3), " ");
                        echo "<strong>:</strong> ";
                        echo ($entries[$i]->get_golfer_score(3) >= 0) ? ($entries[$i]->get_golfer_score(3) > 0 ? "+" . $entries[$i]->get_golfer_score(3) : "E") : $entries[$i]->get_golfer_score(3);
                        echo "</td>";
                        echo "<td style='border-right: 3px solid #a3a6a8;border-bottom: 8px solid #a3a6a8;background:";
                        echo ($entries[$i]->get_golfer_isWorst(4)) ? "#af4141'>(" : "#133451'>(";
                        echo $entries[$i]->get_golfer_thru(4);
                        echo ") ";
                        echo $entries[$i]->get_golfer_name(4)[0] . ". " . strstr($entries[$i]->get_golfer_name(4), " ");
                        echo "<strong>:</strong> ";
                        echo ($entries[$i]->get_golfer_score(4) >= 0) ? ($entries[$i]->get_golfer_score(4) > 0 ? "+" . $entries[$i]->get_golfer_score(4) : "E") : $entries[$i]->get_golfer_score(4);
                        echo "</td>";
                        echo "</tr>";
                    }

                    ?>
                    
                    </table>
                </div>

                <div class='table-responsive leaderboard' style='margin-top: 20px;margin-bottom: 20px;'>
                    <table class='table next_race'>
                    <tr>
                        <th colspan="6" style="border: 3px solid #a3a6a8;background:#133451;text-align:center;font-size:20px;">Standings</th>
                    </tr>
                    <tr>
                        <th width="19%" style="border-right: 3px solid #a3a6a8;border-bottom: 8px solid #a3a6a8;background:#2f70a8;">Entrant</th>
                        <th width="19%" style="border-right: 3px solid #a3a6a8;border-bottom: 8px solid #a3a6a8;background:#2f70a8;;">Tier 1 Golfer</th> 
                        <th width="19%" style="border-right: 3px solid #a3a6a8;border-bottom: 8px solid #a3a6a8;background:#2f70a8;;">Tier 2 Golfer</th> 
                        <th width="19%" style="border-right: 3px solid #a3a6a8;border-bottom: 8px solid #a3a6a8;background:#2f70a8;;">Tier 3 Golfer</th>
                        <th width="19%" style="border-right: 3px solid #a3a6a8;border-bottom: 8px solid #a3a6a8;background:#2f70a8;">Tier 4 Golfer</th>
                        <th width="5%" style="border-bottom: 8px solid #a3a6a8;background:#2f70a8;">Total</th>
                    </tr>
                    <?php
                    for ($i = 0; $i < $rowCount; $i++) {
                        echo "<tr>";
                        echo "<td style='border-right: 3px solid #a3a6a8;border-bottom: 8px solid #a3a6a8;background:#133451'>";
                        echo $entries[$i]->get_name();
                        echo " &nbsp;(T: ";
                        echo $entries[$i]->get_tiebreaker();
                        echo ")";
                        echo "</td>";
                        echo "<td style='border-bottom: 8px solid #a3a6a8;background:#133451;border-right: 3px solid #a3a6a8;background:";
                        echo ($entries[$i]->get_golfer_isWorst(1)) ? "#af4141'>(" : "#133451'>(";
                        echo $entries[$i]->get_golfer_thru(1);
                        echo ") ";
                        echo $entries[$i]->get_golfer_name(1)[0] . ". " . strstr($entries[$i]->get_golfer_name(1), " ");
                        echo "<strong>:</strong> ";
                        echo ($entries[$i]->get_golfer_score(1) >= 0) ? ($entries[$i]->get_golfer_score(1) > 0 ? "+" . $entries[$i]->get_golfer_score(1) : "E") : $entries[$i]->get_golfer_score(1);
                        echo "</td>";
                        echo "<td style='border-bottom: 8px solid #a3a6a8;background:#133451;border-right: 3px solid #a3a6a8;background:";
                        echo ($entries[$i]->get_golfer_isWorst(2)) ? "#af4141'>(" : "#133451'>(";
                        echo $entries[$i]->get_golfer_thru(2);
                        echo ") ";
                        echo $entries[$i]->get_golfer_name(2)[0] . ". " . strstr($entries[$i]->get_golfer_name(2), " ");
                        echo "<strong>:</strong> ";
                        echo ($entries[$i]->get_golfer_score(2) >= 0) ? ($entries[$i]->get_golfer_score(2) > 0 ? "+" . $entries[$i]->get_golfer_score(2) : "E") : $entries[$i]->get_golfer_score(2);
                        echo "</td>";
                        echo "<td style='border-bottom: 8px solid #a3a6a8;background:#133451;border-right: 3px solid #a3a6a8;background:";
                        echo ($entries[$i]->get_golfer_isWorst(3)) ? "#af4141'>(" : "#133451'>(";
                        echo $entries[$i]->get_golfer_thru(3);
                        echo ") ";
                        echo $entries[$i]->get_golfer_name(3)[0] . ". " . strstr($entries[$i]->get_golfer_name(3), " ");
                        echo "<strong>:</strong> ";
                        echo ($entries[$i]->get_golfer_score(3) >= 0) ? ($entries[$i]->get_golfer_score(3) > 0 ? "+" . $entries[$i]->get_golfer_score(3) : "E") : $entries[$i]->get_golfer_score(3);
                        echo "</td>";
                        echo "<td style='border-bottom: 8px solid #a3a6a8;background:#133451;border-right: 3px solid #a3a6a8;background:";
                        echo ($entries[$i]->get_golfer_isWorst(4)) ? "#af4141'>(" : "#133451'>(";
                        echo $entries[$i]->get_golfer_thru(4);
                        echo ") ";
                        echo $entries[$i]->get_golfer_name(4)[0] . ". " . strstr($entries[$i]->get_golfer_name(4), " ");
                        echo "<strong>:</strong> ";
                        echo ($entries[$i]->get_golfer_score(4) >= 0) ? ($entries[$i]->get_golfer_score(4) > 0 ? "+" . $entries[$i]->get_golfer_score(4) : "E") : $entries[$i]->get_golfer_score(4);
                        echo "</td>";
                        echo "<td style='border-bottom: 8px solid #a3a6a8;background:#133451;'>";
                        echo ($entries[$i]->get_total() >= 0) ? ($entries[$i]->get_total() > 0 ? "+" . $entries[$i]->get_total() : "E") : $entries[$i]->get_total();
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                    </table>
                </div>
            </div>
        </div>   
    </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $(document).on('click','.navbar-collapse.in',function(e) {
            if( $(e.target).is('a') && $(e.target).attr('class') != 'dropdown-toggle' ) {
                $(this).collapse('hide');
            }
        });  
    </script>
    <script>
        function setTableWidth() {
            var w = window,
            d = document,
            e = d.documentElement,
            g = d.getElementsByTagName('body')[0],
            x = w.innerWidth || e.clientWidth || g.clientWidth;

            alert(x);
        }
    </script>
</body>
</html>