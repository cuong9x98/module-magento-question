# Ok, Làm hiện thị list question
## I.Viết Controller cho hành động click vào nút menu Question
### 1.Tạo file Index.php trong controller.
```
	<?php
<?php
namespace AHT\Question\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 */
class Index extends Action implements HttpGetActionInterface
{
    const MENU_ID = 'AHT_Question::index';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * Index constructor.
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);

        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Load the page defined in view/adminhtml/layout/exampleadminnewpage_helloworld_index.xml
     *
     * @return Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu(static::MENU_ID);
        $resultPage->getConfig()->getTitle()->prepend(__('Question All'));
        return $resultPage;
    }
}


```
- Lưu ý : Các bạn đặt file Controller theo địa chỉ url khi bạn click vào nút Question. Trong trường hợp này action trong file menu.xml của mình là question/question/index nên file mình sẽ đặt là Controller/Adminhtml/Question/Index 

### 2.Tạo file router.xml để khai báo "url gốc"
```
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:App/etc/routes.xsd">
	<router id="admin">
		<route id="question" frontName="question">
			<module name="AHT_Question" before="Magento_Backend" />
		</route>
	</router>
</config>
```

### 3.Tạo file layout question_question_index.xml.xml(view/adminhtml/layout)
```
<?xml version="1.0"?>
<page
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd">
    <referenceBlock name="content">
        <uiComponent name="question_index_listing" />
    </referenceBlock>
</page>


```

### 4.Tạo file question_index_listing.xml trong (view/adminhtml/ui_component)
```
<listing
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:module:Magento_Ui:etc/ui_configuration.xsd">
    <argument name="data" xsi:type="array">
        <item name="js_config" xsi:type="array">
            <item name="provider" xsi:type="string">question_index_listing.question_index_listing_data_source</item>
            <item name="deps" xsi:type="string">question_index_listing.question_index_listing_data_source</item>
        </item>
        <item name="spinner" xsi:type="string">question_index_listing_columns</item> 
        <!-- <item name="buttons" xsi:type="array"><item name="add" xsi:type="array"><item name="name" xsi:type="string">add</item><item name="label" xsi:type="string" translate="true">Add New Post</item><item name="class" xsi:type="string">primary</item><item name="url" xsi:type="string">qaa/question/edit</item></item></item> -->
    </argument>
    <dataSource name="nameOfDataSource">
        <argument name="dataProvider" xsi:type="configurableObject">
            <argument name="class" xsi:type="string">Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider</argument>
            <argument name="name" xsi:type="string">question_index_listing_data_source</argument>
            <argument name="primaryFieldName" xsi:type="string">question_id</argument>
            <argument name="requestFieldName" xsi:type="string">question_id</argument>
            <argument name="data" xsi:type="array">
                <item name="config" xsi:type="array">
                    <item name="component" xsi:type="string">Magento_Ui/js/grid/provider</item>
                    <item name="update_url" xsi:type="url" path="mui/index/render"/>
                    <item name="storageConfig" xsi:type="array">
                        <item name="indexField" xsi:type="string">question_id</item>
                    </item>
                </item>
            </argument>
        </argument>
    </dataSource>
    <listingToolbar name="listing_top">
        <settings>
            <sticky>true</sticky>
        </settings>
        <bookmark name="bookmarks"/>
        <columnsControls name="columns_controls"/>
        <filters name="listing_filters">
            <settings>
                <templates>
                    <filters>
                        <select>
                            <param name="template" xsi:type="string">ui/grid/filters/elements/ui-select</param>
                            <param name="component" xsi:type="string">Magento_Ui/js/form/element/ui-select</param>
                        </select>
                    </filters>
                </templates>
            </settings>
            <filterSelect name="question_id" provider="${ $.parentName }">
                <settings>
                    <captionValue>0</captionValue>
                    <options class="Magento\Cms\Ui\Component\Listing\Column\Cms\Options"/>
                    <label translate="true">Store View</label>
                    <dataScope>question_id</dataScope>
                    <imports>
                        <link name="visible">componentType = column, index = ${ $.index }:visible</link>
                    </imports>
                </settings>
            </filterSelect>
        </filters>
        <massaction name="listing_massaction">
            <action name="delete">
                <settings>
                    <confirm>
                        <message translate="true">Are you sure you want to delete selected items?</message>
                        <title translate="true">Delete items</title>
                    </confirm>
                    <url path="qaa/question/massDelete"/>
                    <type>delete</type>
                    <label translate="true">Delete</label>
                </settings>
            </action>
            <action name="enable">
                <settings>
                    <confirm>
                        <message translate="true">Are you sure you want enable items?</message>
                        <title translate="true">Enable items</title>
                    </confirm>
                    <url path="qaa/question/massEnable"/>
                    <type>enable</type>
                    <label translate="true">Enable</label>
                </settings>
            </action>
            <action name="disable">
                <settings>
                    <confirm>
                        <message translate="true">Are you sure you want disable items?</message>
                        <title translate="true">Disable items</title>
                    </confirm>
                    <url path="qaa/question/massDisable"/>
                    <type>disable</type>
                    <label translate="true">Disable</label>
                </settings>
            </action>
            <action name="edit">
                <settings>
                    <callback>
                        <target>editSelected</target>
                        <provider>question_index_listing.question_index_listing.question_index_listing_columns_editor</provider>
                    </callback>
                    <type>edit</type>
                    <label translate="true">Edit</label>
                </settings>
            </action>
        </massaction>
        <paging name="listing_paging"/>
    </listingToolbar>
    <columns name="question_index_listing_columns">
        <settings>
            <editorConfig>
                <param name="clientConfig" xsi:type="array">
                    <item name="saveUrl" xsi:type="url" path="question/question/inlineEdit"/>
                    <item name="validateBeforeSave" xsi:type="boolean">false</item>
                </param>
                <param name="indexField" xsi:type="string">question_id</param>
                <!-- Tat bat inline edit -->
                <param name="enabled" xsi:type="boolean">true</param>
                <param name="selectProvider" xsi:type="string">question_index_listing.question_index_listing.question_index_listing_columns.ids</param>
            </editorConfig>
            <childDefaults>
                <param name="fieldAction" xsi:type="array">
                    <item name="provider" xsi:type="string">question_index_listing.question_index_listing.question_index_listing_columns_editor</item>
                    <item name="target" xsi:type="string">startEdit</item>
                    <item name="params" xsi:type="array">
                        <item name="0" xsi:type="string">${ $.$data.rowIndex }</item>
                        <item name="1" xsi:type="boolean">true</item>
                    </item>
                </param>
            </childDefaults>
        </settings>
        <selectionsColumn name="ids">
            <argument name="data" xsi:type="array">
                <item name="config" xsi:type="array">
                    <item name="resizeEnabled" xsi:type="boolean">false</item>
                    <item name="resizeDefaultWidth" xsi:type="string">55</item>
                    <item name="indexField" xsi:type="string">question_id</item>
                </item>
            </argument>
        </selectionsColumn>
        <column name="question_id">
            <argument name="data" xsi:type="array">
                <item name="config" xsi:type="array">
                    <item name="filter" xsi:type="string">textRange</item>
                    <item name="sorting" xsi:type="string">asc</item>
                    <item name="label" xsi:type="string" translate="true">ID</item>
                </item>
            </argument>
        </column>
        <column name="name">
            <argument name="data" xsi:type="array">
                <item name="config" xsi:type="array">
                    <item name="filter" xsi:type="string">text</item>
                    <item name="dataType" xsi:type="string">text</item>
                    <item name="label" xsi:type="string" translate="true">Name</item>
                </item>
            </argument>
        </column>
        <column name="question">
            <argument name="data" xsi:type="array">
                <item name="config" xsi:type="array">
                    <item name="filter" xsi:type="string">text</item>
                    <item name="dataType" xsi:type="string">text</item>
                    <item name="label" xsi:type="string" translate="true">Question</item>
                </item>
            </argument>
        </column>
        <column name="answer">
            <argument name="data" xsi:type="array">
                <item name="config" xsi:type="array">
                    <item name="filter" xsi:type="string">text</item>
                    <item name="editor" xsi:type="array">
                        <item name="editorType" xsi:type="string">text</item>
                        <!-- <item name="validation" xsi:type="array"><item name="required-entry" xsi:type="boolean">true</item></item> -->
                    </item>
                    <item name="label" xsi:type="string" translate="true">Answer</item>
                </item>
            </argument>
        </column>
        <column name="status" component="Magento_Ui/js/grid/columns/select">
            <settings>
                <options class="AHT\Question\Model\Question\Source\Status"/>
                <filter>select</filter>
                <editor>
                    <editorType>select</editorType>
                </editor>
                <dataType>select</dataType>
                <label translate="true">Status</label>
            </settings>
        </column>
        <!-- <column name="store_id" class="Magento\Store\Ui\Component\Listing\Column\Store">
            <settings>
                <label translate="true">Store View</label>
                <bodyTmpl>ui/grid/cells/html</bodyTmpl>
                <sortable>false</sortable>
            </settings>
        </column> -->
        <column name="value">
            <argument name="data" xsi:type="array">
                <item name="config" xsi:type="array">
                    <item name="filter" xsi:type="string">text</item>
                    <item name="dataType" xsi:type="string">text</item>
                    <item name="label" xsi:type="string" translate="true">Product Name</item>
                </item>
            </argument>
        </column>
        <!-- <column name="image_path" class="AHT\QA\Ui\Component\Listing\Column\Thumbnail">
            <argument name="data" xsi:type="array">
                <item name="config" xsi:type="array">
                    <item name="component" xsi:type="string">Magento_Ui/js/grid/columns/thumbnail</item>
                    <item name="sortable" xsi:type="boolean">false</item>
                    <item name="altField" xsi:type="string">title</item>
                    <item name="has_preview" xsi:type="string">1</item>
                    <item name="label" xsi:type="string" translate="true">Image</item>
                </item>
            </argument>
        </column> -->
        <column name="created_at" class="Magento\Ui\Component\Listing\Columns\Date">
            <argument name="data" xsi:type="array">
                <item name="config" xsi:type="array">
                    <item name="filter" xsi:type="string">dateRange</item>
                    <item name="component" xsi:type="string">Magento_Ui/js/grid/columns/date</item>
                    <item name="dataType" xsi:type="string">date</item>
                    <item name="label" xsi:type="string" translate="true">Created</item>
                </item>
            </argument>
        </column>
        <column name="updated_at" class="Magento\Ui\Component\Listing\Columns\Date">
            <argument name="data" xsi:type="array">
                <item name="config" xsi:type="array">
                    <item name="filter" xsi:type="string">dateRange</item>
                    <item name="component" xsi:type="string">Magento_Ui/js/grid/columns/date</item>
                    <item name="dataType" xsi:type="string">date</item>
                    <item name="label" xsi:type="string" translate="true">Modified</item>
                </item>
            </argument>
        </column>
        <actionsColumn name="actions" class="AHT\Question\Ui\Component\Listing\Column\QuestionActions">
            <settings>
                <indexField>question_id</indexField>
            </settings>
        </actionsColumn>
    </columns>
</listing>
```
- Chú ý: Ở file ui này chúng ta sử dụng hai tài nguyên là :
	+ AHT\Question\Ui\Component\Listing\Column\QuestionActions
	+ AHT\Question\Model\Question\Source\Status

### 5.Tạo file QuestionActions (Ui/Component/Listing/Column)
```
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
                        'edit' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_EDIT,
                                [
                                    'question_id' => $item['question_id'],
                                ]
                            ),
                            'label' => __('Edit'),
                            '__disableTmpl' => true,
                        ],
                        'delete' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_DELETE,
                                [
                                    'question_id' => $item['question_id'],
                                ]
                            ),
                            'label' => __('Delete'),
                            'confirm' => [
                                'title' => __('Delete %1', $question),
                                'message' => __('Are you sure you want to delete a %1 record?', $question),
                            ],
                            'post' => true,
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
```

### 6.Tạo file Status.php (Module/Question/Source/Status.php)
```
<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AHT\Question\Model\Question\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class IsActive
 */
class Status implements OptionSourceInterface
{
    /**
     * @var \Magento\Cms\Model\Block
     */
    protected $cmsBlock;

    /**
     * Constructor
     *
     * @param \Magento\Cms\Model\Block $cmsBlock
     */
    // public function __construct(\Magento\Cms\Model\Block $cmsBlock)
    // {
    //     $this->cmsBlock = $cmsBlock;
    // }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $availableOptions = [1 =>__('Approved'), 0 =>__('Pending')];
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}

``

