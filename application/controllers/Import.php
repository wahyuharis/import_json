<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Import extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index()
    {
        require "./feeds/feeds.php";
        $this->load->database();
        // $this->load->database();

        // $this->db->truncate('feeds');

        $length = count($feeds);
        $length = $length - 1;


        echo "\n";
        $start = $length;
        $end = 0;


        $error_ids = array(
            128, 87, 21
        );


        $i = $start;
        while ($i >= $end) {

            if (!in_array($feeds[$i]['id'], $error_ids)) {
                $feeds[$i]['slug'] = url_title($feeds[$i]['title'], '-', true) . "-" . uniqid();
                $exc = $this->db->replace('feeds', $feeds[$i]);

                echo "increment(". $i . ") - id.feeds(" . ($feeds[$i]['id']) . ") - succes(" . intval($exc).")";
                echo "\n";
            }
            $i--;
        }
    }
}
