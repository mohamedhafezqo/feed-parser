<?php

namespace App\Service\Parser;

use App\Exception\ParserException;
use App\Service\Parser\Contract\ParserInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Class Parser
 *
 * @package App\Service\Parser
 */
class XmlParser implements ParserInterface
{
    private HttpClientInterface $httpClient;

    /** @var string $type */
    private $type;

    /**
     * Parser constructor.
     *
     * @param HttpClientInterface $client
     */
    public function __construct(HttpClientInterface $client)
    {
        $this->httpClient = $client;
    }

    /**
     * @param string $url
     *
     * @return \SimpleXMLElement
     * @throws ParserException
     */
    public function parse(string $url)
    {
        try {
            $response = $this->httpClient->request('GET', $url);
            $response = new \SimpleXMLElement($response->getContent());
            $this->type = current($response->getDocNamespaces());
        } catch (\Throwable $exception) {
            throw new ParserException(
                sprintf(
                    'Invalid response from this Url: (%s)',
                    $url,
                )
            );
        }

        return $response;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        $this->type = explode('/', $this->type);

        return end($this->type);
    }
}
