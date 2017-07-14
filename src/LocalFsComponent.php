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

use League\Flysystem\Adapter\Local;
use Yii;
use yii\base\InvalidConfigException;

class LocalFsComponent extends AbstractFsComponent
{
    /**
     * @var string
     */
    public $path;
    /**
     * @var int
     */
    public $writeFlags = LOCK_EX;
    /**
     * @var int
     */
    public $linkHandling = Local::DISALLOW_LINKS;
    /**
     * @var array
     */
    public $permissions = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        if ($this->path === null) {
            throw new InvalidConfigException('The "path" property must be set.');
        }
        $this->path = Yii::getAlias($this->path);
        parent::init();
    }

    /**
     * @return Local
     */
    protected function initAdapter()
    {
        return new Local($this->path, $this->writeFlags, $this->linkHandling, $this->permissions);
    }
}
