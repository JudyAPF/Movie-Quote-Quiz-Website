<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Quote Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/labactivity.css">
</head>

<body>
    <div class="container-sm">
        <h1>Movie Quote Quiz</h1>
        <form action="labactivity3_submit.php" method="POST">
            <div class="mb-3">
                <label for="studentName" class="form-label">Student Name:</label>
                <input type="text" class="form-control" id="studentName" name="studentName" required>
            </div>

            <?php
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

            // Create an array to store the original indexes of questions
            $questionIndexes = range(0, count($questions) - 1);

            // Shuffle the original question indexes
            shuffle($questionIndexes);

            // Create an array to store the original indexes of answers
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
            shuffle($answerKey);

            // Add a hidden input field to store shuffled question indexes
            echo '<input type="hidden" name="questionIndexes" value="' . implode(',', $questionIndexes) . '">';


            // Display questions and options
            foreach ($questionIndexes as $index) {
                $questionData = $questions[$index];
                echo "<fieldset>";
                echo "<legend>" . ($index + 1) . ". " . $questionData["question"] . "</legend>";

                // Shuffle the options for each question
                shuffle($questionData["options"]);

                foreach ($questionData["options"] as $option) {
                    echo "<label><input type='radio' name='question{$index}' value='{$option}' required> {$option}</label><br>";
                }

                echo "</fieldset>";
            }
            ?>
            <div>
                <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>