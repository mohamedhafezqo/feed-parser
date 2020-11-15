<?php declare(strict_types=1);

namespace App\Service\Feed\Formatters;

use App\Service\Feed\Formatters\Contract\FormatterInterface;

/**
 * Class AtomFormatter
 *
 * @package App\Service\Feed\Formatters
 */
class AtomFormatter implements FormatterInterface
{
    private \SimpleXMLElement $root;

    /**
     * AtomReader constructor.
     *
     * @param \SimpleXMLElement $root
     */
    public function __construct(\SimpleXMLElement $root)
    {
        $this->root = $root;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getChannel()
    {
        $channel['title'] = (string)$this->root->title;
        $channel['publicId'] = (string)$this->root->id;
        $channel['link'] = current($this->root->link)['href'] ?? "";
        $channel['icon'] = (string)$this->root->icon;
        $channel['logo'] = (string)$this->root->logo;
        $channel['rights'] = (string)$this->root->rights;
        $channel['updatedAt'] = new \DateTime((string)$this->root->updated);

        return $channel;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getEntities()
    {
        $listings = [];
        foreach($this->root->entry as $entry) {
            $data ['title'] = (string) $entry->title;
            $data ['publicId'] = (string) $entry->id;
            $data ['link'] = current($entry->link)['href'] ?? "";
            $data ['summary'] = (string) $entry->summary;
            $data ['content'] = (string) $entry->content;
            $data ['category'] = current($entry->category)['terms'] ?? "";
            $data ['updatedAt'] = new \DateTime((string) $entry->updated);
            $data ['publishedAt'] = new \DateTime((string) $entry->published) ?? "";

            $listings [] = $data;
        }

        return $listings;
    }
}
