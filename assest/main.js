const searchBtn = document.querySelector('.icon-header-js');
const closeBtn = document.querySelector('.icon-close-js');
const headerSearch = document.querySelectorAll('.header-search-js');

// hàm hiển thị search
function showSearch() {
    headerSearch.forEach(function(item){
        item.classList.add('open')
    })
    hideIconSearch(); // Đảm bảo biểu tượng được cập nhật thành close khi hiển thị tìm kiếm
}

// hàm ẩn search
function hideSearch() {
    headerSearch.forEach(function(item){
        item.classList.remove('open')
    })
    hideIconClose(); // Đảm bảo biểu tượng được cập nhật thành search khi ẩn tìm kiếm
}

// hàm này đổi icon search thành icon close
function hideIconSearch() {
    searchBtn.classList.remove('fa-magnifying-glass');
    searchBtn.classList.add('fa-xmark');
}

//hàm này đổi icon close thành icon search
function hideIconClose() {
    searchBtn.classList.remove('fa-xmark');
    searchBtn.classList.add('fa-magnifying-glass');
}
// hàm click nút search
searchBtn.addEventListener('click', function() {
    if (headerSearch[0].classList.contains('open')) { // Kiểm tra nếu thanh tìm kiếm đã mở
        hideSearch();
    } else {
        showSearch();
    }
});

// bag shoping
const bagBtn = document.querySelector('.icon-shoping-js');
const shopingBag = document.querySelector('.header-bag-js');
const closeShoping = document.querySelector('.close-icon-js')
function showShoping(){
    shopingBag.classList.add('active')
}

function hideShoping(){
    shopingBag.classList.remove('active')
}

bagBtn.addEventListener('click', showShoping);
closeShoping.addEventListener('click', hideShoping);

// animation khi bắt đầu cuộn chuột
const navigation = document.querySelector('.navigation');
const logo = document.querySelector('.header-logo');

// thêm sự kiện cuộn trang
window.addEventListener('scroll', function() {
    // Nếu cuộn trang xuống hơn 80px thì thêm lớp 'shrink'
    if (window.scrollY > 80) {
        navigation.classList.add('shrink');
        logo.classList.add('shrink');
    } else {
        // Ngược lại, loại bỏ lớp 'shrink' ở cả 2 dối tượng
        navigation.classList.remove('shrink');
        logo.classList.remove('shrink');
    }
});

// hàm navigation-mobile and tablet
const barbtn = document.querySelector('.icon-header-bar')
const modal = document.querySelector('.navigation-mobile')
const modalContainer = document.querySelector('.navigation-container-js')
const closeModal = document.querySelector('.mobile-icon-close')

//hàm hiển thị modal
function showModal() {
    modalContainer.classList.add("active")
}

//hàm ẩn modal
function hideModal() {
    modalContainer.classList.remove("active")
}

//lắng nghe hành vi click 
barbtn.addEventListener('click',showModal);

//lắng nghe hành vi nút close
closeModal.addEventListener('click', hideModal);

modalContainer.addEventListener('click', hideModal)

modal.addEventListener('click',function(event){
    event.stopPropagation();
})


// lấy dữ liệu của các product về
// chọn tất cả các class product
const productList = document.querySelectorAll('.product'); 

productList.forEach(function(product){
        // lắng nghe sự kiện click khi click vào 1 đối tượng product
        product.addEventListener('click', function(event) {
        
        // lấy dữ liệu từ product và gán váo biến
        const productName = this.querySelector('.product-name').textContent;
        const productPrice = this.querySelector('.product-price').textContent;
        const productImage = this.querySelector('.product-img').getAttribute('src');
        const productType = this.querySelector('.product-type').textContent;
        const productAmount = this.querySelector('.product-amount').textContent;
        
        //tạo 1 object product data
        const productData = {
            name: productName,
            price: productPrice,
            image: productImage,
            type: productType,
            amount: productAmount
        };
        
        // lưu trự vào biến local storage
        localStorage.setItem('selectedProduct', JSON.stringify(productData));
    });
});

// khai báo biến url gán giá trị địa chỉ của màn hình
const url = window.location.href
// kiểm tra xem có đang ở trang DetailProduct.html 
if(url.includes('DetaiProduct.html')){
    // lấy dữ liệu lưu trữ vào biến local storage
    const storedProductData = JSON.parse(localStorage.getItem('selectedProduct'));
    // lấy giá trị từ object stored productData và gán vào từng biến khởi tạo
    const productNameElement = document.querySelector('.product-detail-name');
    productNameElement.textContent = storedProductData.name;
    
    const productImageElement = document.querySelector('.product-img');
    productImageElement.setAttribute('src', storedProductData.image);
    
    const productTypeElement = document.querySelector('.product-detail-type');
    productTypeElement.textContent = storedProductData.type;
    
    const productPriceElement = document.querySelector('.product-detail-price');
    productPriceElement.textContent = storedProductData.price;
    
    const productamountElement = document.querySelector('.product-detail-amount')
    productamountElement.textContent = storedProductData.amount;

    
    // + - số lượng món ăn
    var quantityInput = document.getElementById('quantity');
    var currentValue = parseInt(quantityInput.value);
    // + - số lượng món ăn
    // Lấy thẻ input và giá trị hiện tại của nó
    // Hàm tăng giảm giá trị
    function increaseQuantity() {
        currentValue += 1;
        quantityInput.value = currentValue;
    }
    
    //hàm giảm giá trị
    function decreaseQuantity() {
        if (currentValue > 1) {
            currentValue -= 1;
            quantityInput.value = currentValue;
        }else{
            alert("số lượng không thể bé hơn 1");
        }
    }
}

if(url.includes('index.html')){
    // chuyển động cho ảnh img-story
    const listImg = document.querySelector(".list-img-story");
    const imgs = document.querySelectorAll(".image-story");
    const btnLeft = document.querySelector(".btn-left");
    const btnRight = document.querySelector(".btn-right");

    const length = imgs.length
    let current  = 0;
    
    const handleChangeSlide = function(){
        if(current == length-1){
            current = 0;
            listImg.style.transform =`translateX(${0}px)`
            document.querySelector(".index-item.active").classList.remove('active')
            document.querySelector('.index-item-'+current).classList.add('active')
        }else{ 
            current ++;
            let width = imgs[0].offsetWidth;
            width += 12;
            listImg.style.transform =`translateX(${width * -1 * current}px)`
            document.querySelector(".index-item.active").classList.remove('active')
            document.querySelector('.index-item-'+current).classList.add('active')
        }
    }

    let handleEventChangeSlide = setInterval( handleChangeSlide , 3000) // loop

    btnRight.addEventListener('click',function(){
        clearInterval(handleEventChangeSlide)
        handleChangeSlide();
        handleEventChangeSlide = setInterval(handleChangeSlide , 3000 )
    })

    btnLeft.addEventListener('click',function(){
        clearInterval(handleEventChangeSlide)
        if(current == 0){
            console.log(current)
            let width = imgs[0].offsetWidth;
            width += 12;
            listImg.style.transform =`translateX(${width * -1 * current}px)`
            document.querySelector(".index-item.active").classList.remove('active')
            document.querySelector('.index-item-'+current).classList.add('active')
        }else{ 
            current --;
            let width = imgs[0].offsetWidth;
            width += 12;    
            listImg.style.transform =`translateX(${width * -1 * current}px)`
            document.querySelector(".index-item.active").classList.remove('active')
            document.querySelector('.index-item-'+current).classList.add('active')
        }
        handleEventChangeSlide = setInterval(handleChangeSlide , 40000 )
    })
}


// xử lý sự kiện header-search
document.addEventListener('DOMContentLoaded', function () {
    const inputSearch = document.querySelector('.input-search-js');
    const searchResults = document.querySelector('.search-results');

    // Dữ liệu mẫu của danh sách món ăn (có thể thay bằng dữ liệu thực tế)
    const foodItems = [
        'CÁNH GÀ 2 VỊ',
        'GÀ RÁN NỬA CON',
        'GÀ RÁN SỐT NƯỚC TƯƠNG',
        'CÁNH GÀ 3 VỊ',
        'GÀ RÁN KHÔNG XƯƠNG',
        'GÀ RÁN SỐT HÀNH PANDAK - 2 VỊ',
        'GÀ SỐT NGỌT',
        'KHOAI TÂY CHÊN',
        'HÀNH TRỘN',
        'SALAD DẦU GIẤM',
        'GÀ VIÊN',
        'KEM TƯƠI',
        'BÁNH TRỨNG',
        'PHÔ MAI QUE'
    ];

    // Xử lý sự kiện khi người dùng nhập vào ô tìm kiếm
    inputSearch.addEventListener('input', function () {
        const searchTerm = inputSearch.value.trim().toLowerCase();
        // pt filter lọc mãng thỏa điều kiển và trả về 1 mảng mới
        const filteredFoodItems = foodItems.filter(function(item){
            return item.toLowerCase().includes(searchTerm) //hàm includes xử lý xem mỗi mục có chứa searchterm hay không nếu có thì trả về phần tử
                                                           // và tạo ra mảng mới từ phương thức filter
        });
        
        // Hiển thị danh sách kết quả tìm kiếm
        renderSearchResults(filteredFoodItems);
    });

    // Xử lý sự kiện khi người dùng xóa nội dung trong ô tìm kiếm
    inputSearch.addEventListener('keyup', function (event) {
        if (inputSearch.value.trim() === '') {
            searchResults.innerHTML = ''; // Xóa danh sách kết quả tìm kiếm khi input rỗng
        }
    });


    // Xử lý sự kiện khi click ra ngoài ô tìm kiếm
    document.addEventListener('click', function (event) {
        if (!event.target.closest('.header-search')) {
            searchResults.innerHTML = ''; // Xóa danh sách kết quả tìm kiếm khi click ra ngoài
        }
    });

    // Hàm hiển thị danh sách kết quả tìm kiếm
    function renderSearchResults(results) {
        if (results.length) {
            const html = results.map(function(item){
                return `<div class="search-item">${item}</div>`
            }).join('');
            searchResults.innerHTML = html;
        } else {
            searchResults.innerHTML = '<div class="search-item">Không có kết quả</div>';
        }
    }
});