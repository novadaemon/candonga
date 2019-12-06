<?php namespace Candonga\Exceptions;

use App\Exceptions\Handler as BaseHandler;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Candonga\Http\Responses\ApiResponse;

class Handler extends BaseHandler
{
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if($request->segment(1) == 'api'){
            /**
             * Is an Api Exception
             */
            return $this->renderApiException($request, $exception);
        }

        return parent::render($request, $exception);
    }

    protected function renderApiException($request, $exception)
    {
        $data = [];
        $message = $exception->getMessage();
        $status = $this->isHttpException($exception) ? $exception->getStatusCode() : 500;

        if($exception instanceof AuthenticationException){
            $message = 'Token is missing or invalid';
            $status = 401;
        }elseif($exception instanceof  ValidationException){
            $data = [
                'errors' => $exception->errors()
            ];
        }elseif($exception instanceof HttpResponseException) {
            return $exception->getResponse();

        }elseif($exception instanceof NotFoundHttpException){
            $message = 'Route not found';
        }elseif($exception instanceof ModelNotFoundException){
            $status = 404;
        }

        return ApiResponse::response(false, $data, $message, $status);
    }
}