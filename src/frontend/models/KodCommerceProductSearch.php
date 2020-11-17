<?php


namespace kodCommerce\frontend\models;


use ronashdkl\kodCms\components\FieldConfig;
use ronashdkl\kodCms\modules\admin\models\Post;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;


class KodCommerceProductSearch extends KodCommerceProduct
{
    public $sort;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tree_id','price'], 'integer'],
            [['title', 'body', 'tag'], 'string'],
            ['sort','safe']
        ];
    }
    public function formTypes()
    {
        return [
            'title'=>[
                'type'=>FieldConfig::INPUT
            ],
            'tag'=>[
                'type'=>FieldConfig::INPUT
            ],
            'sort'=>[
                'type'=>FieldConfig::RADIO,
                'data'=>ArrayHelper::map([
                    [
                        'code'=>'price',
                        'name'=> 'Low to High'
                    ],
                    [
                        'code'=>'-price',
                        'name'=> 'High to Low'
                    ],
                    [
                        'code'=>'created_at',
                        'name'=> 'Oldest'
                    ],
                    [
                        'code'=>'-created_at',
                        'name'=> 'Latest'
                    ],

                ],'code','name'),
                'label'=>'Filter'
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
    public function formName()
    {
        return '';
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
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>[
                'pageSize'=>20
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'tag', $this->tag])
            ->andFilterWhere(['=', 'tree_id', $this->tree_id]);

        return $dataProvider;
    }
}
