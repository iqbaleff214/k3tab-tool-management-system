<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function pesan($text, $tipe)
{
    $ci = &get_instance();
    $ci->session->set_flashdata(
        'pesan',
        "<script> $(document).ready(function() {Swal.fire('" . $text . "', '', '" . $tipe . "')});</script>"
    );
}
