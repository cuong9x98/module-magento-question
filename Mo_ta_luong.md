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
	- 
