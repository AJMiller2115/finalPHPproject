<?php
	$data = [
	    '0' => 27,
	    '1-50,000' => 14,
	    '50,001-75,000' => 23,
	    '75,001-100,000' => 37,
	    '100,001+' => 26,
	];

	// Image dimensions
	$imageWidth = 700;
	$imageHeight = 400;

	$gridTop = 40;
	$gridLeft = 50;
	$gridBottom = 340;
	$gridRight = 650;
	$gridHeight = $gridBottom - $gridTop;
	$gridWidth = $gridRight - $gridLeft;
	
	// Bar and line width
	$lineWidth = 1;
	$barWidth = 40;
	// Font settings
	$font = 'CaviarDreams.ttf';
	$fontSize = 12;
	// Margin between label and axis
	$labelMargin = 8;
	// Max value on y-axis
	$yMaxValue = 50;
	// Distance between grid lines on y-axis
	$yLabelSpan = 5;
	// Init image
	$chart = imagecreate($imageWidth, $imageHeight);
	// Setup colors
	$backgroundColor = imagecolorallocate($chart, 255, 255, 255);
	$axisColor = imagecolorallocate($chart, 0, 0, 0);
	$labelColor = $axisColor;
	$gridColor = imagecolorallocate($chart, 0, 0, 0);
	$barColor = imagecolorallocate($chart, 37, 53, 41);
	imagefill($chart, 0, 0, $backgroundColor);
	imagesetthickness($chart, $lineWidth);

	for($i = 0; $i <= $yMaxValue; $i += $yLabelSpan) {
	    $y = $gridBottom - $i * $gridHeight / $yMaxValue;
	    // draw the line
	    imageline($chart, $gridLeft, $y, $gridRight, $y, $gridColor);
	    // draw right aligned label
	    $labelBox = imagettfbbox($fontSize, 0, $font, strval($i));
	    $labelWidth = $labelBox[4] - $labelBox[0];
	    $labelX = $gridLeft - $labelWidth - $labelMargin;
	    $labelY = $y + $fontSize / 2;
	    imagettftext($chart, $fontSize, 0, $labelX, $labelY, $labelColor, $font, strval($i));
	}

	imageline($chart, $gridLeft, $gridTop, $gridLeft, $gridBottom, $axisColor);
	imageline($chart, $gridLeft, $gridBottom, $gridRight, $gridBottom, $axisColor);

	$barSpacing = $gridWidth / count($data);
	$itemX = $gridLeft + $barSpacing / 2;
	foreach($data as $key => $value) {
	    // Draw the bars
	    $x1 = $itemX - $barWidth / 2;
	    $y1 = $gridBottom - $value / $yMaxValue * $gridHeight;
	    $x2 = $itemX + $barWidth / 2;
	    $y2 = $gridBottom - 1;
	    imagefilledrectangle($chart, $x1, $y1, $x2, $y2, $barColor);
	    // Draw the label
	    $labelBox = imagettfbbox($fontSize, 0, $font, $key);
	    $labelWidth = $labelBox[4] - $labelBox[0];
	    $labelX = $itemX - $labelWidth / 2;
	    $labelY = $gridBottom + $labelMargin + $fontSize;
	    imagettftext($chart, $fontSize, 0, $labelX, $labelY, $labelColor, $font, $key);
	    $itemX += $barSpacing;
	}

	//Output image to browser

	header('Content-Type: image/png');
	imagepng($chart);
	imagedestroy($chart);
	
	
	?>