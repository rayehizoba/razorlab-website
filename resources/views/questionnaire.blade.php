<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questionnaire</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7fafc;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 50px auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
        }

        .question {
            margin-bottom: 20px;
            font-size: 20px;
        }

        .options ul {
            list-style-type: none;
            padding: 0;
        }

        .options ul li {
            margin-bottom: 15px;
            font-size: 18px;
        }

        label {
            font-size: 18px;
        }

        .button-container {
            text-align: center;
        }

        button {
            margin-top: 30px;
            padding: 15px 30px;
            font-size: 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Questionnaire</h1>
        <form action="{{ route('questionnaire', ['set' => $nextSetId]) }}" method="GET" id="questionForm">
            @csrf
            <div class="question">
                <strong>{{ $questionnaire['question'] }}</strong>
            </div>
            <div class="options" id="optionsContainer">
                <ul>
                    @foreach ($questionnaire['options'] as $option)
                        <li><input type="radio" name="question1" id="{{ $option }}" value="{{ $option }}"> <label for="{{ $option }}">{{ $option }}</label></li>
                    @endforeach
                </ul>
            </div>
            <div class="button-container">
                <input type="hidden" name="nextSetId" value="{{ $nextSetId }}">
                <button type="submit">Next</button>
            </div>
        </form>
    </div>
</body>
</html>
