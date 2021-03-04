
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$result = '';
if (array_key_exists('name', $_GET)) {
    $name = $_GET['name'];
    
}
if (array_key_exists('result', $_GET)) {
    $result = $_GET['result'];
}

if (array_key_exists('number', $_GET)) {
    $result = $result . $_GET['number'];
    
    header('location: ?result=' . $result);
}


$table = &$entries['table'];

$nr_list = json_decode(file_get_contents('phone_number.json'), true);
if (!is_array($nr_list)) {
    $nr_list = [];
}
if (array_key_exists('save', $_GET)) {
    $nr_list[] = $result;
    file_put_contents('phone_number.json', json_encode($nr_list, JSON_PRETTY_PRINT));
    header('location: ?result=');
}
// 
$name_list = json_decode(file_get_contents('phone_number.json'), true);
if (!is_array($name_list)) {
    $name_list = [];
}
if (array_key_exists('send_name', $_GET)) {
    $name_list[] = $name;
    file_put_contents('phone_number.json', json_encode($name_list, JSON_PRETTY_PRINT));
    header('location: ?name=' );
}

?>

<!-- Output part: -->
<link rel="stylesheet" href="style1.css">
<div class="container">



<?php
    $i = 9;
    while($i >= 0):?>
<a href="?number=<?=$i?>&result=<?=$result?>"><?=$i-- ; ?></a>
    <?php endwhile;?>
    <a href="?save&result=<?=$result?>">Save</a>
</div>

<h2>Dial: <span id="output"><?=$result; ?></span></h2>
<a href="index.php"><strong>Clear</strong></a><br>
<form action="#" method="GET">
<input type="name" name="name">
<input type="submit" name="send_name">
</form>

<?php
for($i = 0; $i < count($nr_list); $i++ ) {
    echo "<p>" . $nr_list[$i] .  "</p>";
}
print_r($nr_list);
?>
