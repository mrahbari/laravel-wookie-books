<?php
/**
 * Json Response Trait
 *
 * This trait makes it easier to return the JSON response from controllers
 * accompanied with proper status code
 *
 * @author Mojtaba Rahbari <mojtaba.rahbari@gmail.com | mojtabarahbari.ir>
 * @copyright Copyright &copy; from 2021 Mike.
 * @version 1.0.0
 * @date 2021/08/20 15:00 PM
 */

namespace Base\Traits\Jsons;

use Base\Http\Resources\Common\BaseApiCollection;
use Base\Http\Resources\Common\BaseApiResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\MessageBag;

trait JsonResponseTrait
{

    public $successMeta = ['success' => true, 'status' => 'success'];
    public $failedMeta = ['success' => false, 'status' => 'error'];
    public $key = 'data';

    /**
     * The request has succeeded.
     *
     * @param null $data
     * @param array|null $extra
     * @param array|null $apiColumns
     * @param bool|null $isCollection
     * @return JsonResponse
     */
    protected function apiOk($data = null, ?array $extra = [], ?array $apiColumns = [], ?bool $isCollection = false): JsonResponse
    {
        $meta = @array_merge(['message' => trans('base::modules.message.succeed')], $this->successMeta);
        return $this->_partialResponse(200, $data, $extra, $meta, $apiColumns, $isCollection);
    }

    /**
     * The request has been fulfilled and resulted in a new resource being created.
     *
     * @param null $data
     * @param array|null $extra
     * @param array|null $apiColumns
     * @param bool|null $isCollection
     * @return JsonResponse
     */
    protected function apiCreated($data = null, ?array $extra = [], ?array $apiColumns = [], ?bool $isCollection = false): JsonResponse
    {
        $meta = @array_merge(['message' => trans('base::modules.message.created')], $this->successMeta);
        return $this->_partialResponse(201, $data, $extra, $meta, $apiColumns, $isCollection);
    }

     /**
     * The request has been accepted for processing, but the processing has not been completed.
     *
     * @param null $data
     * @param array|null $extra
     * @param array|null $apiColumns
     * @param bool|null $isCollection
     * @return JsonResponse
     */
    protected function apiUpdated($data = null, ?array $extra = [], ?array $apiColumns = [], ?bool $isCollection = false): JsonResponse
    {
        $meta = @array_merge(['message' => trans('base::modules.message.updated')], $this->successMeta);
        return $this->_partialResponse(202, $data, $extra, $meta, $apiColumns, $isCollection);
    }

    /**
     * The request has been accepted for processing, but the processing has not been completed.
     *
     * @param null $data
     * @param array|null $extra
     * @param array|null $apiColumns
     * @param bool|null $isCollection
     * @return JsonResponse
     */
    protected function apiAccepted($data = null, ?array $extra = [], ?array $apiColumns = [], ?bool $isCollection = false): JsonResponse
    {
        $meta = null;
        $data = @array_merge(['message' => trans('base::modules.message.accepted')], $this->successMeta);
        return $this->_partialResponse(202, $data, $extra, $meta, $apiColumns, $isCollection);
    }

    /**
     * The request has been accepted for processing, but the processing has not been completed.
     *
     * @param null $data
     * @param array|null $extra
     * @param array|null $apiColumns
     * @param bool|null $isCollection
     * @return JsonResponse
     */
    protected function apiDeleted($data = null, ?array $extra = [], ?array $apiColumns = [], ?bool $isCollection = false): JsonResponse
    {
        $meta = null;
        $data = @array_merge(['message' => trans('base::modules.message.deleted')], $this->successMeta);
        return $this->_partialResponse(202, $data, $extra, $meta, $apiColumns, $isCollection);
    }

    /**
     * The request has been accepted for processing, but the processing has not been completed.
     *
     * @param null $data
     * @param array|null $extra
     * @param array|null $apiColumns
     * @param bool|null $isCollection
     * @return JsonResponse
     */
    protected function apiUnPublish($data = null, ?array $extra = [], ?array $apiColumns = [], ?bool $isCollection = false): JsonResponse
    {
        $meta = null;
        $data = @array_merge(['message' => trans('base::modules.message.un_published')], $this->successMeta);
        return $this->_partialResponse(202, $data, $extra, $meta, $apiColumns, $isCollection);
    }

    /**
     * The request has been accepted for processing, but the processing has not been completed.
     *
     * @param null $data
     * @param array|null $extra
     * @param array|null $apiColumns
     * @param bool|null $isCollection
     * @return JsonResponse
     */
    protected function apiChanged($data = null, ?array $extra = [], ?array $apiColumns = [], ?bool $isCollection = false): JsonResponse
    {
        $meta = null;
        $data = @array_merge(['message' => trans('base::modules.message.changed')], $this->successMeta);
        return $this->_partialResponse(202, $data, $extra, $meta, $apiColumns, $isCollection);
    }

    /**
     * The request has been accepted for processing, but the processing has not been completed.
     *
     * @param null $data
     * @param array|null $extra
     * @param array|null $apiColumns
     * @param bool|null $isCollection
     * @return JsonResponse
     */
    protected function apiRestored($data = null, ?array $extra = [], ?array $apiColumns = [], ?bool $isCollection = false): JsonResponse
    {
        $meta = null;
        $data = @array_merge(['message' => trans('base::modules.message.restored')], $this->successMeta);
        return $this->_partialResponse(202, $data, $extra, $meta, $apiColumns, $isCollection);
    }

    /**
     * The request successfully deleted the resource
     *
     * @return JsonResponse
     */
    protected function apiNoContent(): JsonResponse
    {
        $meta = null;
        $data = @array_merge(['message' => trans('base::modules.message.no_data')], $this->successMeta);
        return $this->_partialResponse(204, $data, $meta);
    }

    /**
     * The server understands the content type of the request entity,
     * and the syntax of the request entity is correct,
     * but was unable to process the contained instructions.
     *
     * @param null $data
     * @param array|null $extra
     * @param array|null $apiColumns
     * @param bool|null $isCollection
     * @return JsonResponse
     */
    protected function apiFailed($data = null, ?array $extra = [], ?array $apiColumns = [], ?bool $isCollection = false): JsonResponse
    {
        $meta = @array_merge(['message' => trans('base::modules.message.failed')], $this->failedMeta);
        return $this->_partialResponse(422, $data, $extra, $meta, $apiColumns, $isCollection);
    }

    /**
     * The request could not be understood by the server due to malformed syntax.
     * The client SHOULD NOT repeat the request without modifications.
     *
     * @param null $data
     * @param array|null $extra
     * @param array|null $apiColumns
     * @param bool|null $isCollection
     * @return JsonResponse
     */
    protected function apiBadRequest($data = null, ?array $extra = [], ?array $apiColumns = [], ?bool $isCollection = false): JsonResponse
    {
        $meta = null;
        $data = @array_merge(['message' => trans('base::modules.message.bad_request')], $this->failedMeta);
        return $this->_partialResponse(400, $data, $extra, $meta, $apiColumns, $isCollection);
    }

    /**
     * The request requires user authentication.
     *
     * @param null $data
     * @param array|null $extra
     * @param array|null $apiColumns
     * @param bool|null $isCollection
     * @return JsonResponse
     */
    protected function apiUnauthorized($data = null, ?array $extra = [], ?array $apiColumns = [], ?bool $isCollection = false): JsonResponse
    {
        $meta = null;
        $data = @array_merge(['message' => trans('base::modules.message.unauthorized')], $this->failedMeta);
        return $this->_partialResponse(401, $data, $extra, $meta, $apiColumns, $isCollection);
    }


    /**
     * The server understood the request, but is refusing to fulfill it.
     * Authorization will not help and the request SHOULD NOT be repeated.
     *
     * @param null $data
     * @param array|null $extra
     * @param array|null $apiColumns
     * @param bool|null $isCollection
     * @return JsonResponse
     */
    protected function apiForbidden($data = null, ?array $extra = [], ?array $apiColumns = [], ?bool $isCollection = false): JsonResponse
    {
        $meta = null;
        $data = @array_merge(['message' => trans('base::modules.message.forbidden')], $this->failedMeta);
        return $this->_partialResponse(403, $data, $extra, $meta, $apiColumns, $isCollection);
    }

    /**
     * The server has not found anything matching the Request-URI.
     * No indication is given of whether the condition is temporary or permanent.
     *
     * @param null $data
     * @param array|null $extra
     * @param array|null $apiColumns
     * @param bool|null $isCollection
     * @return JsonResponse
     */
    protected function apiNotFound($data = null, ?array $extra = [], ?array $apiColumns = [], ?bool $isCollection = false): JsonResponse
    {
        $meta = null;
        $data = @array_merge(['message' => trans('base::modules.message.not_found')], $this->failedMeta);
        return $this->_partialResponse(404, $data, $extra, $meta, $apiColumns, $isCollection);
    }

    /**
     * @param $data
     * @param $statusCode
     * @param array|null $apiColumns
     * @param bool|null $isCollection
     * @return JsonResponse
     */
    protected function apiException($data, $statusCode, ?array $apiColumns = [], ?bool $isCollection = false): JsonResponse
    {
        return $this->_partialResponse($statusCode, $data, null, null, $apiColumns, $isCollection);
    }

    /**
     * The request has been accepted for processing, but the processing has not been completed.
     *
     * @param int $responseStatus
     * @param null $data
     * @param array|null $extra
     * @param array|null $meta
     * @param array|null $apiColumns
     * @param bool|null $isCollection
     * @return JsonResponse
     */
    private function _partialResponse(int $responseStatus = 202, $data = null, ?array $extra = [], ?array $meta = [], ?array $apiColumns = [], ?bool $isCollection = false): JsonResponse
    {
        //Convert messageBags to string just for API guard
        $message = '';
        if (!empty($extra['message']) && $extra['message'] instanceof MessageBag) {
            $messages = $extra['message']->toArray();
            foreach ($messages as $key => $value)
                $message .= @array_shift($value) . '||';

            //$extra['message'] = !empty($message) ? $message : $extra['message'];
            $extra['success'] = false;
            $extra['status'] = 'error';
            $data['error'] = !empty($message) ? $message : $extra['message'];
            $data['code'] = 'VALIDATION_EXCEPTION';
        }

        //Added for response Integration
            if ($data === null || empty($data)) {
                $result = null;
            } elseif ($isCollection === true) {
                //As i wanted to keep JsonResponse As return method, i tricked with below scenario. Otherwise i could return it directly
                [$meta, $links] = $this->_makeCollectionParams($data);
                $data = (new BaseApiCollection($data))->columns($this->apiColumns);
                $result = $extra !== null ? ['data', 'meta', 'links', 'extra'] : ['data', 'meta', 'links'];
            } else {
                $data = !is_array($data) ? (new BaseApiResource($data))->columns($this->apiColumns) : $data;
                $result = $extra !== null ? ['data', 'extra'] : ['data'];
            }

        return response()->json(compact($result), $responseStatus);
    }


    /**
     * @param null $data
     * @return array
     *
     * Note: As i wanted to keep JsonResponse As response of main method, i tricked with below scenario
     */
    private function _makeCollectionParams($data = null): array
    {
        $meta = $links = [];
        if ($data !== null) {
            $dataArray = $data->toArray();
            if (isset($dataArray['data'])) {
                unset($dataArray['data']);
            }
            //dump($dataArray);
            if (isset($dataArray['links']) && is_array($dataArray['links'])) {
                $links = $dataArray['links'];
                unset($dataArray['links']);
                $meta = is_array($dataArray) ? $dataArray : null;
            }
        }
        return [$meta, $links];
    }
}
