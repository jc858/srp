<!DOCTYPE html>
<html lang="">
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <title>SRP - Gene Search</title>
        <meta name="Author" content=""/>
        <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="navbar">
    <a href="srp.html">main</a>
    <a href="srpabout.html">about</a>
    <a href="srpdata.html">data</a>
    <a href="srpfigures.html">figures</a>
    <a class="active" href="srpsearch.html">gene search</a>
</div>

<div class="title">
<h2>
        Search Results
</h2>
</div>

<div class="main">
<p>
<?php
$config = parse_ini_file('search.ini');
$query = $_POST['search'];
$sql = "SELECT * FROM wilcox_genes WHERE Gene_name LIKE ('$query%')";
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
$result = $conn->query($sql);
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

if (strlen($query) > 0){
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			echo "<table cellspacing='3' bgcolor='#000000'>";
				echo "<tr bgcolor='#ffffff'>";
					echo "<th>Gene name</th>";
					echo "<th>HGNC symbol</th>";
					echo "<th>Gene type</th>";
					echo "<th>Gene version</th>";
					echo "<th>Gene % GC Content</th>";
					echo "<th>Cluster</th>";
				echo "</tr>";
				echo "<tr bgcolor='#ffffff'>";
					echo "<td>" . $row['Gene_name'] . "</td>";
					echo "<td>" . $row['HGNC_symbol'] . "</td>";
					echo "<td>" . $row['Gene_type'] . "</td>";
					echo "<td>" . $row['gene_version'] . "</td>";
					echo "<td>" . $row['Gene_percent_GC_content'] . "</td>";
					echo "<td>" . $row['cluster_wilcox'] . "</td>";
				echo "</tr>";
			echo "</table>";
		}
	}
	else {
		echo "no results";
	}
}
else {
	echo "Please enter something";
}
$conn->close();

?>
</p>
<p>
        <form>
                <input type="button" value="Go Back" onclick="history.back()">
        </form>
</p>
</div>
</body>
</html>


