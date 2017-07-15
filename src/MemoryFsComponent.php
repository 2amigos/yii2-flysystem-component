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

use League\Flysystem\Memory\MemoryAdapter;

/**
 * This adapter keeps the filesystem completely in memory. This is useful when you need a filesystem, but don’t want it
 * persisted.
 */
class MemoryFsComponent extends AbstractFsComponent
{
    /**
     * @return MemoryAdapter
     */
    protected function initAdapter()
    {
        return new MemoryAdapter();
    }
}
