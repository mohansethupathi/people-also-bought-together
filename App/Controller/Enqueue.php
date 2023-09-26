<?php

namespace App\Controller;

class Enqueue
{
    public function enqueueScripts()
    {
        wp_enqueue_script('jquery-js', plugins_url('../../assets/js/jquery.js', __FILE__));
        wp_enqueue_script('myscript-js', plugins_url('../../assets/js/custom.js', __FILE__));
    }
}