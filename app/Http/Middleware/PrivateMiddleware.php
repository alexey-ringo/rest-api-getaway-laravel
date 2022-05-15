<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\IpUtils;
use Symfony\Component\HttpFoundation\Request as HttpRequest;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

/**
 * Class PrivateMiddleware
 * @package App\Http\Middleware
 */
class PrivateMiddleware
{
    /**
     * Check CRM
     *
     * @param  Request  $request
     * @param  Closure  $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $this->validateIpAddress($request);

        $credentials = $this->basicCredentials($request);

        if (! $this->once($credentials)) {
            $this->failedBasicResponse();
        }

        return $next($request);
    }

    /**
     * Get the credential array for an HTTP Basic request.
     *
     * @param  HttpRequest  $request
     *
     * @return array
     */
    private function basicCredentials(HttpRequest $request)
    {
        return [
            'username' => $request->getUser(),
            'password' => $request->getPassword(),
        ];
    }

    /**
     * Log a user into the application without sessions or cookies.
     *
     * @param  array  $credentials
     *
     * @return bool
     */
    private function once(array $credentials = [])
    {
        if ($this->validate($credentials)) {
            return true;
        }

        return false;
    }

    /**
     * Validate a user's credentials.
     *
     * @param  array  $credentials
     *
     * @return bool
     */
    private function validate(array $credentials = [])
    {
        if ($credentials['username'] !== config('auth.private.username')) {
            $this->failedBasicResponse();
        }

        return Hash::check(
            value: config('auth.private.password'),
            hashedValue: $credentials['password'],
        );
    }

    /**
     * Get the response for basic authentication.
     *
     * @return void
     *
     * @throws UnauthorizedHttpException
     */
    private function failedBasicResponse()
    {
        throw new UnauthorizedHttpException(
            challenge: 'Basic',
            message: 'Invalid credentials.',
        );
    }

    /**
     * @param  Request  $request
     */
    private function validateIpAddress($request)
    {
        if (! app()->environment('production')) {
            return;
        }

        $ips = $this->defineIpAddresses();
        $allowed = $ips->filter(function ($mask) use ($request) {
            return IpUtils::checkIp($request->ip(), trim($mask));
        });

        if ($allowed->isEmpty()) {
            logger()->warning(__METHOD__ . '::invalid_ip', [
                'ip'        => $request->ip(),
                'useragent' => $request->userAgent(),
            ]);

            abort(403, 'Invalid IP');
        }
    }

    /**
     * @return Collection
     */
    private function defineIpAddresses()
    {
        $ips = collect(
            explode(',', config('auth.private.ip_addresses'))
        )->filter()
         ->unique();

        if ($ips->isEmpty()) {
            logger()->warning(__METHOD__ . '::empty_ip_range');

            abort(403, 'Invalid default IP range');
        }

        return $ips;
    }
}
