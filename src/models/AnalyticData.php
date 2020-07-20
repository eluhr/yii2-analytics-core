<?php

namespace eluhr\analytics\core\models;

use eluhr\analytics\core\models\base\AnalyticData as BaseAnalyticData;
use Ramsey\Uuid\Uuid;

/**
 * This is the model class for table "app_dmstr_analytic_data".
 *
 * @property-read mixed $typeLabel
 */
class AnalyticData extends BaseAnalyticData
{

    public const TYPE_VISIT = 'VISIT';
    public const TYPE_INFO = 'INFO';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%analytic_data}}';
    }

    public function rules()
    {
        $rules = parent::rules();
        $rules['type-validation'] = [
            'type',
            'in',
            'range' => array_keys(static::optsType())
        ];
        $rules['data-validation'] = [
            'data',
            'validateDataByType'
        ];
        return $rules;
    }

    public function validateDataByType () {
        if ($this->validateData() === false) {
            $this->addError('data',\Yii::t('analytics','Data in wrong format for type "{type}"', ['type' => $this->typeLabel]));
        }
    }

    protected function validateData(): bool
    {
        switch ($this->type) {
            case static::TYPE_VISIT:
                return $this->validateDataVisit();
                break;
            case static::TYPE_INFO:
                return true;
                break;
        }
        \Yii::error('No validation defined for type "' . $this->type . '"', __METHOD__);
        return false;
    }

    protected function validateDataVisit(): bool
    {
        $data = json_decode($this->data, true);
        if (isset($data['route'])) {
            return true;
        }
        $this->addError('data','"route" must be set in data');
        return false;
    }

    public function beforeValidate()
    {
        if ($this->isNewRecord) {
            $this->id = (string)Uuid::uuid4();
        }
        return parent::beforeValidate();
    }

    public static function optsType(): array
    {
        return [
            static::TYPE_INFO => \Yii::t('analytics','Info'),
            static::TYPE_VISIT => \Yii::t('analytics','Visit')
        ];
    }

    public function getTypeLabel()
    {
        return static::optsType()[$this->type] ?? \Yii::t('analytics','Undefined');
    }

    public static function savePageVisit($route): bool
    {
        $model = new static([
            'type' => static::TYPE_VISIT,
            'data' => json_encode(['route' => $route])
        ]);

        if ($model->save() === false) {
            \Yii::error($model->errors,__METHOD__);
            return false;
        }
        return true;
    }

    public static function saveInfo(string $data): bool
    {
        $model = new static([
            'type' => static::TYPE_INFO,
            'data' => $data
        ]);

        if ($model->save() === false) {
            \Yii::error($model->errors,__METHOD__);
            return false;
        }
        return true;
    }
}
