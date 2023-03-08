<?php

/**
 *
 * @author hossein beiki  <ho33ein.b@gmail.com>
 * @site hosseinbeiki.ir
 * @version 1.0.0
 *
 **/
class model_api extends Model
{
    function __construct()
    {
        parent::__construct();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $checkToken = self::Validate_token($_REQUEST['api_key']);
            if (!$checkToken) {
                $data = ["description" => "Unauthorized: Api key is invalid"];
                self::generate_jsonp(FALSE, "result", $data);
                exit;
            }
        } else {
            $data = ["description" => "Unauthorized: Method Not Allowed"];
            self::generate_jsonp(FALSE, "result", $data);
            exit;
        }
    }

    //Not Found: method not found
    function index()
    {
        $data = ["description" => "Not Found: method not found"];
        self::generate_jsonp(FALSE, "result", $data);
        exit;
    }

    //calculate user level
    function calculatePoints($getData)
    {
        $userId = $this->getUserID($getData['token']);
        if ($userId != FALSE) {
            if (isset($getData['data'])) {
                $data = json_decode($getData['data'], TRUE);

                $score = 0;
                foreach ($data as $item) {
                    $check = $this->getIssetChallange($item['challenge_id']);
                    if (!$check) {
                        $data = ["description" => "Challenge not found!"];
                        self::generate_jsonp(FALSE, "result", $data);
                        die();
                    }
                    $sql2 = "INSERT INTO usr_gameplay (idusr_users,idcml_challenges,points) VALUES (?,?,?)";
                    $params = [$userId, $item['challenge_id'], $item['point']];
                    $this->doQuery($sql2, $params);
                    $score += $item['point'];
                }

                $levelID = NULL;
                $sqlSel = "SELECT min_point,idcml_levels,`name` FROM cml_levels ORDER BY reading_Order ASC";
                $level = $this->doSelect($sqlSel);
                foreach ($level as $item) {
                    if ($score >= $item['min_point']) {
                        $levelID = $item['idcml_levels'];
                    }
                }

                if ($levelID != NULL) {
                    $this->ActivityLog($userId, 'calculate user level');
                    $data = $this->getLevel($getData, FALSE, $levelID);
                    self::generate_jsonp(TRUE, "result", $data);
                } else {
                    $this->ActivityLog($userId, 'can not calculate user level');
                    $data = ["description" => "can not calculate level"];
                    self::generate_jsonp(FALSE, "result", $data);
                }
            } else {
                $data = ["description" => "data is empty"];
                self::generate_jsonp(FALSE, "result", $data);
            }
        } else {
            $data = ["description" => "Token is invalid"];
            self::generate_jsonp(FALSE, "result", $data);
        }
    }

    //calculate user level
    function saveScore($getData)
    {
        $userId = $this->getUserID($getData['token']);
        if ($userId != FALSE) {
            if (isset($getData['data'])) {
                $data = json_decode($getData['data'], TRUE);
                if (!$data || !isset($getData['data'][0])) {
                    $data = ["description" => "data is empty"];
                    self::generate_jsonp(FALSE, "result", $data);
                    die();
                }
                $score = 0;

                $episode = $this->getIssetEpisode($data[0]['episode_id']);
                if (!$episode) {
                    $data = ["description" => "data is empty"];
                    self::generate_jsonp(FALSE, "result", $data);
                    die();
                }

                foreach ($data as $item) {
                    $score += $item['point'];
                }

                $query = "SELECT sum(points) as sumall FROM `cml_epsd_chall`
left join cml_challenges on cml_challenges.idcml_challenges = cml_epsd_chall.idcml_challenges
where idcml_episodes = ?";
                $level = $this->doSelect($query, [$data[0]['episode_id']]);

                $query1 = "SELECT * FROM `users_scores` where user_id=? and episode_id = ?";
                $users_scores = $this->doSelect($query1, [$userId, $data[0]['episode_id']]);
                if (sizeof($users_scores) > 0) {
                    if ($users_scores[0]['points'] <= 80) {
                        $sqlUpdateMobile = "UPDATE users_scores SET points=? WHERE user_id=? and episode_id=?";
                        $paramsUpdateMobile = [($score * 100 / $level[0]['sumall']), $userId, $data[0]['episode_id']];
                        $this->doQuery($sqlUpdateMobile, $paramsUpdateMobile);
                    }
                } else {
                    $sql2 = "INSERT INTO users_scores (user_id,episode_id,points) VALUES (?,?,?)";
                    $params = [$userId, $data[0]['episode_id'], ($score * 100 / $level[0]['sumall'])];
                    $this->doQuery($sql2, $params);
                }


                // increase sesasion and epipsode
                if (($score * 100 / $level[0]['sumall']) > 80) {
                    $query = "SELECT * FROM `cml_episodes` where idcml_episodes = ?";
                    $episode = $this->doSelect($query, [$data[0]['episode_id']]);

                    $next_episode = $this->doSelect("SELECT idcml_episodes FROM `cml_episodes`
                left join unlocked_episodes on unlocked_episodes.episode_id = cml_episodes.idcml_episodes and unlocked_episodes.user_id = ?
                where idcml_seasons = ? ORDER By reading_Order ASC ", [$userId, $episode[0]['idcml_seasons']]);

                    $next_episode_id = NULL;
                    $current = FALSE;

                    foreach ($next_episode as $tnex) {
                        if ($tnex['idcml_episodes'] == $data[0]['episode_id']) {
                            $current = TRUE;
                            continue;
                        }
                        if ($current) {
                            $next_episode_id = $tnex;
                            break;
                        }
                    }


                    if ($next_episode_id && isset($next_episode_id['idcml_episodes'])) {
                        $sql2 = "INSERT INTO unlocked_episodes (user_id,episode_id) VALUES (?,?) ON DUPLICATE KEY UPDATE user_id = ?;";
                        $params = [$userId, $next_episode_id['idcml_episodes'], $userId];
                        $this->doQuery($sql2, $params);
                    } else {

                        $next_season = $this->doSelect("SELECT cml_levels.reading_Order as level_order, cml_seasons.* FROM `cml_seasons`
                        left join cml_levels on cml_levels.idcml_levels = cml_seasons.idcml_levels
                        order by level_order, reading_Order");
                        $next_season_id = NULL;
                        $current = FALSE;

                        foreach ($next_season as $tnex) {
                            if ($tnex['idcml_seasons'] == $episode[0]['idcml_seasons']) {
                                $current = TRUE;
                                continue;
                            }
                            if ($current) {
                                $next_season_id = $tnex;
                                break;
                            }
                        }

                        if (isset($next_season_id['idcml_seasons'])) {
                            //unlock next season

                            $sql2 = "INSERT INTO unlocked_seasons (user_id,season_id) VALUES (?,?) ON DUPLICATE KEY UPDATE user_id = ?;";
                            $params = [$userId, $next_season_id['idcml_seasons'], $userId];
                            $this->doQuery($sql2, $params);


                            $next_episode = $this->doSelect("SELECT idcml_episodes FROM `cml_episodes` left join unlocked_episodes on unlocked_episodes.episode_id = cml_episodes.idcml_episodes and unlocked_episodes.user_id = ?
                where    idcml_seasons = ? ORDER By reading_Order ASC LIMIT 1 ", [$userId, $next_season_id['idcml_seasons']]);

                            if (sizeof($next_episode) > 0) {
                                $sql2 = "INSERT INTO unlocked_episodes (user_id,episode_id) VALUES (?,?) ON DUPLICATE KEY UPDATE user_id = ?;";
                                $params = [$userId, $next_episode[0]['idcml_episodes'], $userId];
                                $this->doQuery($sql2, $params);

                            }
                        }
                    }
                }

                $data = ["description" => [
                    'your_achieved_points' => (int)$score,
                    'episode_total_points' => (int)$level[0]['sumall'],
                    'percent' => round($score * 100 / $level[0]['sumall']) . '%',
                    'go_to_next_episode' => ($score * 100 / $level[0]['sumall']) > 80 ? TRUE : FALSE
                ]];
                self::generate_jsonp(TRUE, "result", $data);
            } else {
                $data = ["description" => "data is empty"];
                self::generate_jsonp(FALSE, "result", $data);
            }
        } else {
            $data = ["description" => "Token is invalid"];
            self::generate_jsonp(FALSE, "result", $data);
        }
    }

    //get user id
    function getUserID($token)
    {
        $sqlSel = "SELECT user_id FROM usr_login WHERE token=?";
        $paramSel = array($token);
        $userId = $this->doSelect($sqlSel, $paramSel, 1);

        if (sizeof($userId) > 0) {
            return $userId['user_id'];
        } else {
            return FALSE;
        }
    }

    //log activity
    function ActivityLog($user_id, $activity)
    {
        $sql2 = "INSERT INTO usr_activity (user_id,activity) VALUES (?,?)";
        $params = array($user_id, $activity);
        $this->doQuery($sql2, $params);
    }

    //get all level
    function getLevel($getData, $print = TRUE, $id = NULL)
    {
        $userId = $this->getUserID($getData['token']);
        if ($userId != FALSE) {
            if ($id == NULL) {
                $sql = "SELECT l.*,f.src FROM cml_levels l
                    LEFT JOIN sys_files f
                    ON l.image_file=f.idsys_files
                    ORDER BY l.reading_Order ASC";
                $datas = $this->doSelect($sql);
            } else {
                $sql = "SELECT l.*,f.src FROM cml_levels l
                    LEFT JOIN sys_files f
                    ON l.image_file=f.idsys_files
                    WHERE l.idcml_levels=?";
                $param = array($id);
                $datas = $this->doSelect($sql, $param);
            }
            if (is_array($datas)) {
                $responses = array();
                foreach ($datas as $data) {
                    $response['id_levels'] = $data['idcml_levels'];
                    $response['name'] = $data['name'];
                    $response['min_point'] = $data['min_point'];
                    $response['ImgSrc'] = URL . "public/cdn/level/" . $data['src'];

                    array_push($responses, $response);
                }

                if ($print) {
                    $this->ActivityLog($userId, 'get level list');
                    self::generate_jsonp(TRUE, "result", $responses);
                } else {
                    return ["status" => TRUE, "result" => $responses];
                }
            } else {
                $data = ["description" => "FATAL ERROR: database selection error."];
                if ($print) {
                    self::generate_jsonp(FALSE, "result", $data);
                } else {
                    return ["status" => TRUE, "result" => $data];
                }
            }
        } else {
            $data = ["description" => "Token is invalid"];
            if ($print) {
                self::generate_jsonp(FALSE, "result", $data);
            } else {
                return ["status" => TRUE, "result" => $data];
            }
        }
    }

    //register
    function register($getData)
    {
        if (isset($getData['mobile'])) {
            $mobileCeheck = self::Validate_mobile($getData['mobile']);

            if ($mobileCeheck) {
                $mobile = self::Format_mobile_number($getData['mobile']);
                $sqlSel = "SELECT mobile,user_id FROM usr_mobile WHERE mobile=?";
                $paramSel = array($mobile);
                $resExist = $this->doSelect($sqlSel, $paramSel);

                if (sizeof($resExist) == 0) {
                    $newUser = $this->create_new_user($mobile);
                    if ($newUser) {
                        $data = ["description" => "new user created and activation code sent to user.", "user_status" => "new"];
                        self::generate_jsonp(TRUE, "result", $data);
                    } else {
                        $data = ["description" => "Internal Server Error: database insert error."];
                        self::generate_jsonp(FALSE, "result", $data);
                    }
                } else {
                    $oldUser = $this->user_exist_by_mobile($mobile);
                    if ($oldUser) {
                        $sqlSel = "SELECT username FROM usr_users WHERE idusr_users=?";
                        $paramSel = array($resExist['0']['user_id']);
                        $username = $this->doSelect($sqlSel, $paramSel);

                        $data = ["description" => "activation code sent to user.", "user_status" => $username['0']['username']];
                        self::generate_jsonp(TRUE, "result", $data);
                    } else {
                        $data = ["description" => "Internal Server Error: database selection error."];
                        self::generate_jsonp(FALSE, "result", $data);
                    }
                }
            } else {
                $data = ["description" => "Mobile is Invalid"];
                self::generate_jsonp(FALSE, "result", $data);
            }
        } else {
            $data = ["description" => "Mobile is empty"];
            self::generate_jsonp(FALSE, "result", $data);
        }
    }

    //creat new user if mobile not exist
    function create_new_user($mobile)
    {
        //create new user
        $sql2 = "INSERT INTO usr_users (username) VALUES (?)";
        $params = ["new"];
        $this->doQuery($sql2, $params);
        $userId = self::$conn->lastInsertId();
        //create user token
        $userToken = self::generateRandomString(50);

        $sqlSelToken = "SELECT COUNT(*) FROM usr_login WHERE token = ?";
        $paramSelToken = array($userToken);
        $token = $this->doSelect($sqlSelToken, $paramSelToken);
        if (sizeof($token) > 0) { //check if token code is duplicate
            $userToken = self::generateRandomString(50);
        }

        $sqlLogin = "INSERT INTO usr_login (user_id, token) VALUES (?,?)";
        $paramsLogin = [$userId, $userToken];
        $this->doQuery($sqlLogin, $paramsLogin);

        //save mobile number
        $sqlMobile = "INSERT INTO usr_mobile (user_id, mobile) VALUES (?,?)";
        $paramsMobile = [$userId, $mobile];
        $this->doQuery($sqlMobile, $paramsMobile);

        //generate activation code
        $active_code = self::generateActivationCode(5);
        $sqlSelCode = "SELECT COUNT(*) FROM usr_mobile WHERE active_code = ?";
        $paramSelCode = array($active_code);
        $code = $this->doSelect($sqlSelCode, $paramSelCode);
        if (sizeof($code) > 0) { //check if token code is duplicate
            $active_code = self::generateActivationCode(5);
        }

        $sqlUpdateMobile = "UPDATE usr_mobile SET active_code=? WHERE user_id=?";
        $paramsUpdateMobile = [$active_code, $userId];
        $this->doQuery($sqlUpdateMobile, $paramsUpdateMobile);

        $this->ActivityLog($userId, 'Register a mobile number');

        //send activation code
        try {
            // message data
            $data = array(
                "ParameterArray" => array(
                    array(
                        "Parameter" => "VerificationCode",
                        "ParameterValue" => $active_code,
                    ),
                ),
                "Mobile" => $mobile,
                "TemplateId" => 7321,
            );
            $SmsIR_UltraFastSend = new SmsIR_UltraFastSend(SMSAPIKey, SMSSecretKey);
            $SmsIR_UltraFastSend->UltraFastSend($data);

            $this->ActivityLog($userId, 'Send SMS for confirm user mobile number');

            return TRUE;
        } catch (Exeption $e) {
            $this->ActivityLog($userId['user_id'], 'Can not send SMS for confirm user mobile number');

            return FALSE;
        }
    }

    //check mobile number exist in db
    function user_exist_by_mobile($mobile)
    {
        $sqlSelID = "SELECT user_id FROM usr_mobile WHERE mobile=?";
        $paramSelID = array($mobile);
        $userId = $this->doSelect($sqlSelID, $paramSelID, 1);

        //generate activation code
        $active_code = self::generateActivationCode(5);

        $sqlUpdateMobile = "UPDATE usr_mobile SET active_code=? WHERE user_id=?";
        $paramsUpdateMobile = [$active_code, $userId['user_id']];
        $this->doQuery($sqlUpdateMobile, $paramsUpdateMobile);

        //send activation code
        try {
            // message data
            $data = array(
                "ParameterArray" => array(
                    array(
                        "Parameter" => "VerificationCode",
                        "ParameterValue" => $active_code,
                    ),
                ),
                "Mobile" => $mobile,
                "TemplateId" => 7321,
            );
            $SmsIR_UltraFastSend = new SmsIR_UltraFastSend(SMSAPIKey, SMSSecretKey);
            $SmsIR_UltraFastSend->UltraFastSend($data);

            $this->ActivityLog($userId['user_id'], 'Send SMS for login');

            return TRUE;
        } catch (Exeption $e) {
            $this->ActivityLog($userId['user_id'], 'Can not send SMS for login');

            return FALSE;
        }
    }

    //validate code
    function validateCode($getData)
    {
        if (isset($getData['mobile']) && isset($getData['code']) && is_numeric($getData['code'])) {
            $mobile = self::Format_mobile_number($getData['mobile']);

            $sqlSelID = "SELECT idusr_mobile,user_id FROM usr_mobile WHERE mobile=? AND active_code=?";
            $paramSelID = array($mobile, $getData['code']);
            $selectId = $this->doSelect($sqlSelID, $paramSelID);

            if (sizeof($selectId) > 0) {
                $sqlUpdateMobile = "UPDATE usr_mobile SET active_code=? WHERE idusr_mobile=?";
                $paramsUpdateMobile = [NULL, $selectId['0']['idusr_mobile']];
                $this->doQuery($sqlUpdateMobile, $paramsUpdateMobile);

                //get user status
                $sqlSel = "SELECT username FROM usr_users WHERE idusr_users=?";
                $paramSel = array($selectId['0']['user_id']);
                $username = $this->doSelect($sqlSel, $paramSel);
                if ($username['0']['username'] == "new") {
                    $status = "pre-register";
                    $sqlUpdateMobile = "UPDATE usr_users SET username=? WHERE idusr_users=?";
                    $paramsUpdateMobile = [$status, $selectId['0']['user_id']];
                    $this->doQuery($sqlUpdateMobile, $paramsUpdateMobile);
                } else {
                    $sqlSel = "SELECT username FROM usr_users WHERE idusr_users=?";
                    $paramSel = array($selectId['0']['user_id']);
                    $username = $this->doSelect($sqlSel, $paramSel);
                    $status = $username['0']['username'];
                }

                //get token
                $sqlSelToken = "SELECT token FROM usr_login WHERE user_id=?";
                $paramSelToken = array($selectId['0']['user_id']);
                $token = $this->doSelect($sqlSelToken, $paramSelToken, 1);

                $this->ActivityLog($selectId['0']['user_id'], 'Activate mobile number');

                $data = ["token" => $token['token'], "user_status" => $status];
                self::generate_jsonp(TRUE, "result", $data);
            } else {
                $data = ["description" => "Mobile or Code is Invalid"];
                self::generate_jsonp(FALSE, "result", $data);
            }
        } else {
            $data = ["description" => "Mobile or Code is empty"];
            self::generate_jsonp(FALSE, "result", $data);
        }
    }

    //get all data of course
    function getLeaderBoard($getData)
    {
        $userId = $this->getUserID($getData['token']);
        if ($userId != FALSE) {
            $sql = "SELECT l.*,f.src FROM cml_levels l
                    LEFT JOIN sys_files f
                    ON l.image_file=f.idsys_files
                    ORDER BY l.reading_Order ASC";
            $datas = $this->doSelect($sql);

            if (is_array($datas)) {
                $responses = array();
                foreach ($datas as $data) {
                    $current_season = $this->getSeason($data['idcml_levels'], FALSE, TRUE);

                    $response['id_levels'] = $data['idcml_levels'];
                    $response['name'] = $data['name'];
                    $response['min_point'] = $data['min_point'];
                    $response['ImgSrc'] = URL . "public/cdn/level/" . $data['src'];
                    $response['season'] = $current_season;

                    array_push($responses, $response);
                }
                self::generate_jsonp(TRUE, "result", $responses);
            } else {
                $data = ["description" => "FATAL ERROR: database selection error."];
                self::generate_jsonp(FALSE, "result", $data);
            }
        } else {
            $data = ["description" => "Token is invalid"];
            self::generate_jsonp(FALSE, "result", $data);
        }
    }

    //get all data of course
    function getLastEpisode($getData)
    {
        $userId = $this->getUserID($getData['token']);
        if ($userId != FALSE) {
            $check = $this->getIssetLevel($getData['id']);
            if ($check) {
                $sql = "SELECT s.*,f.src,l.name as levelName FROM cml_seasons s
                    LEFT JOIN sys_files f
                    ON s.image_file=f.idsys_files
                    LEFT JOIN cml_levels l
                    ON s.idcml_levels=l.idcml_levels
                    WHERE s.idcml_levels=?
                    ORDER By s.reading_Order ASC";
                $params = array($getData['id']);
                $datas = $this->doSelect($sql, $params);

                if (sizeof($datas) > 0) {
                    $responses = array();
                    foreach ($datas as $data) {
                        //check if locked/unlocked
                        $userId = $this->getUserID($getData['token']);
                        $locked = [];
                        if ($userId) {
                            $locked = $this->doSelect("SELECT * FROM unlocked_seasons WHERE user_id=? and season_id=?", [$userId, $data['idcml_seasons']]);
                        }

                        $response['id_seasons'] = $data['idcml_seasons'];
                        $response['id_levels'] = $data['idcml_levels'];
                        $response['name'] = $data['name'];
                        $response['desc'] = $data['desc'];
                        $response['ImgSrc'] = URL . "public/cdn/season/" . $data['src'];
                        $response['levelName'] = $data['levelName'];
                        $response['locked'] = sizeof($locked) > 0 ? FALSE : TRUE;

                        $current_episode = $this->getEpisode($data['idcml_seasons'], FALSE, TRUE);
                        $response['episodes'] = $current_episode;

                        array_push($responses, $response);
                    }

                    self::generate_jsonp(TRUE, "result", $responses);

                } else {
                    $data = ["description" => "Empty: No season has been added to this level."];
                    self::generate_jsonp(FALSE, "result", $data);
                }

                self::generate_jsonp(TRUE, "result", $current_season);
            } else {
                $data = ["description" => "Not Found: Level not found"];
                self::generate_jsonp(FALSE, "result", $data);
            }
        } else {
            $data = ["description" => "Token is invalid"];
            self::generate_jsonp(FALSE, "result", $data);
        }
    }

    //get all season for level selected
    function getSeason($getId, $print = TRUE, $getEpisode = FALSE)
    {
        $check = $this->getIssetLevel($getId['id']);
        if ($check) {
            $sql = "SELECT s.*,f.src,l.name as levelName FROM cml_seasons s
                    LEFT JOIN sys_files f
                    ON s.image_file=f.idsys_files
                    LEFT JOIN cml_levels l
                    ON s.idcml_levels=l.idcml_levels
                    WHERE s.idcml_levels=?
                    ORDER By s.reading_Order ASC";
            $params = array($getId['id']);
            $datas = $this->doSelect($sql, $params);

            if (sizeof($datas) > 0) {
                $responses = array();
                foreach ($datas as $data) {
                    //check if locked/unlocked
                    $userId = $this->getUserID($getId['token']);
                    $locked = [];
                    if ($userId) {
                        $locked = $this->doSelect("SELECT * FROM unlocked_seasons WHERE user_id=? and season_id=?", [$userId, $data['idcml_seasons']]);
                    }

                    $response['id_seasons'] = $data['idcml_seasons'];
                    $response['id_levels'] = $data['idcml_levels'];
                    $response['name'] = $data['name'];
                    $response['desc'] = $data['desc'];
                    $response['ImgSrc'] = URL . "public/cdn/season/" . $data['src'];
                    $response['levelName'] = $data['levelName'];
                    $response['locked'] = sizeof($locked) > 0 ? FALSE : TRUE;

                    if ($getEpisode) {
                        $current_episode = $this->getEpisode($data['idcml_seasons'], FALSE, TRUE);
                        $response['episodes'] = $current_episode;
                    }

                    array_push($responses, $response);
                }

                if ($print) {
                    $userId = $this->getUserID($getId['token']);
                    if ($userId != FALSE) {
                        $this->ActivityLog($userId, 'get season');
                        self::generate_jsonp(TRUE, "result", $responses);
                    } else {
                        $data = ["description" => "Token is invalid"];
                        self::generate_jsonp(FALSE, "result", $data);
                    }
                } else {
                    return ["status" => TRUE, "result" => $responses];
                }
            } else {
                $data = ["description" => "Empty: No season has been added to this level."];
                if ($print) {
                    self::generate_jsonp(FALSE, "result", $data);
                } else {
                    return ["status" => FALSE, "result" => $data];
                }
            }
        } else {
            $data = ["description" => "Not Found: level not found"];
            if ($print) {
                self::generate_jsonp(FALSE, "result", $data);
            } else {
                return ["status" => FALSE, "result" => $data];
            }
        }
    }

    //check level id
    function getIssetLevel($id)
    {
        $sql = "SELECT idcml_levels FROM cml_levels WHERE idcml_levels= ?";
        $param = array($id);
        $result = $this->doSelect($sql, $param);

        if (sizeof($result) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //check chann id
    function getIssetChallange($id)
    {
        $sql = "SELECT idcml_challenges FROM cml_challenges WHERE idcml_challenges= ?";
        $param = array($id);
        $result = $this->doSelect($sql, $param);

        if (sizeof($result) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //get all episodes for season selected
    function getEpisode($getId, $print = TRUE, $getChallenge = FALSE)
    {
        $check = $this->getIssetSeason($getId['id']);
        if ($check) {
            $sql = "SELECT e.*,f.src,s.name as seasonName,l.name as levelName FROM cml_episodes e
                    LEFT JOIN cml_seasons s
                    ON e.idcml_seasons=s.idcml_seasons
                    LEFT JOIN cml_levels l
                    ON s.idcml_levels=l.idcml_levels
                    LEFT JOIN sys_files f
                    ON e.image_file=f.idsys_files
                    WHERE e.idcml_seasons=?
                    ORDER BY e.reading_Order ASC";
            $params = array($getId['id']);
            $datas = $this->doSelect($sql, $params);

            if (sizeof($datas) > 0) {

                $responses = array();
                foreach ($datas as $data) {
                    //check if locked/unlocked
                    $userId = $this->getUserID($getId['token']);
                    $locked = [];
                    if ($userId)
                        $locked = $this->doSelect("SELECT * FROM unlocked_episodes WHERE user_id=? and episode_id=?", [$userId, $data['idcml_episodes']]);

                    $response['id_episodes'] = $data['idcml_episodes'];
                    $response['id_seasons'] = $data['idcml_seasons'];
                    $response['name'] = $data['name'];
                    $response['desc'] = $data['desc'];
                    $response['ImgSrc'] = URL . "public/cdn/episodes/" . $data['src'];
                    $response['seasonName'] = $data['seasonName'];
                    $response['levelName'] = $data['levelName'];
                    $response['is_quiz'] = $data['is_quiz'] == 0 ? FALSE : TRUE;
                    $response['quiz_time'] = (int)$data['quiz_time'];
                    $response['quiz_count'] = (int)$data['quiz_count'];
                    $response['locked'] = sizeof($locked) > 0 ? FALSE : TRUE;

                    if ($getChallenge) {
                        $current_challenge = $this->getChallenge($data['idcml_episodes'], FALSE);
                        $response['challenge'] = $current_challenge;
                    }

                    array_push($responses, $response);
                }

                if ($print) {
                    $userId = $this->getUserID($getId['token']);
                    if ($userId != FALSE) {
                        $this->ActivityLog($userId, 'get episodes');
                        self::generate_jsonp(TRUE, "result", $responses);
                    } else {
                        $data = ["description" => "Token is invalid"];
                        self::generate_jsonp(FALSE, "result", $data);
                    }
                } else {
                    return ["status" => TRUE, "result" => $responses];
                }
            } else {
                $data = ["description" => "Empty: No episodes has been added to this season."];
                if ($print) {
                    self::generate_jsonp(FALSE, "result", $data);
                } else {
                    return ["status" => TRUE, "result" => $data];
                }
            }
        } else {
            $data = ["description" => "Not Found: season not found"];
            if ($print) {
                self::generate_jsonp(FALSE, "result", $data);
            } else {
                return ["status" => TRUE, "result" => $data];
            }
        }
    }

    //check season id
    function getIssetSeason($id)
    {
        $sql = "SELECT idcml_seasons FROM cml_seasons WHERE idcml_seasons= ?";
        $param = array($id);
        $result = $this->doSelect($sql, $param);

        if (sizeof($result) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //get all challenge for episodes selected
    function getChallenge($getId, $print = TRUE)
    {
        $check = $this->getIssetEpisode($getId['id']);
        if ($check) {
            $sql = "SELECT c.idcml_challenges,c.type_chall as typeChallenge,c.name,c.desc,c.points,
                    f.src as imgChallenge,qa.text as textQuestion,qv.QuestionVideo,
                    qa.QuestionAudio,qu.QuestionImage,
                    a.type as answerType,
                    a.answer_data,cc.answer_data as chat_data,r.time_limit,r.score_multi,cc.wrong_answer_rule
                    FROM cml_challenges c
                    LEFT JOIN sys_files f
                    ON c.image_file=f.idsys_files
                    LEFT JOIN (SELECT q.*,f.src as QuestionVideo FROM cml_challenges_questions q 
                    LEFT JOIN sys_files f 
                    ON q.video=f.idsys_files) as qv
                    ON c.idcml_challenges_questions=qv.idcml_challenges_questions
                    LEFT JOIN (SELECT q.*,f.src as QuestionAudio FROM cml_challenges_questions q 
                    LEFT JOIN sys_files f 
                    ON q.audio=f.idsys_files) as qa
                    ON c.idcml_challenges_questions=qa.idcml_challenges_questions
                    LEFT JOIN (SELECT q.*,f.src as QuestionImage FROM cml_challenges_questions q 
                    LEFT JOIN sys_files f 
                    ON q.image=f.idsys_files) as qu
                    ON c.idcml_challenges_questions=qu.idcml_challenges_questions
                    LEFT JOIN cml_challenges_answers a
                    ON c.idcml_challenges_answers=a.idcml_challenges_answers
                    LEFT JOIN cml_challenges_rules r
                    ON c.idcml_challenges_rules=r.idcml_challenges_rules
                    LEFT JOIN cml_challenges_chats cc
                    ON c.idcml_challenges_chats=cc.idcml_challenges_chats
                    LEFT JOIN cml_epsd_chall ec
                    ON c.idcml_challenges=ec.idcml_challenges
                    LEFT JOIN cml_episodes e
                    ON ec.idcml_episodes=e.idcml_episodes
                    WHERE c.type_chall!=? AND e.idcml_episodes=?
                    ORDER BY ec.reading_Order ASC";
            $params = array("placement", $getId['id']);
            $datas = $this->doSelect($sql, $params);

            if (sizeof($datas) > 0) {
                $responses = array();
                foreach ($datas as $data) {
                    array_push($responses, $data);
                }

                if ($print) {
                    $userId = $this->getUserID($getId['token']);
                    if ($userId != FALSE) {
                        $this->ActivityLog($userId, 'get challenge');
                        self::generate_jsonp(TRUE, "result", $responses);
                    } else {
                        $data = ["description" => "Token is invalid"];
                        self::generate_jsonp(FALSE, "result", $data);
                    }
                } else {
                    return ["status" => TRUE, "result" => $responses];
                }
            } else {
                $data = ["description" => "Empty: No challenge has been added to this episodes."];
                if ($print) {
                    self::generate_jsonp(FALSE, "result", $data);
                } else {
                    return ["status" => TRUE, "result" => $data];
                }
            }
        } else {
            $data = ["description" => "Not Found: episodes not found"];
            if ($print) {
                self::generate_jsonp(FALSE, "result", $data);
            } else {
                return ["status" => TRUE, "result" => $data];
            }
        }
    }

    //check episodes id
    function getIssetEpisode($id)
    {
        $sql = "SELECT idcml_episodes FROM cml_episodes WHERE idcml_episodes= ?";
        $param = array($id);
        $result = $this->doSelect($sql, $param);

        if (sizeof($result) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //get all data of course
    function getCourse($getData)
    {
        $userId = $this->getUserID($getData['token']);
        if ($userId != FALSE) {
            $sql = "SELECT l.*,f.src FROM cml_levels l
                    LEFT JOIN sys_files f
                    ON l.image_file=f.idsys_files
                    ORDER BY l.reading_Order ASC";
            $datas = $this->doSelect($sql);

            if (is_array($datas)) {
                $responses = array();
                foreach ($datas as $data) {
                    $current_season = $this->getSeason($data['idcml_levels'], FALSE, TRUE);

                    $response['id_levels'] = $data['idcml_levels'];
                    $response['name'] = $data['name'];
                    $response['min_point'] = $data['min_point'];
                    $response['ImgSrc'] = URL . "public/cdn/level/" . $data['src'];
                    $response['season'] = $current_season;

                    array_push($responses, $response);
                }
                self::generate_jsonp(TRUE, "result", $responses);
            } else {
                $data = ["description" => "FATAL ERROR: database selection error."];
                self::generate_jsonp(FALSE, "result", $data);
            }
        } else {
            $data = ["description" => "Token is invalid"];
            self::generate_jsonp(FALSE, "result", $data);
        }
    }

    //get data
    function getData($getData)
    {
        $userId = $this->getUserID($getData['token']);
        if ($userId != FALSE) {
            $userInfo = $this->getUserInfo($userId);
            $userState = $this->getUserState($userId);
            $checkForUpdate = $this->checkForUpdate($getData['os'], $getData['version']);
            $promotionImage = $this->getPromotionImage();
            $eventImage = $this->getEventImage();
            $contact = $this->getContactUsURL();
            $support = $this->getSupportURL();
            $updateVersion = $this->getUpdateVersion($getData['os']);

            $level = $this->doSelect("SELECT sum(points) as sumpoints FROM usr_gameplay WHERE idusr_users = ?", [$userId]);
            if (isset($level[0]) && isset($level[0]['sumpoints'])) {
                $sum = $level[0]['sumpoints'];
            } else {
                $sum = 0;
            }

            $signUp = $this->doSelect("SELECT signup_time FROM usr_users WHERE idusr_users = ?", [$userId], 1);


            $data = array(
                'userExpired' => time() - strtotime($signUp['signup_time']) > (60 * 60 * 24 * 3) ? TRUE : FALSE,
                'daysSinceSignUp' => round((time() - strtotime($signUp['signup_time'])) / 60 / 60 / 24),
                'points' => (int)$sum,
                'version' => $updateVersion,
                'update' => $checkForUpdate,
                'userInfo' => $userInfo,
                'userState' => $userState,
                'promotion' => $promotionImage,
                'event' => $eventImage,
                'contactUs' => $contact,
                'support' => $support
            );

            $this->ActivityLog($userId, 'get data');

            self::generate_jsonp(TRUE, "result", $data);
        } else {
            $data = ["description" => "Token is invalid"];
            self::generate_jsonp(FALSE, "result", $data);
        }
    }

    //get user info
    function getUserInfo($token)
    {
        $sql = "SELECT u.idusr_users,u.username,u.vip,u.name,u.family,u.email,u.sex,u.city,m.mobile,f.src as image
           FROM usr_users u
           LEFT JOIN usr_mobile m
           ON u.idusr_users=m.user_id
           LEFT JOIN sys_files f
           ON u.avatar=f.idsys_files
           WHERE u.idusr_users=? AND u.role=?
           ORDER BY u.idusr_users DESC";
        $param = array($token, "student");
        $data = $this->doSelect($sql, $param, 1);

        if (sizeof($data) > 0) {
            $user_plan_active = $this->getUserPlan($data['idusr_users']);

            $date1 = date_create($user_plan_active['start_date']);
            $date2 = date_create($user_plan_active['end_date']);

            $interval = $date1->diff($date2);
            $elapsed = array(
                'total' => $interval->format('%y years %m months %a days %h hours %i minutes %s seconds'),
                'year' => $interval->format('%y'),
                'month' => $interval->format('%m'),
                'day' => $interval->format('%a'),
                'hour' => $interval->format('%h'),
                'minute' => $interval->format('%i'),
                'second' => $interval->format('%s')
            );

            $response = array(
                'info' => array(
                    'id' => $data['idusr_users'],
                    'state' => $data['username'],
                    'name' => $data['name'],
                    'family' => $data['family'],
                    'mobile' => $data['mobile'],
                    'email' => $data['email'],
                    'sex' => $data['sex'],
                    'image' => $data['image'] ? URL . "public/cdn/user/" . $data['image'] : "https://www.gravatar.com/avatar/" . $data['email'] . "?d=robohash&r=x",
                    'defaultImage' => URL . "public/images/user-default-image.jpg",
                ),
                'sub' => array(
                    'plan_status' => $user_plan_active,
                    'remaining_date' => date_diff($date1, $date2)->days,
                    'remaining_time' => $elapsed
                )
            );

            return ["status" => TRUE, "result" => $response];
        } else {
            return ["status" => FALSE, "description" => "user not found"];
        }
    }

    //get active plan of user
    function getUserPlan($id)
    {
        $sql = "SELECT plan_id,start_date,end_date FROM usr_vip_plan WHERE user_id= ? AND end_date>=? ORDER BY log_time DESC LIMIT 1";
        $param = array($id, date("Y-m-d H:m:s"));
        $result = $this->doSelect($sql, $param, 1);

        if (sizeof($result) > 0) {
            return $result;
        } else {
            return FALSE;
        }
    }

    //get user state
    function getUserState($token)
    {
        $sql = "SELECT p.idcml_episodes,p.idcml_challenges,p.state,p.reason,
           e.idcml_seasons,e.name as episodeName,s.name as seasonName,s.idcml_levels,
           l.name as levelName,ch.name as challengeName FROM usr_progress p
           LEFT JOIN cml_challenges ch
           ON p.idcml_challenges=ch.idcml_challenges
           LEFT JOIN cml_episodes e
           ON p.idcml_episodes=e.idcml_episodes
           LEFT JOIN cml_seasons s
           ON e.idcml_seasons=s.idcml_seasons
           LEFT JOIN cml_levels l
           ON s.idcml_levels=l.idcml_levels
           WHERE p.idusr_users=? AND p.state=? ORDER BY p.log_time DESC LIMIT 1";
        $param = array($token, "pass");
        $data = $this->doSelect($sql, $param, 1);

        $current_season = $this->getSeason($data['idcml_levels'], FALSE, FALSE);
        $current_episode = $this->getEpisode($data['idcml_seasons'], FALSE, FALSE);

        if (sizeof($data) > 0) {
            $response = array(
                'level_id' => $data['idcml_levels'],
                'level_name' => $data['levelName'],
                'season_id' => $data['idcml_seasons'],
                'season_name' => $data['seasonName'],
                'episode_id' => $data['idcml_episodes'],
                'episode_name' => $data['episodeName'],
                'challenge_id' => $data['idcml_challenges'],
                'challenge_name' => $data['challengeName'],
                'current_level_seasons' => $current_season,
                'current_season_episodes' => $current_episode,
            );

            return ["status" => TRUE, "result" => $response];
        } else {
            return ["status" => FALSE, "description" => "user state not found"];
        }
    }

    //check for update
    function checkForUpdate($getOS, $getVersion)
    {
        if (isset($getOS) && isset($getVersion) && $getOS != NULL && $getVersion != NULL) {
            $sql = "SELECT version_number, version_name, download_link_bazar, download_link_vas,
                 update_state, public_desc  FROM sys_versions
                 WHERE version_number > ? AND os = ? ORDER BY version_number DESC LIMIT 1";
            $param = array($getVersion, $getOS);
            $data = $this->doSelect($sql, $param, 1);

            if ($data['version_number'] > $getVersion) {
                $_response['currentVersionNumber'] = $data['version_number'];
                $_response['currentVersionName'] = $data['version_name'];
                $_response['currentDownloadlink_bazar'] = $data['download_link_bazar'];
                $_response['updateState'] = $data['update_state'];
                $_response['publicDesc'] = $data['public_desc'];

                return ["status" => TRUE, "versionState" => "update", "result" => $_response];
            } else {
                $_response['currentVersionNumber'] = NULL;
                $_response['currentVersionName'] = NULL;
                $_response['currentDownloadlink_bazar'] = NULL;
                $_response['updateState'] = NULL;
                $_response['publicDesc'] = NULL;

                return ["status" => FALSE, "versionState" => "current", "result" => $_response];
            }
        } else {
            $_response['currentVersionNumber'] = NULL;
            $_response['currentVersionName'] = NULL;
            $_response['currentDownloadlink_bazar'] = NULL;
            $_response['updateState'] = NULL;
            $_response['publicDesc'] = NULL;

            return ["status" => FALSE, "versionState" => "current", "result" => $_response];
        }
    }

    //promotion image
    function getPromotionImage()
    {
        $sql = "SELECT `value` as image FROM sys_setting WHERE `name`=?";
        $param = array("imgPromotion");
        $data = $this->doSelect($sql, $param, 1);

        $sql = "SELECT `value` as title FROM sys_setting WHERE `name`=?";
        $param = array("titlePromotion");
        $dataTitle = $this->doSelect($sql, $param, 1);

        if (is_array($data)) {
            $_response['image'] = URL . $data['image'];
            $_response['title'] = $dataTitle['title'];

            return ["status" => TRUE, "result" => $_response];
        } else {
            return ["status" => FALSE, "description" => "Promotion image not found."];
        }
    }

    //event image
    function getEventImage()
    {
        $sql = "SELECT `value` as image FROM sys_setting WHERE `name`=?";
        $param = array("imgEvent");
        $dataImg = $this->doSelect($sql, $param, 1);

        $sql = "SELECT `value` as url FROM sys_setting WHERE `name`=?";
        $param = array("urlEvent");
        $dataUrl = $this->doSelect($sql, $param, 1);

        $sql = "SELECT `value` as title FROM sys_setting WHERE `name`=?";
        $param = array("titleEvent");
        $dataTitle = $this->doSelect($sql, $param, 1);

        $sql = "SELECT `value` as `desc` FROM sys_setting WHERE `name`=?";
        $param = array("descEvent");
        $dataDesc = $this->doSelect($sql, $param, 1);

        if (is_array($dataImg) && is_array($dataUrl)) {
            $_response['image'] = URL . $dataImg['image'];
            $_response['url'] = $dataUrl['url'];
            $_response['title'] = $dataTitle['title'];
            $_response['desc'] = $dataDesc['desc'];

            return ["status" => TRUE, "result" => $_response];
        } else {
            return ["status" => FALSE, "description" => "Event image not found."];
        }
    }

    //contact us url
    function getContactUsURL()
    {
        $sql = "SELECT `value` as url FROM sys_setting WHERE `name`=?";
        $param = array("linkContactUs");
        $dataUrl = $this->doSelect($sql, $param, 1);

        if (is_array($dataUrl)) {
            $_response['url'] = $dataUrl['url'];

            return ["status" => TRUE, "result" => $_response];
        } else {
            return ["status" => FALSE, "description" => "contact us link not found."];
        }
    }

    //support url
    function getSupportURL()
    {
        $sql = "SELECT `value` as url FROM sys_setting WHERE `name`=?";
        $param = array("linkSupport");
        $dataUrl = $this->doSelect($sql, $param, 1);

        if (is_array($dataUrl)) {
            $_response['url'] = $dataUrl['url'];

            return ["status" => TRUE, "result" => $_response];
        } else {
            return ["status" => FALSE, "description" => "support link not found."];
        }
    }

    //check data is change or no
    function getUpdateVersion($os)
    {
        $sql = "SELECT version_number FROM sys_versions WHERE `os`=? ORDER BY version_number DESC LIMIT 1";
        $param = array($os);
        $dataUrl = $this->doSelect($sql, $param, 1);

        if (is_array($dataUrl)) {
            $_response['number'] = $dataUrl['version_number'];

            return ["status" => TRUE, "result" => $_response];
        } else {
            return ["status" => FALSE, "description" => "version not found."];
        }
    }

    //check data is change or no
    function saveUserData($getData)
    {
        function isJson($string)
        {
            json_decode($string);

            return (json_last_error() == JSON_ERROR_NONE);
        }

        $userId = $this->getUserID($getData['token']);
        if ($userId != FALSE) {
            if (!isJson($_POST['data'])) {
                self::generate_jsonp(FALSE, "result", 'Invalid JSON.');

                return;
            }
            $sqlImg = "INSERT INTO user_data (user_id,data) VALUES (?,?) ON DUPLICATE KEY UPDATE data = ?";
            $paramsImg = [$userId, json_encode(json_decode($_POST['data'])), json_encode(json_decode($_POST['data']))];
            $this->doQuery($sqlImg, $paramsImg);
            self::generate_jsonp(TRUE, "result", json_decode($_POST['data']));
        } else {
            $data = ["description" => "Token is invalid"];
            self::generate_jsonp(FALSE, "result", $data);
        }
    }

    function getUserData($getData)
    {
        $userId = $this->getUserID($getData['token']);
        if ($userId != FALSE) {
            $sql = "SELECT `data` FROM user_data WHERE `user_id`=?";
            $param = [$userId];
            $dataUrl = $this->doSelect($sql, $param, 1);

            self::generate_jsonp(TRUE, "result", json_decode($dataUrl['data']));

            return;
        } else {
            $data = ["description" => "Token is invalid"];
            self::generate_jsonp(FALSE, "result", $data);
        }
    }

    function leaderboard($getData)
    {
        header('Content-Type: application/json');
        $userId = $this->getUserID($getData['token']);
        if ($userId != FALSE) {
//            var_dump($_POST['type']);return;
            if ($_POST['type'] !== 'daily' && $_POST['type'] !== 'weekly' && $_POST['type'] !== 'monthly' && $_POST['type'] !== 'yearly') {
                echo json_encode([
                    'status' => FALSE,
                    'result' => 'Invalid type.'
                ]);

                return;
            }
            $type = '';
            if ($_POST['type'] == 'daily') {
                $type = 'WHERE created_at >= \'' . date("Y-m-d H:i:s", time() - 60 * 60 * 24) . "'";
            }
            if ($_POST['type'] == 'weekly') {
                $type = 'WHERE created_at >= \'' . date("Y-m-d H:i:s", time() - 60 * 60 * 24 * 7) . "'";
            }
            if ($_POST['type'] == 'monthly') {
                $type = 'WHERE created_at >= \'' . date("Y-m-d H:i:s", time() - 60 * 60 * 24 * 30) . "'";
            }
            if ($_POST['type'] == 'yearly') {
                $type = 'WHERE created_at >= \'' . date("Y-m-d H:i:s", time() - 60 * 60 * 24 * 365) . "'";
            }

            $level = '';
            if (isset($_POST['level']) && is_numeric($_POST['level'])) {
                $_POST['level'] = (int)$_POST['level'];
                if (strlen($_POST['type']) > 1) {
                    $level = ' AND cml_seasons.idcml_levels = ' . $_POST['level'];
                } else {
                    $level = ' WHERE cml_seasons.idcml_levels = ' . $_POST['level'];
                }
            }

            $sql = "SELECT user_id, sum(points) score, usr_users.name, family, src FROM `users_scores`
                    left join usr_users on usr_users.idusr_users = user_id
                    LEFT JOIN sys_files ON avatar=idsys_files
                    left join cml_episodes on cml_episodes.idcml_episodes = episode_id
                    left JOIN cml_seasons on cml_seasons.idcml_seasons = cml_episodes.idcml_seasons
                    $type $level
                    group by user_id
                    order by score desc LIMIT 50";
            $dataUrl = $this->doSelect($sql);
            $result = [];

            foreach ($dataUrl as $item) {
                $result[] = [
                    'user' => [
                        'id' => (int)$item['user_id'],
                        'fullName' => $item['name'] . ' ' . $item['family'],
                        'firstName' => $item['name'],
                        'lastName' => $item['family'],
                        'profilePhoto' => $item['src'] ? (URL . "public/cdn/user/" . $item['src']) : 'https://www.gravatar.com/avatar/' . $item['user_id'] . '?d=robohash&r=x&s=256',
                    ],
                    'score' => (int)$item['score']
                ];
            }
            echo json_encode([
                'status' => TRUE,
                'currentUserID' => (int)$userId,
                'type' => $_POST['type'],
                'result' => $result
            ]);

            return;

            self::generate_jsonp(TRUE, "result", json_decode($dataUrl['data']));
        } else {
            $data = ["description" => "Token is invalid"];
            self::generate_jsonp(FALSE, "result", $data);
        }

    }

    //get placement challenge
    function getPlacementChallenge($getData)
    {
        $userId = $this->getUserID($getData['token']);
        if ($userId != FALSE) {
            $this->ActivityLog($userId, 'get placement questions');

            $sql = "SELECT c.idcml_challenges,c.type_chall as typeChallenge,c.name,c.desc,c.points,
                    f.src as imgChallenge,qa.text as textQuestion,qv.QuestionVideo,
                    qa.QuestionAudio,qu.QuestionImage,
                    a.type as answerType,
                    a.answer_data,cc.answer_data as chat_data,r.time_limit,r.score_multi,cc.wrong_answer_rule
                    FROM cml_challenges c
                    LEFT JOIN sys_files f
                    ON c.image_file=f.idsys_files
                    LEFT JOIN (SELECT q.*,f.src as QuestionVideo FROM cml_challenges_questions q 
                    LEFT JOIN sys_files f 
                    ON q.video=f.idsys_files) as qv
                    ON c.idcml_challenges_questions=qv.idcml_challenges_questions
                    LEFT JOIN (SELECT q.*,f.src as QuestionAudio FROM cml_challenges_questions q 
                    LEFT JOIN sys_files f 
                    ON q.audio=f.idsys_files) as qa
                    ON c.idcml_challenges_questions=qa.idcml_challenges_questions
                    LEFT JOIN (SELECT q.*,f.src as QuestionImage FROM cml_challenges_questions q 
                    LEFT JOIN sys_files f 
                    ON q.image=f.idsys_files) as qu
                    ON c.idcml_challenges_questions=qu.idcml_challenges_questions
                    LEFT JOIN cml_challenges_answers a
                    ON c.idcml_challenges_answers=a.idcml_challenges_answers
                    LEFT JOIN cml_challenges_rules r
                    ON c.idcml_challenges_rules=r.idcml_challenges_rules
                    LEFT JOIN cml_challenges_chats cc
                    ON c.idcml_challenges_chats=cc.idcml_challenges_chats
                    WHERE c.type_chall=?
                    ORDER BY c.idcml_challenges ASC";
            $params = array("placement");
            $datas = $this->doSelect($sql, $params);

            $responses = array();
            foreach ($datas as $data) {
                $response['serverURL'] = URL;
                $response['idcml_challenges'] = $data['idcml_challenges'];
                $response['typeChallenge'] = $data['typeChallenge'];
                $response['name'] = $data['name'];
                $response['desc'] = $data['desc'];
                $response['points'] = $data['points'];
                $response['imgChallenge'] = $data['imgChallenge'];
                $response['textQuestion'] = $data['textQuestion'];
                $response['QuestionVideo'] = $data['QuestionVideo'] != NULL ? $data['QuestionVideo'] : NULL;
                $response['QuestionAudio'] = $data['QuestionAudio'] != NULL ? $data['QuestionAudio'] : NULL;
                $response['QuestionImage'] = $data['QuestionImage'] != NULL ? $data['QuestionImage'] : NULL;
                $response['answerType'] = $data['answerType'];
                $response['answer_data'] = $data['answer_data'];
                $response['chat_data'] = $data['chat_data'];
                $response['time_limit'] = $data['time_limit'];
                $response['score_multi'] = $data['score_multi'];
                $response['wrong_answer_rule'] = $data['wrong_answer_rule'];

                array_push($responses, $response);
            }


            $dataUrl = $this->doSelect("SELECT `value` FROM sys_setting WHERE `name`='placementTime'", [], 1);
            $placementCount = $this->doSelect("SELECT `value` FROM sys_setting WHERE `name`='placementCount'", [], 1);

//            if (is_array($dataUrl)) {
//                $_response['url'] = $dataUrl['url'];
//                return ["status" => true, "result" => $_response];
//            } else {
//                return ["status" => false, "description" => "contact us link not found."];
//            }

            header('Content-Type: application/json');
            echo json_encode([
                'status' => TRUE,
                'time' => (int)$dataUrl['value'],
                'count' => (int)$placementCount['value'],
                'result' => $responses
            ]);

            return;
            self::generate_jsonp(TRUE, "result", $responses);
        } else {
            $data = ["description" => "Token is invalid"];
            self::generate_jsonp(FALSE, "result", $data);
        }
    }

    //edit user info
    function editProfile($getData)
    {
        $userId = $this->getUserID($getData['token']);
        if ($userId != FALSE) {
            $data = json_decode($getData['data'], TRUE);

            if (isset($_FILES["image"]["tmp_name"])) {
                if ($data['state'] == "register" or $data['state'] == "edit") {
                    $dir = "public/cdn/user/";
                    $time = time() . "_" . rand(1, 999999999999) . "_";

                    $sqlSel = "SELECT f.src,f.idsys_files FROM usr_users u
                    LEFT JOIN sys_files f
                    ON u.avatar=f.idsys_files
                    WHERE u.idusr_users=?";
                    $paramSel = array($userId);
                    $res = $this->doSelect($sqlSel, $paramSel, 1);

                    if ($res['src'] != "") {
                        $sqlDel = "DELETE FROM sys_files WHERE idsys_files =?";
                        $paramDel = [$res['idsys_files']];
                        $this->doQuery($sqlDel, $paramDel);
                        unlink($dir . $res['src']);
                    }

                    $nameImg = $time . $_FILES['image']['name'];
                    move_uploaded_file($_FILES["image"]["tmp_name"], $dir . $nameImg);

                    $sqlImg = "INSERT INTO sys_files (src,title,type) VALUES (?,?,?)";
                    $paramsImg = [$nameImg, "عکس کاربر " . $userId, "image"];
                    $this->doQuery($sqlImg, $paramsImg);
                    $id = self::$conn->lastInsertId();

                    if ($data['state'] == "register") {
                        $sql3 = "UPDATE usr_users SET username=?,avatar=?,`name`=?,family=?,email=?,sex=?,phone_data=?,city=?,cpi_campaign=?,birthday=? WHERE idusr_users=?";
                        $params = ["registered", $id, $data['name'], $data['family'], $data['email'], $data['sex'], $data['phone_data'], $data['city'], $data['cpi_campaign'], $data['birthday'], $userId];
                        $this->doQuery($sql3, $params);
                        $this->ActivityLog($userId, 'Register profile information');
                    } else {
                        $sql3 = "UPDATE usr_users SET username=?,avatar=?,`name`=?,family=?,email=?,sex=?,city=?,birthday=? WHERE idusr_users=?";
                        $params = ["registered", $id, $data['name'], $data['family'], $data['email'], $data['sex'], $data['city'], $data['birthday'], $userId];
                        $this->doQuery($sql3, $params);
                        $this->ActivityLog($userId, 'Edit profile information');
                    }

                    $data = ["description" => "user data and avatar updated successfully"];
                    self::generate_jsonp(TRUE, "result", $data);
                } else {
                    $data = ["description" => "state is invalid"];
                    self::generate_jsonp(FALSE, "result", $data);
                }
            } else {
                if ($data['state'] == "register") {
                    $sql3 = "UPDATE usr_users SET username=?,`name`=?,family=?,email=?,sex=?,phone_data=?,city=?,cpi_campaign=?,birthday=? WHERE idusr_users=?";
                    $params = ["registered", $data['name'], $data['family'], $data['email'], $data['sex'], $data['phone_data'], $data['city'], $data['cpi_campaign'], $data['birthday'], $userId];
                    $this->doQuery($sql3, $params);

                    $this->ActivityLog($userId, 'Register profile information');

                    $data = ["description" => "user data updated successfully"];
                    self::generate_jsonp(TRUE, "result", $data);
                } else if ($data['state'] == "edit") {
                    $sql3 = "UPDATE usr_users SET username=?,`name`=?,family=?,email=?,sex=?,city=?,birthday=? WHERE idusr_users=?";
                    $params = ["registered", $data['name'], $data['family'], $data['email'], $data['sex'], $data['city'], $data['birthday'], $userId];
                    $this->doQuery($sql3, $params);

                    $this->ActivityLog($userId, 'Edit profile information');

                    $data = ["description" => "user data updated successfully"];
                    self::generate_jsonp(TRUE, "result", $data);
                } else {
                    $data = ["description" => "state is invalid"];
                    self::generate_jsonp(FALSE, "result", $data);
                }
            }
        } else {
            $data = ["description" => "Token is invalid"];
            self::generate_jsonp(FALSE, "result", $data);
        }
    }

    //get plan
    function getPlan($getData)
    {
        $userId = $this->getUserID($getData['token']);
        if ($userId != FALSE) {
            $sql = "SELECT p.category,p.title,p.duration,p.sku,p.price,p.off_text,p.off_percent,p.off_price,p.sku_off,p.off_start,p.off_end,f.src FROM pay_plan p
                        LEFT JOIN sys_files f
                        ON p.image_file=f.idsys_files
                        WHERE p.active=1 
                        ORDER BY p.sort ASC";
            $datas = $this->doSelect($sql);

            if (sizeof($datas) > 0) {
                $this->ActivityLog($userId, 'get plan');

                $responses = array();
                foreach ($datas as $data) {
                    $response=null;
                    $response['category'] = $data['category'];
                    $response['src'] = URL . "public/cdn/plan/" . $data['src'];
                    $response['title'] = $data['title'];
                    $response['duration'] = $data['duration'];
                    $response['sku'] = $data['sku'];
                    $response['price'] = $data['price'];

                    if ($data['sku_off'] != NULL) {
                        $response['off_status'] = true;
                        $date1 = date_create($data['off_start']);
                        $date2 = date_create($data['off_end']);

                        $interval = $date1->diff($date2);
                        $elapsed = array(
                            'total' => $interval->format('%y years %m months %a days %h hours %i minutes %s seconds'),
                            'year' => $interval->format('%y'),
                            'month' => $interval->format('%m'),
                            'day' => $interval->format('%a'),
                            'hour' => $interval->format('%h'),
                            'minute' => $interval->format('%i'),
                            'second' => $interval->format('%s')
                        );

                        $response['off_text'] = $data['off_text'];
                        $response['off_percent'] = $data['off_percent'];
                        $response['off_price'] = $data['off_price'];
                        $response['sku_off'] = $data['sku_off'];
                        $response['off_start'] = $data['off_start'];
                        $response['off_end'] = $data['off_end'];
                        $response['off_duration'] = $elapsed;
                    } else {
                        $response['off_status'] = false;
                    }

                    array_push($responses, $response);
                }

                self::generate_jsonp(TRUE, "result", $responses);
            } else {
                $data = ["description" => "plans not found"];
                self::generate_jsonp(FALSE, "result", $data);
            }
        } else {
            $data = ["description" => "Token is invalid"];
            self::generate_jsonp(FALSE, "result", $data);
        }
    }

}

?>