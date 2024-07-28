<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Authentication;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\API\Authentication\LoginRequest;
use App\Http\Resources\API\Authentication\UserAccessTokenResource;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\AuditLog;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

final class LoginController extends AbstractAPIController
{
    public function __construct(
        private readonly Request $request,
        private readonly UserRepositoryInterface $userRepository
    ) {
    }

    /**
     * @throws Exception
     */
    public function __invoke(LoginRequest $request): JsonResource
    {
        $email = $request->getEmail();

        $user = $this->userRepository->findByEmail($email);

        if ($user === null) {
            return $this->respondUnauthorised([
                'message' => 'Invalid credentials',
            ]);
        }

        try {
            $response = $this->authenticate($email, $request->getPassword());

            if (Arr::get($response, 'error') !== null) {
                return $this->respondError(Arr::get($response, 'message'), Response::HTTP_UNAUTHORIZED);
            }

            $response['user'] = $user;

            $this->logAction($user->id, 'login', 'Login successful');
            return new UserAccessTokenResource($response);
        } catch (Exception $exception) {
            return new JsonResource(
                [
                    'error' => $exception->getMessage(),
                    'code' => $exception->getCode(),
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * @throws Exception
     */
    private function authenticate(string $username, string $password): array
    {
        $request = Request::create('/oauth/token', 'POST');

        $request->headers->set('Accept', 'application/json');
        $request->request->add([
            'client_id' => env('CLIENT_ID'),
            'client_secret' => env('CLIENT_SECRET'),
            'grant_type' => 'password',
            'username' => $username,
            'password' => $password,
        ]);

        $res = app()->handle($request);

        return json_decode($res->getContent(), true);
    }

    /**
     * Log an action to the audit log.
     *
     * @param int|string $userId
     * @param string $action
     * @param string $description
     */
    private function logAction(int|string $userId, string $action, string $description): void
    {
        AuditLog::create([
            'user_id' => is_numeric($userId) ? (int)$userId : null,
            'action' => $action,
            'description' => $description,
        ]);
    }
}
