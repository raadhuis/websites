<?
if (isset($report["Reportcategory"])) {

    if (isset($report["Reportcategory"]['icon'])) {
        echo "<i class='material-icons'>" . $report["Reportcategory"]['icon'] . "</i>";
    }
    echo $report["Reportcategory"]['name'];
} else {
    echo "<i class='material-icons'>help</i>";
}

if (!empty($report["Report"]['comment'])) {
    echo "<i class='material-icons'>comment</i>";
    echo $report["Report"]['comment'];
}
?>
