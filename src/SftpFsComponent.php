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

use League\Flysystem\Sftp\SftpAdapter;
use Yii;
use yii\base\InvalidConfigException;

class SftpFsComponent extends AbstractFsComponent
{
    /**
     * @var string
     */
    public $host;
    /**
     * @var string
     */
    public $port;
    /**
     * @var string
     */
    public $username;
    /**
     * @var string
     */
    public $password;
    /**
     * @var integer
     */
    public $timeout;
    /**
     * @var string
     */
    public $root;
    /**
     * @var string
     */
    public $privateKey;
    /**
     * @var integer
     */
    public $permPrivate;
    /**
     * @var integer
     */
    public $permPublic;

    /**
     * @inheritdoc
     */
    public function init()
    {
        if ($this->host === null) {
            throw new InvalidConfigException('The "host" property must be set.');
        }
        if ($this->username === null) {
            throw new InvalidConfigException('The "username" property must be set.');
        }
        if ($this->password === null && $this->privateKey === null) {
            throw new InvalidConfigException('Either "password" or "privateKey" property must be set.');
        }
        if ($this->root !== null) {
            $this->root = Yii::getAlias($this->root);
        }
        parent::init();
    }

    /**
     * @return SftpAdapter
     */
    protected function initAdapter()
    {
        $config = array_filter(
            [
                'host' => $this->host,
                'port' => $this->port,
                'username' => $this->username,
                'password' => $this->password,
                'timeout' => $this->timeout,
                'root' => $this->root,
                'permPrivate' => $this->permPrivate,
                'permPublic' => $this->permPublic,
                'privatekey' => $this->privateKey
            ]
        );

        return new SftpAdapter($config);
    }
}
