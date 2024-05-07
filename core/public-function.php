<?php

trait publicTrait
{

    //VALIDATE FUNCTION
    public static function check_param($val)
    {
        $value = addslashes($val);
        $string1 = htmlspecialchars($value);
        $string2 = strip_tags($string1);

        return $string2;
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

    //DATE FUNCTION
    public static function jalali_date($format = 'Y/m/d')
    {
        $date = jdate($format, '', '', 'Asia/Tehran', 'en');
        return $date;
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
                        "fa" => self::miladi_to_jalali_2no(date('Y'.$divider.'m'.$divider.'d', $iDateFrom), "-"),
                        "en" => date('Y'.$divider.'m'.$divider.'d', $iDateFrom)
                    ); // first entry
                }
                while ($iDateFrom < $iDateTo) {
                    $iDateFrom += 86400; // add 24 hours
                    $aryRange[] = array(
                        "fa" => self::miladi_to_jalali_2no(date('Y'.$divider.'m'.$divider.'d', $iDateFrom), "-"),
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


}