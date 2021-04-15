# Ok Chúng ta sẽ đi mô tả các chức năng các mục trong quá trình làm
## 1.Model
	- file Model/ResourceModel/Question/Collection.php có tác dùng cho phép truy vấn nhiều bản ghi theo 1 điều kiện cho phép. Các bạn phải hiểu model của magento theo chuẩn của ORM nên sẽ có CROD mà READING thì chỉ có thể đọc được 1 bản ghi nên bắt buộc magento phải ccó thêm Collection để hỗ trợ cho việc truy vấn nhiều đối tượng 

	- Vậy còn file Model/ResourceModel/Question/Grid/Collection.php dùng để làm gì. Các bạn để ý lớp Collection kế thừa từ UI/Component nên nó sẽ được sử dụng cho UI/Component. Ở đây, do giao diện của mình sử dụng ui/component nên để giao diện có thể hiểu dữ liệu đổ vào giao diện thì bạn phải có file Collection hỗ trợ cho việc đổ dữ liệu vào giao diện. Các có thể thấy trong file di.xml chúng ta phải 'tiêm' Collection để giao diện có thể hiểu.
	- file Model/Question.php sẽ làm việc với Db thông qua file Resource Model nó sẽ gọi đến Model/ResourceModel/Question.php
	- Model/ResourceModel/Question.php gọi phương thức truyền 2 đối số tên bảng và khóa chính, không thực hiện bất kì truy vấn nào. Nó extend đến AbstractDb có chứa các CRUD
	- Facetory là gì ?? Các bạn cứ hiểu nó là 1 bản nháp do Magento tự động tạo ra để chúng ta có thể làm việc với nó.

## 2.Block 
	- Các bạn còn nhớ các xuất dữ liệu trong phần làm theme chứ.Chúng ta có layout và trong layout có container là  bộ khung trong đó có templates và block (trong đó templates là các html r,còn block là dữ liệu) => Block có tác dụng đổ dữ liệu vào layout. Chúng ta không thế sử dụng trực tiếp dữ liệu của Model nên phải sử dụng thông qua Block trong hợp này chúng ta có ui/componet nên sẽ được khai báo trong đấy.

## 3.Controlller 
	- Là nơi xử lí chính của các request.
	- Khi chúng ta tạo menu các action a/b/c thì magento sẽ cắt chuỗi tìm đến thư mục Controller/b/c tương ứng chạy vào đấy.
## 4.view 
	- Chứa các file view phía admin và clien của module.
## 5.Api
	- Cho phép các ứng dụng các sử dụng được tài nguyên của hệ thống chúng ta.

## 6.Helper
	- Duoc su dung nham muc dich tao ra nhung phuong thuc co the tai su dung nhieu lan . Cac controller hay model hay phtml deu co the su dung cac ham trong helper, tiet kiem tai nguyen.
## 7.Widget
	- Là 1 dạng nâng cấp của Block giúp cho người quản trị có thể thay đổi được mà không cần vào trong code. Về bản chất Widget là 1 BLock nhưng được thêm các opiton để nhận dữ liệu thay đổi các kết quả trả về.

# Bây giờ mình sẽ mô tả luồng .

 - thiếu xót gì ae bổ sung thêm và luôn.
Sơ qua về luồng trong index.php 
	+ Apache hay webserve bao giờ cũng sẽ tìm đến file index.php hoặc index.html (Thuộc cấu hình của serve) . 
điển hình là .htaccess .
	+ Có "" DirectoryIndex index.php "" mặc định sẽ vào index file
	+ Có "' RewriteEngine on "" viết lại cái url cho thân thiên . không còn url?php== index.php
 - Tất cả các Request sẽ đều qua Application entry point (design pattern Frontend Controller)
đều phải tuân theo Frontend Controller. 
Ở đây Application entry point : 
- App là 1 ứng dụng . nó giống một hàm main trong C, Java mọi thứ đều đi qua đây .
 index sẽ gọi bootstrap.php nó sẽ boot những tài nguyên ban đầu 
	+ Đầu tiên sẽ check version php .
	require autoload.php 
	+ tất nhiên là autoload composer để phục vụ cho việc được sử dụng use và namespace 
 - $bootstrap in index.php 
	+ Khởi tạo đường dẫn đến thư mục gốc hiện tại .phương thức Bootstrap::create(BP, $_SERVER)  ở đây :
-BP đây là $rootDir - Base Path , 
di.xml
 - $_SERVER ở đây được tạo bởi ObjectManagerFactory khi OMF làm việc thì nó sẽ đọc cái di.xml chung của hệ thống (Tức là thằng file xml là file phi cấu trúc nên nó sẽ gom tất cả các các thằng di.xml con trong các module lại vào đây chạy mà ko ảnh hưởng gì cả). Tiếp theo nó sẽ tạo hết những cái Obj (Những cái thẻ  <type> í, đây là các lớp sẽ tạo ra các đối tượng dựa trên cấu hình của nó )
 - $app in index.php
 - Tạo App ở đây là Magento\Framework\App\Http trong App có khá là nhiều loại , Ở đây là tạo ứng dụng dạng web (Htttp) để đáp ứng các request dạng http
$bootstrap->run($app);
 - Gọi thằng đối tượng Http ở trên vào hàm bootstrap này:
	+ Phương thức của run(AppInterface $application) nhưng được truyền vào = 1 Obj (Tính đa hình ) . Hiểu đơn giản là khởi tạo những cái cần thiết của ứng dụng Magento lên .
 - Khi Magento được chạy thì nó sẽ khởi tạo ObjectManager và nó có nhiệm vụ là khởi tạo các Object khác dựa vào file di.xml đã được tổng hợp các file di.xml trong module .Các bạn có thể hiểu rằng di.xml nó như 1 cái danh sách các công việc của ObjectManager phải làm . Nếu khởi tạo 1 đối tượng mà cần các đối tượng khác thì nó sẽ tạm thời đi khởi tạo các đối tượng kia. Nếu thời gian khởi tạo quá lâu hay bị vòng lặp thì trong magento có Proxy giúp cho quay trở lại ObjectManager, các bạn có thể vào trong file di.xml tìm từ khóa Proxy sẽ thấy.
## Luồng trong Module .
 - Các  request sẽ qua bộ lọc router trước (front và back) .
	+ ví dụ : Request . product/item/index
	+ Thì cái frontName của request[1] trên là product nó sẽ so tất cả với các router và nếu khớp thì nó sẽ tìm được đến Module của bạn .
rồi tiếp theo sẽ vào controller folder rồi kiểm tra request[2]. 
Action.php và tiếp theo sẽ check request tiêp theo tương đương vs các Action thì các file trong controller đều được kế thừa từ Action.php trong core . 
và đây là nơi để điều hướng tùy theo mục đích nếu ko nó sẽ auto cho đổ sang view.
Từ phần này là trên slide là có hết rồi nhé . nên nói qua.
View 
layout và default.xml
Kết quả $resultPage trong Action trên sẽ trả sang view rồi vào layout folder. Và layout sẽ dựa vào tham số của url .(frontname, controller name, action ). để tìm đây là config layout . Nếu ko tìm thấy thì vẫn hiển thì bình thường . Mặc dù file default.xml ko hiện hữu ở đây nhưng lúc nào nó cũng tồn tại trong tim người code và nó sẽ được load ra . Đây là page layout
- Trong layout đầu tiên phải gọi ra 1 cái container . và nó sẽ gọi các block và template .Block lấy dữ liệu từ Model
lấy dữ liệu từ module nào thì chỉ cần tiêm 1 cái Factory vào đây . rồi trôn với template để lấy dữ liệu ra ,pub/static

mọi thứ được render ra đây . 
var/cache

di.xml
Nói chi tiết hơn về cái di.xml ở trên : 
Tuần theo design pattern dependency injection . 
Khi tạo ra cac ObjectManager rồi ............