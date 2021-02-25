<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test web result layout</title>
    <style>
        .card {
            border: 1px solid;
            padding: 0.5rem;
            margin-bottom: 1rem;
        }

        .card-fail {
            color: hsl(0, 100%, 50%);
            background-color: hsl(0, 100%, 95%);
        }

        .card-pass {
            color: hsl(120, 100%, 25%);
            background-color: hsl(120, 100%, 95%);
            ;
        }
    </style>
</head>

<body>

    <?php

    require './sanitizeName.php';

    $dataset = [
        ['mario', 'Mario', __LINE__],
        ['mAriO', 'Mario', __LINE__],
        ['MARIO', 'Mario', __LINE__],
        ['De giovanni', 'De Giovanni', __LINE__],
        ['de giovanni', 'De Giovanni', __LINE__],
        ['de Giovanni', 'De Giovanni', __LINE__],
        ['de Giovanni ', 'De Giovanni', __LINE__],
        ['de Giovanni ', 'De Giovanni', __LINE__],
        ['de Giovanni ', 'De Giovanni', __LINE__],
        ['de 55 Giovanni', 'De Giovanni', __LINE__],
        ['Mario83', 'Mario', __LINE__],
        ['Mario@', 'Mario', __LINE__],
        ['Mario@ ', 'Mario', __LINE__],
        ['John Romita Sr.', 'John Romita Sr.', __LINE__],
        ['John Romita Jr.', 'John Romita Jr.', __LINE__],
        ['John Romita Jr.', 'John Romita Jr.', __LINE__],
        ['<h1>John123456789</h1>', 'John', __LINE__],
        ['<script>alert("ciccio")</script>', '', __LINE__],
        [' <h1> John123456789 </h1> ', 'John', __LINE__],

    ];

    foreach ($dataset as $row) {
        $text = $row[0];
        $atteso = $row[1];
        $line = $row[2];

        $result = sanitizeName($text);

        if ($result === $atteso) { ?>
            <div class="card card-pass">
                <?php echo "PASS: line: $line <br>" . "atteso $atteso" . gettype($atteso) . "<br>" . "trovato $result" . gettype($result) ?>
            </div>
        <?php } else { ?>
            
            <div class="card card-fail">
                <?php echo "FAIL: line: $line <br>" . "atteso $atteso" . gettype($atteso) . "<br>" . "trovato $result" . gettype($result); ?>
            </div>
        <?php }
    }?>

</body>

</html>