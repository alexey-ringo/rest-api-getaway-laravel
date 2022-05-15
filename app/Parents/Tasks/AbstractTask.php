<?php

declare(strict_types = 1);

namespace App\Parents\Tasks;

use App\Exceptions\ApiLogicalException;
use App\Exceptions\ApiNotFoundException;
use App\Parents\Dto\Base\DataTransferObject;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

abstract class AbstractTask
{
    const CONNECTION_TIMEOUT = 10;
    const TIMEOUT = 180;
    const GET_TYPE = 'get';
    const POST_TYPE = 'post';
    const PUT_TYPE = 'put';
    const PATCH_TYPE = 'patch';
    const DELETE_TYPE = 'delete';

    protected string $baseUri;
    protected string $apiPath;
    protected array $options;

    protected string $token;
    protected string $username;
    protected string $password;
    protected string $bearerToken;

    protected Response $response;
    protected array $responseJson;
    protected DataTransferObject $responseResourceDto;
    protected DataTransferObject $responseResourceDataDto;
    protected Collection $responseCollectionDataDto;

    protected string $httpType;

    protected string $responseDtoClassName;
    protected string $responseDataDtoClassName;

    protected string $extractFromContentName;
    protected bool $isOriginalContentWrapped = true;

    protected string $contentArrayName;
    protected string $subContentArrayName;
    protected array $addParams;

    protected string $resourceCollectionClassName;

    /**
     * AbstractTask constructor.
     */
    public function __construct()
    {
        $this->initialize();
    }

    protected function sendHttp(DataTransferObject $dto)
    {
        if (isset($this->token, $dto->token)) {
            $dto->token = $this->token;
        }

        $params = [];
        if (isset($dto->rawRequestIntoData)) {
            if (isset($dto->requestData) && is_array($dto->requestData)) {
                $params = $dto->requestData;
            }
            unset($params['http_process_id']);
        } else {
            $params = $dto->toArrayNoGaps();
        }

        //POST - default
        if (isset($this->username, $this->password)) {
            $this->response = match ($this->httpType) {
                self::GET_TYPE => Http::withBasicAuth($this->username, $this->password)->withOptions($this->options)
                    ->retry(3, 1000, function ($exception) {
                        return $exception instanceof ConnectionException || $exception->getCode() === 503 || $exception->code() === 429;
                    })
                    ->get($this->baseUri . $this->apiPath, $params),
                self::PUT_TYPE => Http::withBasicAuth($this->username, $this->password)->withOptions($this->options)
                    ->retry(3, 1000, function ($exception) {
                        return $exception instanceof ConnectionException || $exception->getCode() === 503 || $exception->code() === 429;
                    })
                    ->put($this->baseUri . $this->apiPath, $params),
                self::PATCH_TYPE => Http::withBasicAuth($this->username, $this->password)->withOptions($this->options)
                    ->retry(3, 1000, function ($exception) {
                        return $exception instanceof ConnectionException || $exception->getCode() === 503 || $exception->code() === 429;
                    })
                    ->patch($this->baseUri . $this->apiPath, $params),
                self::DELETE_TYPE => Http::withBasicAuth($this->username, $this->password)->withOptions($this->options)
                    ->retry(3, 1000, function ($exception) {
                        return $exception instanceof ConnectionException || $exception->getCode() === 503 || $exception->code() === 429;
                    })
                    ->delete($this->baseUri . $this->apiPath, $params),
                default => Http::withBasicAuth($this->username, $this->password)->withOptions($this->options)
                    ->retry(3, 1000, function ($exception) {
                        return $exception instanceof ConnectionException || $exception->getCode() === 503 || $exception->code() === 429;
                    })
                    ->post($this->baseUri . $this->apiPath, $params),
            };
        } elseif (isset($this->bearerToken)) {
            $this->response = match ($this->httpType) {
                self::GET_TYPE => Http::withToken($this->bearerToken)->withOptions($this->options)
                    ->retry(3, 1000, function ($exception) {
                        return $exception instanceof ConnectionException || $exception->getCode() === 503 || $exception->getCode() === 429;
                    })
                    ->get($this->baseUri . $this->apiPath, $params),
                self::PUT_TYPE => Http::withToken($this->bearerToken)->withOptions($this->options)
                    ->retry(3, 1000, function ($exception) {
                        return $exception instanceof ConnectionException || $exception->getCode() === 503 || $exception->getCode() === 429;
                    })
                    ->put($this->baseUri . $this->apiPath, $params),
                self::PATCH_TYPE => Http::withToken($this->bearerToken)->withOptions($this->options)
                    ->retry(3, 1000, function ($exception) {
                        return $exception instanceof ConnectionException || $exception->getCode() === 503 || $exception->getCode() === 429;
                    })
                    ->patch($this->baseUri . $this->apiPath, $params),
                self::DELETE_TYPE => Http::withToken($this->bearerToken)->withOptions($this->options)
                    ->retry(3, 1000, function ($exception) {
                        return $exception instanceof ConnectionException || $exception->getCode() === 503 || $exception->getCode() === 429;
                    })
                    ->delete($this->baseUri . $this->apiPath, $params),
                default => Http::withToken($this->bearerToken)->withOptions($this->options)
                    ->retry(3, 1000, function ($exception) {
                        return $exception instanceof ConnectionException || $exception->getCode() === 503 || $exception->getCode() === 429;
                    })
                    ->post($this->baseUri . $this->apiPath, $params),
            };
        } else {
            $this->response = match ($this->httpType) {
                self::GET_TYPE => Http::withOptions($this->options)
                    ->retry(3, 1000, function ($exception) {
                        return $exception instanceof ConnectionException || $exception->getCode() === 503 || $exception->getCode() === 429;
                    })
                    ->get($this->baseUri . $this->apiPath, $params),
                self::PUT_TYPE => Http::withOptions($this->options)
                    ->retry(3, 1000, function ($exception) {
                        return $exception instanceof ConnectionException || $exception->getCode() === 503 || $exception->getCode() === 429;
                    })
                    ->put($this->baseUri . $this->apiPath, $params),
                self::PATCH_TYPE => Http::withOptions($this->options)
                    ->retry(3, 1000, function ($exception) {
                        return $exception instanceof ConnectionException || $exception->getCode() === 503 || $exception->getCode() === 429;
                    })
                    ->patch($this->baseUri . $this->apiPath, $params),
                self::DELETE_TYPE => Http::withOptions($this->options)
                    ->retry(3, 1000, function ($exception) {
                        return $exception instanceof ConnectionException || $exception->getCode() === 503 || $exception->getCode() === 429;
                    })
                    ->delete($this->baseUri . $this->apiPath, $params),
                default => Http::withOptions($this->options)
                    ->retry(3, 1000, function ($exception) {
                        return $exception instanceof ConnectionException || $exception->getCode() === 503 || $exception->getCode() === 429;
                    })
                    ->post($this->baseUri . $this->apiPath, $params),
            };
        }
    }

    /**
     * @throws ApiLogicalException
     * @throws ValidationException
     */
    protected function responseValidationData(): void
    {
        $responseJson = $this->response->json();
        if ($this->response->successful()) {
            if (! isset($responseJson)) {
                throw new ApiLogicalException('Missing or incorrect response format from remote service '
                    . $this->baseUri . $this->apiPath . ' ! Remote server returns NULL!', 500);
            }
            if (isset($responseJson['status']) && $responseJson['status'] === 'error') {
                throw new ApiLogicalException('Error from remote service '
                    . $this->baseUri . $this->apiPath . ' - ' . $responseJson['message'] ?? 'Remote server returns error!', 500);
            }
            if (isset($this->contentArrayName) && (! isset($responseJson[$this->contentArrayName])
                    || ! is_array($responseJson[$this->contentArrayName]))) {
                throw new ApiLogicalException('Missing or incorrect response format from remote service '
                    . $this->baseUri . $this->apiPath . ' ! Missing ' . $this->contentArrayName . ' data!', 500);
            }
            if (isset($this->contentArrayName, $this->subContentArrayName) && (! isset($responseJson[$this->contentArrayName][$this->subContentArrayName])
                    || ! is_array($responseJson[$this->contentArrayName][$this->subContentArrayName]))) {
                throw new ApiLogicalException('Missing or incorrect response format from remote service '
                    . $this->baseUri . $this->apiPath . ' ! Missing ' . $this->subContentArrayName . ' data!', 500);
            }
            if (isset($this->addParams) && ! empty($this->addParams)) {
                foreach ($this->addParams as $paramKey => $paramValue) {
                    if (is_string($paramValue)) {
                        if (!isset($responseJson[$paramValue])) {
                            throw new ApiLogicalException('Missing or incorrect response format from remote service '
                                . $this->baseUri . $this->apiPath . ' ! Missing ' . $paramValue . ' data!', 500);
                        }
                    }
                    if (is_array($paramValue)) {
                        foreach ($paramValue as $subParam) {
                            if (! isset($responseJson[$paramKey][$subParam])) {
                                throw new ApiLogicalException('Missing or incorrect response format from remote service '
                                    . $this->baseUri . $this->apiPath . ' ! Missing ' . $subParam . ' data!', 500);
                            }
                        }
                    }
                }
            }
            $this->responseJson = $responseJson;
        }
        $this->responseFailed();
    }

    /**
     * @throws ValidationException
     * @throws ApiLogicalException
     * @throws ApiNotFoundException
     */
    protected function responseFailed(): void
    {
        if ($this->response->failed()) {
            $responseJson = $this->response->json();
            if ($this->response->status() === 404) {
                throw new ApiNotFoundException($responseJson['message'] ?? 'Resource not found!', 404);
            } else {
                if (isset($responseJson['errors'])) {
                    $errorsBag = is_array($responseJson['errors']) ? $responseJson['errors'] : ['Remote service validation error!'];
                    throw ValidationException::withMessages($errorsBag);
                } else {
                    $errorMsg = $responseJson['message'] ?? 'Remote service error!';
                    throw new ApiLogicalException($errorMsg, $this->response->status());
                }
            }
        }
    }

    protected function fillResponseDto(): void
    {
        if (isset($this->extractFromContentName)) {
            $responseData = $this->responseJson[$this->extractFromContentName];
        } else {
            $responseData = $this->responseJson;
        }
        if ($this->isOriginalContentWrapped) {
            $this->responseResourceDto = new $this->responseDtoClassName($responseData);
        } else {
            $this->responseResourceDto = new $this->responseDtoClassName(data: $responseData);
        }
//
//        if (isset($this->responseDtoClassName) && ! isset($this->responseDataDtoClassName)) {
//            $this->responseResourceDto = new $this->responseDtoClassName($responseDtoArray);
//        }
//        if (isset($this->responseDataDtoClassName) && ! isset($this->responseDtoClassName)) {
//            $this->responseResourceDto = new $this->responseDataDtoClassName($responseDtoArray);
//        }

        // TODO : if I will be able to transfer dynamic attribute into caster constructor
//        if (isset($this->responseDtoClassName) && isset($this->responseDataDtoClassName)) {
//            $this->responseResourceDto = new $this->responseDtoClassName($responseDtoArray, $this->responseDataDtoClassName);
//        }
    }

    protected function fillResponseResourceDataDto()
    {
        $responseDataDtoArray = isset($this->contentArrayName) ? $this->responseJson[$this->contentArrayName] : $this->responseJson;
        $this->responseResourceDataDto = new $this->responseDataDtoClassName($responseDataDtoArray);
    }

    protected function fillResponseCollectionDataDto()
    {
        if (isset($this->contentArrayName)) {
            if (isset($this->subContentArrayName)) {
                $iterableResponseArray = $this->responseJson[$this->contentArrayName][$this->subContentArrayName];
            } else {
                $iterableResponseArray = $this->responseJson[$this->contentArrayName];
            }
        } else {
            $iterableResponseArray = $this->responseJson;
        }
        $this->responseCollectionDataDto = collect($iterableResponseArray)->map(function ($item) {
            return new $this->responseDataDtoClassName($item);
        });
    }

    private function initialize()
    {
        $this->options = [
            'connect_timeout' => self::CONNECTION_TIMEOUT,
            'timeout'         => self::TIMEOUT,
            'verify' => ! app()->environment('local')
        ];
    }
}
