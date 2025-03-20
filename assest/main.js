


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