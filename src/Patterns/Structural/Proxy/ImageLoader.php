<?php

namespace App\Patterns\Structural\Proxy;

use Symfony\Contracts\Cache\CacheInterface;

readonly class ImageLoader implements ImageLoaderInterface
{
    public function __construct(
        private CacheInterface $cache
    )
    {
    }

    public function stream(string $folderPath): string
    {
        echo "Streaming images from folder: $folderPath\n";
        $images = glob($folderPath . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE);

        if (empty($images)) {
            throw new \RuntimeException(sprintf('No images found in folder "%s".', $folderPath));
        }

        $streamedImages = [];
        foreach ($images as $image) {
            if (!file_exists($image)) {
                throw new \RuntimeException(sprintf('Image file "%s" does not exist.', $image));
            }

            $streamedImages[] = file_get_contents($image);
        }

        $implodeImages = implode("\n", $streamedImages);

        $item = $this->cache->getItem('streamed_images_' . md5($folderPath));
        $item->set($implodeImages);
        $this->cache->save($item);

        echo "Images streamed and cached successfully.\n";
        return $implodeImages;
    }
}
