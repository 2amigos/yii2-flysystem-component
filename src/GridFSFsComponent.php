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

use League\Flysystem\GridFS\GridFSAdapter;
use MongoClient;
use yii\base\InvalidConfigException;

class GridFSFsComponent extends AbstractFsComponent
{
    /**
     * @var string
     */
    public $server;
    /**
     * @var string
     */
    public $database;

    /**
     * @inheritdoc
     */
    public function init()
    {
        if ($this->server === null) {
            throw new InvalidConfigException('The "server" property must be set.');
        }

        if ($this->database === null) {
            throw new InvalidConfigException('The "database" property must be set.');
        }

        parent::init();
    }

    /**
     * @return GridFSAdapter
     */
    protected function initAdapter()
    {
        $mongo = new MongoClient($this->server);

        return new GridFSAdapter($mongo->selectDB($this->database)->getGridFS());
    }
}
