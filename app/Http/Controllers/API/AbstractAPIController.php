<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use function app;
use App\Exceptions\Interfaces\ErrorLogInterface;
use App\Http\Resources\ErrorResource;
use App\Models\User;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

abstract class AbstractAPIController
{

    public function getUser(): ?User
    {
        /** @var User $user */
       $user = auth()->user();

       return $user;
    }

    /**
     * Return HTTP OK (200) response
     *
     * @param array $data
     * @param array $headers
     *
     * @return JsonResource
     */
    protected function respondOk(array $data = [], array $headers = []): JsonResource
    {
        return new JsonResource($data, Response::HTTP_OK, $headers);
    }

    /**
     * Return HTTP bad request (400) response
     *
     * @param array $data
     * @param array $headers
     * @return JsonResource
     */
    protected function respondBadRequest(array $data = [], array $headers = []): JsonResource
    {
        return new ErrorResource($data['message'], ResponseAlias::HTTP_BAD_REQUEST);
    }

    /**
     * Return HTTP conflict (409) response
     *
     * @param array $data
     * @param array $headers
     *
     * @return JsonResource
     */
    protected function respondConflict(array $data = [], array $headers = []): JsonResource
    {
        return new ErrorResource($data['message'], ResponseAlias::HTTP_CONFLICT);
    }

    /**
     * Return HTTP created (201) response
     *
     * @param array $data
     * @param array $headers
     * @return JsonResponse
     */
    protected function respondCreated(array $data = [], array $headers = []): JsonResponse
    {
        return new JsonResponse($data, Response::HTTP_CREATED, $headers);
    }

    protected function respondJsonResourceCreated(array $data = [], array $headers = []): JsonResource
    {
        return new JsonResource($data, Response::HTTP_CREATED, $headers);
    }

    /**
     * Return HTTP bad request (400) response
     *
     * @param array $data
     * @param array $headers
     * @return JsonResource
     */
    protected function respondInternalError(array $data = [], array $headers = []): JsonResource
    {
        try {
            $logger = app()->make(ErrorLogInterface::class);

            $logger->log($data['message'] ?? '', 'error');

            return new ErrorResource($data['message'], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (BindingResolutionException $exception) {
            return new ErrorResource('Internal Server Error', ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Return HTTP forbidden (403) response
     *
     * @param ?array $data
     * @param array $headers
     * @return JsonResource
     */
    protected function respondForbidden(?array $data = null, array $headers = []): JsonResource
    {
        $message = 'You are not allowed to access this resource';
        if ($data !== null) {
            $message = $data['message'] ?? $message;
        }

        return new ErrorResource($message, ResponseAlias::HTTP_FORBIDDEN);
    }

    /**
     * Return HTTP no content (204) response
     *
     * @param array $headers
     * @return JsonResource
     */
    protected function respondNoContent(array $headers = []): JsonResource
    {
        return new JsonResource([], Response::HTTP_NO_CONTENT, $headers);
    }

    /**
     * Return HTTP not found (404) response
     *
     * @param array $data
     * @param array $headers
     * @return JsonResource
     */
    protected function respondNotFound(array $data = [], array $headers = []): JsonResource
    {
        return new ErrorResource($data['message'], ResponseAlias::HTTP_NOT_FOUND);
    }

    /**
     * Return HTTP unauthorized (401) response
     *
     * @param array $data
     * @param array $headers
     * @return JsonResource
     */
    protected function respondUnauthorised(array $data = [], array $headers = []): JsonResource
    {
        return $this->respondError($data['message'] ?? 'Invalid Credentials', Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Return HTTP unprocessable (422) response
     *
     * @param array $data
     * @param array $headers
     *
     * @return JsonResource
     */
    protected function respondUnprocessable(array $data = [], array $headers = []): JsonResource
    {
        return new JsonResource($data, Response::HTTP_UNPROCESSABLE_ENTITY, $headers);
    }

    protected function respondError(string $message, ?int $status = null): ErrorResource
    {
        return new ErrorResource($message, $status);
    }

    protected function isEmailValid(string $email): bool
    {
        $validate = Validator::make(
            [
                'email' => $email,
            ],
            [
                'email' => 'email',
            ],
        );

        return $validate->fails() === false;
    }
}
