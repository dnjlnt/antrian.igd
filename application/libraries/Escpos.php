<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Escpos extends CI_Controller {
	public function __construct() {
		require_once APPPATH . 'third_party/Mike42/autoloader.php';
    }
}