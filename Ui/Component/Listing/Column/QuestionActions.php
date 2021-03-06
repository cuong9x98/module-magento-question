<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AHT\Question\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Escaper;

/**
 * Class to build edit and delete link for each item.
 */
class QuestionActions extends Column
{
    /**
     * Url path
     */
    const URL_PATH_EDIT = 'question/question/fix';
    const URL_PATH_DELETE = 'question/question/delete';
    const URL_PATH_GET_PRICE = 'question/question/price';
    const URL_PATH_GET_SYSTEM = 'question/question/config';

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var Escaper
     */
    private $escaper;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * @inheritDoc
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['question_id'])) {
                    $question = $this->getEscaper()->escapeHtmlAttr($item['question']);
                    $item[$this->getData('name')] = [
                        'fix' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_EDIT,
                                [
                                    'question_id' => $item['question_id'],
                                ]
                            ),
                            'label' => __('Sua'),
                            '__disableTmpl' => true,
                        ],
                        'delete' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_DELETE,
                                [
                                    'question_id' => $item['question_id'],
                                ]
                            ),
                            'label' => __('Xoa'),
                            'confirm' => [
                                'title' => __('Delete %1', $question),
                                'message' => __('Are you sure you want to delete a %1 record?', $question),
                            ],
                            'post' => true,
                            '__disableTmpl' => true,
                        ],
                        'price' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_GET_PRICE,
                                [
                                    'product_id' => $item['product_id'],
                                ]
                            ),
                            'label' => __('Get price'),
                            '__disableTmpl' => true,
                        ],
                        'getsystem' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_GET_SYSTEM
                            ),
                            'label' => __('Get system'),
                            '__disableTmpl' => true,
                        ],
                    ];
                }
            }
        }
        return $dataSource;
    }

    /**
     * Get instance of escaper
     *
     * @return Escaper
     * @deprecated 101.0.7
     */
    private function getEscaper()
    {
        if (!$this->escaper) {
            $this->escaper = ObjectManager::getInstance()->get(Escaper::class);
        }
        return $this->escaper;
    }
}