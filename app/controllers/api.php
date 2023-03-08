<?php

/**
 *
 * @author hossein beiki  <ho33ein.b@gmail.com>
 * @site hosseinbeiki.ir
 * @version 1.0.0
 *
 **/
class Api extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->model->index();
    }

    function register()
    {
        $this->model->register($_REQUEST);
    }

    function validateCode()
    {
        $this->model->validateCode($_REQUEST);
    }

    function getData()
    {
        $this->model->getData($_REQUEST);
    }

    function getLastEpisode()
    {
        $this->model->getLastEpisode($_REQUEST);
    }

    function editProfile()
    {
        $this->model->editProfile($_REQUEST);
    }

    function getPlacementChallenge()
    {
        $this->model->getPlacementChallenge($_REQUEST);
    }

    function saveUserData()
    {
        $this->model->saveUserData($_REQUEST);
    }

    function saveScore()
    {
        $this->model->saveScore($_REQUEST);
    }

    function leaderboard()
    {
        $this->model->leaderboard($_REQUEST);
    }

    function getUserData()
    {
        $this->model->getUserData($_REQUEST);
    }

    function getLevel()
    {
        $this->model->getLevel($_REQUEST);
    }

    function getSeason()
    {
        $this->model->getSeason($_REQUEST);
    }

    function getEpisode()
    {
        $this->model->getEpisode($_REQUEST);
    }

    function getChallenge()
    {
        $this->model->getChallenge($_REQUEST);
    }

    function getPlan()
    {
        $this->model->getPlan($_REQUEST);
    }

    function verifyPurchase()
    {
        $this->model->verifyPurchase($_REQUEST);
    }

    function getCourse()
    {
        $this->model->getCourse($_REQUEST);
    }

    function calculatePoints()
    {
        $this->model->calculatePoints($_REQUEST);
    }

    function getLeaderBoard()
    {
        $this->model->getLeaderBoard($_REQUEST);
    }

}

?>