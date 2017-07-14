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

use Aws\S3\S3Client;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use yii\base\InvalidConfigException;

class AwsS3FsComponent extends AbstractFsComponent
{
    /**
     * @var string
     */
    public $key;
    /**
     * @var string
     */
    public $secret;
    /**
     * @var string
     */
    public $region;
    /**
     * @var string
     */
    public $bucket;
    /**
     * @var string|null
     */
    public $prefix;
    /**
     * @var string
     */
    public $version = "latest";
    /**
     * @var string for custom endpoints
     */
    public $endpoint;
    /**
     * @var array
     */
    public $options = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        if ($this->key === null) {
            throw new InvalidConfigException('The "key" property must be set.');
        }

        if ($this->secret === null) {
            throw new InvalidConfigException('The "secret" property must be set.');
        }

        if ($this->bucket === null) {
            throw new InvalidConfigException('The "bucket" property must be set.');
        }

        if ($this->region === null) {
            throw new InvalidConfigException('The "region" property must be set.');
        }

        parent::init();
    }

    /**
     * @return AwsS3Adapter
     */
    protected function initAdapter()
    {
        $config = array_filter(
            [
                'credentials' => [
                    'key' => $this->key,
                    'secret' => $this->secret
                ],
                'region' => $this->region,
                'version' => $this->version,
                'endpoint' => $this->endpoint
            ]
        );

        return new AwsS3Adapter(
            new S3Client($config),
            $this->bucket,
            $this->prefix
        );
    }
}
