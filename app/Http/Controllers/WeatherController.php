<?php
//Указываю неймспейс и импортирую все, что нужно. Без валидатора или guzzlehttp не работает
namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
//Воспользовался тем классом, который ларавел создал автоматически через консоль. Я не самый лучший в этом фреймворке и лучше использовать то, что есть из коробки
class WeatherController extends Controller
{
    public function getWeather(Request $request)
{
    $validator = Validator::make($request->all(), [
        'city' => 'required|string'
    ]);

    if ($validator->fails()) {
        return redirect('/')->withErrors($validator)->withInput();
    }

    $city = $request->input('city');
    $url = "https://api.openweathermap.org/data/2.5/weather";
    

    $client = new Client();
    $response = $client->get($url, [
        'query' => [
            'q' => $city,
            'units' => 'metric', // из непонятного тут будет только это наверное. Это я указываю метрическую систему, а то api использует другую
            'appid' => '594cf78aebd17591b564bee1d57fe801' // ключ, который openweathermap дает после регистрации
        ]
    ]);

    $result = json_decode($response->getBody(), true);
     // проверяю код запроса - они бывают разными и 404, 200 и... я сонный и не могу вспомнить какие там еще, кроме этих двоих
    if ($result['cod'] == 200) {
        $status = "yes";
        $temperature = round($result['main']['temp']);
        $weatherCondition = $result['weather'][0]['main'];//температура, которую перевел в метрическую систему - по сути, все что тут есть это ключ и значение из джейсона api сайта
        $windSpeed = $result['wind']['speed']; //скорость ветра
        $pressure = $result['main']['pressure']; // Атмосферное давление
        $humidity = $result['main']['humidity']; // Влажность
    } else {
        $msg = $result['message'];
        $status = "no";
    }
        //передаю это все представление и в файл с html страницей
    return view('weather', compact('status', 'result', 'msg', 'city', 'temperature', 'weatherCondition', 'windSpeed', 'pressure', 'humidity'));
}

}
