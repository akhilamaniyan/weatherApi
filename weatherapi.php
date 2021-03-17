<?php
        $weather ="";
        $error ="";

        if($_GET['city']){

        $urlContents= file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".urlencode($_GET['city'])."&appid=d80a5ec699b081856a095e863b6da642");
        $weatherArray=json_decode($urlContents,true);
if($weatherArray['cod']== 200){

   $weather ="The weather in ".$_GET['city']." is currently '" .$weatherArray['weather'][0]['description']."'.";
   $tempInCelcius =intval($weatherArray['main']['temp'] - 273);
   $fahrenheit=$tempInCelcius*9/5+32;
   $wind=intval(($weatherArray['wind']['speed'])*2.236);
   $weather .= "The temperature is " .$fahrenheit."&deg; and the windspeed is ".$wind."miles/hr.";
 }else{

        $error = "Couldn't find the city- please try again.";
        }
}
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Weather Scraper</title>
    <style type="text/css">
        html {
        background: url(background.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        }

        body{
         background:none;
        }

        .container{
         text-align:center;
         margin-top:100px;
         width:500px;
        }
        input{
                margin:20px;
        }
        #weather {
         margin-top:15px;
         width :500px;
        }
    </style>
  </head>
  <body>
        <div class="container">
        <h2>Whats the weather today?</h2>

        <form>
        <fieldset class="form-group">
        <label for="city">Enter the name of a city.</label>
        <input type="text" class="form-control" name="city" id="city" placeholder="Eg. London, Tokyo" value="<?php echo $_GET['city'];?>">
        </fieldset>

        <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <div id="weather"><?php
                if($weather){

                        echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';

                }else if($error){

                        echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';

                }

        ?></div>

        </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
  </body>
</html>
