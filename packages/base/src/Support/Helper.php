<?php
/**
 * @author Mojtaba Rahbari <mojtaba.rahbari@gmail.com | mojtabarahbari.ir>
 * @copyright Copyright &copy; from 2021 Mike.
 * @version 1.0.0
 * @date 2021/08/20 15:00 PM
 */

namespace Base\Support;

class Helper {

    /**
     * load module helpers
     *
     * @param $dir
     */
    public static function loadModuleHelpers($dir)
    {
        $helpers = glob($dir . '/../../helpers/*.php');
        foreach ($helpers as $helper) {
            require_once $helper;
        }
    }

    /**
     * load module configs
     *
     * @param $dir
     * @return array
     */
    public static function loadModuleConfig($dir): array
    {
        $files = glob($dir . '/../../config/*.php');
        $configs = split_files_with_basename($files);

        return ($configs);
    }

}
