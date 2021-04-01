# ok Start Acl
	- Cho phép phân các chức năng riêng biệt cho các tài khoản riêng biệt.
## Đầu tiên, chúng ta khởi tạo file acl.xml trong etc để tạo mục role
```
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:Acl/etc/acl.xsd">
   <acl>
        <resources>
            <resource id="Magento_Backend::admin">
                <resource id="AHT_Question::question" title="Use ACL" sortOrder="100">
                    <resource id="AHT_Question::index" title="Question" sortOrder="10"/>
                </resource>
            </resource>
        </resources>
    </acl>
</config>
```
- Chú ý:
	+ resource id là id của menu 
	+ đoạn code trên sẽ khai báo ra role trong system/role user/new user/role resource
	
- Chúng ta chạy php bin/magento c:c 

## Tiếp theo chúng ta tạo thêm 2 tài khoản ở system/role user/new user/role resource với 2 chức danh chúng ta tạo 

## Cuối cùng, check login user xem tài khoản mới của chúng ta đã được phân quyền chưa. 
