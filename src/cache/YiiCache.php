<?php
/**
 * This file is part of the 2amigos/yii2-flysystem-component project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */
namespace dosamigos\flysystem\cache;

use League\Flysystem\Cached\Storage\AbstractCache;
use yii\caching\Cache;

class YiiCache extends AbstractCache
{
    /**
     * @var Cache
     */
    protected $yiiCache;
    /**
     * @var string
     */
    protected $key;
    /**
     * @var integer
     */
    protected $duration;
    /**
     * @param Cache $cache
     * @param string $key
     * @param integer $duration
     */
    public function __construct(Cache $cache, $key = 'flysystem', $duration = 0)
    {
        $this->cache = $cache;
        $this->key = $key;
        $this->duration = $duration;
    }
    /**
     * @inheritdoc
     */
    public function load()
    {
        $contents = $this->cache->get($this->key);
        if ($contents !== false) {
            $this->setFromStorage($contents);
        }
    }
    /**
     * @inheritdoc
     */
    public function save()
    {
        $this->cache->set($this->key, $this->getForStorage(), $this->duration);
    }
}
