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

use League\Flysystem\Azure\AzureAdapter;
use MicrosoftAzure\Storage\Common\ServicesBuilder;
use yii\base\InvalidConfigException;

class AzureFsComponent extends AbstractFsComponent
{
    /**
     * @var string
     */
    public $accountName;
    /**
     * @var string
     */
    public $accountKey;
    /**
     * @var string
     */
    public $container;
    /**
     * @inheritdoc
     */
    public function init()
    {
        if ($this->accountName === null) {
            throw new InvalidConfigException('The "accountName" property must be set.');
        }
        if ($this->accountKey === null) {
            throw new InvalidConfigException('The "accountKey" property must be set.');
        }
        if ($this->container === null) {
            throw new InvalidConfigException('The "container" property must be set.');
        }
        parent::init();
    }
    /**
     * @return AzureAdapter
     */
    protected function initAdapter()
    {
        return new AzureAdapter(
            ServicesBuilder::getInstance()->createBlobService(sprintf(
                'DefaultEndpointsProtocol=https;AccountName=%s;AccountKey=%s',
                base64_encode($this->accountName),
                base64_encode($this->accountKey)
            )),
            $this->container
        );
    }
}
