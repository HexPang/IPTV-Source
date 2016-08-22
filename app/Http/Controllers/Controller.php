<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public static function page_exists($url)
    {
        $parts = parse_url($url);
        if (!$parts) {
            return false; /* the URL was seriously wrong */
        }

        if (isset($parts['user'])) {
            return false; /* user@gmail.com */
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        /* set the user agent - might help, doesn't hurt */
        //curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; wowTreebot/1.0; +http://wowtree.com)');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

        /* try to follow redirects */
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        /* timeout after the specified number of seconds. assuming that this script runs
           on a server, 20 seconds should be plenty of time to verify a valid URL.  */
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        /* don't download the page, just the header (much faster in this case) */
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_HEADER, true);

        /* handle HTTPS links */
        if ($parts['scheme'] == 'https') {
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        }

        $response = curl_exec($ch);
        curl_close($ch);
        /* allow content-type list */
//        $content_type = false;
//        if (preg_match('/Content-Type: (.+\/.+?)/i', $response, $matches)) {
//            switch ($matches[1])
//            {
//                case 'application/atom+xml':
//                case 'application/rdf+xml':
//                    //case 'application/x-sh':
//                case 'application/xhtml+xml':
//                case 'application/xml':
//                case 'application/xml-dtd':
//                case 'application/xml-external-parsed-entity':
//                    //case 'application/pdf':
//                    //case 'application/x-shockwave-flash':
//                    $content_type = true;
//                    break;
//            }
//
//            if (!$content_type && (preg_match('/text\/.*/', $matches[1]) || preg_match('/image\/.*/', $matches[1]))) {
//                $content_type = true;
//            }
//        }

//        dd([$response,$content_type]);

//        if (!$content_type) {
//            return false;
//        }
        /*  get the status code from HTTP headers */
        if (preg_match('/HTTP\/1\.\d+\s+(\d+)/', $response, $matches)) {
            $code = intval($matches[1]);
        } else {
            return 0;
        }

        /* see if code indicates success */
        return $code;
    }

// Test & 使用方法:
// var_dump(page_exists('http://tw.yahoo.com'));
}
