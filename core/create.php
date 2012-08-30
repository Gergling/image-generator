<?php

require_once("BasicImage.class.php");

$width = $argv[1] OR die("Width required.\n");
$height = $argv[2] OR die("Height required.\n");
$classfile = $argv[3] OR die("Class file path required.\n");
$objectname = $argv[4] OR die("Object name required.\n");
$outputfile = $argv[5] OR die("Output file required.\n");
$truecolour = $argv[6] OR die("Truecolour flag required.\n");

echo "?: Arguments OK.\n";

require_once($classfile);

echo "?: Included class file.\n";

$img = new $objectname($width, $height, $truecolour);

echo "?: Object instantiated.\n";

$img->write($outputfile);

echo "?: Written to file.\n";

?>