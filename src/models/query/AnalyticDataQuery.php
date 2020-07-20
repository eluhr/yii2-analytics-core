<?php

namespace eluhr\analytics\core\models\query;

/**
 * This is the ActiveQuery class for [[\dmstr\analytics\models\AnalyticData]].
 *
 * @see \dmstr\analytics\models\AnalyticData
 */
class AnalyticDataQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return \dmstr\analytics\models\AnalyticData[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \dmstr\analytics\models\AnalyticData|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
