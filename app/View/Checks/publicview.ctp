<?php
$oldcategory = '';

$arr = array(
    1 => "een",
    2 => "twee",
    3 => "drie",
    4 => "vier",
    5 => "vijf",
    6 => "zes",
    7 => "zeven",
    8 => "acht",
    9 => "negen",
    10 => "tien",
    11 => "elf",
    12 => "twaalf",
    13 => "dertien",
    14 => "veertien",
    15 => "vijftien",
    16 => "vijftien",
    17 => "vijftien",
    18 => "vijftien",
    19 => "vijftien",
    20 => "vijftien",
    21 => "vijftien",
    22 => "vijftien",
    23 => "vijftien",
    24 => "vijftien",
    25 => "vijftien",
    26 => "vijftien",
    27 => "vijftien",
    28 => "vijftien",
    29 => "vijftien",
    30 => "vijftien",
    31 => "vijftien",
    33 => "vijftien",
    34 => "vijftien",
    35 => "vijftien",
    36 => "vijftien",
    37 => "vijftien",
    38 => "vijftien",
    39 => "vijftien",
    40 => "veertig",
    41 => "eenenveertig",
    42 => "tweeenveertig",
    43 => "drieenveertig",
    44 => "vierenveertig",
    45 => "vijfenveertig",
    46 => "zesenveertig",
    47 => "zevenveertig",
    48 => "achtenveertig",
    49 => "negenveertig",
    50 => "vijftig",
);

$i = 0;
$html = '';

foreach ($checks as $check):
    if ($oldcategory <> $check['Checkcategory']['name']) {
        $html .= '<div class="row marginbottom">';
        $html .= '<div class="col-md-2">';
        $html .= '<a class="btn btn-primary btn-circle btn-xxl"><i class="material-icons">' . $check['Checkcategory']['icon'] . '</i></a>';
        $html .= '</div>';
        $html .= '<div class="col-md-10">';
        $html .= '<h2>' . $check['Checkcategory']['name'] . '</h2><h4>' . $check['Checkcategory']['description'] . '</h4>';
        $html .= '</div></div>';
    }

    $html .= '<div class="row" ><div class="col-md-10 col-md-offset-2">';
    $html .= '<h3>' . $check['Check']['name'] . '</h3>';
    $html .= '<p>' . nl2br($check['Check']['description']) . '</p>';
    $html .= '</div>';
    $html .= '</div>';
    $i++;

    $oldcategory = $check['Checkcategory']['name'];
endforeach;
?>
<div class="heading">
    <div class="container">
        <h1>Kwaliteitscriteria</h1>

        <p class="lead">Wij zijn RAADHUIS en wij geloven in een goed visueel verhaal vertellen. RAADHUIS is
            onderscheidend en maakt
            gebruik van zowel online als offline technieken om dit doel te bereiken. Wij staan voor kwaliteit. Om deze
            kwaliteit te waarborgen voldoet ons online werk altijd aan
            onderstaande <?php echo $arr[$i] ?> algemene kwaliteitscriteria.
        </p>
    </div>
</div>
<div class="container">
    <?php echo $html ?>
</div>
<div class="heading">
    <div class="container">
        <h1>Kwaliteitsscan voor uw website</h1>
        <p class="lead">Wij hebben dit ook voor u beschikbaar gemaakt. </p>
        <a href="/users/login" class="btn btn-success btn-lg">Bekijk mijn kwaliteitsscan</a>
    </div>
</div>
