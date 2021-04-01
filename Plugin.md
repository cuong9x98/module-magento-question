# Ok Stat Plugin
	- Cho phép custom bất kì phương thức nào trong core magento 2 mà không ảnh hưởng đến lớp cha khác với preference cho phép ghi đè phương thức
## Khởi tạo 
### 1.Đầu tiên, chúng ta phải khai báo plugin trong etc\frontend\file di.xml 
```
	<?xml version="1.0"?>
<!-- Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider -->
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:ObjectManager/etc/config.xsd">
    <type name="Magento\Catalog\Model\Product">
        <plugin name="cache_price1" type="AHT\Question\Plugin\Product2" sortOrder="10" />
    </type>

    <type name="Magento\Catalog\Model\Product">
        <plugin name="cache_price2" type="AHT\Question\Plugin\Product1" sortOrder="20" />
    </type>

    <type name="Magento\Catalog\Model\Product">
        <plugin name="cache_price3" type="AHT\Question\Plugin\Product3" sortOrder="30" />
    </type>
</config>
```
- Chú ý : 
	+ type name là namespace của class mình tác động  vào 
	+ plugin name là tên plugin chú ý các plugin phải có tên khác nhau thì thuộc tính sortOrder mới họat động.
	+ plugin type là namespace plugin của chúng ta
	+ sortOrder là độ ưu tiên của plugin trong đó sortOrder nhỏ sẽ chạy trước.

### 2.Tiếp theo, chúng ta tạo các file Product1.php, Product2.php, Product3.php trong thư mục Plugin của module mình
```
	<?php
		namespace AHT\Question\Plugin;

		use Magento\Framework\Interception;

		class Product1
		{
		   public function afterGetPrice(\Magento\Catalog\Model\Product $subject, $result)
		   {
		    return $result + 100;
		   }
		}
```
```
	<?php
		namespace AHT\Question\Plugin;

		use Magento\Framework\Interception;

		class Product2
		{
		   public function aroundGetPrice(\Magento\Catalog\Model\Product $subject, callable $proceed)
		   {

		      $result = $proceed(); /// Proceed cua callable dung de nhan lai gia tri tra ve cua phuong thuc khi chay xong phan befoce vs around(firts) => lay ket qua tra ve de thuc hien tiep cac around(s), after.
		      return $result + 500;
		   }
		}
```
```
	<?php
		namespace AHT\Question\Plugin;

		use Magento\Framework\Interception;

		class Product3
		{
		   public function afterGetPrice(\Magento\Catalog\Model\Product $subject, $result)
		   {
		    return $result + 300;
		   }
		}
```
- Chạy lại c:c
- Chú ý:
	+ Befoce là thay đổi tham số đầu vào của phương thức,after là thay đổi kết quả trả về của phương thức, around là cả hai vừa thay đổi tham số đầu vào và thay đổi giá trị trả về.
	+ Luồng chạy của các plugin sẽ chạy vào plugin có sortOrder nhỏ nhất trong plugin sẽ chạy befoce trc sau đó chạy around (f), tiếp theo mới chạy đến Plugin tiếp theo tương tự như thế. Khi chạy hết các befoce với around (f) thì sẽ chạy code chính của các phương thức . Tại plugin cuối cùng sẽ chạy around (s) rồi chạy after. Tiếp theo sẽ chạy đến các Plugin tiếp theo từ softorder cao đến thấp.
	+ Từ luồng chạy trên có thể kết luận khi hai plugin cùng tác động đến 1 phương thức thì chúng sẽ cập nhật kết quả trả về của từng phương thức . Trong trường
 hợp này thì chúng cộng dồn các kết quả trả về giá sản phầm.

### 3.Tạo Module mới cùng tác động lên phương thức 
```
<?xml version="1.0"?>
<!-- Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider -->
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:ObjectManager/etc/config.xsd">
    <type name="Magento\Catalog\Model\Product">
       <plugin name="cache_price" type="AHT\Test\Plugin\Product" sortOrder="40" />
   </type>
</config>
```
- Chú ý:
	+ Module nào chạy trc thì plugin đó sẽ được chạy trc.Chúng ta có thể xem module nào chạy trước bằng cách vào file config trong etc.
	+ Chú ý : trong trường hợp này vẫn sẽ cộng dồn kết quả trả về.