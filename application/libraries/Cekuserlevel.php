<?php

defined('BASEPATH') or exit('No direct script access allowed');


/**
 * Output View for Admin or Front .
 *
 **/
class Cekuserlevel
{
    // CI
    private $CI;
    private $privilege = true;
    


    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function is_pemohon(){

    }

    public function is_unit(){

    }

    public function is_tu(){

    }

    public function is_kepala(){

    }

    
}
