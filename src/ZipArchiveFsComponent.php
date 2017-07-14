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

use League\Flysystem\ZipArchive\ZipArchiveAdapter;
use Yii;
use yii\base\InvalidConfigException;

class ZipArchiveFsComponent extends AbstractFsComponent
{
    /**
     * @var string
     */
    public $path;
    /**
     * @var string|null
     */
    public $prefix;

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
     * @return ZipArchiveAdapter
     */
    protected function initAdapter()
    {
        return new ZipArchiveAdapter($this->path, null, $this->prefix);
    }
}
