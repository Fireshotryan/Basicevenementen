<?php
//Check if data is valid & generate error if not so
$errors = [];

if ($name == "") {
    $errors['evname'] = 'Evenement cannot be empty';
}
if ($description == "") {
    $errors['description'] = 'Description cannot be empty';
}

if ($date == "") {
    $errors['date'] = 'Date cannot be empty';
}
