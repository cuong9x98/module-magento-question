# Block
- Các bạn còn nhớ các xuất dữ liệu trong phần làm theme chứ.Chúng ta có layout và trong layout có container là  bộ khung trong đó có templates và block (trong đó templates là các html r,còn block là dữ liệu) => Block có tác dụng đổ dữ liệu vào layout. Chúng ta không thế sử dụng trực tiếp dữ liệu của Model nên phải sử dụng thông qua Block trong hợp này chúng ta có ui/componet nên sẽ được khai báo trong đấy.

## Ví Dụ :
- Trong source code của mình có 2 file Form.php và ListView.php(Block/Product/View) được layout trong  view/frontend/layout/catalog_product_view.php sử dụng 
```
<?xml version="1.0"?>
<!--
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
-->
<page layout="1column"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd">
    <body>
        <referenceBlock name="product.info.details">
            <block class="Magento\Framework\View\Element\Template" name="qa.tab" as="qa.tab" template="AHT_Question::product/view/question.phtml" group="detailed_info" cacheable="false" ifconfig="question_pending/question/is_enabled">
                <arguments>
                    <argument translate="true" name="title" xsi:type="string">Q and A</argument>
                    <argument name="sort_order" xsi:type="string">20</argument>
                </arguments>
                <!-- List question -->
                <block class="AHT\Question\Block\Product\View\ListView" name="qa.list" as="qa.list" template="AHT_Question::product/view/list.phtml" cacheable="false"/>
                <!-- ??? -->
                <block class="Magento\Theme\Block\Html\Pager" name="product_question_list.toolbar"/>
                <!-- Form Question -->
                <block class="AHT\Question\Block\Product\View\Form" name="qa.form" as="qa.form" template="AHT_Question::product/view/form.phtml" cacheable="false"/>
            </block>
        </referenceBlock>
    </body>
</page>

```  

=> Chú ý : Các templates list.phtml và form.phtml sẽ được magento mặc định có biến $block tương ứng với Block đã được gọi trong file layout.Như list.phtml có biến $block của AHT\Question\Block\Product\View\ListView .
- Block sẽ chứa dữ liệu còn templates sẽ chứa html .


## Ví Dụ 2:
 - Trong file ListQuestion.php (Block/Customer) sẽ được layout question_customer_index.xml(view/frontend/layout)
 ```
<page xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd">
    <update handle="customer_account"/>
    <body>
        <referenceContainer name="content">
            <block class="AHT\Question\Block\Customer\ListQuestion" name="AHT.Name" cacheable="false" template="AHT_Question::customer/list.phtml" ifconfig="question_pending/question/is_enabled"/>
        </referenceContainer>
    </body>
</page>

 ```

 - Chúng ta có thể thấy trong file customer/list.phtml sẽ có biến $block gọi ra được hàm getQuestions,getToolbarHtml trong Block ListQuestion.php  

```
<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
/** @var \AHT\Question\Block\Customer\ListQuestion $block */
?>
<?php if (count($block->getQuestions())) : ?>
    <div class="table-wrapper questions">
        <table class="data table table-questions" id="my-questions-table">
            <caption class="table-caption"><?= $block->escapeHtml(__('Product questions')) ?></caption>
            <thead>
                <tr>
                    <th scope="col" class="col date"><?= $block->escapeHtml(__('Created')) ?></th>
                    <th scope="col" class="col item"><?= $block->escapeHtml(__('Product Name')) ?></th>
                    <th scope="col" class="col question"><?= $block->escapeHtml(__('Question')) ?></th>
                    <th scope="col" class="col answer"><?= $block->escapeHtml(__('Answer')) ?></th>
                    <th scope="col" class="col actions">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($block->getQuestions() as $question) : ?>
                <tr>
                    <td data-th="<?= $block->escapeHtmlAttr(__('Created')) ?>" class="col date"><?= $block->escapeHtml($block->dateFormat($question->getCreatedAt())) ?></td>
                    <td data-th="<?= $block->escapeHtmlAttr(__('Product Name')) ?>" class="col name">
                        <strong class="product-name">
                            <a href="<?= $block->escapeUrl($block->getProductUrl($block->getProductById($question->getProductId()))) ?>"><?= $block->getProductById($question->getProductId())->getName() ?></a>
                        </strong>
                    </td>
                    <td data-th="<?= $block->escapeHtmlAttr(__('Question')) ?>" class="col question">
                        <?= $block->escapeHtml($question->getQuestion()) ?>
                    </td>
                    <td data-th="<?= $block->escapeHtmlAttr(__('Answer')) ?>" class="col answer">
                        <?= $block->escapeHtml($question->getAnswer()) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php if ($block->getToolbarHtml()) : ?>
        <div class="toolbar products-questions-toolbar bottom">
            <?= $block->getToolbarHtml() ?>
        </div>
    <?php endif; ?>
<?php else : ?>
    <div class="message info empty"><span><?= $block->escapeHtml(__('You have submitted no questions.')) ?></span></div>
<?php endif; ?>
<div class="actions-toolbar">
    <div class="secondary">
        <a class="action back" href="<?= $block->escapeUrl($block->getBackUrl()) ?>">
            <span><?= $block->escapeHtml(__('Back')) ?></span>
        </a>
    </div>
</div>

```

