<?php

namespace dosamigos\flysystem;

use CedricZiel\FlysystemGcs\GoogleCloudStorageAdapter;
use yii\base\InvalidConfigException;

class GoogleCloudFsComponent extends AbstractFsComponent
{
    /**
     * @var string
     */
    public $projectId;
    /**
     * @var string
     */
    public $bucket;
    /**
     * @var string
     */
    public $prefix;

    /**
     * @inheritdoc
     */
    public function init()
    {
        if ($this->projectId === null) {
            throw new InvalidConfigException('The "projectId" property must be set.');
        }

        if ($this->bucket === null) {
            throw new InvalidConfigException('The "bucket" property must be set.');
        }

        parent::init();
    }

    /**
     * @return GoogleCloudStorageAdapter
     */
    protected function initAdapter()
    {
        $config = array_filter(
            [
                'projectId' => $this->projectId,
                'bucket' => $this->bucket,
                'prefix' => $this->prefix
            ]
        );

        return new GoogleCloudStorageAdapter(null, $config);
    }
}
