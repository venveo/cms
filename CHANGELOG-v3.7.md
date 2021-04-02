# Release Notes for Craft CMS 3.7

### Added
- Date fields now have a “Show Time Zone” setting, allowing authors to choose which time zone the date is set to, rather than using the system time zone.
- Matrix fields can now be set to custom propagation methods, based on a propagation key template. ([#7610](https://github.com/craftcms/cms/issues/7610))
- Added `craft\base\Element::getCanonical()`.
- Added `craft\base\Element::getCanonicalId()`.
- Added `craft\base\Element::getIsCanonical()`.
- Added `craft\base\Element::getIsDerivative()`.
- Added `craft\base\Element::getOutdatedAttributes()`.
- Added `craft\base\Element::getOutdatedFields()`.
- Added `craft\base\Element::isAttributeModified()`.
- Added `craft\base\Element::isAttributeOutdated()`.
- Added `craft\base\Element::isFieldModified()`.
- Added `craft\base\Element::isFieldOutdated()`.
- Added `craft\base\Element::mergeCanonicalChanges()`.
- Added `craft\base\Element::setCanonicalId()`.
- Added `craft\base\ElementTrait::$dateLastMerged`.
- Added `craft\base\ElementTrait::$mergingCanonicalChanges`.
- Added `craft\base\ElementTrait::$updatingFromDerivative`.
- Added `craft\base\FieldInterface::copyValue()`.
- Added `craft\base\FieldInterface::getStatus()`.
- Added `craft\base\FieldTrait::$columnSuffix`.
- Added `craft\fields\Matrix::$propagationKeyFormat`.
- Added `craft\fields\Matrix::PROPAGATION_METHOD_CUSTOM`.
- Added `craft\helpers\Db::batch()` and `each()`, which can be used instead of `craft\db\Query::batch()` and `each()`, to execute batched SQL queries over a new, unbuffered database connection (if using MySQL). ([#7338](https://github.com/craftcms/cms/issues/7338))
- Added `craft\helpers\ElementHelper::fieldColumn()`.
- Added `craft\helpers\ElementHelper::fieldColumnFromField()`.
- Added `craft\helpers\ElementHelper::isDraft()`.
- Added `craft\helpers\ElementHelper::isRevision()`.
- Added `craft\web\twig\variables\Cp::getTimeZoneOptions()`.
- Added `craft\services\Elements::EVENT_BEFORE_MERGE_CANONICAL_CHANGES`.
- Added `craft\services\Elements::EVENT_AFTER_MERGE_CANONICAL_CHANGES`.
- Added `craft\services\Elements::mergeCanonicalChanges()`.
- Added `craft\services\Elements::updateCanonicalElement()`.
- Added `craft\services\Matrix::mergeCanonicalChanges()`.
- Added the `timeZone` and `timeZoneField` macros to the `_includes/forms.html` control panel template.

### Changed
- Changes from an entry’s Current revision are now automatically merged into drafts upon visiting drafts’ edit pages.
- When changes from an entry’s Current revision are merged into a draft, Matrix field changes are now merged on a per-block basis. ([#5503](https://github.com/craftcms/cms/issues/5503), [#7710](https://github.com/craftcms/cms/pull/7710))
- Matrix blocks now retain their original IDs and UIDs when a draft is published. ([#7710](https://github.com/craftcms/cms/pull/7710))
- Improved the styling of field status indicators, when editing a draft that has preexisting changes.
- Improved the UI of the Time Zone input in Settings → General.
- Custom fields with a custom translation method are no longer labelled as translatable if the translation key is an empty string. ([#7647](https://github.com/craftcms/cms/issues/7647))
- The `defaultCpLanguage` no longer affects console requests. ([#7747](https://github.com/craftcms/cms/issues/7747))
- The `date()` Twig function now supports arrays with `date` and/or `time` keys. ([#7681](https://github.com/craftcms/cms/issues/7681))
- Custom field column names now include a random string, preventing column name conflicts when deploying multiple project config changes at once. ([#6922](https://github.com/craftcms/cms/issues/6922))
- Custom fields can now store data across multiple columns in the `content` table.
- `craft\base\Element::__set()` now detects whether a custom field value is being set, and if so, passes the value through `setFieldValue()`. ([#7726](https://github.com/craftcms/cms/issues/7726))
- `craft\base\FieldInterface::getContentColumnType()` can now return an array, if the field stores content across multiple columns.

### Deprecated
- Deprecated `craft\base\Element::ATTR_STATUS_CONFLICTED`.
- Deprecated `craft\base\Element::getFieldStatus()`.
- Deprecated `craft\base\Element::getSourceId()`. `getCanonicalId()` should be used instead.
- Deprecated `craft\base\Element::getSourceUid()`. `getCanonical()->uid` should be used instead.
- Deprecated `craft\base\VolumeInterface::folderExists()`. `directoryExists()` should be used instead.
- Deprecated `craft\behaviors\BaseRevisionBehavior::$sourceId`. `craft\base\ElementInterface::getCanonicalId()` should be used instead.
- Deprecated `craft\behaviors\DraftBehavior::$dateLastMerged`. `craft\base\ElementTrait::$dateLastMerged` should be used instead.
- Deprecated `craft\behaviors\DraftBehavior::$mergingChanges`. `craft\base\ElementTrait::$mergingCanonicalChanges` should be used instead.
- Deprecated `craft\behaviors\DraftBehavior::$trackChanges`.
- Deprecated `craft\behaviors\DraftBehavior::getOutdatedAttributes()`. `craft\base\ElementInterface::getOutdatedAttributes()` should be used instead.
- Deprecated `craft\behaviors\DraftBehavior::getOutdatedFields()`. `craft\base\ElementInterface::getOutdatedFields()` should be used instead.
- Deprecated `craft\behaviors\DraftBehavior::isAttributeModified()`. `craft\base\ElementInterface::isAttributeModified()` should be used instead.
- Deprecated `craft\behaviors\DraftBehavior::isAttributeOutdated()`. `craft\base\ElementInterface::isAttributeOutdated()` should be used instead.
- Deprecated `craft\behaviors\DraftBehavior::isFieldModified()`. `craft\base\ElementInterface::isFieldModified()` should be used instead.
- Deprecated `craft\behaviors\DraftBehavior::isFieldOutdated()`. `craft\base\ElementInterface::isFieldOutdated()` should be used instead.
- Deprecated `craft\elements\Asset::KIND_FLASH`.
- Deprecated `craft\services\Content::getContentRow()`.
- Deprecated `craft\services\Content::populateElementContent()`.
- Deprecated `craft\services\Drafts::EVENT_AFTER_MERGE_SOURCE_CHANGES`.
- Deprecated `craft\services\Drafts::EVENT_BEFORE_MERGE_SOURCE_CHANGES`.
- Deprecated `craft\services\Drafts::mergeSourceChanges()`.

### Removed
- Removed support for the “Flash” file kind. ([#7626](https://github.com/craftcms/cms/issues/7626))