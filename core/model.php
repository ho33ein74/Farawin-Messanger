<?php

class Model
{
    public static $conn = '';

    function __construct()
    {
        Model::cookieInit();
        Model::sessionInit();

        $attr = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
        self::$conn = new PDO('mysql:host=' . SERVER_NAME . ';dbname=' . DATABASE, USERNAME, PASSWORD, $attr);
        self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if (function_exists('jdate') == FALSE) {
            require('public/library/jdf/jdf.php');
        }
    }

    public static function cookieInit()
    {
        @ob_start();
    }

    public static function cookieGet($name)
    {
        if (isset($_COOKIE[$name])) {
            return $_COOKIE[$name];
        } else {
            return FALSE;
        }
    }

    public static function minifyStyles($styles)
    {
        $styles = preg_replace('/\s+/is', ' ', $styles);
        $styles = str_replace(array('; }'), '}', $styles);
        $styles = str_replace(array('{ '), '{', $styles);
        $styles = str_replace(array('{ {'), '{{', $styles);
        $styles = str_replace(array('} }'), '}}', $styles);
        $styles = str_replace(array(': '), ':', $styles);
        return $styles;
    }

    public static function cookieSet($name, $value, $duratain = 30)
    {
        setcookie($name, $value, time() + (24 * 60 * 60 * $duratain), '/', NULL, NULL, TRUE);
    }

    public static function sessionInit()
    {
        @session_start();
    }

    public static function sessionSet($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public static function sessionGet($name)
    {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        } else {
            return FALSE;
        }
    }

    public static function RedirectLink($url, $statusCode = 301)
    {
        if ($statusCode == 404) {
            header('Location: ' . URL . "notfound");
            die();
        } else {
            header('Location: ' . $url, true, $statusCode);
            die();
        }
    }

    public static function Encrypt($data, $encryption_key)
    {
        $ciphering = "AES-128-CTR";
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        $encryption_iv = '1234567891011121';

        return openssl_encrypt($data, $ciphering, $encryption_key, $options, $encryption_iv);
    }

    public static function Decrypt($data, $decryption_key)
    {
        $ciphering = "AES-128-CTR";
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        $decryption_iv = '1234567891011121';

        return openssl_decrypt($data, $ciphering, $decryption_key, $options, $decryption_iv);
    }

    public static function getEncodedVideoString($type, $file)
    {
        return 'data:video/' . $type . ';base64,' . base64_encode(file_get_contents($file));
    }

    public static function hash_value_md5($value)
    {
        return md5($value);
    }

    public static function hash_value_sha1($value)
    {
        return sha1($value);
    }

    public static function hash_value_crc32($value)
    {
        return "ar" . crc32($value);
    }

    public static function Check_Param($val)
    {
        $value = addslashes($val);
        $string1 = htmlspecialchars($value);
        $string2 = strip_tags($string1);

        return $string2;
    }

    public static function filesize_formatted($path)
    {
        $size = filesize($path);
        $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $power = $size > 0 ? floor(log($size, 1024)) : 0;
        return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
    }

    public static function getClientIP()
    {
        if (isset($_SERVER)) {
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
                return $_SERVER["HTTP_X_FORWARDED_FOR"];

            if (isset($_SERVER["HTTP_CLIENT_IP"]))
                return $_SERVER["HTTP_CLIENT_IP"];

            return $_SERVER["REMOTE_ADDR"];
        }

        if (getenv('HTTP_X_FORWARDED_FOR'))
            return getenv('HTTP_X_FORWARDED_FOR');

        if (getenv('HTTP_CLIENT_IP'))
            return getenv('HTTP_CLIENT_IP');

        return getenv('REMOTE_ADDR');
    }

    public static function detectBrowser()
    {
        $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);

        // Identify the browser. Check Opera and Safari first in case of spoof. Let Google Chrome be identified as Safari.
        if (strpos($userAgent, 'mise') !== FALSE)
            $name = 'Internet explorer';
        elseif (strpos($userAgent, 'trident') !== FALSE) //For Supporting IE 11
            $name = 'Internet explorer';
        elseif (strpos($userAgent, 'firefox') !== FALSE)
            $name = 'Mozilla Firefox';
        elseif (strpos($userAgent, 'chrome') !== FALSE)
            $name = 'Google Chrome';
        elseif (strpos($userAgent, 'opera Mini') !== FALSE)
            $name = "Opera Mini";
        elseif (strpos($userAgent, 'opera') !== FALSE)
            $name = 'opera';
        elseif (strpos($userAgent, 'safari') !== FALSE)
            $name = "Safari";
        else
            $name = 'Something else';

        // What version?
        if (preg_match('/.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/', $userAgent, $matches)) {
            $version = $matches[1];
        } else {
            $version = 'unknown';
        }

        // Running on what platform?
        if (preg_match('/linux/', $userAgent)) {
            $platform = 'linux';
        } elseif (preg_match('/macintosh|mac os x/', $userAgent)) {
            $platform = 'mac';
        } elseif (preg_match('/windows|win32/', $userAgent)) {
            $platform = 'windows';
        } else {
            $platform = 'unrecognized';
        }

        return array(
            'name' => $name,
            'version' => $version,
            'platform' => $platform,
            'userAgent' => $userAgent
        );
    }

    public static function str_lreplace($search, $replace, $subject)
    {
        $pos = strrpos($subject, $search);
        if ($pos !== false) {
            $subject = substr_replace($subject, $replace, $pos, strlen($search));
        }
        return $subject;
    }

    public static function summary($str, $limit = 100, $strip = FALSE)
    {
        $str = ($strip == TRUE) ? strip_tags($str) : $str;
        if (strlen($str) > $limit) {
            $str = substr($str, 0, $limit - 3);

            return (substr($str, 0, strrpos($str, ' ')) . ' ...');
        }

        return trim($str);
    }

    public static function doSelect($sql, $values = array(), $fetch = '', $fetchStyle = PDO::FETCH_ASSOC)
    {
        $stmt = self::$conn->prepare($sql);
        foreach ($values as $key => $value) {
            $stmt->bindValue($key + 1, $value);
        }
        $stmt->execute();
        if ($fetch == '') {
            $result = $stmt->fetchAll($fetchStyle);
        } else {
            $result = $stmt->fetch($fetchStyle);
        }

        return $result;
    }

    public static function doQuery($sql, $values = array())
    {
        $stmt = self::$conn->prepare($sql);

        foreach ($values as $key => $value) {
            $stmt->bindValue($key + 1, $value);
        }
        $stmt->execute();
    }

    public static function jaliliDate($format = 'Y/m/d')
    {
        $date = jdate($format, '', '', 'Asia/Tehran', 'en');
        return $date;
    }

    public static function gLeapYear($year)
    {
        // کبیسه بودن سال میلادی
        if (($year % 4 == 0) and (($year % 100 != 0) or ($year % 400 == 0)))
            return true;
        else
            return false;
    }

    public static function sLeapYear($year)
    {
        // کبیسه بودن سال شمسی
        $ary = array(1, 5, 9, 13, 17, 22, 26, 30);
        $b = $year % 33;
        if (in_array($b, $ary))
            return true;
        return false;
    }

    public static function jaliliToMiladi($jalili, $format = '/', $format_export = '/')
    {
        $jalili = explode('/', $jalili);
        $year = $jalili[0];
        $month = $jalili[1];
        $day = $jalili[2];
        $date = jalali_to_gregorian($year, $month, $day);
        $date = implode($format, $date);
        $date = new DateTime($date);
        $date = $date->format('Y' . $format_export . 'm' . $format_export . 'd');

        return $date;
    }

    public static function days_away_to($dt)
    {
        $mkt_diff = time() - strtotime($dt);

        return floor($mkt_diff / 60 / 60 / 24); # 0 = today, -1 = yesterday, 1 = tomorrow
    }

    public static function day_of_date($dateInfo = '', $dateDelimiter = '/', $timeInfo = '', $timeDelimiter = ':')
    {
        if ($dateInfo != self::jaliliDate()) {
            $date = explode($dateDelimiter, $dateInfo);
            $time = explode($timeDelimiter, $timeInfo);
            $timestamp = jmktime($time['0'], $time['1'], 00, $date['1'], $date['2'], $date['0']);

            return jdate("l, j F Y", $timestamp);
        } else {
            $date = Model::jaliliToMiladi($dateInfo, "/", "-");
            $to_time = time();
            $from_time = strtotime($date . " " . $timeInfo . ":00");
            $diff_time = round(abs($to_time - $from_time) / 60, 0);
            if ($diff_time < 60) {
                $time_to_show = $diff_time . " دقیقه پیش";
            } else {
                $time_to_show = round(abs($to_time - $from_time) / 60 / 60, 0) . " ساعت پیش";
            }
            return $time_to_show;
        }
    }

    public static function MiladiTojalili($miladi, $exp = '/', $format = '/')
    {
        $miladi = explode($exp, $miladi);
        $year = $miladi[0];
        $month = $miladi[1];
        $day = $miladi[2];
        $date = gregorian_to_jalali($year, $month, $day);
        $date = implode($format, $date);

        return $date;
    }

    public static function MiladiTojalili_2no($miladi, $exp = '/', $format = '/')
    {
        list($year, $month, $day) = explode($exp, $miladi);
        $timestamp = mktime(0, 0, 0, $month, $day, $year);

        $jalali_date = jdate("Y" . $format . "m" . $format . "d", $timestamp);

        return $jalali_date;
    }

    public static function createDateRangeArray($strDateFrom, $strDateTo)
    {
        $aryRange = [];

        $iDateFrom = mktime(1, 0, 0, substr($strDateFrom, 5, 2), substr($strDateFrom, 8, 2), substr($strDateFrom, 0, 4));
        $iDateTo = mktime(1, 0, 0, substr($strDateTo, 5, 2), substr($strDateTo, 8, 2), substr($strDateTo, 0, 4));

        if ($iDateTo >= $iDateFrom) {
            $aryRange[] = array(
                "fa" => self::MiladiTojalili_2no(date('Y-m-d', $iDateFrom), "-"),
                "en" => date('Y-m-d', $iDateFrom)
            ); // first entry
            while ($iDateFrom < $iDateTo) {
                $iDateFrom += 86400; // add 24 hours
                $aryRange[] = array(
                    "fa" => self::MiladiTojalili_2no(date('Y-m-d', $iDateFrom), "-"),
                    "en" => date('Y-m-d', $iDateFrom)
                );
            }
        }
        return $aryRange;
    }

    public static function JalaliAfter($jalaliDate, $afterDays)
    {
        list($y, $m, $d) = explode('/', $jalaliDate);
        $ts = jmktime(0, 0, 0, $m, $d, $y);
        for ($i = 0; $i < $afterDays; $i++) {
            $ts += 86400;
        }
        return jdate('Y/m/d', $ts, '', 'Asia/Tehran', 'en');
    }

    function passValidate($password)
    {
        //password bayad 8 raghami va daraye add,horof bozorg bashe
        return preg_match('/^(?=^.{8,}$)((?=.*[A-Za-z0-9])(?=.*[A-Z])(?=.*[a-z]))^.*$/', $password);
    }

    public static function DateDifference($firstDate, $secondDate)
    {

        list($fdY, $fdM, $fdD) = explode('/', $firstDate);
        list($sdY, $sdM, $sdD) = explode('/', $secondDate);

        $old_time_array = jalali_to_gregorian($sdY, $sdM, $sdD);
        $old_time = $old_time_array[0] . '-' . $old_time_array[1] . '-' . $old_time_array[2];
        $now_time = new DateTime(date('Y-m-d'));
        $old_time = new DateTime($old_time);
        $interval = $now_time->diff($old_time);
        $time = $interval->format('%a ');
        if ($interval->invert == 1) {
            return 0;
        } else {
            return $time;
        }
    }

    public static function qr($url, $parameters, $width = 90, $height = 90, $border = 0, $error = "L", $https = true, $loadBalance = false)
    {
        $filename = str_replace(array("http://", "https://"), "", $url);
        $filename = str_replace("%", "_", urlencode($filename));
        $filename = "./qr-$error$border-$filename.png";
        if (!file_exists($filename)) {
            // build Google Charts URL:
            // secure connection ?
            $protocol = $https ? "https" : "http";
            // load balancing
            $host = "chart.googleapis.com";
            if ($loadBalance)
                $host = abs(crc32($parameters) % 10) . ".chart.apis.google.com";
            // safe URL
            $url = urlencode($url);
            // put everything together
            $qrUrl = "$protocol://$host/chart?chs={$width}x{$height}&cht=qr&chld=$error|$border&chl=$url";
            // get QR code from Google's servers
            $qr = file_get_contents($qrUrl);
            // optimize PNG and save locally
            $imgIn = imagecreatefromstring($qr);
            $imgOut = imagecreate($width, $height);
            imagecopy($imgOut, $imgIn, 0, 0, 0, 0, $width, $height);
            imagepng($imgOut, $filename, 9, PNG_ALL_FILTERS);
            imagedestroy($imgIn);
            imagedestroy($imgOut);
        }
        // serve image from local server
        echo "<img style='margin-top: 2px;margin-left: -20px;' src=\"$filename\" width=\"$width\" height=\"$height\" alt=\"Scan my QR !\" />";
        unlink($filename);
    }

    public static function getReadTime($allcontent = '')
    {
        $words_per_minute = 200;
        $word = count(explode(" ", strip_tags($allcontent)));
        return ceil($word / $words_per_minute);
    }

    public static function addParametersToUrl(string $url, array $newParams, string $type): string
    {
        $url = parse_url($url);
        parse_str($url['query'] ?? '', $existingParams);

        $newQuery = array_merge($existingParams, $newParams);
        if ($type == "remove") {
            $newQuery = array_diff($existingParams, $newParams);
        }

        $newUrl = $url['host'] . ($url['path'] ?? '');
        if ($newQuery) {
            $newUrl .= '?' . http_build_query($newQuery);
        }

        if (isset($url['fragment'])) {
            $newUrl .= '#' . $url['fragment'];
        }

        return $newUrl;
    }

    public static function SendEmail($emailto, $name, $content, $subject)
    {
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Debugoutput = 'html';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = TRUE;
        $mail->CharSet = 'UTF-8';
        $mail->Username = "info.unix.team@gmail.com";
        $mail->Password = "0923133585";
        $mail->ContentType = 'text/html';
        $mail->setFrom('info.unix.team@gmail.com', NAME);
        $mail->addAddress($emailto, $name);
        $mail->Subject = $subject;
        $mail->AltBody = 'متاسفانه برنامه شما از این ایمیل پشتیبانی نمی کند، برای دیدن آن، لطفا از برنامه دیگری استفاده نمائید';
        $mail->msgHTML($content, dirname(__FILE__));
        if (!$mail->send()) {
            return $mail->ErrorInfo;
        } else {
            return "ok";
        }
    }

    public static function time_elapsed_string($datetime, $full = FALSE)
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'سال',
            'm' => 'ماه',
            'w' => 'هفته',
            'd' => 'روز',
            'h' => 'ساعت',
            'i' => 'دقیقه',
            's' => 'ثانیه',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);

        return $string ? implode(', ', $string) . ' قبل' : 'هم اکنون';
    }

    public static function sendPhoto($photo, $caption, $channel, $encodedMarkup = '')
    {
        $caption = urlencode($caption);
        $curl = curl_init("https://api.telegram.org/bot" . self::getPublicInfo('bot_token') . "/sendPhoto");
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, "chat_id=" . $channel . "&photo=$photo&caption=$caption&reply_markup=$encodedMarkup");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }

    public static function sendMessage($text, $channel, $encodedMarkup = '')
    {
        $text = urlencode($text);
        $curl = curl_init("https://api.telegram.org/bot" . self::getPublicInfo('bot_token') . "/sendMessage");
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, "chat_id=" . $channel . "&text=$text&reply_markup=$encodedMarkup&parse_mode=HTML");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }

    public static function filter($request, $columns, &$bindings, $equal = NULL)
    {
        $globalSearch = array();
        $columnSearch = array();
        $dtColumns = self::pluck($columns, 'dt');

        // Individual column filtering
        if (isset($request['columns'])) {
            for ($i = 0, $ien = count($request['columns']); $i < $ien; $i++) {
                $requestColumn = $request['columns'][$i];
                $columnIdx = array_search($requestColumn['data'], $dtColumns);
                $column = $columns[$columnIdx];

                $str = str_replace("^", "", $requestColumn['search']['value']);
                $str = str_replace("$", "", $str);

                if ($requestColumn['searchable'] == 'true' && $str != '') {
                    if (!in_array($column['db'], $equal)) {
                        $binding = self::bind($bindings, '%' . $str . '%', PDO::PARAM_STR);
                        $columnSearch[] = $column['db'] . " LIKE " . $binding;
                    } else {
                        $binding = self::bind($bindings, $str, PDO::PARAM_STR);
                        $columnSearch[] = $column['db'] . " = " . $binding;
                    }
                }
            }
        }

        // Combine the filters into a single string
        $where = '';

        if (count($globalSearch)) {
            $where = '(' . implode(' OR ', $globalSearch) . ')';
        }

        if (count($columnSearch)) {
            $where = $where === '' ?
                implode(' AND ', $columnSearch) :
                $where . ' AND ' . implode(' AND ', $columnSearch);
        }

        if ($where !== '') {
            $where = 'WHERE ' . $where;
        }

        return $where;
    }

    public static function pluck($a, $prop)
    {
        $out = array();

        for ($i = 0, $len = count($a); $i < $len; $i++) {
            $out[] = $a[$i][$prop];
        }

        return $out;
    }

    public static function bind(&$a, $val, $type)
    {
        $key = ':binding_' . count($a);

        $a[] = array(
            'key' => $key,
            'val' => $val,
            'type' => $type
        );

        return $key;
    }

    public static function order($request, $columns)
    {
        $order = '';

        if (isset($request['order']) && count($request['order'])) {
            $orderBy = array();
            $dtColumns = self::pluck($columns, 'dt');

            for ($i = 0, $ien = count($request['order']); $i < $ien; $i++) {
                // Convert the column index into the column data property
                $columnIdx = intval($request['order'][$i]['column']);
                $requestColumn = $request['columns'][$columnIdx];

                $columnIdx = array_search($requestColumn['data'], $dtColumns);
                $column = $columns[$columnIdx];

                if ($requestColumn['orderable'] == 'true') {
                    $dir = $request['order'][$i]['dir'] === 'asc' ?
                        'DESC' :
                        'ASC';

                    $orderBy[] = '' . $column['db'] . ' ' . $dir;
                }
            }

            if (count($orderBy)) {
                $order = 'ORDER BY ' . implode(', ', $orderBy);
            }
        }

        return $order;
    }

    public static function limit($request, $columns)
    {
        $limit = '';

        if (isset($request['start']) && $request['length'] != -1) {
            $limit = "LIMIT " . intval($request['start']) . ", " . intval($request['length']);
        }

        return $limit;
    }

    public static function data_output($columns, $data)
    {
        $out = array();

        for ($i = 0, $ien = count($data); $i < $ien; $i++) {
            $row = array();

            for ($j = 0, $jen = count($columns); $j < $jen; $j++) {
                $column = $columns[$j];

                // Is there a formatter?
                if (isset($column['formatter'])) {
                    $row[$column['dt']] = $column['formatter']($data[$i][$column['db']], $data[$i]);
                } else {
                    $row[$column['dt']] = $data[$i][$columns[$j]['db']];
                }
            }

            $out[] = $row;
        }

        return $out;
    }

    public static function sql_exec($bindings, $sql = null)
    {
        if ($sql === null) {
            $sql = $bindings;
        }

        $stmt = self::$conn->prepare($sql);

        if (is_array($bindings)) {
            for ($i = 0, $ien = count($bindings); $i < $ien; $i++) {
                $binding = $bindings[$i];
                $stmt->bindValue($binding['key'], $binding['val'], $binding['type']);
            }
        }

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo json_encode(array(
                "error" => "An SQL error occurred: " . $e->getMessage()
            ));
        }

        return $stmt->fetchAll(PDO::FETCH_BOTH);
    }

    public static function timeCompare($compareTime, $baseTime)
    {
        if ($baseTime == null) {
            $baseTime = gettimeofday();
        } else {
            $baseTime = strtotime($baseTime);
        }
        $compareTime = strtotime($compareTime);
        $diff = $compareTime - $baseTime['sec'];

        if ($diff > 0) {
            return 1;
        }
        if ($diff < 0) {
            return -1;
        }
        if ($diff == 0) {
            return 0;
        }
    }

    public static function Validate_token($token = NULL)
    {
        if ($token != NULL) {
            $sql = "SELECT `key` FROM tbl_api_keys WHERE `key`= ?";
            $param = array($token);
            $result = self::doSelect($sql, $param);

            //check for lenght
            if (sizeof($result) > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function convertNumbers($srting, $toPersian = false)
    {
        $en_num = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        $fa_num = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
        if ($toPersian)
            return str_replace($en_num, $fa_num, $srting);
        else
            return str_replace($fa_num, $en_num, $srting);
    }

    public static function Validate_mobile($mobile)
    {
        $mobile = self::convertNumbers($mobile); //make sure all numbers are en format

        //remove the first zero if exists
        if (substr($mobile, 0, 1) === "0") {
            $mobile = ltrim($mobile, '0'); //remove every zeros at the start of number (also prevent 000000000)
        }

        if (substr($mobile, 0, 1) === "+") {
            $mobile = ltrim($mobile, "+"); //remove every + at the start of number
        }

        //remove the 98 if exists
        if (substr($mobile, 0, 2) === "98") {
            $mobile = ltrim($mobile, "9"); //remove every 98 at the start of number
            $mobile = ltrim($mobile, "8"); //remove every 98 at the start of number
        }

        $mobile = str_pad($mobile, 11, "0", STR_PAD_LEFT);
        //check for lenght
        if (strlen($mobile) == 11) {
            return true;
        } else {
            return false;
        }
    }

    public static function generateActivationCode($length = 4)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function uploadFile($file, $title = null, $desc = null, $type = null)
    {
        global $server, $config, $db;

        $target_dir = $config->cdn_path;
        $target_file = $target_dir . basename($file["name"]);
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        $check = getimagesize($file["tmp_name"]);
        if ($check == false) {
            $server->generate_jsonp(0, "error", "invalid file type"); // File is not an image
            return;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $server->generate_jsonp(0, "error", "invalid file format. only jpg,jpeg,png,gif"); // only JPG, JPEG, PNG & GIF files are allowed
            return;
        }

        $temp = explode(".", $file["name"]);
        $newfilename = self::generateRandomString($config->file_name_lenght) . '.' . end($temp);

        if (move_uploaded_file($file["tmp_name"], $target_dir . $newfilename)) {
            $target_file = $target_dir . $newfilename;
            $resized_file = $target_dir . $newfilename;
            $wmax = 700;
            $hmax = 500;
            self::ak_img_resize($target_file, $resized_file, $wmax, $hmax, $imageFileType);
        } else {
            $server->generate_jsonp(0, "error", "error on saving file"); // could not copy image
            return;
        }

        return self::saveFiletoLib($newfilename, $title, $desc, $type);
    }

    public static function ak_img_resize($target, $newcopy, $w, $h, $ext)
    {
        list($w_orig, $h_orig) = getimagesize($target);
        $scale_ratio = $w_orig / $h_orig;
        if (($w / $h) > $scale_ratio) {
            $w = $h * $scale_ratio;
        } else {
            $h = $w / $scale_ratio;
        }
        $img = "";
        $ext = strtolower($ext);
        if ($ext == "gif") {
            $img = imagecreatefromgif($target);
        } else if ($ext == "png") {
            $img = imagecreatefrompng($target);
        } else {
            $img = imagecreatefromjpeg($target);
        }
        $tci = imagecreatetruecolor($w, $h);
        // imagecopyresampled(dst_img, src_img, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
        imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
        imagejpeg($tci, $newcopy, 100);
    }

    function get_array_value($array, $key)
    {
        if (is_array($array) && array_key_exists($key, $array)) {
            return $array[$key];
        }
    }

    function array_remove_by_value($array, $value)
    {
        return array_values(array_diff($array, array($value)));
    }

    function set_csrf_token()
    {
        $this->sessionSet("token", bin2hex(random_bytes(32)));
        $this->sessionSet("token-expire", time() + (3600 * 12)); // 1 hour = 3600 secs
    }

    function check_csrf_token()
    {
        $status = 1;
        $msg = "access";

        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/";
        if (strpos($this->getPublicInfo('root'), $actual_link) !== false) {
            if ($_SESSION["token"] == $_SERVER['HTTP_X_CSRF_TOKEN']) {
                if (time() >= $_SESSION["token-expire"]) {
                    $status = 0;
                    $msg = "مدت زمان نشست این صفحه به پایان رسیده است. لطفا صفحه را به روز نمایید.";
                }
            } else {
                $status = 0;
                $msg = "توکن ارسالی صحیح نمی باشد لطفا صفحه را به روز نمایید.";
            }
        } else {
            $status = 0;
            $msg = "شما مجاز به ارسال درخواست به این آدرس نمی باشید.";
        }

        $response = array(
            "status" => $status,
            "msg" => $msg
        );
        return $response;
    }

    function generate_jsonp($status, $label, $data)
    {
        header('Content-type: application/json; charset=utf-8');
        print sprintf('%s', json_encode(array("status" => $status, $label => $data)));
    }

    public function response_success($msg, $status = "ok", $link = '', $data = '')
    {
        $response = array(
            "status" => $status,
            "link" => $link,
            "noty_type" => "success",
            "msg" => $msg,
            "data" => $data
        );

        echo json_encode($response);
    }

    public function response_error($msg, $status = "error", $data = '')
    {
        $response = array(
            "status" => $status,
            "noty_type" => "error",
            "msg" => $msg,
            "data" => $data
        );

        echo json_encode($response);
    }

    public function response_warning($msg, $status = "warning", $data = '')
    {
        $response = array(
            "status" => $status,
            "noty_type" => "warning",
            "msg" => $msg,
            "data" => $data
        );

        echo json_encode($response);
    }

    function response_access_denied()
    {
        $response = array(
            "status" => "access_denied",
            "noty_type" => "error",
            "msg" => "متاسفانه شما به این بخش دسترسی ندارید"
        );

        echo json_encode($response);
    }

//        PUBLIC FUNCTION HERE
    public function get_role_allow_access($id): array
    {
        $result = $this->doSelect("SELECT path FROM tbl_admin_role_access WHERE role_id=?", array($id));
        return array_column($result, 'path');
    }

    public function getLastId($activity)
    {
        $sql = "SELECT " . $activity . "_id as vids from tbl_vids";
        $result = $this->doSelect($sql);

        return $result[0]['vids'];
    }

    public function updateLastId($activity)
    {
        $sql = "UPDATE tbl_vids SET " . $activity . "_id=" . $activity . "_id+1";
        $this->doQuery($sql);
    }

    function getProfileNotification($userId)
    {
        $sql = "DELETE FROM tbl_services_reservation WHERE sre_timestamp_expire<? AND sre_status=0";
        $this->doQuery($sql, array(time()));

        $result['service'] = $this->doSelect("SELECT count(*) as count FROM tbl_services_reservation WHERE user_id=? AND sre_status=0", array($userId));

        return $result;
    }

    function getScoreItem($id, $type)
    {
        return $this->doSelect("SELECT COUNT(r_id) count, SUM(r_rate) sum, FORMAT(AVG(r_rate), 2) avg FROM tbl_rating WHERE item_id=? AND r_type=?", array($id, $type), 1);
    }

    function getIcons()
    {
        return $this->doSelect("SELECT * FROM tbl_icons WHERE i_status=1");
    }

    function sendSMS($pattern_code, $mobile, $input_data)
    {
        $setting = $this->getPublicInfo();
        if ($setting['sms_status'] == 1) {
            $siteSMS = $setting['sms_site'];
            $sms_api_key = $setting['sms_api_key'];
            $sms_secret_key = $setting['sms_secret_key'];
            $sms_number = $setting['sms_number'];

            if ($sms_api_key != "" and $pattern_code != "") {
                if ($siteSMS == "faraz") {
                    $client = new SoapClient("http://188.0.240.110/class/sms/wsdlservice/server.php?wsdl");
                    $result = $client->sendPatternSms($sms_number, array($mobile), $sms_api_key, $sms_secret_key, $pattern_code, $input_data);
                } else if ($siteSMS == "sms_ir") {
                    if ($sms_secret_key != "") {
                        $data = array(
                            "ParameterArray" => $input_data,
                            "Mobile" => $mobile,
                            "TemplateId" => $pattern_code,
                        );

                        $SmsIR_UltraFastSend = new SmsIR_UltraFastSend($sms_api_key, $sms_secret_key);
                        $result = $SmsIR_UltraFastSend->UltraFastSend($data);
                    } else {
                        $data = array(
                            "parameters" => $input_data,
                            "mobile" => $mobile,
                            "templateId" => $pattern_code,
                        );

                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'https://api.sms.ir/v1/send/verify',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => json_encode($data),
                            CURLOPT_HTTPHEADER => array(
                                'Content-Type: application/json',
                                'Accept: text/plain',
                                'x-api-key: ' . $sms_api_key
                            ),
                        ));
                        $result = curl_exec($curl);
                        curl_close($curl);
                    }
                }

                return $result;
            }
        }
    }

    function getPublicInfo($value = '')
    {
        if ($value == "") {
            $sql = "SELECT `key`,`value` FROM tbl_settings";
            $result = self::doSelect($sql);

            foreach ($result as $item) {
                $res[$item['key']] = $item['value'];
            }

            return $res;
        } else {
            $result = self::doSelect("SELECT `value` FROM tbl_settings WHERE `key`=?", array($value), 1)['value'];
            return $result;
        }
    }

    function getDomainsInfo($type="", $name = '')
    {
        if ($type == "") {
            $sql = "SELECT domain_name,domain_title,domain_code,domain_prority FROM tbl_domains";
            $result = self::doSelect($sql);

            $res = array();
            foreach ($result as $item) {
                $res[$item['domain_name']][] = $item;
            }
            return $res;
        } else {
            $param = array($type, $name);
            return self::doSelect("SELECT * FROM tbl_domains WHERE `domain_name`=? AND `domain_code`=?", $param, 1);
        }
    }

    function getMethodsContacting($key="", $check_status = false)
    {
        $where = "mc_status in (0, 1)";
        if($check_status){
            $where = "mc_status=1";
        }

        if ($key == "") {
            $sql = "SELECT * FROM tbl_methods_contacting WHERE ".$where." ORDER BY mc_priority ASC";
            $result = self::doSelect($sql);

            $res = array();
            foreach ($result as $item) {
                $res[$item['mc_key']] = $item;
            }
            return $res;
        } else {
            $param = array($key);
            return self::doSelect("SELECT * FROM tbl_methods_contacting WHERE `mc_key`=?", $param, 1);
        }
    }

    function getinfoUser($id)
    {
        $sql = "SELECT c.*,p.pro_name,ci.ci_name FROM tbl_customer c 
                        LEFT JOIN tbl_provinces p ON c.province_id=p.pro_id
                        LEFT JOIN tbl_cities ci ON c.city_id=ci.ci_id
                        WHERE customer_vids_id=?";
        $result = $this->doSelect($sql, array($id), 1);
        return $result;
    }

    function checkRedirectLink($link)
    {
        $sql = "SELECT * FROM tbl_redirect WHERE old_url=?";
        $result = $this->doSelect($sql, array($link));
        return $result;
    }

    function checkServiceTiming($serviceId, $date, $time, $userId)
    {
        //حذف زمان های منقضی شده
        $sql = "DELETE FROM tbl_services_reservation WHERE sre_timestamp_expire<? AND sre_status=0";
        $this->doQuery($sql, array(time()));

        $check_date = explode("_", $date);
        $dateInfo = jgetdate(jmktime(0, 0, 0, $check_date[1], $check_date[2], $check_date[0]), "", '', 'en');
        $days = array('saturday', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday');
        $rows_select = 'st_turn_' . $days[$dateInfo['wday']];

        $sql = "SELECT * FROM tbl_services_timing WHERE service_id=?";
        $turn_status = $this->doSelect($sql, array($serviceId), 1);

        if ($turn_status[$rows_select] == "not_turn" || ($turn_status[$rows_select] == "holiday" && $turn_status['st_turn_holiday'] == "not_turn")) {
            return false;
        } else {
            if (jcheckdate($check_date[1], $check_date[2], $check_date[0])) {
                if ($turn_status[$rows_select] == "custom") {
                    $title_day = $days[$dateInfo['wday']];
                } else {
                    $title_day = $turn_status[$rows_select];
                }

                //چک کردن اینکه تاریخ و ساعت ورودی وجود داشته باشد
                if ($turn_status[$rows_select] == "custom_date") {
                    $sql = "SELECT * FROM tbl_services_timing_manage_day WHERE service_id=? AND sm_status=1 AND sm_title_day=? AND sm_time_start=? AND sm_description=?";
                    $turns = $this->doSelect($sql, array($serviceId, $title_day, str_replace("_", ":", $time), str_replace("_", "/", $date)));
                } else {
                    $sql = "SELECT * FROM tbl_services_timing_manage_day WHERE service_id=? AND sm_status=1 AND sm_title_day=? AND sm_time_start=?";
                    $turns = $this->doSelect($sql, array($serviceId, $title_day, str_replace("_", ":", $time)));
                }
                if (sizeof($turns) > 0) {
                    //چک کردن ظرفیت نوبت
                    $sql = "SELECT COUNT(*) as count FROM tbl_services_reservation WHERE service_id=? AND sre_date=? AND sre_time=? AND sre_status!=6";
                    $reservationCount = $this->doSelect($sql, array($serviceId, str_replace("_", "/", $date), str_replace("_", ":", $time)));

                    $sql = "SELECT COUNT(*) as count FROM tbl_services_reservation WHERE service_id=? AND sre_date=? AND sre_time=? AND sre_status=0 AND user_id=?";
                    $reservationUserCount = $this->doSelect($sql, array($serviceId, str_replace("_", "/", $date), str_replace("_", ":", $time), $userId));

                    if ($turns['0']['sm_capacity'] >= ($reservationCount[0]['count'] + 1) or $reservationUserCount[0]['count'] > 0) {
                        return array(
                            "status" => true,
                            "day" => $dateInfo['weekday'],
                            "capacity" => $turns['0']['sm_capacity'],
                            "description" => $turns['0']['sm_description'],
                            "turn_type" => $turn_status[$rows_select],
                            "is_vip" => (int)$turns['0']['sm_vip']
                        );
                    } else {
                        return array(
                            "status" => false,
                            "is_vip" => "0"
                        );
                    }
                } else {
                    return array(
                        "status" => false,
                        "is_vip" => "0"
                    );
                }
            } else {
                return array(
                    "status" => false,
                    "is_vip" => "0"
                );
            }
        }
    }

    function getMenuDisplay($type, $parent_id = 0)
    {
        $sql = "SELECT l_id,l_name as title,l_link as link,l_parent_id, l_menu_type as menu_type FROM tbl_link WHERE l_parent_id=? AND l_type=? AND l_status=? ORDER BY l_order";
        $params = array($parent_id, $type, 1);
        $result = self::doSelect($sql, $params);

        foreach ($result as &$value) {
            $subresult = $this->getMenuDisplay($type, $value["l_id"]);

            if (count($subresult) > 0) {
                $value['children'] = $subresult;
            }
        }
        unset($value);

        return $result;
    }

    function calViewer($item_id, $ip, $type)
    {
        $sql = "SELECT * FROM `tbl_view` WHERE `item_id` = ? AND `type` = ? AND `ip` = ? AND `date` = ?";
        $params = array($item_id, $type, $ip, self::jaliliDate());
        $res = $this->doSelect($sql, $params);

        if (sizeof($res) == 0) {
            $sql = "INSERT INTO tbl_view (item_id,type,ip,date) VALUES (?,?,?,?)";
            $value = array($item_id, $type, $ip, self::jaliliDate());
            $this->doQuery($sql, $value);

            if ($type == "blog") {
                $this->doQuery("UPDATE tbl_blog SET view=view+1 WHERE n_id=?", array($item_id));
            } else if ($type == "service") {
                $this->doQuery("UPDATE tbl_services SET s_view=s_view+1 WHERE s_id=?", array($item_id));
            } else if ($type == "faq") {
                $this->doQuery("UPDATE tbl_faq SET view=view+1 WHERE id=?", array($item_id));
            } else {
                $this->doQuery("UPDATE tbl_page SET view=view+1 WHERE p_id=?", array($item_id));
            }
        }
    }

    function getRelatedFaq($id, $type)
    {
        $sql = "SELECT f.* FROM tbl_faq f 
                    LEFT JOIN tbl_faq_related fr ON f.id=fr.faq_id
                    WHERE fr.item_id=? AND fr.type=? AND f.status=1 ORDER BY f.id DESC";
        $result = $this->doSelect($sql, array($id, $type));
        return $result;
    }

    function getPage($link = '')
    {
        $result = self::doSelect("SELECT p.*,d.a_name FROM tbl_page p LEFT JOIN tbl_admin d ON p.writer=d.a_id WHERE p.p_status in (1,2) AND link= ?", array($link), 1);
        return $result;
    }

    function getProvinces()
    {
        $result = $this->doSelect("SELECT * FROM tbl_provinces WHERE pro_status=1");
        return $result;
    }

    function getCityByProvince($post)
    {
        if (isset($post)) {
            $states = explode(",", $post['states']);
            foreach ($states as $id) {
                $sql = "SELECT ci_id as id, ci_name as name FROM tbl_cities WHERE province_id=? and ci_status=1";
                $result[] = $this->doSelect($sql, array($id));
            }

            if (sizeof($result) > 0) {
                echo json_encode($result);
            } else {
                echo "notfound";
            }
        }
    }

    function getContactSubject($check = TRUE)
    {
        if ($check) {
            $sql = "SELECT cs_id as id,cs_title as title FROM tbl_contact_subject WHERE cs_status=1";
        } else {
            $sql = "SELECT cs_id as id,cs_title as title FROM tbl_contact_subject";
        }
        return $this->doSelect($sql);
    }

    function getBookingLatestActivity($order_id)
    {
        $sql = "SELECT srl.*,u.a_name as name FROM tbl_services_reservation_log srl
                LEFT JOIN tbl_admin u ON srl.admin_id=u.a_id
                WHERE srl.reservation_id = ? ORDER BY srl.idusr_activity DESC";
        $result = $this->doSelect($sql, array($order_id));

        return $result;
    }

    function getBookingData($print_query = False, $userId = False, $where = '', $order = '', $limit = '', $input = array(), $select_one = False)
    {
        $sql = "SELECT sre.*,u.*,r.title as statusTitle,r.percent,r.background_color,s.s_title,s.s_cover,s.s_slug,b.b_name,ss.name,p.pay_title
                    FROM tbl_services_reservation sre
                    LEFT JOIN tbl_services s ON sre.service_id=s.s_id
                    LEFT JOIN tbl_customer u ON sre.user_id=u.customer_vids_id
                    LEFT JOIN tbl_branches b ON sre.branch_id=b.branch_vids_id
                    LEFT JOIN tbl_payment_methods p ON sre.payment_method_id=p.pay_id
                    LEFT JOIN tbl_services_staff ss ON sre.staff_id=ss.staff_vids_id
                    LEFT JOIN tbl_status r ON sre.sre_status=r.id
                    WHERE $where $order $limit";

        if ($print_query) {
            file_put_contents("query.json", print_r($sql, true));
        }

        if ($select_one) {
            $result = $this->doSelect($sql, $input, 1);
        } else {
            $result = $this->doSelect($sql, $input);
        }

        return $result;
    }

    function getCity($id)
    {
        $sql = "SELECT ci_id as id, ci_name as name FROM tbl_cities WHERE province_id=? and ci_status=1";
        $result = $this->doSelect($sql, array($id));

        return $result;
    }

    function getPayType($id = '', $justOneSelect = 1)
    {
        if ($id == "") {
            $sql = "SELECT * FROM tbl_payment_methods WHERE user_type=0 AND pay_status=1";
            return $this->doSelect($sql);
        } else {
            $sql = "SELECT * FROM tbl_payment_methods WHERE user_type=0 AND pay_status=1 AND pay_id=?";
            $params = array($id);
            if ($justOneSelect == 1) {
                return $this->doSelect($sql, $params, $justOneSelect);
            } else {
                return $this->doSelect($sql, $params);
            }
        }
    }

    function getAllPageLinks($count, $pageNo, $href, $perpage, $get_params)
    {
        unset($get_params['url']); // delete url parameter;
        $params = http_build_query($get_params);
        $params = $params!="" ? "?".$params:"";

        $output = '';
        if (!isset($pageNo)) $pageNo = 1;
        if ($perpage != 0)
            $pages = ceil($count / $perpage);
        if ($pages > 1) {
            $output = '<div class="items-center justify-center sm:flex hidden">';
            if ($pageNo == 1) {
                $output .= '<div class="ml-3 opacity-60">';
                $output .= '<svg class="text-biscay-700 dark:text-white" width="23" height="16" viewBox="0 0 23 16" fill="none" xmlns="http://www.w3.org/2000/svg">';
                $output .= '<path opacity="0.4" d="M6.64577 6.43275L2.05275 6.02655C1.02199 6.02655 0.186279 6.8704 0.186279 7.9112C0.186279 8.952 1.02199 9.79585 2.05275 9.79585L6.64577 9.38965C7.45439 9.38965 8.10996 8.7277 8.10996 7.9112C8.10996 7.09333 7.45439 6.43275 6.64577 6.43275" fill="currentColor"></path>';
                $output .= '<path d="M22.0696 6.50741C21.9978 6.43492 21.7296 6.12856 21.4777 5.87418C20.0081 4.28084 16.1709 1.67543 14.1635 0.878077C13.8588 0.750884 13.0881 0.480085 12.675 0.460937C12.2808 0.460937 11.9043 0.552571 11.5453 0.733104C11.097 0.986123 10.7394 1.38548 10.5417 1.85596C10.4157 2.18147 10.218 3.15935 10.218 3.17713C10.0216 4.24528 9.91455 5.98222 9.91455 7.90243C9.91455 9.72964 10.0216 11.3955 10.1827 12.4814C10.2003 12.5005 10.3981 13.7137 10.6135 14.1294C11.0076 14.8899 11.7783 15.3603 12.6032 15.3603H12.675C13.2127 15.3426 14.3423 14.8707 14.3423 14.8543C16.2427 14.057 19.9891 11.5774 21.4953 9.92932C21.4953 9.92932 21.9206 9.50534 22.1048 9.24138C22.392 8.86117 22.5355 8.39069 22.5355 7.92021C22.5355 7.39503 22.3744 6.90677 22.0696 6.50741" fill="currentColor"></path>';
                $output .= '</svg>';
                $output .= ' </div>';
            } else {
                $output .= '<a class="ml-3 hover:opacity-80" href="' . $href . "/page/" . ($pageNo - 1) . $params . '" data-turbolinks="false" wire:click.prevent="previousPage" rel="prev">';
                $output .= '<svg class="text-biscay-700 dark:text-white" width="23" height="16" viewBox="0 0 23 16" fill="none" xmlns="http://www.w3.org/2000/svg">';
                $output .= '<path opacity="0.4" d="M6.64577 6.43275L2.05275 6.02655C1.02199 6.02655 0.186279 6.8704 0.186279 7.9112C0.186279 8.952 1.02199 9.79585 2.05275 9.79585L6.64577 9.38965C7.45439 9.38965 8.10996 8.7277 8.10996 7.9112C8.10996 7.09333 7.45439 6.43275 6.64577 6.43275" fill="currentColor"></path>';
                $output .= '<path d="M22.0696 6.50741C21.9978 6.43492 21.7296 6.12856 21.4777 5.87418C20.0081 4.28084 16.1709 1.67543 14.1635 0.878077C13.8588 0.750884 13.0881 0.480085 12.675 0.460937C12.2808 0.460937 11.9043 0.552571 11.5453 0.733104C11.097 0.986123 10.7394 1.38548 10.5417 1.85596C10.4157 2.18147 10.218 3.15935 10.218 3.17713C10.0216 4.24528 9.91455 5.98222 9.91455 7.90243C9.91455 9.72964 10.0216 11.3955 10.1827 12.4814C10.2003 12.5005 10.3981 13.7137 10.6135 14.1294C11.0076 14.8899 11.7783 15.3603 12.6032 15.3603H12.675C13.2127 15.3426 14.3423 14.8707 14.3423 14.8543C16.2427 14.057 19.9891 11.5774 21.4953 9.92932C21.4953 9.92932 21.9206 9.50534 22.1048 9.24138C22.392 8.86117 22.5355 8.39069 22.5355 7.92021C22.5355 7.39503 22.3744 6.90677 22.0696 6.50741" fill="currentColor"></path>';
                $output .= '</svg>';
                $output .= ' </a>';
            }

            $output .= ' <ul class="flex items-center flex-row">';
            if (($pageNo - 3) > 0) {
                if ($pageNo == 1) {
                    $output .= '<li class="mx-1">';
                    $output .= '<span class="min-w-pagination h-8 flex items-center justify-center border border-gray-300 dark:bg-dark-930 dark:border-opacity-0 border-opacity-30 text-white bg-biscay-700 rounded">';
                    $output .= 1;
                    $output .= '</span>';
                    $output .= '</li>';
                } else {
                    $output .= '<li class="mx-1">';
                    $output .= '<a class="min-w-pagination h-8 flex items-center justify-center border dark:text-gray-920 border-gray-300 border-opacity-30 text-biscay-700 rounded transition duration-200 hover:bg-biscay-650 hover:text-white" href="' . $href . '/page/1' . $params . '">';
                    $output .= 1;
                    $output .= '</a>';
                    $output .= '</li>';
                }
            }

            if (($pageNo - 3) > 1) {
                $output .= '<li class="mx-1">';
                $output .= '<span class="min-w-pagination h-8 flex items-center justify-center border dark:text-gray-920 border-gray-300 border-opacity-30 text-biscay-700 rounded transition duration-200 hover:bg-biscay-650 hover:text-white">';
                $output .= "...";
                $output .= '</span>';
                $output .= '</li>';
            }

            for ($i = ($pageNo - 2); $i <= ($pageNo + 2); $i++) {
                if ($i < 1) continue;
                if ($i > $pages) break;
                if ($pageNo == $i) {
                    $output .= '<li class="mx-1">';
                    $output .= '<span class="min-w-pagination h-8 flex items-center justify-center border border-gray-300 dark:bg-dark-930 dark:border-opacity-0 border-opacity-30 text-white bg-biscay-700 rounded">';
                    $output .= $i;
                    $output .= '</span>';
                    $output .= '</li>';
                } else {
                    $output .= '<li class="mx-1">';
                    $output .= '<a class="min-w-pagination h-8 flex items-center justify-center border dark:text-gray-920 border-gray-300 border-opacity-30 text-biscay-700 rounded transition duration-200 hover:bg-biscay-650 hover:text-white" href="' . $href . '/page/' . $i . $params . '">';
                    $output .= $i;
                    $output .= '</a>';
                    $output .= '</li>';
                }
            }

            if (($pages - ($pageNo + 2)) > 1) {
                $output .= '<li class="mx-1">';
                $output .= '<span class="min-w-pagination h-8 flex items-center justify-center border dark:text-gray-920 border-gray-300 border-opacity-30 text-biscay-700 rounded transition duration-200 hover:bg-biscay-650 hover:text-white">';
                $output .= "...";
                $output .= '</span>';
                $output .= '</li>';
            }
            if (($pages - ($pageNo + 2)) > 0) {
                if ($pageNo == $pages) {
                    $output .= '<li class="mx-1">';
                    $output .= '<span class="min-w-pagination h-8 flex items-center justify-center border border-gray-300 dark:bg-dark-930 dark:border-opacity-0 border-opacity-30 text-white bg-biscay-700 rounded">';
                    $output .= $pages;
                    $output .= '</span>';
                    $output .= '</li>';
                } else {
                    $output .= '<li class="mx-1">';
                    $output .= '<a class="min-w-pagination h-8 flex items-center justify-center border dark:text-gray-920 border-gray-300 border-opacity-30 text-biscay-700 rounded transition duration-200 hover:bg-biscay-650 hover:text-white" href="' . $href . '/page/' . $pages . $params . '">';
                    $output .= $pages;
                    $output .= '</a>';
                    $output .= '</li>';
                }
            }

            $output .= '</ul>';

            if ($pageNo < $pages) {
                $output .= '<a class="mr-3 hover:opacity-80" href="' . $href . '/page/' . ($pageNo + 1) . $params . '" data-turbolinks="false" wire:click.prevent="nextPage" rel="next">';
                $output .= '<svg class="text-biscay-700 dark:text-white" width="24" height="16" viewBox="0 0 24 16" fill="none" xmlns="http://www.w3.org/2000/svg">';
                $output .= '<path opacity="0.4" d="M16.6145 6.43275L21.2075 6.02655C22.2383 6.02655 23.074 6.8704 23.074 7.9112C23.074 8.952 22.2383 9.79585 21.2075 9.79585L16.6145 9.38965C15.8059 9.38965 15.1503 8.7277 15.1503 7.9112C15.1503 7.09333 15.8059 6.43275 16.6145 6.43275" fill="currentColor"></path>';
                $output .= '<path d="M1.19065 6.50741C1.26243 6.43492 1.53062 6.12856 1.78255 5.87418C3.25216 4.28084 7.08938 1.67543 9.09672 0.878077C9.40147 0.750884 10.1722 0.480085 10.5853 0.460937C10.9794 0.460937 11.356 0.552571 11.7149 0.733104C12.1632 0.986123 12.5208 1.38548 12.7186 1.85596C12.8445 2.18147 13.0423 3.15935 13.0423 3.17713C13.2387 4.24528 13.3457 5.98222 13.3457 7.90243C13.3457 9.72964 13.2387 11.3955 13.0775 12.4814C13.0599 12.5005 12.8622 13.7137 12.6468 14.1294C12.2526 14.8899 11.4819 15.3603 10.6571 15.3603H10.5853C10.0476 15.3426 8.91793 14.8707 8.91793 14.8543C7.0176 14.057 3.27112 11.5774 1.76494 9.92932C1.76494 9.92932 1.33964 9.50534 1.15543 9.24138C0.868281 8.86117 0.724707 8.39069 0.724707 7.92021C0.724707 7.39503 0.885889 6.90677 1.19065 6.50741" fill="currentColor"></path>';
                $output .= '</svg>';
                $output .= '</a>';
            } else {
                $output .= '<div class="mr-3 opacity-60">';
                $output .= '<svg class="text-biscay-700 dark:text-white" width="24" height="16" viewBox="0 0 24 16" fill="none" xmlns="http://www.w3.org/2000/svg">';
                $output .= '<path opacity="0.4" d="M16.6145 6.43275L21.2075 6.02655C22.2383 6.02655 23.074 6.8704 23.074 7.9112C23.074 8.952 22.2383 9.79585 21.2075 9.79585L16.6145 9.38965C15.8059 9.38965 15.1503 8.7277 15.1503 7.9112C15.1503 7.09333 15.8059 6.43275 16.6145 6.43275" fill="currentColor"></path>';
                $output .= '<path d="M1.19065 6.50741C1.26243 6.43492 1.53062 6.12856 1.78255 5.87418C3.25216 4.28084 7.08938 1.67543 9.09672 0.878077C9.40147 0.750884 10.1722 0.480085 10.5853 0.460937C10.9794 0.460937 11.356 0.552571 11.7149 0.733104C12.1632 0.986123 12.5208 1.38548 12.7186 1.85596C12.8445 2.18147 13.0423 3.15935 13.0423 3.17713C13.2387 4.24528 13.3457 5.98222 13.3457 7.90243C13.3457 9.72964 13.2387 11.3955 13.0775 12.4814C13.0599 12.5005 12.8622 13.7137 12.6468 14.1294C12.2526 14.8899 11.4819 15.3603 10.6571 15.3603H10.5853C10.0476 15.3426 8.91793 14.8707 8.91793 14.8543C7.0176 14.057 3.27112 11.5774 1.76494 9.92932C1.76494 9.92932 1.33964 9.50534 1.15543 9.24138C0.868281 8.86117 0.724707 8.39069 0.724707 7.92021C0.724707 7.39503 0.885889 6.90677 1.19065 6.50741" fill="currentColor"></path>';
                $output .= '</svg>';
                $output .= '</div>';
            }

            $output .= '</div>';

            $output .= '<div class="flex sm:hidden items-center justify-between w-full flex-row-reverse">';

            if ($pageNo < $pages) {
                $output .= '<a href="' . $href . '/page/' . ($pageNo + 1) . $params . '" data-turbolinks="false" rel="next" class="border border-gray-700 text-gray-700 rounded-md bg-white shadow-md py-2 px-6 font-medium text-base hover:text-white hover:bg-biscay-700 hover:border-white transition duration-200">';
                $output .= 'صفحه بعد';
                $output .= '</a>';
            } else {
                $output .= '<button rel="next" class="opacity-30 cursor-not-allowed border border-gray-700 text-gray-700 rounded-md bg-white shadow-md py-2 px-6 font-medium text-base hover:text-white hover:bg-biscay-700 hover:border-white transition duration-200">';
                $output .= 'صفحه بعد';
                $output .= '</button>';
            }

            if ($pageNo == 1) {
                $output .= '<button disabled="" rel="prev" class="opacity-30 cursor-not-allowed border border-gray-700 text-gray-700 rounded-md bg-white shadow-md py-2 px-6 font-medium text-base hover:text-white hover:bg-biscay-700 hover:border-white transition duration-200">';
                $output .= 'صفحه قبل';
                $output .= '</button>';
            } else {
                $output .= '<a href="' . $href . "/page/" . ($pageNo - 1) . $params . '" data-turbolinks="false" wire:click.prevent="previousPage" rel="prev" class="border border-gray-700 text-gray-700 rounded-md bg-white shadow-md py-2 px-6 font-medium text-base hover:text-white hover:bg-biscay-700 hover:border-white transition duration-200">';
                $output .= 'صفحه قبل';
                $output .= '</a>';
            }

            $output .= '</div>';
        }
        return $output;
    }

    function getCommentData($id, $type, $userId, $limit = 20)
    {
        $sql = "SELECT cm_id,cm_answer_id,cm_reply_admin_id,cm_date,cm_time,c_display_name,b.c_image,cm_text,l.cl_id as liked,
				(SELECT COUNT(cl_id) as count FROM tbl_comment_like WHERE comment_id=a.cm_id AND cl_type=?) as likeCount
                FROM tbl_comments a
                LEFT JOIN tbl_customer b ON a.cm_user_id=b.customer_vids_id
                LEFT JOIN tbl_comment_like l ON (a.cm_id=l.comment_id AND l.cl_type=? AND user_id='$userId')
                WHERE a.p_id=? AND a.cm_status=1 AND a.cm_type=? AND a.reply=0 ORDER BY cm_id DESC LIMIT " . $limit;
        $result = $this->doSelect($sql, array($type, $type, $id, $type));

        $res = array();
        $res['count'] = sizeof($result) > 0 ? sizeof($result) : 0;
        foreach ($result as $item) {
            $res['comments']["comment-" . $item['cm_id']]['comment'] = $item;

            $sql_reply = "SELECT cm_id,cm_answer_id,cm_reply_admin_id,cm_date,cm_time,c_display_name,b.c_image,cm_text,l.cl_id as liked,
				(SELECT COUNT(cl_id) as count FROM tbl_comment_like WHERE comment_id=a.cm_id AND cl_type=?) as likeCount
                FROM tbl_comments a
                LEFT JOIN tbl_customer b ON a.cm_user_id=b.customer_vids_id
                LEFT JOIN tbl_comment_like l ON (a.cm_id=l.comment_id AND l.cl_type=? AND user_id='$userId')
                WHERE a.p_id=? AND a.cm_status=1 AND a.cm_type=? AND a.cm_answer_id=? ORDER BY cm_id DESC";
            $reply = $this->doSelect($sql_reply, array($type, $type, $id, $type, $item['cm_id']));

            if (sizeof($reply) > 0) {
                $res['count'] = $res['count'] + sizeof($reply);
                $res['comments']["comment-" . $item['cm_id']]['reply'] = $reply;
            } else {
                $res['comments']["comment-" . $item['cm_id']]['reply'] = NULL;
            }
        }

        return $res;
    }

    function getBlogData($print_query = False, $userId = False, $where = '', $order = '', $limit = '', $input = array(), $join = '', $select_one = False)
    {
        $sql = "SELECT a.*,b.name,b.link,d.title AS sourceName,d.image AS sourceImg,d.title AS sourceName,d.link AS sourceLink,e.a_name AS writer,e.a_id AS writerId,e.a_image as writerImage,e.a_desc as writerDesc,ar.ar_title as writerRole,
                    (SELECT COUNT(cm_id) FROM `tbl_comments` WHERE cm_status=1 AND cm_type='blog' AND p_id=a.n_id) as commentCount,
					(SELECT COUNT(l_id) as count FROM tbl_like WHERE item_id=a.n_id AND l_type='blog') as likeCount, l.l_id as liked,
					(SELECT COUNT(b_id) as count FROM tbl_bookmarks WHERE item_id=a.n_id AND b_type='blog') as bookmarkCount, bo.b_id as bookmarked
                    FROM tbl_blog a
                    LEFT JOIN tbl_category b ON a.cat_id=b.id
                    LEFT JOIN tbl_sources d ON a.source=d.so_id
                    LEFT JOIN tbl_admin e ON a.writer=e.a_id
                    LEFT JOIN tbl_admin_role ar ON e.admin_role_id=ar.ar_id
                    LEFT JOIN tbl_like l ON (a.n_id=l.item_id AND l.l_type='blog' AND l.user_id='$userId')
                    LEFT JOIN tbl_bookmarks bo ON (a.n_id=bo.item_id AND bo.b_type='blog' AND bo.user_id='$userId')
                    $join
                    $where $order $limit";

        if ($print_query) {
            file_put_contents("query.json", print_r($sql, true));
        }

        if ($select_one) {
            $result = $this->doSelect($sql, $input, 1);
        } else {
            $result = $this->doSelect($sql, $input);
        }

        return $result;
    }

    function getServiceData($print_query = False, $userId = False, $where = '', $order = '', $limit = '', $input = array(), $join = '', $select_one = False)
    {
        $sql = "SELECT s.*,
                    (SELECT COALESCE(AVG(r_rate), 0) FROM `tbl_rating` WHERE r_type='service' AND item_id=s.s_id) as rating, 
                    (SELECT case when l_id is null then '0' else '1' end isset FROM tbl_like WHERE user_id='$userId' AND item_id=s.s_id AND l_type='service') as liked, 
                    (SELECT COUNT(l_id) as count FROM tbl_like WHERE item_id=s.s_id AND l_type='service') as likeCount,
                    (SELECT case when b_id is null then '0' else '1' end isset FROM tbl_bookmarks WHERE user_id='$userId' AND item_id=s.s_id AND b_type='service') as bookmarked,                                 
                    (SELECT COUNT(b_id) as count FROM tbl_bookmarks WHERE item_id=s.s_id AND b_type='service') as bookmark_count
                    FROM tbl_services s
                    LEFT JOIN tbl_like l ON (s.s_id=l.item_id AND l.l_type='service' AND user_id='$userId')
                    $join
                    $where $order $limit";

        if ($print_query) {
            file_put_contents("query.json", print_r($sql, true));
        }

        if ($select_one) {
            $result = $this->doSelect($sql, $input, 1);
        } else {
            $result = $this->doSelect($sql, $input);
        }

        return $result;
    }

    function ActivityLog($activity, $id='', $data=NULL)
    {
        try {
            $this->cookieInit();
            if ($id != '') {
                $adminId = $id;
            } else {
                $adminId = $this->Decrypt($this->cookieGet('adminId'), KEY);
            }
            $ip = $this->getClientIP();
            $detect = $this->detectBrowser();

            $sql2 = "INSERT INTO tbl_admin_activity (admin_id, ip, platform, browser, activity, data_changed) VALUES (?,?,?,?,?,?)";
            $params = array($adminId, $ip, $detect['platform'], $detect['name'], $activity, $data);
            $this->doQuery($sql2, $params);
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }
}

?>
