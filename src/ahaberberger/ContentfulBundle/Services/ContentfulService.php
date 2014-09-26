<?php
/**
 * Created by IntelliJ IDEA.
 * User: andreas
 * Date: 26.09.14
 * Time: 10:19
 */

namespace ahaberberger\ContentfulBundle\Services;

use ahaberberger\ContentfulBundle\Entities\Entry;
use GuzzleHttp\Client;

class ContentfulService {

    /** @var  string */
    protected $space;

    /** @var  string */
    protected $token;

    /** @var  Client */
    protected $client;

    function __construct($space, $token)
    {
        $this->space = $space;
        $this->token = $token;

        $this->client = new Client();
    }

    public function listEntries($contentType = null)
    {
        $request = $this->client->createRequest('GET', sprintf('%s/entries', $this->getUrl()));
        $request->addHeader('Authorization', sprintf('Bearer %s', $this->token));

        if ($contentType !== null) {
            $request->setQuery(
                [
                    'content_type' => $contentType
                ]
            );
        }

        $response = $this->client->send($request);

        $entries = $this->parseEntries($response->json());

        return $entries;
    }

    protected function getUrl(){
        return sprintf('https://cdn.contentful.com/spaces/%s', $this->space);
    }

    protected function parseEntries($data)
    {
        $out = [];
        $no = $data['total'];
        if ($no > 0) {
            foreach ($data['items'] as $item) {
                if ($item['sys']['type'] == 'Entry'){
                    $out[] = Entry::fromArray($item);
                }
            }
        }
        return $out;
    }
}