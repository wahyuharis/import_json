<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Download_image extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->ambil_foto();
    }

    function ambil_foto()
    {
        $url_lama = "https://diskominfo.jemberkab.go.id/code/storage/app/feed/";
        // $path_image = "../kominfoweb/assets/uploads/files/";
        $path_image = "C:/xampp/htdocs/kominfoweb/assets/uploads/files/";

        // $ds = DIRECTORY_SEPARATOR;

        $image_list_json = file_get_contents($url_lama . 'list.php');
        $image_list = json_decode($image_list_json, true);
        $image_list_files = $image_list['files'];

        $limit = count($image_list_files);
        // $limit = 1;
        $i = 0;
        echo "######################################\n";
        echo "MENGUNDUH FOTO\n";
        while ($i < $limit) {
            $row = $image_list_files[$i];
            $foto = $image_list_files[$i]['file'];
            // Remote image URL
            $url = $url_lama . $foto;

            // Image path
            $img = $path_image . $foto;

            // Save image 
            $hasil = file_put_contents($img, file_get_contents($url));
            if ($hasil) {
                echo "\n";
                echo  $img." -> berhasil ";
            }
            $i++;
        }
        echo "\nselesai\n";
        echo "######################################\n";
    }
}
