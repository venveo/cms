<?php
/**
 * @link https://craftcms.com/
 * @copyright Copyright (c) Pixel & Tonic, Inc.
 * @license https://craftcms.github.io/license/
 * @since 3.4.0
 */

namespace craft\assetpreviews;

use Craft;
use craft\base\AssetPreview;

/**
 * Provides functionality to preview audio files
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since 3.4.0
 */
class AudioPreview extends AssetPreview
{

    private $template = '';
    private $foot = '';

    // Public Methods
    // =========================================================================

    public function init()
    {
        $volume = $this->asset->getVolume();

        if ($volume->hasUrls) {
            $assetUrl = $this->asset->getUrl();
        } else {
            $assetUrl = $this->asset->getCopyOfFile();
        }

        $view = Craft::$app->getView();
        $this->template = $view->renderTemplate('assets/_previews/audio', [
            'asset' => $this->asset,
            'assetUrl' => $assetUrl
        ]);

        $this->foot = $view->getBodyHtml();

        parent::init();
    }

    /**
     * @inheritDoc
     */
    public function getModalHtml(): string
    {
        return $this->template;
    }

    public function getFootHtml()
    {
        return $this->foot;
    }
}
