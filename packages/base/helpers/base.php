<?php
/**
 * @author Mojtaba Rahbari <mojtaba.rahbari@gmail.com | mojtabarahbari.ir>
 * @copyright Copyright &copy; from 2021 Mike.
 * @version 1.0.0
 * @date 2021/08/20 15:00 PM
 */

use Vinkla\Hashids\Facades\Hashids;

if (!function_exists('hashids_encode')) {
    /**
     * Encode the given id.
     *
     * @param $idOrArray
     * @return string
     */
    function hashids_encode($idOrArray): string
    {
        return Hashids::encode($idOrArray);
    }
}

if (!function_exists('hashids_decode')) {
    /**
     * Decode the given value.
     *
     * @param $value
     * @param bool $strict
     * @return array|\Hashids\Hashids|mixed|null
     */
    function hashids_decode($value, bool $strict = false)
    {
        if (empty($value)) {
            return null;
        }

        if (is_array($value)) {
            $decode_ids = [];
            foreach ($value as $id) {
                $decode_ids[] = ((strlen($id) === 11) || ($strict === true)) ? Hashids::decode($id) : $id;
            }
            $return = $decode_ids;
        } else {
            $return = ((strlen($value) === 11) || ($strict === true)) ? Hashids::decode($value) : $value;
        }

        if (!isset($return)) {
            return null;
        }

        if (is_array($return) && count($return) === 1) {
            return $return[0];
        }

        return $return;
    }
}

if (!function_exists('trans_boolean')) {

    /**
     * return   0->No, 1->Yes value
     * @param int $value
     * @return mixed
     */
    function trans_boolean(int $value = 0): string
    {
        $trans_boolean = trans('base::modules.boolean.false');
        if ($value === 1) {
            $trans_boolean = trans('base::modules.boolean.true');
        }

        return $trans_boolean;
    }
}

if (!function_exists('trans_status')) {

    function trans_status($status, bool $badge = true, $deleted_at = null)
    {
        $trans_status = '';
        switch ($status):
            case 1:
                $trans_status = trans('base::modules.status.active');
                break;
            case 2:
                $trans_status = trans('base::modules.status.inactive');
                break;
            case 3:
                $trans_status = trans('base::modules.status.draft');
                break;
            case 4:
                $trans_status = trans('base::modules.status.archive');
                break;
            default:
        endswitch;

        return $trans_status;
    }
}
if (!function_exists('get_api_versions')) {

    /**
     * return valid api versions
     * @param bool $implode
     * @return string|string[]
     */
    function get_api_versions(bool $implode = true)
    {
        $permitted_versions = ['v1', 'v2'];
        return ($implode === true) ? implode('|', $permitted_versions) : $permitted_versions;
    }
}


if (!function_exists('split_files_with_basename')) {

    /**
     * @param array $files
     * @param string $suffix
     * @return array
     */
    function split_files_with_basename(array $files, string $suffix = '.php'): array
    {
        $result = [];
        foreach ($files as $row) {
            $baseName = basename($row, $suffix);
            $result[$baseName] = $row;
        }
        return $result;
    }
}

if (!function_exists('is_admin')) {
    /**
     * Check whether user can publish or not
     *
     * @return bool
     */
    function is_admin(): bool
    {
        if (auth()->check() && !empty(auth()->user()->is_admin)) {
            return (bool)auth()->user()->is_admin;
        }
        return false;
    }
}

if (!function_exists('is_publish_allowed')) {
    /**
     * Check whether user can publish or not
     *
     * @return bool
     */
    function is_publish_allowed(): bool
    {
        if (auth()->check() && !empty(auth()->user()->is_publish_allowed)) {
            return (bool)auth()->user()->is_publish_allowed;
        }
        return false;
    }
}


if (!function_exists('get_user_id')) {
    /**
     * get current logged user id
     * @return int|null
     */
    function get_user_id(): ?int
    {

        if (auth()->check() && !empty(auth()->user()->id)) {
            return (int)auth()->user()->id;
        }
        return null;
    }
}
