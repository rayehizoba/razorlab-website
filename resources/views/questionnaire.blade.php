<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questionnaire</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .question {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        input[type="radio"] {
            margin-right: 10px;
            display: none;
        }

        .option-label {
            display: inline-block;
            vertical-align: middle;
            cursor: pointer;
            padding: 8px 16px;
            background-color: #f9f9f9;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .option-label:hover {
            background-color: #e0e0e0;
        }

        button[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <form id="questionnaireForm">
        @csrf
        @foreach ($questions as $key => $question)
            <div class="question">
                <label>{{ $question }}</label>
                <div>
                    <input type="radio" id="option1_{{ $key }}" name="answer{{ $key + 1 }}" value="option1">
                    <label class="option-label" for="option1_{{ $key }}">On-demand service marketplace app</label>
                </div>
                <div>
                    <input type="radio" id="option2_{{ $key }}" name="answer{{ $key + 1 }}" value="option2">
                    <label class="option-label" for="option2_{{ $key }}">E-commerce (store, e-catalogue, loyalty, etc.)</label>
                </div>
                <div>
                    <input type="radio" id="option3_{{ $key }}" name="answer{{ $key + 1 }}" value="option3">
                    <label class="option-label" for="option3_{{ $key }}">Option 3</label>
                </div>
            </div>
        @endforeach

        <button type="submit">Submit</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // jQuery code to handle dynamic question display and form submission via AJAX
    $(document).ready(function() {
        $('#questionnaireForm').submit(function(event) {
            event.preventDefault();
            
            // Collect form data
            const formData = new FormData(this);
            
            // Submit form data via AJAX
            $.ajax({
                url: '/questionnaire/submit',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    console.log(data);
                    alert(data.message);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
    });
</script>

</body>
</html>
