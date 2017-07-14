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

use Spatie\Dropbox\Client;
use Spatie\FlysystemDropbox\DropboxAdapter;
use yii\base\InvalidConfigException;

class DropboxFsComponent extends AbstractFsComponent
{
    /**
     * @var string
     */
    public $token;
    /**
     * @var string
     */
    public $app;
    /**
     * @var string|null
     */
    public $prefix;

    /**
     * @inheritdoc
     */
    public function init()
    {
        if ($this->token === null) {
            throw new InvalidConfigException('The "token" property must be set.');
        }

        if ($this->app === null) {
            throw new InvalidConfigException('The "app" property must be set.');
        }

        parent::init();
    }

    /**
     * @return DropboxAdapter
     */
    protected function initAdapter()
    {
        return new DropboxAdapter(
            new Client($this->token, $this->app),
            $this->prefix
        );
    }
}
