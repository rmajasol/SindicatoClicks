<?
function phpbb_hash($password){

	$itoa64 = './0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
	$random_state = unique_id();
	$random = '';
	$count = 6;

	if (($fh = @fopen('/dev/urandom', 'rb'))){
		$random = fread($fh, $count);
		fclose($fh);
	}

	if (strlen($random) < $count){
		$random = '';

		for ($i = 0; $i < $count; $i += 16){
			$random_state = md5(unique_id() . $random_state);
			$random .= pack('H*', md5($random_state));
		}
		$random = substr($random, 0, $count);
	}

	$hash = _hash_crypt_private($password, _hash_gensalt_private($random, $itoa64), $itoa64);

	if (strlen($hash) == 34){
		return $hash;
	}

	return md5($password);
}


function unique_id($extra = 'c'){
	static $dss_seeded = false;
	global $config;

	$val = $config['rand_seed'] . microtime();
	$val = md5($val);
	$config['rand_seed'] = md5($config['rand_seed'] . $val . $extra);

	if ($dss_seeded !== true && ($config['rand_seed_last_update'] < time() - rand(1,10))){
		$config['rand_seed_last_update']=time();
		$dss_seeded = true;
	}

	return substr($val, 4, 16);
}


function _hash_crypt_private($password, $setting, &$itoa64){

	$output = '*';

	// Check for correct hash
	if (substr($setting, 0, 3) != '$H$'){
	return $output;
	}

	$count_log2 = strpos($itoa64, $setting[3]);

	if ($count_log2 < 7 || $count_log2 > 30){
	return $output;
	}

	$count = 1 << $count_log2;
	$salt = substr($setting, 4, 8);

	if (strlen($salt) != 8)
{
return $output;
}

/**
* We're kind of forced to use MD5 here since it's the only
* cryptographic primitive available in all versions of PHP
* currently in use. To implement our own low-level crypto
* in PHP would result in much worse performance and
* consequently in lower iteration counts and hashes that are
* quicker to crack (by non-PHP code).
*/


$hash = pack('H*', md5($salt . $password));
do
{
$hash = pack('H*', md5($hash . $password));
}
while (--$count);


$output = substr($setting, 0, 12);
$output .= _hash_encode64($hash, 16, $itoa64);

return $output;
}
function _hash_gensalt_private($input, &$itoa64, $iteration_count_log2 = 6)
{
if ($iteration_count_log2 < 4 || $iteration_count_log2 > 31)
{
$iteration_count_log2 = 8;
}

$output = '$H$';
$output .= $itoa64[min($iteration_count_log2 + ((PHP_VERSION >= 5) ? 5 : 3), 30)];
$output .= _hash_encode64($input, 6, $itoa64);

return $output;
}

/**
* Encode hash
*/
function _hash_encode64($input, $count, &$itoa64)
{
$output = '';
$i = 0;

do
{
$value = ord($input[$i++]);
$output .= $itoa64[$value & 0x3f];

if ($i < $count)
{
$value |= ord($input[$i]) << 8;
}

$output .= $itoa64[($value >> 6) & 0x3f];

if ($i++ >= $count)
{
break;
}

if ($i < $count)
{
$value |= ord($input[$i]) << 16;
}

$output .= $itoa64[($value >> 12) & 0x3f];

if ($i++ >= $count)
{
break;
}

$output .= $itoa64[($value >> 18) & 0x3f];
}
while ($i < $count);

return $output;
}

function phpbb_check_hash($password, $hash)
{
$itoa64 = './0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
if (strlen($hash) == 34)
{
return (_hash_crypt_private($password, $hash, $itoa64) === $hash) ? true : false;
}

return (md5($password) === $hash) ? true : false;
}

/*$val=phpbb_hash('admin123');

if(phpbb_check_hash("admin123", $val))
{
echo "Value is true";
}
else
{
echo "val is false";
}*/

$pw = "uiPDInvaLjw";
$pw2 = phpbb_hash($pw);
echo "$pw<br>";
echo "$pw2";
?>
