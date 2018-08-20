<?php

namespace App\Http\Requests;

use App\Exceptions\RequestException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

/**
 * Class ApiRequest
 * @package App\Http\Requests
 */
abstract class ApiRequest extends FormRequest
{
    /**
     * @var Collection
     */
    protected $data;

    /**
     *
     */
    public function validate()
    {
        $validation = \Validator::make(
            $this->data(),
            $this->rules(),
            $this->messages()
        );

        if ($validation->fails()) {

            throw new RequestException(
                $this->message(),
                $this->messageCode(),
                $this->statusCode(),
                $validation->errors()->all(),
                $this->header()
            );
        }
    }

    public function authorize()
    {
        return true;
    }

    /**
     * @return int
     */
    public function statusCode() : int
    {
        return Response::HTTP_BAD_REQUEST;
    }

    /**
     * @param string $fieldName
     * @param $errorMessage
     * @return string
     */
    protected function formatRequestError(string $fieldName, $errorMessage)
    {
        return serialize([
            'field' => $fieldName,
            'message' => $errorMessage,
        ]);
    }

    /**
     * @return string
     */
    abstract public function message() : string;

    /**
     * @return string
     */
    abstract public function messageCode(): string;

    /**
     * @return array
     */
    abstract public function data() : array;

    /**
     * @return array
     */
    abstract public function rules() : array;

    /**
     * @param string $name
     * @param array $fields
     */
    public function mapArrayField(string $name, array $fields) : void
    {
        if (array_key_exists($name, $this->json()->all())) {
            $this->data->put($name, collect($this->json($name))
                ->map(function ($item) use ($fields) {
                    return array_only($item, $fields);
                })->all());
        }
    }

    /**
     * @param string $name
     * @param array $fields
     */
    public function mapObjectField(string $name, array $fields) : void
    {
        if (array_key_exists($name, $this->json()->all())) {
            $this->data->put($name, collect($this->json($name))
                ->only($fields)
                ->all());
        }
    }

    /**
     *
     */
    public function loadJsonData(array $fields) : void
    {
        $this->data = collect($this->json())
            ->only($fields);
    }
}
