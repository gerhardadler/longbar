<?php
$input = "# Big title
Normal paragraph
Another paragraph
- Bildebeskrivelse
Yet another paragraph
## Small title
The last paragraph
Got ya there tenkj e
";

$output = "";

$input = explode("\n", $input);

foreach ($input as &$row) {
    if (substr($row, 0, 3) == "## ") {
        $output .= "<h3>".substr($row, 3, -1)."</h3>\n";
    }
    else if (substr($row, 0, 2) == "# ") {
        $output .= "<h2>".substr($row, 2, -1)."</h2>\n";
    }
    else if (substr($row, 0, 2) == "- ") {
        $output .= '<p class="img-description">'.substr($row, 2, -1)."</p>\n<hr>\n";
    }
    else {
        $output .= "<p>".$row."</p>\n";
    };
};

echo $output;
?>