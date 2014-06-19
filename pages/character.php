<?php
$ch = new Unit($db);
if (isset($_POST['a'])) {
    $a = $_POST['a'];
    switch ($a) {
        case "upload_image":
            upload_image();
            echo $_POST['uid'];
            exit();
            break;
        case "edit_unit";
            $ch->process_input($_POST);
            exit();
            break;
    }
}
//$ch->process($_POST);
//print_r($ch->debug());

//print_r($_GET);


function upload_image() {
    if ($_FILES["file"]["error"] > 0) {
        echo "Error: " . $_FILES["file"]["error"] . "<br>";
    } else {
        $uid = $_POST['uid'];
        $to = "images/units/" . $uid . ".png";
        $from = "images/units/" . $_FILES['file']['name'];
        convert_to_png($from, $to);
    }
}
