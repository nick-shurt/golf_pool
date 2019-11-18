<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Golf Pool</title>
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

        html, body {
            overflow-x: hidden;
        }

        body {
            /*background: url("https://amp.businessinsider.com/images/5cb37d0daefeef046521f545-750-419.jpg") no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;*/
            background: black;
            position: relative;
        }

        #wrapper {
            width: 100%;
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        a, a:hover, a:active, a:visited, a:focus {
            color: #fff;
            text-decoration: none; 
            background-color: none;
        }

        .scorecard {
            width: 100%;
        }

        .scorecard td {
            border: 1px solid #4f4f4f;
            text-align: center;
            width: 8.5%;
            padding: 7px 3px;
            font-size: 13px;
            font-family: Roboto Condensed,sans-serif;
        }

        .rounds td {
            border: 3px solid #4f4f4f;
            text-align: center;
            padding: 7px 7px;
            font-size: 13px;
            font-family: Roboto Condensed,sans-serif;
            border-radius: 50%;
            color: white;
            height: 34px;
            width: 34px;
        }

        .rounds {
            border-collapse: separate;
            border-spacing: 10px;
            margin-bottom: 10px;
        }

        .front_back td {
            border: 1px solid #4f4f4f;
            text-align: center;
            padding: 5px 10px;
            border-radius: 5px 5px 0 0;
            border-bottom: none;
            margin-right: 5px;
        }

        .front_back {
            border-collapse: separate;
            border-spacing: 0;
        }

        .tabs {
            color: #e4e4e4;
        }

        .selected {
            color:#fff; 
            background-color: #333333;
        }

        .main {
            position: relative;
            height: 90px;
            padding: 15px 7px 15px 0;
        }

        .header-photo {
            display: block;
            position: absolute;
        }

        .header-info {
            position: absolute;
            left: 80px;
        }

        .header-info h4 {
            font-size: 26px;
        }

        img {
            height: auto;
            vertical-align: middle;
            max-width: 65px;
            max-height: 65px;
            border: 0;
            border-radius: 50%;
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
        <?php if (!$is_started) { echo "<button type='button' class='btn btn-primary' style='display: flex;justify-content: center;' onclick='formRedirect()'>Sign Up for the Pool</button>"; } ?>
    </div>
    <br>
    <div class="container-fluid">
        <div class="row top_margin">
            <div class="col-lg-12">
                <div id="costumModal9" class="modal fade" data-easein="expandIn"  tabindex="-1" role="dialog" aria-labelledby="costumModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="top:5%;">
                        <div class="modal-content" style="border-radius: 10px;">
                            <div class="modal-header" style="background-color: #00213d; border-radius: 7px 7px 0 0; padding: 15px 15px 15px 10px;">
                                <div class="main">
                                    <div class="header-photo">
                                        <img class="photo" id="player_face" src="">
                                    </div>
                                    <div class="header-info">
                                        <h4 class="modal-title text-nowrap" id="modalHeader" style="color: #e4e4e4;"></h4>
                                        <div>
                                            <span id="player_country" style="color: #e4e4e4; font-size: 14.5px; font-family: Roboto Condensed,sans-serif; font-weight: 400;">
                                                <img src="" id="player_flag" style="border-radius: 0; margin-right: 1px;">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-body" style="background-color: #00213d;">
                                <div class="score_info" style="color: #e4e4e4;">
                                    <h2 id="overallScore" style="margin: 0; font-stretch: expanded;"></h2>
                                    <h4 id="todayScore" style="margin: 15px 0 0 0; font-size: 16px; padding-top: 18px; border-top: 1px solid #49495c;"></h4>
                                    <h4 id="round" style="margin: 5px 0 25px 0; padding-bottom: 18px; border-bottom: 1px solid #49495c; font-size: 16px;">Round: 4</h4>
                                </div>

                                <!-- <table class="rounds">
                                    <tr>
                                        <td>1</td>
                                        <td>2</td>
                                        <td>3</td>
                                        <td>4</td>
                                    </tr>
                                </table> -->
                                <table class="front_back">
                                    <tbody>
                                        <tr>
                                            <td class="tabs selected" id="front9" onclick="showStuff(this)">Front 9</td>
                                            <td style="border:none;width: 5px;"></td>
                                            <td class="tabs" id="back9" onclick="showStuff(this)">Back 9</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="scorecard" id="front-9">
                                    <tbody id="front9_body">
                                    </tbody>
                                </table>

                                <table class="scorecard" id="back-9" style="display:none;">
                                    <tbody id="back9_body">
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer" style="background-color: #00213d; border-radius: 0 0 7px 7px;">
                                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

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

                        if ($is_started) {
                            echo "<td style='border-right: 3px solid #a3a6a8;background:";
                            echo ($entries[$i]->get_golfer_isWorst(1)) ? "#af4141'><a class='names' href='#costumModal9' data-toggle='modal'>(" : "#133451'><a class='names' href='#costumModal9' data-toggle='modal'>(";
                            echo $entries[$i]->get_golfer_thru(1);
                            echo ") ";
                            echo $entries[$i]->get_golfer_name(1)[0] . ". " . strstr($entries[$i]->get_golfer_name(1), " ");
                            echo "<input type='hidden' id='fullName' name='fullName' value='" . $entries[$i]->get_golfer_name(1) . " " . $entries[$i]->get_golfer_place(1) . " " . $entries[$i]->get_golfer_today(1) . "'><strong>:</strong> ";
                            echo ($entries[$i]->get_golfer_score(1) >= 0) ? ($entries[$i]->get_golfer_score(1) > 0 ? ($entries[$i]->get_golfer_score(1) > 40 ? "--" : "+" . $entries[$i]->get_golfer_score(1)) : "E") : $entries[$i]->get_golfer_score(1);                   
                            echo "</a></td>";
                        } else {
                            echo "<td style='border-right: 3px solid #a3a6a8;background:#133451;font-style:oblique;'>";
                            echo "-- Hidden --";
                            echo "</td>";
                        }
                            
                        if ($is_started) {
                            echo "<td style='border-right: 3px solid #a3a6a8;background:";
                            echo ($entries[$i]->get_golfer_isWorst(2)) ? "#af4141'><a class='names' href='#costumModal9' data-toggle='modal'>(" : "#133451'><a class='names' href='#costumModal9' data-toggle='modal'>(";
                            echo $entries[$i]->get_golfer_thru(2);
                            echo ") ";
                            echo $entries[$i]->get_golfer_name(2)[0] . ". " . strstr($entries[$i]->get_golfer_name(2), " ");
                            echo "<input type='hidden' id='fullName' name='fullName' value='" . $entries[$i]->get_golfer_name(2) . " " . $entries[$i]->get_golfer_place(2) . " " . $entries[$i]->get_golfer_today(2) . "'><strong>:</strong> ";
                            echo ($entries[$i]->get_golfer_score(2) >= 0) ? ($entries[$i]->get_golfer_score(2) > 0 ? ($entries[$i]->get_golfer_score(2) > 40 ? "--" : "+" . $entries[$i]->get_golfer_score(2)) : "E") : $entries[$i]->get_golfer_score(2);                   
                            echo "</a></td>";
                        } else {
                            echo "<td style='border-right: 3px solid #a3a6a8;background:#133451;font-style:oblique;'>";
                            echo "-- Hidden --";
                            echo "</td>";
                        }

                        echo "<td rowspan='2' style='border-bottom: 8px solid #a3a6a8;background:#133451'>";
                        echo ($entries[$i]->get_total() >= 0) ? ($entries[$i]->get_total() > 0 ? "+" . $entries[$i]->get_total() : "E") : $entries[$i]->get_total();
                        echo "</td>";
                        echo "</tr>";
                        echo "<tr>";

                        if ($is_started) {
                            echo "<td style='border-right: 3px solid #a3a6a8;border-bottom: 8px solid #a3a6a8;background:";
                            echo ($entries[$i]->get_golfer_isWorst(3)) ? "#af4141'><a class='names' href='#costumModal9' data-toggle='modal'>(" : "#133451'><a class='names' href='#costumModal9' data-toggle='modal'>(";
                            echo $entries[$i]->get_golfer_thru(3);
                            echo ") ";
                            echo $entries[$i]->get_golfer_name(3)[0] . ". " . strstr($entries[$i]->get_golfer_name(3), " ");
                            echo "<input type='hidden' id='fullName' name='fullName' value='" . $entries[$i]->get_golfer_name(3) . " " . $entries[$i]->get_golfer_place(3) . " " . $entries[$i]->get_golfer_today(3) . "'><strong>:</strong> ";
                            echo ($entries[$i]->get_golfer_score(3) >= 0) ? ($entries[$i]->get_golfer_score(3) > 0 ? ($entries[$i]->get_golfer_score(3) > 40 ? "--" : "+" . $entries[$i]->get_golfer_score(3)) : "E") : $entries[$i]->get_golfer_score(3);                   
                            echo "</td>";
                        } else {
                            echo "<td style='border-right: 3px solid #a3a6a8;border-bottom: 8px solid #a3a6a8;background:#133451;font-style:oblique;'>";
                            echo "-- Hidden --";
                            echo "</a></td>";
                        }

                        if ($is_started) {
                            echo "<td style='border-right: 3px solid #a3a6a8;border-bottom: 8px solid #a3a6a8;background:";
                            echo ($entries[$i]->get_golfer_isWorst(4)) ? "#af4141'><a class='names' href='#costumModal9' data-toggle='modal'>(" : "#133451'><a class='names' href='#costumModal9' data-toggle='modal'>(";
                            echo $entries[$i]->get_golfer_thru(4);
                            echo ") ";
                            echo $entries[$i]->get_golfer_name(4)[0] . ". " . strstr($entries[$i]->get_golfer_name(4), " ");
                            echo "<input type='hidden' id='fullName' name='fullName' value='" . $entries[$i]->get_golfer_name(4) . " " . $entries[$i]->get_golfer_place(4) . " " . $entries[$i]->get_golfer_today(4) . "'><strong>:</strong> ";
                            echo ($entries[$i]->get_golfer_score(4) >= 0) ? ($entries[$i]->get_golfer_score(4) > 0 ? ($entries[$i]->get_golfer_score(4) > 40 ? "--" : "+" . $entries[$i]->get_golfer_score(4)) : "E") : $entries[$i]->get_golfer_score(4);                   
                            echo "</td>";
                        } else {
                            echo "<td style='border-right: 3px solid #a3a6a8;border-bottom: 8px solid #a3a6a8;background:#133451;font-style:oblique;'>";
                            echo "-- Hidden --";
                            echo "</a></td>";
                        }

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
                        echo "<a href='#costumModal9' role='button' class='btn btn-default' data-toggle='modal'><tr>";
                        echo "<td style='border-right: 3px solid #a3a6a8;border-bottom: 8px solid #a3a6a8;background:#133451'>";
                        echo $entries[$i]->get_name();
                        echo " &nbsp;(T: ";
                        echo $entries[$i]->get_tiebreaker();
                        echo ")";
                        echo "</td></a>";

                        if ($is_started) {
                            echo "<td style='border-bottom: 8px solid #a3a6a8;background:#133451;border-right: 3px solid #a3a6a8;background:";
                            echo ($entries[$i]->get_golfer_isWorst(1)) ? "#af4141'>(" : "#133451'>(";
                            echo $entries[$i]->get_golfer_thru(1);
                            echo ") ";
                            echo $entries[$i]->get_golfer_name(1)[0] . ". " . strstr($entries[$i]->get_golfer_name(1), " ");
                            echo "<strong>:</strong> ";
                            echo ($entries[$i]->get_golfer_score(1) >= 0) ? ($entries[$i]->get_golfer_score(1) > 0 ? ($entries[$i]->get_golfer_score(1) > 40 ? "--" : "+" . $entries[$i]->get_golfer_score(1)) : "E") : $entries[$i]->get_golfer_score(1);
                            echo "</td>"; 
                        } else {
                            echo "<td style='border-bottom: 8px solid #a3a6a8;background:#133451;border-right: 3px solid #a3a6a8;background:#133451;font-style:oblique;'>";
                            echo "-- Hidden --";
                            echo "</td>"; 
                        }
                        
                        if ($is_started) {
                            echo "<td style='border-bottom: 8px solid #a3a6a8;background:#133451;border-right: 3px solid #a3a6a8;background:";
                            echo ($entries[$i]->get_golfer_isWorst(2)) ? "#af4141'>(" : "#133451'>(";
                            echo $entries[$i]->get_golfer_thru(2);
                            echo ") ";
                            echo $entries[$i]->get_golfer_name(2)[0] . ". " . strstr($entries[$i]->get_golfer_name(2), " ");
                            echo "<strong>:</strong> ";
                            echo ($entries[$i]->get_golfer_score(2) >= 0) ? ($entries[$i]->get_golfer_score(2) > 0 ? ($entries[$i]->get_golfer_score(2) > 40 ? "--" : "+" . $entries[$i]->get_golfer_score(2)) : "E") : $entries[$i]->get_golfer_score(2);
                            echo "</td>"; 
                        } else {
                            echo "<td style='border-bottom: 8px solid #a3a6a8;background:#133451;border-right: 3px solid #a3a6a8;background:#133451;font-style:oblique;'>";
                            echo "-- Hidden --";
                            echo "</td>"; 
                        }

                        if ($is_started) {
                            echo "<td style='border-bottom: 8px solid #a3a6a8;background:#133451;border-right: 3px solid #a3a6a8;background:";
                            echo ($entries[$i]->get_golfer_isWorst(3)) ? "#af4141'>(" : "#133451'>(";
                            echo $entries[$i]->get_golfer_thru(3);
                            echo ") ";
                            echo $entries[$i]->get_golfer_name(3)[0] . ". " . strstr($entries[$i]->get_golfer_name(3), " ");
                            echo "<strong>:</strong> ";
                            echo ($entries[$i]->get_golfer_score(3) >= 0) ? ($entries[$i]->get_golfer_score(3) > 0 ? ($entries[$i]->get_golfer_score(3) > 40 ? "--" : "+" . $entries[$i]->get_golfer_score(3)) : "E") : $entries[$i]->get_golfer_score(3);
                            echo "</td>"; 
                        } else {
                            echo "<td style='border-bottom: 8px solid #a3a6a8;background:#133451;border-right: 3px solid #a3a6a8;background:#133451;font-style:oblique;'>";
                            echo "-- Hidden --";
                            echo "</td>"; 
                        }

                        if ($is_started) {
                            echo "<td style='border-bottom: 8px solid #a3a6a8;background:#133451;border-right: 3px solid #a3a6a8;background:";
                            echo ($entries[$i]->get_golfer_isWorst(4)) ? "#af4141'>(" : "#133451'>(";
                            echo $entries[$i]->get_golfer_thru(4);
                            echo ") ";
                            echo $entries[$i]->get_golfer_name(4)[0] . ". " . strstr($entries[$i]->get_golfer_name(4), " ");
                            echo "<strong>:</strong> ";
                            echo ($entries[$i]->get_golfer_score(4) >= 0) ? ($entries[$i]->get_golfer_score(4) > 0 ? ($entries[$i]->get_golfer_score(4) > 40 ? "--" : "+" . $entries[$i]->get_golfer_score(4)) : "E") : $entries[$i]->get_golfer_score(4);
                            echo "</td>"; 
                        } else {
                            echo "<td style='border-bottom: 8px solid #a3a6a8;background:#133451;border-right: 3px solid #a3a6a8;background:#133451;font-style:oblique;'>";
                            echo "-- Hidden --";
                            echo "</td>"; 
                        }

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
        function formRedirect() {
            document.location.href='/golf_pool_signup.php';
        }
    </script>

    <script>
        function showStuff(element)  {
            var tabContents = document.getElementsByClassName('scorecard');
            for (var i = 0; i < tabContents.length; i++) { 
                tabContents[i].style.display = 'none';
            }
            
            var tabContentIdToShow = element.id.replace(/(\d)/g, '-$1');
            document.getElementById(tabContentIdToShow).style.display = 'inline-table';
        }
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.tabs',function () {
                $('.tabs').removeClass("selected");
                $(this).addClass("selected");
            });
        });
    </script>
        
    <script>
        $(document).ready(function() {
            $(document).on('click', '.names',function () {
                $('#overallScore').html("Overall: " + this.innerText.substring(this.innerText.indexOf(':') + 2) + " <span id='place' style='font-size: 18px;'></span>");

                var string = $(this).html().split('value=')[1];
                string = string.split('"')[1];
                var today = string.substring(string.lastIndexOf(" ") + 1);
                var cut = string.substring(0, string.lastIndexOf(" "));
                var name = cut.substring(0, cut.lastIndexOf(" "));
                var place = cut.substring(cut.lastIndexOf(" ") + 1);
                console.log(today + ', ' + name + ', ' + place);
                $('#modalHeader').html(name);
                $('#place').html("(Pos: " + place + ")");
                $('#todayScore').html("Today's Score: " + today);

                var scores = $.get('getScores.php?name=' + name);
                scores.success(function(data) {
                    var score_array = JSON.parse(data);
                    $('#front9_body').html(score_array[0]);
                    $('#back9_body').html(score_array[1]);
                });

                var info = $.get('getPlayerInfo.php?name=' + name);
                info.success(function(data) {
                    var data_array = JSON.parse(data);
                    $('#player_face').attr("src", data_array[0]);
                    $('#player_flag').attr("src", data_array[1]);
                    var flagHTML = $('#player_country').html();
                    flagHTML = flagHTML.substring(0, flagHTML.indexOf('>') + 1);
                    $('#player_country').html(flagHTML + ' ' + data_array[2]);
                });
            });
        });
    </script>

    <script>
        var isFirstShowCall = false;

        $('#costumModal9').on('show.bs.modal', function (e) {
            $('#back9').removeClass("selected");
            $('#front9').addClass("selected");
            document.getElementById("back-9").style.display = 'none';
            document.getElementById("front-9").style.display = 'inline-table';

            isFirstShowCall = !isFirstShowCall;
            if (isFirstShowCall) {
                e.preventDefault();
                window.setTimeout(function () {
                    $('#costumModal9').modal('show');
                }, 750)
            }
        });
    </script>
</body>
</html>