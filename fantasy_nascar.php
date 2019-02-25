<?php
    if(isset($_GET['year'])) {
        $url_year = $_GET['year'];
        $num_year = (int)$url_year;
        if($num_year < 2017 || $num_year > 2019) {
            header("Location: /fantasy_nascar.php?year=2019");
        } 
    } else {
        header("Location: /fantasy_nascar.php?year=2019");
    }      
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fantasy Nascar</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
    <link href="css/HSFM.css" rel="stylesheet">
    <link href="css/fantasy_nascar.css" rel="stylesheet">
    <style type="text/css">
        .year_pick {
            margin-top: 20px;
            margin-left: 100px;
            width: 80px;
        }

        @media screen and (max-width: 767px) {
            .year_pick {
                margin-top: 20px;
                margin-left: 0px;
                width: 80px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-inverse" style="margin-bottom: 0;">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
          </button>
          <a class="navbar-brand" data-toggle="tab" href="#tab1" style="font-style: italic; color: #4286f4;"><span style="color: yellow;">Fantasy</span><span style="color: red;">Nascar</span>League</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li class="active"><a data-toggle="tab" href="#tab1">Home</a></li>
            <li><a data-toggle="tab" href="#tab2">Schedule/Results</a></li>
            <li><a data-toggle="tab" href="#tab3">Standings</a></li>
            <li><a data-toggle="tab" href="#tab4">Teams</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="col-lg-1 col-lg-offset-10">
        <select id="league_year" class="form-control year_pick" onchange="putYearInURL()">
            <option value="2017" <?php if($_GET['year'] == '2017') echo "selected='selected'"; ?> >2017</option>
            <option value="2018" <?php if($_GET['year'] == '2018') echo "selected='selected'"; ?> >2018</option>
            <option value="2019" <?php if($_GET['year'] == '2019') echo "selected='selected'"; ?> >2019</option>
        </select>
    </div>

    <?php 
    include 'nascar_objects_methods.php';
    if($_GET['year'] == '2017') {
        include 'nascar_drivers_teams_2017.php';
        include 'nascar_results_2017.php';
    }
    if($_GET['year'] == '2018') {
        include 'nascar_drivers_teams_2018.php';
        include 'nascar_results_2018.php';
    }
    if($_GET['year'] == '2019') {
        include 'nascar_drivers_teams_2019.php';
        include 'nascar_results_2019.php';
    }
    ?>

    <div class="container-fluid">
        <div class="tab-content">
            <div id="tab1" class="tab-pane fade in active">
                <div class="row top_margin">
                    <div class="col-lg-8 col-lg-offset-2">
                        <h3 style="color: #fff;text-align: center;">Daytona International Speedway Driver Splits</h3>
                        <div class="table-responsive" style="border-right: 3px solid #fff; margin-top: 20px;margin-bottom: 20px;">       
                        <table class="table" style="color: #fff; border: 3px solid #fff; background-color: #194775;margin-bottom: 0px;">
                            <thead>
                                <tr>                    
                                    <th style='width: 162px';>Driver</th>
                                    <th>Starts</th>
                                    <th>Wins</th>
                                    <th>Avg Start Pos</th>
                                    <th>Avg Finish Pos</th>
                                    <th>Top 5</th>
                                    <th>Top 10</th>
                                    <th>Poles</th>
                                    <th>DNF</th>
                                    <th>Laps Led</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php get_driver_splits($team_roster, $_GET['year']); ?>
                            </tbody>
                        </table>
                        </div>
                    </div>  
                </div>  
            </div>
            
            <div id="tab2" class="tab-pane fade">

                <div class="row top_margin">
                    <div class="col-lg-2 col-lg-offset-5">
                        <select class="form-control" data-target=".my-scoreboard" id="theSelect">
                            <option value="one" data-show=".week1">Week 1 (Daytona)</option>
                            <option value="two" data-show=".week2" selected="selected">Week 2 (Atlanta)</option>
                            <option value="three" data-show=".week3">Week 3 (Las Vegas)</option>
                            <option value="four" data-show=".week4">Week 4 (Phoenix)</option>
                            <option value="five" data-show=".week5">Week 5 (Fontana)</option>
                            <option value="six" data-show=".week6">Week 6 (Martinsville)</option>
                            <option value="seven" data-show=".week7">Week 7 (Texas)</option>
                            <option value="eight" data-show=".week8">Week 8 (Bristol)</option>
                            <option value="nine" data-show=".week9">Week 9 (Richmond)</option>
                            <option value="ten" data-show=".week10">Week 10 (Talladega)</option>
                            <option value="eleven" data-show=".week11">Week 11 (Dover)</option>
                            <option value="twelve" data-show=".week12">Week 12 (Kansas)</option>
                            <option value="thirteen" data-show=".week13">Week 13 (Charlotte)</option>
                            <option value="fourteen" data-show=".week14">Week 14 (Pocono)</option>
                            <option value="fifteen" data-show=".week15">Week 15 (Michigan)</option>
                            <option value="sixteen" data-show=".week16">Week 16 (Sonoma)</option>
                            <option value="seventeen" data-show=".week17">Week 17 (Chicago)</option>
                            <option value="eighteen" data-show=".week18">Week 18 (Daytona)</option>
                            <option value="nineteen" data-show=".week19">Week 19 (Kentucky)</option>
                            <option value="twenty" data-show=".week20">Week 20 (New Hampshire)</option>
                            <option value="twenty-one" data-show=".week21">Week 21 (Pocono)</option>
                            <option value="twenty-two" data-show=".week22">Week 22 (Watkins Glen)</option>
                            <option value="twenty-three" data-show=".week23">Week 23 (Michigan)</option>
                            <option value="twenty-four" data-show=".week24">Week 24 (Bristol)</option>
                            <option value="twenty-five" data-show=".week25">Week 25 (Darlington)</option>
                            <option value="twenty-six" data-show=".week26">Week 26 (Indianapolis)</option>
                            
                            <?php 
                            if($_GET['year'] == '2017') {
                                echo '<option value="twenty-seven" data-show=".week27">Wild Card Round (Chicago)</option>';
                                echo '<option value="twenty-eight" data-show=".week28">Semi-Final Round (Weeks 28-31)</option>';
                                echo '<option value="twenty-nine" data-show=".week29">Championship (Weeks 32-36)</option>';
                            }
                            if($_GET['year'] == '2018') {
                                echo '<option value="twenty-seven" data-show=".week27">Week 27 (Las Vegas)</option>';
                                echo '<option value="twenty-eight" data-show=".week28">Wild Card Round (Richmond)</option>';
                                echo '<option value="twenty-nine" data-show=".week29">Semi-Final Round (Weeks 29-32)</option>';
                                echo '<option value="thirty" data-show=".week30">Championship (Weeks 33-36)</option>';
                            }
                            if($_GET['year'] == '2019') {
                                echo '<option value="twenty-seven" data-show=".week27">Week 27 (Las Vegas)</option>';
                                //echo '<option value="twenty-eight" data-show=".week28">Wild Card Round (Richmond)</option>';
                                //echo '<option value="twenty-nine" data-show=".week29">Semi-Final Round (Weeks 29-32)</option>';
                                //echo '<option value="thirty" data-show=".week30">Championship (Weeks 33-36)</option>';
                            }
                            ?>
                            
                        </select>
                        <h3 style="color: #fff;text-align: center;">Scoreboard</h3>
                    </div>
                </div>

                <div class="row">
                    <?php                    
                        $i = 1;
                        $w = ($_GET['year'] == '2017') ? 26 : 27;
                        while ($i <= $w) {
                            $j = ($i - 1) % 9;                       
                            get_matchups($teams_week, $i, $num_pairs[$j], $team_standings);
                            $i++;
                        }
                        if($_GET['year'] == '2017') {
                            get_wildcard_matchup($wildcard_teams, 27, true); 
                            get_semifinal_matchups($semifinal_teams, 28, true);
                            get_championship_matchup($championship_teams, 29, true);
                        } else if ($_GET['year'] == '2018') {
                            get_wildcard_matchup($wildcard_teams, 28, true);
                            get_semifinal_matchups($semifinal_teams, 29, true);
                            get_championship_matchup($championship_teams, 30, true);
                        }             
                    ?>
                </div>
            </div>

            <div id="tab3" class="tab-pane fade">
                <div class="row top_margin">
                    <div class="standings col-lg-4">
                        <h3 style="color: #fff;text-align: center;">Standings</h3>
                        <table class="table" style="color: #fff; border: 3px solid #fff; background-color: #194775;">
                            <thead>
                                <tr>                                        
                                    <th width="50%" style="border-right: 1px solid white">Team</th>
                                    <th width="10%" style="border-right: 1px solid white">W</th>
                                    <th width="10%" style="border-right: 1px solid white">L</th>
                                    <th width="10%" style="border-right: 1px solid white">Points</th>
                                    <th width="10%" style="border-right: 1px solid white">Strk</th>
                                    <th width="10%" style="border-right: 1px solid white">PA</th>                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php get_team_standings($team_standings); ?>                                                 
                            </tbody>
                        </table>
                    </div>

                    <div class="fantasy_pts_leaderboard col-lg-4 col-lg-offset-1">
                        <h3 style="color: #fff;text-align: center;">Fantasy Points Leaderboard</h3>
                        <div style="height:500px; overflow-y: scroll; margin-bottom: 40px;border: 2px solid #fff;">
                            <table class="table" style="color: #fff; border: 3px solid #fff; background-color: #194775;margin-bottom: 0px;">
                                <thead>
                                    <tr>
                                        <th width="2%" style="border-right: 1px solid white">Rank</th>                                        
                                        <th width="56%" style="border-right: 1px solid white">Driver</th>
                                        <th width="20%" style="border-right: 1px solid white">Points</th>
                                        <th width="20%" style="border-right: 1px solid white">Avg per Start</th>
                                        <th width="2%">Starts</th>                     
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $driver_rank = get_driver_standings($season_drivers, $_GET['year']); ?>
                                </tbody>
                            </table>
                        </div>          
                    </div>               
                </div>
            </div>

            <div id="tab4" class="tab-pane fade">
                <div class="row">
                    <?php get_team_rosters(0, 4, $team_roster, $driver_rank, false); ?>                       
                </div>

                <div class="row">
                    <?php get_team_rosters(4, 8, $team_roster, $driver_rank, false); ?>                       
                </div>

                <div class="row">
                    <?php get_team_rosters(8, 10, $team_roster, $driver_rank, true); ?>                      
                </div>
            </div>
        </div>   
    </div>    

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/toggle_nascar_scoreboard3.js"></script>
    <script>
        $(document).on('click','.navbar-collapse.in',function(e) {
            if( $(e.target).is('a') && $(e.target).attr('class') != 'dropdown-toggle' ) {
                $(this).collapse('hide');
            }
        });  
    </script>

    <script> function putYearInURL() {
        var year = document.getElementById("league_year").value;
        var url = location.href;
        url = url.substring(0, url.length - 4);
        url += year;
        window.location = url;
    }
    </script>

</body>
</html>