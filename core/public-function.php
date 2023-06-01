<?php

trait publicTrait
{
    public static function minify_style_file($styles)
    {
        $styles = preg_replace('/\s+/is', ' ', $styles);
        $styles = str_replace(array('; }'), '}', $styles);
        $styles = str_replace(array('{ '), '{', $styles);
        $styles = str_replace(array('{ {'), '{{', $styles);
        $styles = str_replace(array('} }'), '}}', $styles);
        $styles = str_replace(array(': '), ':', $styles);
        return $styles;
    }

    public static function redirect_link($url, $statusCode = 301)
    {
        if ($statusCode == 404) {
            header('Location: ' . URL . "notfound");
            die();
        } else {
            header('Location: ' . $url, true, $statusCode);
            die();
        }
    }

    public static function file_size_format($path)
    {
        $size = filesize($path);
        $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $power = $size > 0 ? floor(log($size, 1024)) : 0;
        return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
    }

    public static function get_client_ip()
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

    public static function detect_browser()
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

    public static function str_left_replace($search, $replace, $subject)
    {
        $pos = strrpos($subject, $search);
        if ($pos !== false) {
            $subject = substr_replace($subject, $replace, $pos, strlen($search));
        }
        return $subject;
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

    public static function add_parameters_to_url(string $url, array $newParams, string $type): string
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

    public static function convert_numbers($srting, $toPersian = false)
    {
        $en_num = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        $fa_num = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
        if ($toPersian)
            return str_replace($en_num, $fa_num, $srting);
        else
            return str_replace($fa_num, $en_num, $srting);
    }

    public static function generate_activation_code($length = 4)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function generate_random_string($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function upload_file($file, $title = null, $desc = null, $type = null)
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
        $newfilename = self::generate_random_string($config->file_name_lenght) . '.' . end($temp);

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

    //POSTS FUNCTION
    public static function summary($str, $limit = 100, $strip = FALSE)
    {
        $str = ($strip == TRUE) ? strip_tags($str) : $str;
        if (strlen($str) > $limit) {
            $str = substr($str, 0, $limit - 3);

            return (substr($str, 0, strrpos($str, ' ')) . ' ...');
        }

        return trim($str);
    }

    public static function get_read_time($all_content = '')
    {
        $words_per_minute = 200;
        $word = count(explode(" ", strip_tags($all_content)));
        return ceil($word / $words_per_minute);
    }

    //VALIDATE FUNCTION
    public static function check_param($val)
    {
        $value = addslashes($val);
        $string1 = htmlspecialchars($value);
        $string2 = strip_tags($string1);

        return $string2;
    }

    function pass_validate($password)
    {
        //password bayad 8 raghami va daraye add,horof bozorg bashe
        return preg_match('/^(?=^.{8,}$)((?=.*[A-Za-z0-9])(?=.*[A-Z])(?=.*[a-z]))^.*$/', $password);
    }

    public static function validate_token($token = NULL)
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

    public static function validate_mobile($mobile)
    {
        $mobile = self::convert_numbers($mobile); //make sure all numbers are en format

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

    //COOKIE FUNCTION
    public static function cookie_init()
    {
        @ob_start();
    }

    public static function cookie_set($name, $value, $duratain)
    {
        @self::cookie_init();
        setcookie($name, $value, $duratain, '/', NULL, NULL, TRUE);
    }

    public static function cookie_get($name)
    {
        @self::cookie_init();
        if (isset($_COOKIE[$name])) {
            return $_COOKIE[$name];
        } else {
            return FALSE;
        }
    }

    //SESSION FUNCTION
    public static function session_init()
    {
        @session_start();
    }

    public static function session_set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public static function session_get($name)
    {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        } else {
            return FALSE;
        }
    }

    //HASH FUNCTION
    public static function get_encoded_video_string($type, $file)
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

    //DATABASE FUNCTION
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

    //DATE FUNCTION
    public static function jalali_date($format = 'Y/m/d')
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

    public static function jalali_to_miladi($jalili, $format = '/', $format_export = '/')
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
        if ($dateInfo != self::jalali_date()) {
            $date = explode($dateDelimiter, $dateInfo);
            $time = explode($timeDelimiter, $timeInfo);
            $timestamp = jmktime($time['0'], $time['1'], 00, $date['1'], $date['2'], $date['0']);

            return jdate("l, j F Y", $timestamp);
        } else {
            $date = Model::jalali_to_miladi($dateInfo, "/", "-");
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

    public static function miladi_to_jalali($miladi, $exp = '/', $format = '/')
    {
        $miladi = explode($exp, $miladi);
        $year = $miladi[0];
        $month = $miladi[1];
        $day = $miladi[2];
        $date = gregorian_to_jalali($year, $month, $day);
        $date = implode($format, $date);

        return $date;
    }

    public static function miladi_to_jalali_2no($miladi, $exp = '/', $format = '/')
    {
        list($year, $month, $day) = explode($exp, $miladi);
        $timestamp = mktime(0, 0, 0, $month, $day, $year);

        $jalali_date = jdate("Y" . $format . "m" . $format . "d", $timestamp);

        return $jalali_date;
    }

    public static function create_date_range_array($strDateFrom, $strDateTo, $type_of_date="en", $add_first_entry=TRUE, $divider="-")
    {
        $aryRange = [];

        $iDateFrom = mktime(1, 0, 0, substr($strDateFrom, 5, 2), substr($strDateFrom, 8, 2), substr($strDateFrom, 0, 4));
        $iDateTo = mktime(1, 0, 0, substr($strDateTo, 5, 2), substr($strDateTo, 8, 2), substr($strDateTo, 0, 4));

        if($type_of_date == "fa") {
            if ($iDateTo >= $iDateFrom) {
                if($add_first_entry) {
                    $aryRange[] = array(
                        "fa" => date('Y/m/d', $iDateFrom),
                        "Y" => date('Y', $iDateFrom),
                        "m" => date('m', $iDateFrom),
                        "d" => date('d', $iDateFrom),
                    ); // first entry
                }
                while ($iDateFrom < $iDateTo) {
                    $iDateFrom += 86400; // add 24 hours
                    $aryRange[] = array(
                        "fa" => date('Y'.$divider.'m'.$divider.'d', $iDateFrom),
                        "Y" => date('Y', $iDateFrom),
                        "m" => date('m', $iDateFrom),
                        "d" => date('d', $iDateFrom),
                    );
                }
            }
        } else {
            if ($iDateTo >= $iDateFrom) {
                if($add_first_entry) {
                    $aryRange[] = array(
                        "fa" => self::MiladiTojalili_2no(date('Y'.$divider.'m'.$divider.'d', $iDateFrom), "-"),
                        "en" => date('Y'.$divider.'m'.$divider.'d', $iDateFrom)
                    ); // first entry
                }
                while ($iDateFrom < $iDateTo) {
                    $iDateFrom += 86400; // add 24 hours
                    $aryRange[] = array(
                        "fa" => self::MiladiTojalili_2no(date('Y'.$divider.'m'.$divider.'d', $iDateFrom), "-"),
                        "en" => date('Y'.$divider.'m'.$divider.'d', $iDateFrom)
                    );
                }
            }
        }
        return $aryRange;
    }

    public static function jalali_after($jalaliDate, $afterDays)
    {
        list($y, $m, $d) = explode('/', $jalaliDate);
        $ts = jmktime(0, 0, 0, $m, $d, $y);
        for ($i = 0; $i < $afterDays; $i++) {
            $ts += 86400;
        }
        return jdate('Y/m/d', $ts, '', 'Asia/Tehran', 'en');
    }

    public static function date_difference($firstDate, $secondDate)
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

    public static function time_compare($compareTime, $baseTime)
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

    //RESPONSE FUNCTION
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

    //SOCIAL MEDIA FUNCTION
    public static function send_email($email_to, $name, $content, $subject)
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
        $mail->Username = "";
        $mail->Password = "";
        $mail->ContentType = 'text/html';
        $mail->setFrom('', NAME);
        $mail->addAddress($email_to, $name);
        $mail->Subject = $subject;
        $mail->AltBody = 'متاسفانه برنامه شما از این ایمیل پشتیبانی نمی کند، برای دیدن آن، لطفا از برنامه دیگری استفاده نمائید';
        $mail->msgHTML($content, dirname(__FILE__));
        if (!$mail->send()) {
            return $mail->ErrorInfo;
        } else {
            return "ok";
        }
    }

    public static function telegram_send_photo($photo, $caption, $channel, $encoded_markup = '')
    {
        $caption = urlencode($caption);
        $curl = curl_init("https://api.telegram.org/bot" . self::getPublicInfo('bot_token') . "/sendPhoto");
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, "chat_id=" . $channel . "&photo=$photo&caption=$caption&reply_markup=$encoded_markup");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }

    public static function telegram_send_message($text, $channel, $encoded_markup = '')
    {
        $text = urlencode($text);
        $curl = curl_init("https://api.telegram.org/bot" . self::getPublicInfo('bot_token') . "/sendMessage");
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, "chat_id=" . $channel . "&text=$text&reply_markup=$encoded_markup&parse_mode=HTML");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }


}