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

use League\Flysystem\Rackspace\RackspaceAdapter;
use OpenCloud\Rackspace;
use yii\base\InvalidConfigException;

class RackspaceFsComponent extends AbstractFsComponent
{
    /**
     * @var string
     */
    public $endpoint;
    /**
     * @var string
     */
    public $username;
    /**
     * @var string
     */
    public $apiKey;
    /**
     * @var string
     */
    public $region;
    /**
     * @var string
     */
    public $container;
    /**
     * @var string|null
     */
    public $prefix;

    /**
     * @inheritdoc
     */
    public function init()
    {
        if ($this->endpoint === null) {
            throw new InvalidConfigException('The "endpoint" property must be set.');
        }
        if ($this->username === null) {
            throw new InvalidConfigException('The "username" property must be set.');
        }
        if ($this->apiKey === null) {
            throw new InvalidConfigException('The "apiKey" property must be set.');
        }
        if ($this->region === null) {
            throw new InvalidConfigException('The "region" property must be set.');
        }
        if ($this->container === null) {
            throw new InvalidConfigException('The "container" property must be set.');
        }
        parent::init();
    }

    /**
     * @return RackspaceAdapter
     */
    protected function initAdapter()
    {
        $client = new Rackspace($this->endpoint, ['username' => $this->username, 'apiKey' => $this->apiKey]);
        $container = $client
            ->objectStoreService('cloudFiles', $this->region)
            ->getContainer($this->container);

        return new RackspaceAdapter(
            $container,
            $this->prefix
        );
    }
}
