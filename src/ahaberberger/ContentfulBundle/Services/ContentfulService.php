<?php
/**
 * Created by IntelliJ IDEA.
 * User: andreas
 * Date: 26.09.14
 * Time: 10:19
 */

namespace ahaberberger\ContentfulBundle\Services;

use ahaberberger\ContentfulBundle\Entities\Asset;
use ahaberberger\ContentfulBundle\Entities\Entry;
use ahaberberger\ContentfulBundle\Entities\Link;
use ahaberberger\ContentfulBundle\Entities\AbstractType;
use GuzzleHttp\Client;

/**
 * Class ContentfulService
 * @package ahaberberger\ContentfulBundle\Services
 */
class ContentfulService {

    /** @var  string */
    protected $space;

    /** @var  string */
    protected $token;

    /** @var  Client */
    protected $client;

    protected $types = [
        'ContentType'   => 'contenttypes',
        'Space'         => 'spaces',
        'Entry'         => 'entries',
        'Asset'         => 'assets'
    ];

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

    public function getAsset($id)
    {
        $request = $this->client->createRequest('GET', sprintf('%s/assets/%s', $this->getUrl(), $id));
        $request->addHeader('Authorization', sprintf('Bearer %s', $this->token));
        $response = $this->client->send($request);
        $asset = $this->parseAsset($response->json());
        return $asset;
    }

    /**
     * @param Link $link
     * @return AbstractType
     */
    public function resolveLink($link)
    {
        $type = $this->types[$link->getLinkType()];
        $request = $this->client->createRequest(
            'GET',
            sprintf('%s/%s/%s', $this->getUrl(), $type, $link->getId())
        );
        $request->addHeader('Authorization', sprintf('Bearer %s', $this->token));
        $response = $this->client->send($request);
        switch ($type) {
            case 'assets':
                $result = Asset::fromArray($response->json());
                break;
            case 'entries':
                $result = Entry::fromArray($response->json());
                break;
            default:
                $result = null;
                break;
        }
        return $result;
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

    protected function parseAsset($json)
    {
        return Asset::fromArray($json);
    }
}