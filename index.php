<html>
<head>

</head>
<body>
<?php
include_once 'Trello.class.php';


$res = Trello::GetBoardListsAndCards(BOARD_ID);

foreach($res as $board) {
    echo $board['name'] . sizeof($board['cards']);
    foreach($board['cards'] as $card) {
        echo $card['name'];
    }
    echo "<br/><br/>";
}

// Pretty print
function debug($var) { print '<pre>'; print_r($var); print '</pre>'; }

?>
</body>
</html>


