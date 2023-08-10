<?php
// верстать я не умею, поэтому использовал автоверстку, ну и понятно добавил все, что мне нужно было по php из контроллера
?>

<!DOCTYPE html>
<html>
<head>
  <title>Weather App</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
  <style>
    body {
      background-color: white;
    }

    .container {
      margin-top: 50px;
    }

    .form {
      margin-bottom: 20px;
    }

    .text {
      width: 300px;
    }

    .submit {
      padding: 10px 20px;
      background-color: #4CAF50;
      color: white;
      border: none;
      cursor: pointer;
      font-family: Arial, sans-serif;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }

    .submit:hover {
      background-color: #45a049;
    }

    .widget {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-top: 20px;
      background-color: #f5f5f5;
      border-radius: 5px;
      padding: 20px;
    }

    .weatherIcon img {
      width: 100px;
      height: 100px;
    }

    .temperature {
      font-size: 36px;
      font-weight: bold;
      margin: 10px 0;
    }

    .description {
      margin-bottom: 5px;
    }

    .weatherCondition {
      font-weight: bold;
    }

    .place {
      font-style: italic;
    }

    .date {
      margin-top: 10px;
      font-style: italic;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="form">
      <form method="post">
        <div class="form-group">
          <label for="cityInput">Введи название города:</label>
          <input type="text" id="cityInput" class="form-control text" name="city" value="<?php echo isset($city) ? $city : '' ?>">
        </div>
        <button type="submit" class="btn btn-primary submit" name="submit">Погода</button>
      </form>
    </div>

    @if (isset($status) && $status == "yes")
    <div class="widget"> 
      <div class="weatherIcon"> 
        <img src="http://openweathermap.org/img/wn/{{ $result['weather'][0]['icon'] }}@4x.png"> 
      </div> 
      <div class="weatherInfo"> 
        <div class="temperature"> 
          <span>{{ $temperature }}°</span> 
        </div> 
        <div class="description"> 
          <div class="weatherCondition">Город</div> 
          <div class="place">{{ $result['name'] }}</div> 
        </div> 
        <div class="description"> 
          <div class="weatherCondition">Ветер</div> 
          <div class="place">{{ $windSpeed }} M/H</div> 
        </div> 
        <div class="description"> 
          <div class="weatherCondition">Давление</div> 
          <div class="place">{{ $pressure }} hPa</div> 
        </div> 
        <div class="description"> 
          <div class="weatherCondition">Влажность</div> 
          <div class="place">{{ $humidity }}%</div> 
        </div> 
      </div> 
      <div class="date"> 
        {{ date('d M', $result['dt']) }} 
      </div> 
    </div> 
    @endif
  </div>
</body>
</html>