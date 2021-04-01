# Ok, Start Turn Off Module
## Đầu tiên, tạo file system.xml trong etc/adminhtml dùng để khai báo ra trường AHT/Question trong trang quản trị
```
<?xml version="1.0"?>
<config
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:module:Magento_Config:etc/system_file.xsd">
    <system>
        <tab id="aht" translate="label" sortOrder="500">
            <label>AHT</label>
        </tab>
        <section id="question_pending" translate="label" type="text" sortOrder="100" showInDefault="1" showInWebsite="1" showInStore="1">
            <label>Question</label>
            <tab>aht</tab>
            <resource>AHT_Question::question</resource>
            <group id="question" translate="label" type="text" sortOrder="1" showInDefault="1" showInWebsite="1" showInStore="1">
                <label>Question Pending page settings</label>
                <field id="is_enabled" translate="label" type="select" sortOrder="10" showInDefault="1" showInWebsite="1" showInStore="1">
                    <label>Is Enabled</label>
                    <source_model>Magento\Config\Model\Config\Source\Yesno</source_model>
                </field>
            </group>
        </section>
    </system>
</config>
```
- Chú ý: 
	+ Đoạn code trên sẽ tạo ra select dùng để bật tắt module.

## Tiếp theo, chúng ta viết thêm thuộc tính ifconfig trong file layout cụ thể là view/frontend/layout/customer_account.xml với đường dẫn là các id thẻ section/resource/group để xác nhận khối layout được bật tắt.
```
<?xml version="1.0"?>
<!--
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
-->
<page xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" layout="2columns-left" xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd" label="Customer My Account (All Pages)" design_abstraction="custom">
    <body>
        <referenceBlock name="customer_account_navigation">
            <block class="Magento\Customer\Block\Account\SortLinkInterface" name="customer-question-navigation" ifconfig="question_pending/question/is_enabled">
                <arguments>
                    <argument name="label" xsi:type="string" translate="true">My Question</argument>
                    <argument name="path" xsi:type="string">qanda/customer</argument>
                    <argument name="sortOrder" xsi:type="number">210</argument>
                </arguments>
            </block>
        </referenceBlock>
    </body>
</page>

```
