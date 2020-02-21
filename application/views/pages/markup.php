<?php
function mark_up($str) {
	$len = strlen($str);
	$ret = "";
	for($i = 0; $i < $len; $i++) {
		$now = substr($str, $i, 3);
		if($now == "[b]") {
			$ret = $ret . "<b>";
			$i += 2;
			continue;
		}
		if($now == "[i]") {
			$ret = $ret . "<i>";
			$i += 2;
			continue;
		}
		$now = substr($str, $i, 4);
		if($now == "[/b]") {
			$ret = $ret . "</b>";
			$i += 3;
			continue;
		}
		if($now == "[ul]") {
			$ret = $ret . "<ul>";
			$i += 3;
			continue;
		}
		if($now == "[li]") {
			$ret = $ret . "<li>";
			$i += 3;
			continue;
		}
		if($now == "[/i]") {
			$ret = $ret . "</i>";
			$i += 3;
			continue;
		}
		if($now == "[h1]") {
			$ret = $ret . "<h1>";
			$i += 3;
			continue;
		}
		if($now == "[h2]") {
			$ret = $ret . "<h2>";
			$i += 3;
			continue;
		}
		if($now == "[h3]") {
			$ret = $ret . "<h3>";
			$i += 3;
			continue;
		}
		if($now == "[h4]") {
			$ret = $ret . "<h4>";
			$i += 3;
			continue;
		}
		if($now == "[h5]") {
			$ret = $ret . "<h5>";
			$i += 3;
			continue;
		}
		if($now == "[h6]") {
			$ret = $ret . "<h6>";
			$i += 3;
			continue;
		}
		$now = substr($str, $i, 5);
		if($now == "[/h1]") {
			$ret = $ret . "</h1>";
			$i += 4;
			continue;
		}
		if($now == "[/h2]") {
			$ret = $ret . "</h2>";
			$i += 4;
			continue;
		}
		if($now == "[/h3]") {
			$ret = $ret . "</h3>";
			$i += 4;
			continue;
		}
		if($now == "[/h4]") {
			$ret = $ret . "</h4>";
			$i += 4;
			continue;
		}
		if($now == "[/h5]") {
			$ret = $ret . "</h5>";
			$i += 4;
			continue;
		}
		if($now == "[/h6]") {
			$ret = $ret . "</h6>";
			$i += 4;
			continue;
		}
		if($now == "[/ul]") {
			$ret = $ret . "</ul>";
			$i += 4;
			continue;
		}
		if($now == "[/li]") {
			$ret = $ret . "</li>";
			$i += 4;
			continue;
		}
		$ret = $ret . $str[$i];
	}
	return $ret;
}
?>