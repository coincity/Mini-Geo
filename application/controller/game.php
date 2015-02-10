<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Game extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        // load views
        $this->view->render('game/index');
    }

    public function play($id='random')
    {   
        $this->model = $this->loadModel("game");
        $this->view->play = $this->model->play($id);
        $this->view->render('game/play',true);
    }

    public function gues($param)
    {
        $this->model = $this->loadModel("game");
        $this->latlng = $this->model->getlatlng($param);
        echo json_encode($this->latlng);
    }
    public function param($param ,$param2)
    {
    }
}
