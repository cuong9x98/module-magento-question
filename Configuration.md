# Configuration.
- Đây là nơi người quản trị có thể thiết lập các cài đặt của mình trên trang web. Là lập trình viên bản thân chúng ta chắc chắn phải biết đến tất cả các tab trong này để về sau khách hàng yêu cầu chỉnh sửa nào đó thì chúng ta có thể tìm ra cách nhanh nhất để giải quyết bài toán mà không cần phải customer lại.

## 1.GENERAL 
- Đây là những thiết lập chung cho người quản trị có thể làm được.

### a.General
- Chứa các thiết lập chung nhất bao gồm;
	+ Country Options : Tùy chọn Quốc gia xác định quốc gia nơi doanh nghiệp của bạn đặt trụ sở và các quốc gia mà từ đó bạn chấp nhận thanh toán.
		++ Default Country : Quốc gia mặc định.
		++ Alllow Countries : Các quốc giá khác bạn chấp nhận đơn đặt hàng.
		++ Zip/Postal Code is Optional for	:  nơi bạn tiến hành hoạt động kinh doanh không yêu cầu bao gồm mã ZIP hoặc mã bưu chính như một phần của địa chỉ đường phố.
		++ European Union Countries : quốc gia trong Liên minh Châu Âu nơi bạn tiến hành hoạt động kinh doanh.
		++ Top destinations	: ác quốc gia chính mà bạn nhắm mục tiêu để bán hàng.
	+ State Options : Lựa chọn trạng thái.
		++ State is Required for : Các quốc gia nơi bạn tiến hành hoạt động kinh doanh yêu cầu bao gồm khu vực hoặc tiểu bang trong địa chỉ bưu điện.
		++ Allow to Choose State if It is Optional for Country : Đối với các quốc gia không bắt buộc, hãy xác định xem trường Khu vực / Tiểu bang có được bao gồm trong địa chỉ bưu điện của khách hàng hay không.Có - Bao gồm trường Khu vực / Tiểu bang trong địa chỉ khách hàng, ngay cả khi quốc gia không yêu cầu.Không - Bỏ qua trường Khu vực / Tiểu bang khỏi địa chỉ khách hàng nếu quốc gia không yêu cầu.
	+ Locale Options : Chọn ngôn ngữ , múi giờ.
		++ Timezone : Múi giờ 
		++ Locale : Ngôn ngữ 
		++ Weught Unit: Đơn vị trọng lượng
		++ First Day of Week : Ngày đầu tuần. => Quy định ngày cuối tuần của hệ thống. 
		++ Weedkend Days : Ngày cuối tuần. => Quy định ngày cuối tuần của hệ thống.
	+ Store Information : Thông tin của cửa hàng. Các bạn có thể lấy thông tin  cửa hàng bằng cacsh làm theo đường dẫn: 	https://www.mageplaza.com/devdocs/how-get-store-information-magento-2.html. Các bạn có thể xem thông tin các bạn lưu lại ở đây bằng cách xem bản mẫu thư điện tử của magento Marketing->Email Templates-> Tại mục Template chọn bất kì bản mẫu nào sao đó bạn chạy lên và click vào  Preview Templates để xem trc lúc đó các bạn có thể xem thấy thông tin của store bạn vừa config.
		++ Store Name : Tên của hàng.
		++ Store Phone Number : Số điện thoại cửa hàng.
		++ Store Hours of Opreration : Giờ hoạt động của cửa hàng 
		++ Count try: Quốc gia.
		++ Region/State : Vùng tiểu bang 
		++ Zip/Postal Code: mã bưu điện
		++ City : tên thành phố
		++ Street Address: Địa chỉ thứ nhất của cửa hàng 
		++ Street Address line 2: Địa chỉ thứ hai của cửa hàng.
		++ VAT Number: Mã số thế .
	+ Single-Store Mode: Chế độ 1 của hàng 
		++ Enable Single- Store Mode : Bật chế độ 1 của hàng . Cài đặt này sẽ không có hiệu quả nếu cửa hàng có sẵn nhiều cửa hàng. 


