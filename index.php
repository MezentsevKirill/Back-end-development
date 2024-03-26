<?php
$search = '';
if (!empty($_GET['search'])) {
    $search = $_GET['search'];
}
$apiKey = 'AIzaSyCoj9EMnclHNgeiJg9M77veTnGALAHLPxA';
$cx = '02c6944ef3e8c444f';
$url = "https://www.googleapis.com/customsearch/v1?key={$apiKey}&cx={$cx}&q={$search}";
$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL , $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$resultJson=curl_exec($ch);
curl_close($ch);
$obj = json_decode($resultJson, true);
$items = $obj["items"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<h2>My Browser</h2>
<form method="GET" action="index.php">
    <label for="search">Search:</label>
    <input type="text" id="search" name="search" value=""><br><br>
    <input type="submit" value="Submit"><br><br>
</ form >
<?php
$counter = 0;
for ($i=0; $i<count($items); $i++) {
    foreach ($items[$i] as $k => $v) {
        if (is_array($v)) {
            continue;
        } else {
            echo "$k : $v<br>";
        }
        if ($counter==$i) {
            continue;
        } else {
            echo '<br>';
            $counter+=1;
        }
    }
}
?>
</body>
</html>