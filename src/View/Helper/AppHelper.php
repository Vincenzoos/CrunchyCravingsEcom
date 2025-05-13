<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

class AppHelper extends Helper
{
    public array $helpers = ['Url']; // load UrlHelper

    public function appUrl(array $url = [], array $options = [])
    {
        $url['plugin'] = false;
        return $this->Url->build($url, $options);
    }
}
