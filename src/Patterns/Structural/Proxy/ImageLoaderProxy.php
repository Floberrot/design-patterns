<?php

namespace App\Patterns\Structural\Proxy;

use Symfony\Component\DependencyInjection\Attribute\AsAlias;
use Symfony\Contracts\Cache\CacheInterface;

#[AsAlias(ImageLoaderInterface::class, public: true)]
final class ImageLoaderProxy implements ImageLoaderInterface
{
    public function __construct(
        private readonly CacheInterface $cache
    )
    {
    }

    private ?ImageLoader $imageLoader = null;

    public function stream(string $folderPath): string
    {
        if (null === $this->imageLoader && !$this->cache->hasItem('streamed_images_' . md5($folderPath))) {
            echo 'Creating ImageLoader instance for folder: ' . $folderPath . "\n";
            $this->imageLoader = new ImageLoader($this->cache);
        } else {
            echo 'Using cached images for folder: ' . $folderPath . "\n";
            return $this->cache->getItem('streamed_images_' . md5($folderPath))->get();
        }

        try {
            return $this->imageLoader->stream($folderPath);
        } catch (\RuntimeException $e) {
            throw new \RuntimeException(sprintf('Error streaming images from folder "%s": %s', $folderPath, $e->getMessage()));
        }
    }
}
