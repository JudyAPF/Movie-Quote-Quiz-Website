<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Quote Quiz Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/labactivity3_submit.css">
</head>

<body>
    <div class="container-sm">
        <h1>Movie Quote Quiz Results</h1>
        <?php
        // Define the shuffled answer key in the same order as shuffled questions
        $shuffledAnswerKey = [
            "Star Wars: The Empire Strikes Back",
            "A Most Violent Year",
            "Harry Potter and the Prisoner of Azkaban",
            "Rudy",
            "Rocky Balboa",
            "Kung Fu Panda",
            "Spider-Man",
            "Home Alone 2: Lost in New York",
            "Titanic",
            "The Dark Knight"
        ];

        // Define the original answer key
        $answerKey = [
            "Star Wars: The Empire Strikes Back",
            "A Most Violent Year",
            "Harry Potter and the Prisoner of Azkaban",
            "Rudy",
            "Rocky Balboa",
            "Kung Fu Panda",
            "Spider-Man",
            "Home Alone 2: Lost in New York",
            "Titanic",
            "The Dark Knight"
        ];

        // Shuffle the answer key
        shuffle($shuffledAnswerKey);

        // Define the questions array with data
        $questions = [
            [
                "question" => "\"Do or do not. There is no try.\"",
                "options" => ["Star Wars: The Empire Strikes Back", "A Most Violent Year", "Harry Potter and the Prisoner of Azkaban", "Rudy"],
            ],
            [
                "question" => "\"When it feels scary to jump, that is exactly when you jump, otherwise you end up staying in the same place your whole life.\"",
                "options" => ["A Most Violent Year", "Harry Potter and the Prisoner of Azkaban", "Rudy", "Rocky Balboa"],
            ],
            [
                "question" => "\"Happiness can be found even in the darkest of times, if only one remembers to turn on the light.\"",
                "options" => ["Harry Potter and the Prisoner of Azkaban", "Rudy", "Rocky Balboa", "Kung Fu Panda",],
            ],
            [
                "question" => "\"In this lifetime you don't have to prove nothing to nobody, except yourself.\"",
                "options" => ["Rocky Balboa", "Rudy", "Kung Fu Panda", "Spider-Man"],
            ],
            [
                "question" => "\"It's about how hard you can get hit and keep moving forward.\"",
                "options" => ["Kung Fu Panda", "Rocky Balboa", "Spider-Man", "Home Alone 2: Lost in New York"],
            ],
            [
                "question" => "\"Yesterday is history, tomorrow is a mystery, but today is a gift. That is why it is called the present.\"",
                "options" => ["Spider-Man", "Kung Fu Panda", "Home Alone 2: Lost in New York", "Titanic"],
            ],
            [
                "question" => "\"With great power, comes great responsibility.\"",
                "options" => ["Titanic", "Home Alone 2: Lost in New York", "Spider-Man", "The Dark Knight"],
            ],
            [
                "question" => "\"I think so. Your heart might still be broken, but it isn't gone. If it was gone, you wouldn't be nice.\"",
                "options" => ["The Dark Knight", "Titanic", "Home Alone 2: Lost in New York", "Star Wars: The Empire Strikes Back"],
            ],
            [
                "question" => "\"Promise me you'll survive. That you won't give up, no matter what happens. No matter how hopeless.\"",
                "options" => ["A Most Violent Year", "Star Wars: The Empire Strikes Back", "The Dark Knight", "Titanic"],
            ],
            [
                "question" => "\"If you're good at something, never do it for free.\"",
                "options" => ["Harry Potter and the Prisoner of Azkaban", "A Most Violent Year", "Star Wars: The Empire Strikes Back", "The Dark Knight"],
            ]
        ];

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
            // Retrieve the shuffled question indexes from the form
            $questionIndexes = explode(',', $_POST["questionIndexes"]);

            // Create an array to store the correct answers in the order of the shuffled questions
            $correctAnswers = [];
            foreach ($questionIndexes as $index) {
                $correctAnswers[] = $answerKey[$index];
            }

            // Get user answers from the form inputs
            $userAnswers = [];
            for ($i = 0; $i < count($questionIndexes); $i++) {
                $questionIndex = $questionIndexes[$i];
                $userAnswers[] = $_POST["question{$questionIndex}"];
            }

            // Call the gradeQuiz function and store the result
            $quizResult = gradeQuiz($userAnswers, $correctAnswers);

            // Display the user's score and all questions with correct and wrong answers
            if (($quizResult['score']) == 0) {
                echo "<h3>Unfortunately, {$_POST['studentName']}, you got {$quizResult['score']}/10.</h3><br>";
            } else {
                echo "<h3>Congratulations {$_POST['studentName']}, you got {$quizResult['score']}/10!</h3><br>";
            }

            // Display all questions with correct and wrong answers
            for ($i = 0; $i < count($questionIndexes); $i++) {
                $questionIndex = $questionIndexes[$i];
                $question = $questions[$questionIndex]["question"];
                $userAnswer = $userAnswers[$i];
                $correctAnswer = $correctAnswers[$i];
                echo "<fieldset>";
                echo "<legend>" . ($questionIndex + 1) . ". " . "$question</legend>";
                echo "</fieldset>";
                echo "<p>Your Answer: $userAnswer</p>";

                if ($userAnswer === $correctAnswer) {
                    echo "<label>Correct Answer: $correctAnswer</label>";
                    echo "<label style='color: green;'>Correct</label>";
                } else {
                    echo "<label>Correct Answer: $correctAnswer</label>";
                    echo "<label style='color: red;'>Wrong</label>";
                }
                echo "<hr>";
            }
        }

        function gradeQuiz($userAnswers, $shuffledAnswerKey)
        {
            $score = 0;
            $errors = [];

            for ($i = 0; $i < count($userAnswers); $i++) {
                if ($userAnswers[$i] === $shuffledAnswerKey[$i]) {
                    $score += 1;
                } else {
                    $errors[] = "Question #" . ($i + 1) . ": You answered \"{$userAnswers[$i]}\", but the correct answer is \"{$shuffledAnswerKey[$i]}\"";
                }
            }

            return ['score' => $score, 'errors' => $errors];
        }
        ?>
    </div>
</body>

</html>