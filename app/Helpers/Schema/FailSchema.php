<?php

namespace App\Helpers\Schema;

use Illuminate\Http\Response;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class FailSchema
 * @package App\Helpers\Schema
 */
class FailSchema extends JsonSchema
{
    private $errors;
    private $trace;
    private $class;
    private $file;
    private $line;
    private $isHttpException;

    /**
     * FailSchema constructor.
     * @param \Exception $e
     */
    public function __construct(\Exception $e)
    {
        $this->isHttpException = ($e instanceof HttpException);

        $status = ($this->isHttpException) ? $e->getCode() : Response::HTTP_INTERNAL_SERVER_ERROR;

        $exception = FlattenException::create($e, $status);

        $this->setMessage($exception->getMessage());
        $this->trace = $exception->getTrace();
        $this->class = $exception->getClass();
        $this->statusCode = $exception->getStatusCode();
        $this->headers = $exception->getHeaders();
        $this->file = $exception->getFile();
        $this->line = $exception->getLine();
        $this->errors = [];

        parent::__construct();
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    public function setErrors(array $errors)
    {
        $this->errors = $errors;
    }

    /**
     * @return string
     */
    public function getMessage() : string
    {
        return $this->message;
    }

    /**
     * @return array
     */
    public function getTrace() : array
    {
        return $this->trace;
    }

    /**
     * @return mixed
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @return string
     */
    public function getFile() : string
    {
        return $this->file;
    }

    /**
     * @return int
     */
    public function getLine() : int
    {
        return $this->line;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $schema = [];

        $message = "";
        $messageCode = "";

        if (empty($this->message)) {
            if ($this->isHttpException) {
                $message = Response::$statusTexts[$this->getStatusCode()];
                $messageCode = strtolower(str_replace(' ', '_', $message));
            }
        } else {
            $message = $this->message;
            $messageCode = $this->messageCode;
        }

        $schema['success'] = false;
        $schema['message'] = $message;
        $schema['messageCode'] = $messageCode;
        $schema['statusCode'] = $this->statusCode;
        $schema['errors'] = $this->utf8Converter($this->errors);


        if ($this->isDebugEnable) {
            $schema['debug'] =[
                'file' => $this->file,
                'line' => $this->line,
                'class' => $this->class,
                'headers' => $this->headers,
            ];

            if ($this->isTraceEnable) {
                $schema['debug']['trace'] = $this->trace;
            }
        }

        return $schema;
    }
}
