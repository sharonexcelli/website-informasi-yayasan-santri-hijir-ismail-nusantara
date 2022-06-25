<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('assets_url')) {
    function assets_url($uri = '')
    {
        return base_url('assets/' . ltrim($uri, '/'));
    }
}

if (!function_exists('full_url')) {
    function full_url($use_query_string = true)
    {
        $scheme = isset($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] : 'http';
        $full_url = "{$scheme}://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        if ($use_query_string === false) {
            $exc_pos = strpos($full_url, '?');
            $full_url = $exc_pos !== false ? substr($full_url, 0, $exc_pos) : $full_url;
        }

        return $full_url;
    }
}

if (!function_exists('pre')) {
    function pre($var, $exit = true)
    {
        echo '<pre>';
        print_r(@$var);
        if (!$var) {
            var_dump($var);
        }
        echo '</pre>';
        if ($exit) {
            exit;
        }
    }
}

if (!function_exists('debug_routes')) {
    function debug_routes($exit = true)
    {
        $ci = &get_instance();
        pre([
            'class' => $ci->router->class,
            'method' => $ci->router->method,
            'directory' => $ci->router->directory,
            'routes' => $ci->router->routes,
            'uri' => [
                'uri_string' => $ci->router->uri->uri_string,
                'segments' => $ci->router->uri->segments,
            ],
        ], $exit);
    }
}

if (!function_exists('print_json')) {
    function print_json($data, $exit_code = 0)
    {
        header('Content-Type: application/json');

        // parse data
        if (isset($data['data']) && !$data['data']) {
            $data['data'] = null;
        }

        // encode
        $json = json_encode($data, JSON_NUMERIC_CHECK);
        $json = str_replace('#STRING#', '', $json);

        echo $json;
        exit($exit_code);
    }
}

if (!function_exists('ISODateTimeFormat')) {
    function ISODateTimeFormat($string_date)
    {
        return $string_date ? date("Y-m-d H:i:s", strtotime($string_date)) : "";
    }
}

if (!function_exists('build_slug')) {
    function build_slug($str)
    {
        if (strlen(trim($str)) == 0) {
            return false;
        }

        $slug = preg_replace('/\d+/', '', $str);
        $slug = url_title($slug, '-', true);

        return $slug;
    }
}

if (!function_exists('paging')) {
    function paging($cfg = [])
    {
        $defaults = [
            'uri_segment' => 3,
            'use_page_numbers' => true,
            'reuse_query_string' => true,
            'per_page' => 20,

            'full_tag_open' => '<ul class="pagination ' . @$cfg['class_name'] . '">',
            'full_tag_end' => '</ul>',

            'first_link' => '&laquo;',
            'first_tag_open' => '<li class="page-item">',
            'first_tag_close' => '</li>',

            'prev_link' => '&lsaquo;',
            'prev_tag_open' => '<li class="page-item">',
            'prev_tag_close' => '</li>',

            'last_link' => '&raquo;',
            'last_tag_open' => '<li class="page-item">',
            'last_tag_close' => '</li>',

            'next_link' => '&rsaquo;',
            'next_tag_open' => '<li class="page-item">',
            'next_tag_close' => '</li>',

            'cur_tag_open' => '<li class="page-item active"><a class="page-link" href="javascript:;">',
            'cur_tag_close' => '</a></li>',

            'num_tag_open' => '<li class="page-item">',
            'num_tag_close' => '</li>',
        ];
        $config = array_merge($defaults, $cfg);

        $ci = &get_instance();
        $ci->load->library('pagination');
        $ci->pagination->initialize($config);

        $page = $ci->pagination->create_links();
        if (!$page) {
            $page = '<ul class="pagination">' .
                '<li class="page-item active"><a class="page-link" href="javascript:;">1</a></li>' .
                '</ul>';
        }

        $page = preg_replace('/(a\s+href)/i', 'a class="page-link" href', $page);

        return $page;
    }
}

if (!function_exists('clear_content_formatting')) {
    function clear_content_formatting($string)
    {
        $output = strip_tags($string, '<p><br><div><a><span><img><strong><u><i><b><ul><ol><li><table><thead><tbody><tr><th><td>');
        $output = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $output);

        return $output;
    }
}

if (!function_exists('cleanup_text')) {
    function cleanup_text($str, $tags = '<p><br><ul><ol><li><strong><b><em><i>', $strict = false)
    {
        if (!$str) {
            return false;
        }

        $str = strip_tags($str, $tags);
        $str = preg_replace('/<(\w+)\b(?:\s+[\w\-.:]+(?:\s*=\s*(?:"[^"]*"|"[^"]*"|[\w\-.:]+))?)*\s*\/?>\s*<\/\1\s*>/', "", $str);
        $str = nl2br(trim($str));
        $str = preg_replace('/(<\/p>)((.*?)|(\s+))([\n\r]?<p)/i', '</p><p', $str);
        $str = preg_replace('/<p[^>]*>(&#?[a-z0-9]+;)?<\\/p[^>]*>/i', '', trim($str));

        if ($strict == true) {
            $str = preg_replace('/[^0-9a-z\s]/i', '', $str);
            $str = preg_replace('/\s+/', ' ', $str);
        }

        return $str;
    }
}

if (!function_exists('sanitize_output')) {
    function sanitize_output($buffer)
    {
        if (ENVIRONMENT == 'development') {
            return $buffer;
        }

        $search = array(
            '/\>[^\S ]+/s', // strip whitespaces after tags, except space
            '/[^\S ]+\</s', // strip whitespaces before tags, except space
            '/(\s)+/s', // shorten multiple whitespace sequences
            '/<!--(.|\s)*?-->/', // Remove HTML comments
            '/\s?(\{|\}|\;|\|\|)\s/',
        );

        $replace = array(
            '>',
            '<',
            '\\1',
            '',
            '$1',
        );

        $buffer = preg_replace(['/(?<!:)\/\/\s?(.*?)\n/', '/\/\*{1,}(.*?)\*\//'], '', $buffer);
        $buffer = preg_replace($search, $replace, $buffer);

        return $buffer;
    }
}

if (!function_exists('ellipsis')) {
    /**
     * Digunakan untuk memotong string
     * @param string $str
     * @param integer $length
     * @param string $position
     * @param string $ellipsis
     * @return boolean
     */
    function ellipsis($str, $length = 100, $position = 'right', $ellipsis = '...')
    {
        if (strlen($str) < $length) {
            return $str;
        }

        switch ($position) {
            case 'left':
                $str = trim(strip_tags($str));
                $str = substr($str, 0 - $length);

                if (strpos($str, ' ') !== false) {
                    $str = substr($str, strpos($str, ' '));
                }

                $str = $ellipsis . trim($str);
                break;

            case 'center':
                $str = trim(strip_tags($str));
                $strL = substr($str, 0, (int)$length / 2);
                $strR = substr($str, 0 - ((int)$length / 2));

                $str = trim($strL) . $ellipsis . trim($strR);
                break;

            default:
                $str = trim(strip_tags($str));
                $str = substr($str, 0, $length);

                if (strrpos($str, ' ') !== false) {
                    $str = substr($str, 0, strrpos($str, ' '));
                }

                $str = trim($str) . $ellipsis;
                break;
        }

        return $str;
    }
}

if (!function_exists('generate_form_id')) {
    function generate_form_id($form_name = 'PKL')
    {
        $public_key = rand(999, 99999);

        $ci = &get_instance();
        $ci->session->set_userdata($form_name, base64_encode($public_key));

        return md5($public_key * PRIVATE_FORM_KEY);
    }
}

if (!function_exists('validate_form_id')) {
    function validate_form_id($form_name = 'PKL')
    {
        $ci = &get_instance();
        $pubic_key = base64_decode($ci->session->userdata($form_name));
        $pubic_key = !$pubic_key ? -1 : $pubic_key;
        $fid = md5($pubic_key * PRIVATE_FORM_KEY);

        return $fid === @$_POST['fid'];
    }
}

if (!function_exists('destroy_form_id')) {
    function destroy_form_id($form_name = 'PKL')
    {
        $ci = &get_instance();
        $ci->session->unset_userdata($form_name);
    }
}

if (!function_exists('view')) {
    /**
     * shortcut buat ngeload view.
     *
     * @param string $view
     * @param string $vars
     * @param bool $return
     * @return string
     */
    function view($view, $vars = null, $return = false)
    {
        $ci =& get_instance();
        return $ci->load->view($view, $vars, $return);
    }
}

if (!function_exists('send_mail')) {
    function send_mail($from, $to, $subject, $html_content, $bcc = '',$title='', $file='')
    {
        $key = "edf72f61af26f2a81bea2709154c12eb-ea44b6dc-9cfeff02";
        $url = "https://api.eu.mailgun.net/v3/ika.uii.ac.id/messages";

        $config = [
            'api_key' => $key,
            'api_url' => $url
        ];

        $html = ''.$html_content;

        $message = [
            'from' => $from,
            'to' => $to,
            'h:Reply-To' => 'no-reply@ika.uii.ac.id',
            'subject' => $subject,
            // 'html' => mainemailtpl($html),
            'html' => $html,
            'text' => ''
        ];

        if ($bcc != '') {
            $message['bcc'] = $bcc;
        }

        $ch = curl_init();
        if($file!= ''){
            curl_setopt($ch, CURLOPT_POSTFIELDS, $file);
        }
        curl_setopt($ch, CURLOPT_URL, $config['api_url']);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "api:{$config['api_key']}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $message);

        $result = curl_exec($ch);
        return $result;
    }
}

if (!function_exists('send_mail_v2')) {
    function send_mail_v2($from, $to, $subject, $html_content, $bcc = '',$title='', $file='', $replyto = '')
    {
        $key = "edf72f61af26f2a81bea2709154c12eb-ea44b6dc-9cfeff02";
        $url = "https://api.eu.mailgun.net/v3/ika.uii.ac.id/messages";

        $config = [
            'api_key' => $key,
            'api_url' => $url
        ];

        $html = ''.$html_content;

        $message = [
            'from' => $from,
            'to' => $to,
            'h:Reply-To' => 'no-reply@ika.uii.ac.id',
            'subject' => $subject,
            // 'html' => mainemailtpl($html),
            'html' => $html,
            'text' => '',
        ];
        if($file!= ''){
            $message['attachment[1]'] = $file;
        }

        if($replyto!=''){
            $message['h:Reply-To'] = $replyto;
        }

        if ($bcc != '') {
            $message['bcc'] = $bcc;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $config['api_url']);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "api:{$config['api_key']}");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $message);

        $result = curl_exec($ch);
        return $result;
    }
}
if (!function_exists('send_mail_v3')) {
    function send_mail_v3($from, $to, $subject, $html_content, $bcc = '',$title='', $file='', $replyto = '')
    {
        $key = "edf72f61af26f2a81bea2709154c12eb-ea44b6dc-9cfeff02";
        $url = "https://api.eu.mailgun.net/v3/ika.uii.ac.id/messages";

        $config = [
            'api_key' => $key,
            'api_url' => $url
        ];

        $html = ''.$html_content;

        $message = [
            'from' => $from,
            'to' => $to,
            'h:Reply-To' => 'no-reply@ika.uii.ac.id',
            'subject' => $subject,
            // 'html' => mainemailtpl($html),
            'html' => $html,
            'text' => '',
        ];
        if($file!= ''){
            foreach ($file as $key => $value) {
                $message['attachment['.($key+1).']'] = $value;
            }
        }

        if($replyto!=''){
            $message['h:Reply-To'] = $replyto;
        }

        if ($bcc != '') {
            $message['bcc'] = $bcc;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $config['api_url']);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "api:{$config['api_key']}");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $message);

        $result = curl_exec($ch);
        return $result;
    }
}

if (!function_exists('send_mail_v4')) {
    function send_mail_v4($from, $to, $subject, $html_content, $bcc = '',$title='', $file='', $replyto = '')
    {
        $key = "e8fc1f24f9c8cbd1c79b5c5be8aa94f9:588c442cb0f01f5a3932885c1bf22947";
        $url = "https://api.mailjet.com/v3.1/send";

        $config = [
            'api_key' => $key,
            'api_url' => $url
        ];

        $html = ''.$html_content;

        $message["Messages"][0] = [
            "From"=> [
                "Email"=> 'no-reply@ika.uii.ac.id'
            ],
            "ReplyTo"=> [
                "Email"=> $from,
            ],
            "Subject"=> $subject,
            "HTMLPart"=> $html
        ];
        $message['Messages'][0]['To'][0]['Email'] = $to;
        if($file!= ''){
            foreach ($file as $key => $value) {
                $message['Messages'][0]['Attachments['.($key+1).']'] = $value;
            }
        }

        if($replyto!=''){
            $message['Messages'][0]['From']['Email'] = $replyto;
        }

        if ($bcc != '') {
            $message['Messages'][0]['Bcc']['Email'] = $bcc;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $config['api_url']);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, $config['api_key']);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));

        $result = curl_exec($ch);
        return $result;
    }
}

if (!function_exists('datetimejkt')) {
    function datetimejkt($date, $format='')
    {
        $cdate = new DateTime($date);
        $cdate->setTimezone(new DateTimeZone('Asia/Jakarta'));
        if($format != ''){
            $res = $cdate->format($format);
        }else{
            $res = $cdate->format('j F Y, g:i a');
        }
        return $res;
    }
}
if (!function_exists('validateEcaptcha')) {
    function validateEcaptcha($code)
    {
        $ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "secret=".__SERVER_CAPTCHA__."&response=".$code);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = json_decode(curl_exec($ch), TRUE);
        curl_close ($ch);
        
        return $result;
    }
}

if (!function_exists('validateEcaptchaKTA')) {
    function validateEcaptchaKTA($code)
    {
        $ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "secret=".__SERVER_CAPTCHA_KTA__."&response=".$code);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = json_decode(curl_exec($ch), TRUE);
        curl_close ($ch);
        
        return $result;
    }
}

if (!function_exists('generateSlug')) {
    function generateSlug($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}
