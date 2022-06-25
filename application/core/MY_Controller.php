<?php

class MY_Controller extends CI_Controller
{

    var $data;

    function __construct()
    {
        parent::__construct();

        // authenticate
        $this->_authenticate();

        // init data
        $this->_init_data();
    }

    /**
     * Cek apakah admin udah login ape belon.
     * Kalo belum suruh dia login (redirect ke form login)
     */
    private function _authenticate()
    {
        $admin = $this->session->userdata('admin');
        if (!$admin) {
            redirect(base_url('cms/auth'), 'refresh');
            return;
        }
    }

    private function _init_data()
    {
        $this->data = array(
            'seo' => array(
                'page_title' => '',
                'description' => '',
                'keywords' => ''
            ),

            'css' => NULL,
            'js' => NULL,
            'inline_js' => NULL,

            'sidenav' => '',
            'content' => '',
        );
    }

    public function add_asset($asset)
    {
        if ($asset) {
            if (!is_array($asset)) {
                $asset = array($asset);
            }

            foreach ($asset as $a) {
                $ext = strtolower(substr($a, strrpos($a, '.') + 1));
                $this->data[$ext][] = preg_match('/(https?)/i', $a) ? $a : assets_url($a);
            }
        }
    }

    public function add_assets($asset)
    {
        $this->add_asset($asset);
    }

    public function set_inline_js($view, $vars = '')
    {
        if (!$view) {
            return;
        }

        $this->data['inline_js'] = $this->load->view($view, $vars, TRUE);
    }

}


class MY_KTA_Controller extends CI_Controller
{

    var $data;
    // public $DBKTA;

    function __construct()
    {
        parent::__construct();
        // $this->DBKTA = $this->load->database('kta', TRUE);

        // authenticate
        $this->_authenticate();

        // init data
        $this->_init_data();

    }

    /**
     * Cek apakah admin udah login ape belon.
     * Kalo belum suruh dia login (redirect ke form login)
     */
    private function _authenticate()
    {
        $admin = $this->session->userdata('adminkta');
        if (!$admin) {
            redirect(base_url('kta/cms/auth'), 'refresh');
            return;
        }
    }

    private function _init_data()
    {
        $this->data = array(
            'seo' => array(
                'page_title' => '',
                'description' => '',
                'keywords' => ''
            ),

            'css' => NULL,
            'js' => NULL,
            'inline_js' => NULL,

            'sidenav' => '',
            'content' => '',
        );
    }

    public function add_asset($asset)
    {
        if ($asset) {
            if (!is_array($asset)) {
                $asset = array($asset);
            }

            foreach ($asset as $a) {
                $ext = strtolower(substr($a, strrpos($a, '.') + 1));
                $this->data[$ext][] = preg_match('/(https?)/i', $a) ? $a : assets_url($a);
            }
        }
    }

    public function add_assets($asset)
    {
        $this->add_asset($asset);
    }

    public function set_inline_js($view, $vars = '')
    {
        if (!$view) {
            return;
        }

        $this->data['inline_js'] = $this->load->view($view, $vars, TRUE);
    }

}
