<?php
/**
 * @link https://github.com/engine-core/module-system
 * @copyright Copyright (c) 2021 engine-core
 * @license BSD 3-Clause License
 */

declare(strict_types=1);

namespace EngineCore\modules\system\models;

use EngineCore\enums\Enums;
use yii\data\ActiveDataProvider;

/**
 * SettingSearch
 *
 * @author E-Kevin <e-kevin@qq.com>
 */
class SettingSearch extends Setting
{

    public $status = Enums::UNLIMITED;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category', 'status', 'type'], 'integer'],
            [['name', 'title'], 'safe'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = self::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query->orderBy('category, order'),
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');

            return $dataProvider;
        }

        $query->andFilterWhere([
            'status' => $this->status != Enums::UNLIMITED ? $this->status : null,
            'category' => $this->category != Enums::UNLIMITED ? $this->category : null,
            'type' => $this->type != Enums::UNLIMITED ? $this->type : null,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }

}