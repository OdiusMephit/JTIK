<?php

error_reporting(0);

include __DIR__ .'/../../libraries/ezpdf/class.ezpdf.php';

$sideWidth = 75;
$sideHeight = 65;

$pdf = new Cezpdf('a4', 'landscape');
$pdf->ezSetMargins($sideHeight, $sideHeight, $sideWidth + 10, $sideWidth);

$width = $pdf->ez['pageWidth'];
$height = $pdf->ez['pageHeight'];
$blue = [0.07450980392156862745098039215686, 0.30196078431372549019607843137255, 0.7960784313725490196078431372549];
$yellow = [0.9921568627450980392156862745098, 0.6, 0.02745098039215686274509803921569];
$black = [0, 0, 0];
$gray50 = [0.5, 0.5, 0.5];
$gray25 = [0.25, 0.25, 0.25];
$gray75 = [0.75, 0.75, 0.75];
$config = [
    'left' => 0,
    'justification' => 'full',
    'spacing' => 1.5
];
$primaryFont = __DIR__ .'/../../libraries/ezpdf/fonts/Times-Roman.afm';
$secondaryFont = __DIR__ .'/../../libraries/ezpdf/fonts/Helvetica.afm';

function changeColor(&$pdf, $color)
{
    $pdf->setColor($color[0], $color[1], $color[2]);
}
function changeStrokeColor(&$pdf, $color)
{
    $pdf->setStrokeColor($color[0], $color[1], $color[2]);
}


$pdf->ezStartPageNumbers($width - $sideWidth, $sideHeight - 25, 10, '', '{PAGENUM}');
$pdf->selectFont($primaryFont);

$pdf->ezText($title, 16, ['left' => -60]);
$pdf->ezSetDy(-20);

$col = [
    'no' => '<b>No.</b>',
    'ni' => '<b>NIM</b>',
    'nama' => '<b>Nama Lengkap</b>',
    'kelas' => '<b>Kelas</b>',
    'prodi' => '<b>Prodi</b>',
    'sakit' => '<b>Sakit</b>',
    'izin' => '<b>Izin</b>',
    'alfa' => '<b>Alfa</b>',
    'nilai_alfa' => '<b>Nilai Alfa</b>',
];
$title = "";
$options = [
    'xPos' => 'center',
    'xOrientation' => 'center',
    'showLines' => 2,
    'shaded' => 0,
    'fontSize' => 12,
    // 'rowGap' => 6,
    // 'colGap' => 6, // colgap + col width jadi bug loading terus
    'lineCol' => $gray25,
    // 'width' => $width - ($sideWidth*2),
    // 'splitRows' => 1,
    'cols' => [ // total 295
        'no' => [
            'justification' => 'right',
            'width' => 35
        ],
        'ni' => [
            'width' => 80
        ],
        'nama' => [
            'width' => 210
        ],
        'kelas' => [
            'width' => 60
        ],
        'prodi' => [
            'width' => 160
        ],
        'sakit' => [
            'width' => 60
        ],
        'izin' => [
            'width' => 60
        ],
        'alfa' => [
            'width' => 60
        ],
        'nilai_alfa' => [
            'width' => 70
        ],
    ]
];

$i=0;
$data = [];
foreach ($presensi as $m) {
    $data[] = [
        'no' => ++$i .".",
        'ni' => $m['NI'],
        'nama' => $m['nama'],
        'kelas' => $m['kelas'],
        'prodi' => $m['prodi'],
        'sakit' => $m['sakit'],
        'izin' => $m['izin'],
        'alfa' => $m['alfa'],
        'nilai_alfa' => $m['nilai_alfa'],
    ];
}
// $pdf->ezSetDy(-35);
$pdf->ezTable($data, $col, $title, $options);


header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="'. $filename .'"');
header('Cache-Control: max-age=0');
$pdf->ezStream();
die();