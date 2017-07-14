<?php
/**
 * This file is part of the 2amigos/yii2-flysystem-component project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */
namespace dosamigos\flysystem;

use dosamigos\flysystem\cache\YiiCache;
use League\Flysystem\AdapterInterface;
use League\Flysystem\Cached\CachedAdapter;
use League\Flysystem\Filesystem;
use League\Flysystem\Replicate\ReplicateAdapter;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\caching\Cache;

/**
 * Filesystem
 *
 * @method \League\Flysystem\FilesystemInterface addPlugin(\League\Flysystem\PluginInterface $plugin)
 * @method void assertAbsent(string $path)
 * @method void assertPresent(string $path)
 * @method boolean copy(string $path, string $newpath)
 * @method boolean createDir(string $dirname, array $config = null)
 * @method boolean delete(string $path)
 * @method boolean deleteDir(string $dirname)
 * @method \League\Flysystem\Handler get(string $path, \League\Flysystem\Handler $handler = null)
 * @method \League\Flysystem\AdapterInterface getAdapter()
 * @method \League\Flysystem\Config getConfig()
 * @method array|false getMetadata(string $path)
 * @method string|false getMimetype(string $path)
 * @method integer|false getSize(string $path)
 * @method integer|false getTimestamp(string $path)
 * @method string|false getVisibility(string $path)
 * @method array getWithMetadata(string $path, array $metadata)
 * @method boolean has(string $path)
 * @method array listContents(string $directory = '', boolean $recursive = false)
 * @method array listFiles(string $path = '', boolean $recursive = false)
 * @method array listPaths(string $path = '', boolean $recursive = false)
 * @method array listWith(array $keys = [], $directory = '', $recursive = false)
 * @method boolean put(string $path, string $contents, array $config = [])
 * @method boolean putStream(string $path, resource $resource, array $config = [])
 * @method string|false read(string $path)
 * @method string|false readAndDelete(string $path)
 * @method resource|false readStream(string $path)
 * @method boolean rename(string $path, string $newpath)
 * @method boolean setVisibility(string $path, string $visibility)
 * @method boolean update(string $path, string $contents, array $config = [])
 * @method boolean updateStream(string $path, resource $resource, array $config = [])
 * @method boolean write(string $path, string $contents, array $config = [])
 * @method boolean writeStream(string $path, resource $resource, array $config = [])
 */
abstract class AbstractFsComponent extends Component
{
    /**
     * @var \League\Flysystem\Config|array|string|null
     */
    public $config;
    /**
     * @var string|null
     */
    public $cache;
    /**
     * @var string
     */
    public $cacheKey = 'flysystem';
    /**
     * @var integer
     */
    public $cacheDuration = 3600;
    /**
     * @var string|null
     */
    public $replica;
    /**
     * @var \League\Flysystem\FilesystemInterface
     */
    protected $filesystem;

    /**
     * @inheritdoc
     */
    public function __call($method, $parameters)
    {
        return call_user_func_array([$this->filesystem, $method], $parameters);
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        $adapter = $this->checkReplica($this->checkCached($this->initAdapter()));

        $this->filesystem = new Filesystem($adapter, $this->config);
    }

    /**
     * @param AdapterInterface $adapter
     *
     * @return AdapterInterface|CachedAdapter
     * @throws InvalidConfigException
     */
    protected function checkCached(AdapterInterface $adapter)
    {
        if (null !== $this->cache) {
            /* @var Cache $cache */
            $cache = Yii::$app->get($this->cache);
            if (!$cache instanceof Cache) {
                throw new InvalidConfigException(
                    printf('The "cache" property must be an instance of %s subclasses.', Cache::class)
                );
            }
            $adapter = new CachedAdapter($adapter, new YiiCache($cache, $this->cacheKey, $this->cacheDuration));
        }

        return $adapter;
    }

    /**
     * @param AdapterInterface $adapter
     *
     * @return ReplicateAdapter|AdapterInterface
     * @throws InvalidConfigException
     */
    protected function checkReplica(AdapterInterface $adapter)
    {
        if ($this->replica !== null) {
            /* @var Filesystem $filesystem */
            $filesystem = Yii::$app->get($this->replica);
            if (!$filesystem instanceof Filesystem) {
                throw new InvalidConfigException(
                    printf('The "replica" property must be an instance of %s subclasses.', AbstractFsComponent::class)
                );
            }
            $adapter = new ReplicateAdapter($adapter, $filesystem->getAdapter());
        }

        return $adapter;
    }

    /**
     * @return  AdapterInterface $adapter
     */
    abstract protected function initAdapter();
}
