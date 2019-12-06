<?php
/**
 * @link https://craftcms.com/
 * @copyright Copyright (c) Pixel & Tonic, Inc.
 * @license https://craftcms.github.io/license/
 */

namespace craft\models;

use Craft;
use craft\base\Model;
use craft\records\GqlToken as GqlSchemaRecord;
use craft\validators\UniqueValidator;

/**
 * GraphQL token class
 *
 * @property bool $isPublic Whether this is the public schema
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since 3.4.0
 */
class GqlToken extends Model
{
    // Constants
    // =========================================================================

    /**
     * The public access token value.
     */
    const PUBLIC_TOKEN = '__PUBLIC__';

    // Properties
    // =========================================================================

    /**
     * @var int|null ID
     */
    public $id;

    /**
     * @var string Token name
     */
    public $name;

    /**
     * @var int|null ID of the associated schema.
     * @since 3.4.0
     */
    public $schemaId;

    /**
     * @var string The access token
     */
    public $accessToken;

    /**
     * @var bool Is the token enabled
     */
    public $enabled = true;

    /**
     * @var \DateTime|null Date expires
     */
    public $expiryDate;

    /**
     * @var \DateTime|null Date last used
     */
    public $lastUsed;

    /**
     * @var \DateTime|null Date created
     */
    public $dateCreated;

    /**
     * @var string $uid
     */
    public $uid;

    /**
     * @var array The allowed scope for the token.
     */
    private $_scope = [];

    /**
     * @var GqlSchema The schema for this token.
     */
    private $_schema;

    /**
     * @var bool Whether this is a temporary token
     */
    public $isTemporary = false;

    // Public Methods
    // =========================================================================

    public function __construct($config = [])
    {
        // If the scope is passed in, intercept it and use it.
        if (!empty($config['schema'])) {
            $this->_schema = $config['schema'];

            // We don't want any confusion here, so unset the schema ID, if they set a custom scope.
            unset($config['schemaId']);
        }

        unset($config['schema']);
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function datetimeAttributes(): array
    {
        $attributes = parent::datetimeAttributes();
        $attributes[] = 'expiryDate';
        $attributes[] = 'lastUsed';
        return $attributes;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['name', 'accessToken'], 'required'];
        $rules[] = [
            ['name', 'accessToken'],
            UniqueValidator::class,
            'targetClass' => GqlSchemaRecord::class,
        ];

        return $rules;
    }

    /**
     * Use the translated group name as the string representation.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->name;
    }

    /**
     * Returns whether this is the public token.
     *
     * @return bool
     */
    public function getIsPublic(): bool
    {
        return $this->accessToken === self::PUBLIC_TOKEN;
    }

    /**
     * Return the schema for this token.
     *
     * @return GqlSchema|null
     */
    public function getSchema()
    {
        if (empty($this->_schema) && !empty($this->schemaId)) {
            $this->_schema = Craft::$app->getGql()->getSchemaById($this->schemaId);
        }

        return $this->_schema;
    }

    /**
     * Return the schema's scope for this token.
     *
     * @return array|mixed
     */
    public function getScope()
    {
        if (empty($this->_scope)) {
            $schema = $this->getSchema();
            $this->_scope = $schema ? $schema->scope : null;
        }

        return $this->_scope;
    }
}
