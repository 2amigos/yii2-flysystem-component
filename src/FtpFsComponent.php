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

use League\Flysystem\Adapter\Ftp;
use Yii;
use yii\base\InvalidConfigException;

class FtpFsComponent extends AbstractFsComponent
{
    /**
     * @var string
     */
    public $host;
    /**
     * @var integer
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
     * @var boolean
     */
    public $ssl;
    /**
     * @var integer
     */
    public $timeout;
    /**
     * @var string
     */
    public $root;
    /**
     * @var integer
     */
    public $permPrivate;
    /**
     * @var integer
     */
    public $permPublic;
    /**
     * @var boolean
     */
    public $passive;
    /**
     * @var integer
     */
    public $transferMode;

    /**
     * @inheritdoc
     */
    public function init()
    {
        if ($this->host === null) {
            throw new InvalidConfigException('The "host" property must be set.');
        }
        if ($this->root !== null) {
            $this->root = Yii::getAlias($this->root);
        }
        parent::init();
    }

    /**
     * @return Ftp
     */
    protected function initAdapter()
    {
        $config = array_filter(
            [
                'host' => $this->host,
                'port' => $this->port,
                'username' => $this->username,
                'password' => $this->password,
                'ssl' => $this->ssl,
                'timeout' => $this->timeout,
                'root' => $this->root,
                'permPrivate' => $this->permPrivate,
                'permPublic' => $this->permPublic,
                'passive' => $this->passive,
                'transferMode' => $this->transferMode,
            ]
        );

        return new Ftp($config);
    }
}
